<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Article'), ['action' => 'edit', $article->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Article'), ['action' => 'delete', $article->id], ['confirm' => __('Are you sure you want to delete # {0}?', $article->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Articles'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Article'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="articles view content">
            <h3><?= h($article->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($article->id) ?></td>
                </tr>

<?php foreach($langs as $lang){ ?>
					<tr>
						<th><?= __('Locale') ?> (<?= $lang->name ?>)</th>
						<td><?= h($article->_translations[$lang->lang]->locale ?? "") ?></td>
					</tr>
					<tr>
						<th><?= __('Title') ?> (<?= $lang->name ?>)</th>
						<td><?= h($article->_translations[$lang->lang]->title ?? "") ?></td>
					</tr>
<?php } ?>

				<tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($article->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($article->modified) ?></td>
                </tr>
            </table>
			
<?php foreach($langs as $lang){ ?>
            <div class="text">
                <strong><?= __('Body') ?> (<?= $lang->name ?>)</strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($article->_translations[$lang->lang]->body ?? "")); ?>
                </blockquote>
            </div>
<?php } ?>

        </div>
    </div>
</div>
