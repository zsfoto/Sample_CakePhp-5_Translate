<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
 * @var \Cake\Collection\CollectionInterface|string[] $langs
 */
	//dd($langs);
	//dd($langs->toArray());
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Articles'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="articles form content">
            <?= $this->Form->create($article) ?>
            <fieldset>
                <legend><?= __('Add Article') ?></legend>
                <?php
                    //echo $this->Form->control('lang_id', ['options' => $langs]);
					foreach($langs as $lang){
						//dd($lang);
						echo $this->Form->control('_translations.' . $lang->lang . '.title', ['label' => 'Cím ('    . $lang->name . ')']);
						echo $this->Form->control('_translations.' . $lang->lang . '.body' , ['label' => 'Szöveg (' . $lang->name . ')']);
					}
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
