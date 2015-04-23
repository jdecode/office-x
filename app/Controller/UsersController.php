<?php

App::uses('AppController', 'Controller');

/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

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
				'admin_dashboard',
				'admin_logout',
				'admin_index',
				'admin_view',
				'admin_add',
				'admin_delete',
				'admin_userlist',
				'admin_changepassword',
				'admin_clogin',
				'admin_slogin',
			),
			'staff' => array(
				'staff_dashboard',
				'staff_changepassword',
				'staff_logout',
			),
			'client' => array(
				'client_dashboard',
				'client_changepassword',
				'client_logout',
			),
		);
		$this->_deny_url($this->_deny);
	}

	/**
	 * index method
	 *
	 * @return void
	 */
	public $components = array('Paginator');

	public function admin_index() {
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}

	function _load_view($id) {
		//$this->layout = 'admin';
		$this->loadModel('Message');
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		} else {
			$this->set('user', $this->User->read(null, $id));
			$this->set('document', $this->Message->find('all', array('conditions' => array('Message.user2id' => $id))));
			//$this->loadModel('Upload');
			//$this->set('upload', $this->Upload->find('all', array('conditions' => array('user_id' => $this->User->id))));
		}
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
		$this->_load_view($id);
	}

	/**
	 * view method
	 *
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		$this->_load_view($id);
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		$groups = $this->User->Group->find('list');
		$departments = $this->User->Department->find('list');
		$this->set(compact('groups', 'departments'));
	}

	/**
	 * Admin user's dashboard
	 */
	function admin_dashboard() {
		$this->log('From within admin_dashboard');
		$this->layout = 'admin_dashboard';
		if ($this->request->is('post')) {
			//pr($this->request->data);
			$user = array('User' => array('active' => 1));
			$user['User']['first_name'] = $this->request->data['User']['first_name'];
			$user['User']['last_name'] = $this->request->data['User']['last_name'];
			$user['User']['email'] = $this->request->data['User']['email'];
			$user['User']['password'] = sha1($this->request->data['User']['password']);
			if ($this->User->save($user)) {
				$this->Session->setFlash('User has been saved');
				$this->redirect('/admin/dashboard');
			} else {
				$this->Session->setFlash('User could not be saved');
			}
		}
		$this->User->recursive = 0;
		$users = $this->Paginator->paginate('User', array('User.group_id' => 2));
		$this->set('users', $users);
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
		$groups = $this->User->Group->find('list');
		$departments = $this->User->Department->find('list');
		$this->set(compact('groups', 'departments'));
	}

	/**
	 * delete method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash('User deleted', 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('User was not deleted', 'error');
		$this->redirect(array('action' => 'index'));
	}

	public function index() {
		$this->layout = 'home';
		$this->recursive = '0';
		$this->set('file', $this->Upload->find('all', array('conditions' => array('Upload.user_id' => $this->Auth->user('id')))));
	}

	public function dashboard() {
		$this->layout = 'dashboard';
		$this->recursive = '0';
		$this->redirect('/staff/uploads/inbox');
		//$this->set('file', $this->Upload->find('all', array('conditions' => array('Upload.user_id' => $this->Auth->user('id')))));
	}

	public function staff_dashboard() {
		$this->recursive = '0';
		//$this->redirect('/staff/uploads/inbox');
		//$this->set('file', $this->Upload->find('all', array('conditions' => array('Upload.user_id' => $this->Auth->user('id')))));
	}

	public function client_dashboard() {
		$this->recursive = '0';
		//$this->redirect('/client/uploads/inbox');
		//$this->set('file', $this->Upload->find('all', array('conditions' => array('Upload.user_id' => $this->Auth->user('id')))));
	}

	public function admin_userlist() {
		$this->layout = '';
		$this->set('user', $this->User->find('list', array('fields' => array('username'), 'conditions' => array('group_id' => $_POST['g_id']))));
	}

	function login() {
		$this->set('title_for_layout', 'Login');
		//die('login');
		if ($this->_staff_auth_check()) {
			$this->redirect('/staff/dashboard');
		}
		if ($this->_client_auth_check()) {
			$this->redirect('/client/dashboard');
		}
		if ($this->_admin_auth_check()) {
			$this->redirect('/admin/dashboard');
		}
		if ($this->request->is('post')) {
			$user = $this->User->find(
					'first', array(
				'conditions' => array(
					'User.username' => $this->request->data['User']['username'],
					'User.status' => 1,
				),
				'recursive' => -1
					)
			);
			if ($user) {
				if ($user['User']['password'] == sha1($this->request->data['User']['password'])) {
					switch ($user['User']['group_id']) {
						case 1:
							$this->Session->write('admin', $user);
							break;
						case 2:
							$this->Session->write('staff', $user);
							break;
						case 3:
							$this->Session->write('client', $user);
							break;
						default:
							$this->redirect('/login');
							break;
					}

					$this->Session->setFlash('You are now logged in', 'flash_close', array('class' => 'alert-success'));

					$_redirect = @$this->Session->read('redirect');
					if (trim($_redirect) != '') {
						$this->Session->setFlash('Welcome back!', 'flash_close', array('class' => 'alert alert-success'));
						$this->Session->delete('redirect');
						$this->redirect("$_redirect");
					} else {
						$this->Session->setFlash('You are now logged in', 'flash_close', array('class' => 'alert alert-success'));
						switch ($user['User']['group_id']) {
							case ADMIN_GROUP_ID:
								$this->redirect('/admin/dashboard');
								break;
							case STAFF_GROUP_ID:
								$this->redirect('/staff/dashboard');
								break;
							case CLIENT_GROUP_ID:
								$this->redirect('/client/dashboard');
								break;
							default:
								$this->redirect('/login');
						}
					}
				} else {
					$this->check_login_retries();
					$this->Session->setFlash('Incorrect password. Please try again', 'flash_close', array('class' => 'alert alert-error'));
				}
			} else {
				$this->Session->setFlash('User not found, or is inactive', 'flash_close', array('class' => 'alert alert-error'));
			}
		}
	}

	function admin_slogin($admin = 0, $username = '', $password = '') {
		if ($this->_admin_auth_check()) {
			$admin = 1;
		}
		if ($this->_admin_auth_check()) {
			$admin = 1;
		}
		if ($admin) {
			$user = $this->User->find(
					'first', array(
				'conditions' => array(
					'User.username' => base64_decode($username),
					'User.status' => 1,
					'User.group_id  ' => STAFF_GROUP_ID
				),
				'recursive' => -1
					)
			);
			if ($user) {
				if ($user['User']['password'] == base64_decode($password)) {
					$this->Session->write('user', $user);
					$this->Session->setFlash('You are now logged in', 'flash_close', array('class' => 'alert-success'));
					$this->redirect('/staff/dashboard');

					$_redirect = @$this->Session->read('redirect');
					if (trim($_redirect) != '') {
						$this->Session->setFlash('Welcome back!', 'flash_close', array('class' => 'alert alert-success'));
						$this->Session->delete('redirect');
						$this->redirect("$_redirect");
					} else {
						$this->Session->setFlash('You are now logged in', 'flash_close', array('class' => 'alert alert-success'));
						$this->redirect('/staff/dashboard');
					}
				} else {
					$this->check_login_retries();
					$this->Session->setFlash('Incorrect password. Please try again', 'flash_close', array('class' => 'alert alert-error'));
				}
			} else {
				$this->Session->setFlash('User not found, or is inactive', 'flash_close', array('class' => 'alert alert-error'));
			}
		} else {
			throw new NotFoundException('Access violation identified. This instance has been logged and reported to Admin');
		}
	}

	function admin_clogin($admin = 0, $username = '', $password = '') {
		if ($this->_admin_auth_check()) {
			$admin = 1;
		}

		//if ($this->request->is('post'))
		if ($admin) {
			//pr($this->request->data); die;
			$user = $this->User->find(
					'first', array(
				'conditions' => array(
					'User.username' => base64_decode($username),
					'User.status' => 1,
					'User.group_id' => CLIENT_GROUP_ID
				),
				'recursive' => -1
					)
			);
			//pr($user);die;
			if ($user) {
				//echo "hello";die;
				if ($user['User']['password'] == base64_decode($password)) {
					$this->Session->write('client', $user);
					$this->Session->setFlash('You are now logged in', 'flash_close', array('class' => 'alert-success'));
					$this->redirect('/client/dashboard');

					$_redirect = @$this->Session->read('redirect');
					if (trim($_redirect) != '') {
						$this->Session->setFlash('Welcome back!', 'flash_close', array('class' => 'alert alert-success'));
						$this->Session->delete('redirect');
						$this->redirect("$_redirect");
					} else {
						$this->Session->setFlash('You are now logged in', 'flash_close', array('class' => 'alert alert-success'));
						$this->redirect('/client/dashboard');
					}
				} else {
					$this->check_login_retries();
					$this->Session->setFlash('Incorrect password. Please try again', 'flash_close', array('class' => 'alert alert-error'));
				}
			} else {
				$this->Session->setFlash('User not found, or is inactive', 'flash_close', array('class' => 'alert alert-error'));
			}
		} else {
			throw new NotFoundException('Access violation identified. This instance has been logged and reported to Admin');
		}
	}

	function check_login_retries() {
		
	}

	/**
	 * logout method
	 *
	 * @return void
	 */
	public function logout() {
		$_user = $this->logged_in_user;
		if ($_user) {
			if (isset($_user['id']) && is_numeric($_user['id'])) {
				switch ($_user['group_id']) {
					case 1:
						$this->redirect('/admin/logout');
						exit();
						break;
					case 2:
						$this->redirect('/staff/logout');
						exit();
						break;
					case 3:
						$this->redirect('/client/logout');
						exit();
						break;
					default:
					//
				}
			}
		}
		//$this->Session->setFlash('You are now logged out.', 'flash_close', array('class' => 'alert alert-success'));
		//$this->redirect('/login');
	}

	/**
	 * Admin logout method
	 *
	 * @return void
	 */
	function admin_logout() {
		$this->Session->delete('admin');
		$this->Session->setFlash('You are now logged out.', 'flash_close', array('class' => 'alert alert-success'));
		$this->redirect('/login');
	}

	/**
	 * Staff logout method
	 *
	 * @return void
	 */
	function staff_logout() {
		$this->Session->delete('staff');
		$this->Session->setFlash('You are now logged out.', 'flash_close', array('class' => 'alert alert-success'));
		$this->redirect('/login');
	}

	/**
	 * Client logout method
	 *
	 * @return void
	 */
	function client_logout() {
		$this->Session->delete('client');
		$this->Session->setFlash('You are now logged out.', 'flash_close', array('class' => 'alert alert-success'));
		$this->redirect('/login');
	}

	public function admin_changepassword() {
		$this->_changepassword();
	}

	public function client_changepassword() {
		$this->_changepassword();
	}

	public function staff_changepassword() {
		$this->_changepassword();
	}

	private function _changepassword() {
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->User->id = $this->logged_in_user['id'];
			$this->User->recursive = -1;
			$password = $this->User->find('first', array('conditions' => array('User.id' => $this->User->id)));
			//debug($password);
			if (empty($this->request->data['User']['old_password'])) {
				$this->Session->setFlash("Please Enter your Old Password");
				$this->redirect(array('controller' => 'Users', 'action' => 'changepassword'));
			} else if (empty($this->request->data['User']['new_password'])) {
				$this->Session->setFlash("Please Enter your New Password");
				$this->redirect(array('controller' => 'Users', 'action' => 'changepassword'));
			} else if (sha1($this->request->data['User']['old_password']) != $password['User']['password']) {
				//debug(AuthComponent::password($this->request->data['User']['old_password'])); exit;
				$this->Session->setFlash("Your old password did not matched.");
				$this->redirect(array('controller' => 'Users', 'action' => 'changepassword'));
			} else if ($this->request->data['User']['new_password'] != $this->request->data['User']['conf_password']) {
				$this->Session->setFlash("Confirm Password mismatch.");
				$this->redirect(array('controller' => 'Users', 'action' => 'changepassword'));
			} else {
				$password['User']['password'] = sha1($this->request->data['User']['new_password']);
				$this->User->save($password);
				$this->Session->setFlash("Password Changed successfully.");
				$this->redirect('/');
			}
		}
	}

}
