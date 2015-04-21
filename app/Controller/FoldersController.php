<?php
App::uses('AppController', 'Controller');
/**
 * Folders Controller
 *
 * @property Folder $Folder
 * @property PaginatorComponent $Paginator
 */
class FoldersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Folder->recursive = 0;
		$this->set('folders', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Folder->exists($id)) {
			throw new NotFoundException(__('Invalid folder'));
		}
		$options = array('conditions' => array('Folder.' . $this->Folder->primaryKey => $id));
		$this->set('folder', $this->Folder->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Folder->create();
			if ($this->Folder->save($this->request->data)) {
				$this->Session->setFlash(__('The folder has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The folder could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Folder->exists($id)) {
			throw new NotFoundException(__('Invalid folder'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Folder->save($this->request->data)) {
				$this->Session->setFlash(__('The folder has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The folder could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Folder.' . $this->Folder->primaryKey => $id));
			$this->request->data = $this->Folder->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Folder->id = $id;
		if (!$this->Folder->exists()) {
			throw new NotFoundException(__('Invalid folder'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Folder->delete()) {
			$this->Session->setFlash(__('The folder has been deleted.'));
		} else {
			$this->Session->setFlash(__('The folder could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
