<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\I18n\I18n;

/**
 * Articles Controller
 *
 * @property \App\Model\Table\ArticlesTable $Articles
 */
class ArticlesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
		I18n::setLocale('hu');
        $query = $this->Articles->find(); //->contain(['Langs']);
        $articles = $this->paginate($query);

        $this->set(compact('articles'));
    }

    /**
     * View method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		//I18n::setLocale('hu');
        //$article = $this->Articles->get($id);
		$article = $this->Articles->find('translations')->contain([
			//'Categories' => function ($query) {
			//	return $query->find('translations');
			//}
		])->where(['id' => $id])->first();
		$langs = $this->fetchTable('Langs')->find(limit: 200)->where(['visible' => true])->order(['pos' => 'asc', 'name' => 'asc'])->all();
		
        $this->set(compact('article', 'langs'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $article = $this->Articles->newEmptyEntity();
        if ($this->request->is('post')) {
			$data = $this->request->getData();
			//dd($data);			
            $article = $this->Articles->patchEntity($article, $data);
			//dd($article->getErrors());
			//dd($article);			
			foreach ($data['_translations'] as $lang => $data) {
				$article->translation($lang)->set($data, ['guard' => false]);
			}
			//dd($article);
			
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The article could not be saved. Please, try again.'));
        }
		$langs = $this->fetchTable('Langs')->find(limit: 200)->where(['visible' => true])->order(['pos' => 'asc', 'name' => 'asc'])->all();
        $this->set(compact('article', 'langs'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$article = $this->Articles->find('translations')->contain([
			//'Categories' => function ($query) {
			//	return $query->find('translations');
			//}
		])->where(['id' => $id])->first();
		//dd($article);
		//dd($article->translation('de'));
        if ($this->request->is(['patch', 'post', 'put'])) {
			$data = $this->request->getData();
			//dd($data);
            $article = $this->Articles->patchEntity($article, $data);
			//dd($article);
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The article could not be saved. Please, try again.'));
        }
		$langs = $this->fetchTable('Langs')->find(limit: 200)->where(['visible' => true])->order(['pos' => 'asc', 'name' => 'asc'])->all();
        $this->set(compact('article', 'langs'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $article = $this->Articles->get($id);
        if ($this->Articles->delete($article)) {
            $this->Flash->success(__('The article has been deleted.'));
        } else {
            $this->Flash->error(__('The article could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
