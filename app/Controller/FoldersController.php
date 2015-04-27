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
	 * beforeFilter method
	 */
	function beforeFilter() {
		parent::beforeFilter();
		/**
		 * Stores array of deniable methods, without logging in.
		 */
		$this->_deny = array(
			'admin' => array(
				'_admin_index',
				'admin_index',
				'admin_staff',
				'admin_clients',
				'admin_view',
				'admin_add',
				'admin_delete',
				'admin_update_status',
			),
			'staff' => array(
				'staff_view',
				'staff_add'
			),
			'client' => array(
				'client_view',
				'client_add'
			),
		);
		$this->_deny_url($this->_deny);
	}

	public $components = array('Paginator');

	/**
	 * admin_index method
	 *
	 * @return void
	 */
	public function _admin_index($type = 0) {
		$this->Folder->recursive = 0;
		if ($type) {
			$this->Paginator->settings = array('conditions' => array('Folder.type' => $type));
		}
		$this->set('folders', $this->Paginator->paginate());
		$this->set('_type', $type);
	}

	public function admin_index() {
		//$this->_admin_index();
	}

	public function admin_all() {
		$this->_admin_index(1);
	}

	public function admin_staff() {
		$this->_admin_index(2);
	}

	public function admin_clients() {
		$this->_admin_index(3);
	}

	/**
	 * admin_view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = 0) {
		$this->_admin_index($id);
	}

	/**
	 * non_admin_index method
	 *
	 * @return void
	 */
	public function _non_admin_index($type = 0) {
		$this->Folder->recursive = 0;
		if ($type)
		{
			$this->Paginator->settings = array(
				'conditions' => array(
					'Folder.type' => $type,
					'Folder.user_id' => $this->logged_in_user['id'],
					)
				);
			$this->set('folders', $this->Paginator->paginate());
		} else {
			$this->redirect('/logout');
		}
		$this->set('_type', $type);
	}

	/**
	 * staff_view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function staff_view() {
		$this->_non_admin_index(4);
		
	}

	/**
	 * client_view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function client_view() {
		$this->_non_admin_index(5);
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function admin_add() {
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
	 * staff_add method
	 *
	 * @return void
	 */
	public function staff_add() {
		if ($this->request->is('post')) {
			$folder = array('Folder' => array('user_id' => $this->logged_in_user['id'], 'type' => 4));
			$folder['Folder']['name'] = $this->request->data['Folder']['name'];
			$this->Folder->create();
			if ($this->Folder->save($folder)) {
				$this->Session->setFlash(__('The folder has been saved.'), 'success');
				return $this->redirect('/staff/folders/view');
			} else {
				$this->Session->setFlash(__('The folder could not be saved. Please, try again.'), 'error');
			}
		}
	}


	/**
	 * client_add method
	 *
	 * @return void
	 */
	public function client_add() {
		if ($this->request->is('post')) {
			$folder = array('Folder' => array('user_id' => $this->logged_in_user['id'], 'type' => 5));
			$folder['Folder']['name'] = $this->request->data['Folder']['name'];
			$this->Folder->create();
			if ($this->Folder->save($folder)) {
				$this->Session->setFlash(__('The folder has been saved.'), 'success');
				return $this->redirect('/client/folders/view');
			} else {
				$this->Session->setFlash(__('The folder could not be saved. Please, try again.'), 'error');
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

	function admin_update_status($id = null) {
		$return = 0;
		$this->Folder->id = $id;
		if ($this->Folder->exists()) {
			$folder = $this->Folder->read(null, $id);
			if($folder['Folder']['status'] == 0) {
				$return = 1;
				$folder['Folder']['status'] = 1;
			} else {
				$return = 2;
				$folder['Folder']['status'] = 0;
			}
			if(!$this->Folder->save($folder)) {
				$return = 0;
			}
		}
		$this->set('return', $return);
	}
}
