<?php

App::uses('AppController', 'Controller');

class DepartmentsController extends AppController {

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
				'admin_add',
				'admin_edit',
				'admin_index',
				'admin_update_status',
			),
			'staff' => array(
			),
			'client' => array(
			)
		);
		$this->_deny_url($this->_deny);
	}

	public function admin_index() {

		//$this->Upload->recursive = 0;
		$this->set('departments', $this->paginate());
	}

	public function admin_add() {

		if ($this->request->is('post')) {
			if ($this->Department->saveAll($this->request->data)) {
				$this->Session->setFlash('Department has been saved', 'success');
				$this->redirect(array('controller' => 'departments', 'action' => 'admin_index'));
			}
		}
	}

	public function admin_edit($id = null) {

		$this->Department->id = $id;
		if (!$this->Department->exists()) {
			throw new NotFoundException(__('Invalid upload'));
		}if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Department->save($this->request->data)) {
				$this->Session->setFlash('The upload has been saved', 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The upload could not be saved. Please, try again.', 'error');
			}
		} else {
			$this->request->data = $this->Department->read(null, $id);
		}
	}

	function admin_update_status($id = null) {
		$return = 0;
		$this->Department->id = $id;
		if ($this->Department->exists()) {
			$department = $this->Department->read(null, $id);
			if ($department['Department']['status'] == 0) {
				$return = 1;
				$department['Department']['status'] = 1;
			} else {
				$return = 2;
				$department['Department']['status'] = 0;
			}
			if (!$this->Department->save($department)) {
				$return = 0;
			}
		}
		$this->set('return', $return);
	}

}
