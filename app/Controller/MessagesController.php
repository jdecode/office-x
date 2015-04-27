<?php

App::uses('AppController', 'Controller');
App::uses('Document', 'Model');
App::uses('Folder', 'Model');

/**
 * Messages Controller
 *
 * @property Message $Message
 * @property PaginatorComponent $Paginator
 */
class MessagesController extends AppController {

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
				'admin_add',
				'admin_inbox',
				'admin_sent',
				'admin_draft',
				'admin_view',
			),
			'staff' => array(
				'_staff_index',
				'staff_add',
				'staff_inbox',
				'staff_sent',
				'staff_view',
				'staff_draft',
				'staff_folder',
				'staff_custom_folder',
			),
			'client' => array(
				'_client_index',
				'client_add',
				'client_inbox',
				'client_sent',
				'client_draft',
				'client_folder',
				'client_view',
				'client_custom_folder',
			),
		);
		$this->_deny_url($this->_deny);
	}

	public $components = array('Paginator');
	private $message_id = 0;

	/**
	 * _admin_index method
	 *
	 * @return void
	 */
	public function _admin_index($folder_id = 0, $sent = false, $draft = false) {
		if ($sent) {
			$this->Paginator->settings = array(
				'conditions' => array(
					'Message.user_id' => $this->logged_in_user['id'],
					'Message.folder_id !=' => $folder_id,
				),
				'order' => 'Message.id DESC'
			);
		} else if ($draft) {
			$this->Paginator->settings = array(
				'conditions' => array(
					'Message.user_id' => $this->logged_in_user['id'],
					'Message.folder_id' => $folder_id,
				),
				'order' => 'Message.id DESC'
			);
		} else {
			$this->Paginator->settings = array(
				'conditions' => array(
					'Message.user2id' => $this->logged_in_user['id'],
					//'Message.folder_id' => $folder_id,
				),
				'order' => 'Message.id DESC'
			);
		}
		$this->Message->recursive = 0;
		$this->set('messages', $this->Paginator->paginate());
	}

	function admin_inbox() {
		$this->_admin_index();
		$this->set('_label', 'Inbox');
	}

	function admin_sent() {
		$this->_admin_index(0, 1);
		$this->set('_label', 'Sent');
	}

	function admin_draft() {
		$this->_admin_index(0, 0, 1);
		$this->set('_label', 'Drafts');
	}

	/**
	 * _staff_index method
	 *
	 * @return void
	 */
	public function _staff_index($folder_id = 0, $sent = false, $draft = false) {
		if ($sent) {
			$this->Paginator->settings = array(
				'conditions' => array(
					'Message.user_id' => $this->logged_in_user['id'],
					'Message.user2id !=' => 0,
					//'Message.folder_id !=' => $folder_id,
				),
				'order' => 'Message.id DESC'
			);
		} else if ($draft) {
			$this->Paginator->settings = array(
				'conditions' => array(
					'OR' => array(
						array(
						'Message.user_id' => $this->logged_in_user['id'],
						'Message.user2id' => 0,
						'Message.folder_id' => $folder_id,
							),
						array(
						'Message.user2id' => $this->logged_in_user['id'],
						//'Message.user2id' => 0,
						'Message.folder_id' => $folder_id,
						)
						),
				),
				'order' => 'Message.id DESC'
			);
		} else {
			$this->Paginator->settings = array(
				'conditions' => array(
					'Message.user2id' => $this->logged_in_user['id'],
					'Message.folder_id' => $folder_id,
				),
				'order' => 'Message.id DESC'
			);
		}
		$this->Message->recursive = 0;
		//$this->Paginator->settings = array();
		$messages = $this->Paginator->paginate();
		//prx($messages);
		$this->set('messages', $messages);
	}

	function staff_inbox() {
		$this->_staff_index();
		$this->set('_label', 'Inbox');
	}

	function staff_sent() {
		$this->_staff_index(0, 1);
		$this->set('_label', 'Sent');
	}

	function staff_draft() {
		$this->_staff_index(0, 0, 1);
		$this->set('_label', 'Drafts');
	}

	function staff_folder($id = 0) {
		switch($id) {
			case 24:
				$this->_staff_index($id);
				$label = 'Received';
				break;
			case 26:
				$this->_staff_index($id, 0, 1);
				$label = 'Uploaded by Scan';
				break;
			case 27:
				$this->_staff_index($id, 0, 1);
				$label = 'Shared';
				break;
			default:
				$label = 'Received';
		}
		$this->set('_label', $label);
	}


	function staff_custom_folder($id = 0) {
		$this->_staff_index($id, 0, 1);
	}





	function client_custom_folder($id = 0) {
		$this->_client_index($id, 0, 1);
	}


	/**
	 * _client_index method
	 *
	 * @return void
	 */
	public function _client_index($folder_id = 0, $sent = false, $draft = false) {
		if ($sent) {
			$this->Paginator->settings = array(
				'conditions' => array(
					'Message.user_id' => $this->logged_in_user['id'],
					'Message.user2id !=' => 0,
					//'Message.folder_id !=' => $folder_id,
				),
				'order' => 'Message.id DESC'
			);
		} else if ($draft) {
			$this->Paginator->settings = array(
				'conditions' => array(
					'OR' => array(
						array(
						'Message.user_id' => $this->logged_in_user['id'],
						'Message.user2id' => 0,
						'Message.folder_id' => $folder_id,
							),
						array(
						'Message.user2id' => $this->logged_in_user['id'],
						//'Message.user2id' => 0,
						'Message.folder_id' => $folder_id,
						)
						),
				),
				'order' => 'Message.id DESC'
			);
		} else {
			$this->Paginator->settings = array(
				'conditions' => array(
					'Message.user2id' => $this->logged_in_user['id'],
					'Message.folder_id' => $folder_id,
				),
				'order' => 'Message.id DESC'
			);
		}
		$this->Message->recursive = 0;
		//$this->Paginator->settings = array();
		$messages = $this->Paginator->paginate();
		//prx($messages);
		$this->set('messages', $messages);
	}

	function client_inbox() {
		$this->_client_index();
		$this->set('_label', 'Inbox');
	}

	function client_sent() {
		$this->_client_index(0, 1);
		$this->set('_label', 'Sent');
	}

	function client_draft() {
		$this->_client_index(0, 0, 1);
		$this->set('_label', 'Drafts');
	}

	function client_folder($id = 0) {
		switch($id) {
			case 19:
				$this->_client_index($id, 0, 1);
				$label = 'Invoices';
				break;
			case 20:
				$this->_client_index($id, 0, 1);
				$label = 'Quotation';
				break;
			case 21:
				$this->_client_index($id, 0, 1);
				$label = 'HSE Update';
				break;
			case 22:
				$this->_client_index($id, 0, 1);
				$label = 'Project Picture and Progress';
				break;
			case 23:
				$this->_client_index($id, 0, 1);
				$label = 'Others';
				break;
			default:
				$label = 'Received';
		}
		$this->set('_label', $label);
	}

	/**
	 * admin_view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
		$this->_message_view($id);
	}

	function staff_view($id) {
		$this->_message_view($id);
	}


	function client_view($id) {
		$this->_message_view($id);
	}
	
	function _message_view($id) {
		if (!$this->Message->exists($id)) {
			throw new NotFoundException(__('Invalid message'));
		}
		$options = array('conditions' => array('Message.' . $this->Message->primaryKey => $id));
		$this->set('message', $this->Message->find('first', $options));
	}

	/**
	 * admin_add method
	 *
	 * @return void
	 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->_save_message();
			$this->Session->setFlash('' . $this->_save_documents() . ' documents has been sent.', 'success');
			return $this->redirect('/admin/folders/view/');
		}
		$_staff_users = $this->Message->User->find('list', array('conditions' => array('group_id' => 2, 'status' => 1)));
		$_client_users = $this->Message->User->find('list', array('conditions' => array('group_id' => 3, 'status' => 1)));

		$this->set('_staff_users', $_staff_users);
		$this->set('_client_users', $_client_users);

		$_staff_folders = $this->Message->Folder->find('list', array('conditions' => array('type' => 2, 'status' => 1)));
		$_client_folders = $this->Message->Folder->find('list', array('conditions' => array('type' => 3, 'status' => 1)));

		$this->set('_staff_folders', $_staff_folders);
		$this->set('_client_folders', $_client_folders);
	}

	/**
	 * staff_add method
	 *
	 * @return void
	 */
	public function staff_add() {
		if ($this->request->is('post')) {
			$this->_save_message();
			$this->Session->setFlash('' . $this->_save_documents() . ' documents has been sent.', 'success');
			return $this->redirect('/staff/messages/inbox/');
		}
		$_staff_users = $this->Message->User->find('list', array('conditions' => array('group_id' => 2, 'status' => 1)));
		$_client_users = $this->Message->User->find('list', array('conditions' => array('group_id' => 3, 'status' => 1)));

		$this->set('_staff_users', $_staff_users);
		$this->set('_client_users', $_client_users);

		$_staff_folders = $this->Message->Folder->find('list', array('conditions' => array('type' => 2, 'status' => 1)));
		$_client_folders = $this->Message->Folder->find('list', array('conditions' => array('type' => 3, 'status' => 1)));

		$this->set('_staff_folders', $_staff_folders);
		$this->set('_client_folders', $_client_folders);
		
		$this->_load_custom_folders();
		
	}

	function _load_custom_folders() {
		$this->loadModel('Folder');
		$custom_folders = $this->Folder->find('list', array('conditions' => array('user_id' => $this->logged_in_user['id'])));
		$this->set('custom_folders', $custom_folders);
	}

	/**
	 * staff_add method
	 *
	 * @return void
	 */
	public function client_add() {
		if ($this->request->is('post')) {
			$this->_save_message();
			$this->Session->setFlash('' . $this->_save_documents() . ' documents has been sent.', 'success');
			return $this->redirect('/client/messages/inbox/');
		}
		$_staff_users = $this->Message->User->find('list', array('conditions' => array('group_id' => 2, 'status' => 1)));
		$_client_users = $this->Message->User->find('list', array('conditions' => array('group_id' => 3, 'status' => 1)));

		$this->set('_staff_users', $_staff_users);
		$this->set('_client_users', $_client_users);

		$_staff_folders = $this->Message->Folder->find('list', array('conditions' => array('type' => 2, 'status' => 1)));
		$_client_folders = $this->Message->Folder->find('list', array('conditions' => array('type' => 3, 'status' => 1)));

		$this->set('_staff_folders', $_staff_folders);
		$this->set('_client_folders', $_client_folders);
		
		$this->_load_custom_folders();
	}

	function _save_documents() {
		$documents = 0;
		$this->Document = new Document();
		if (isset($_FILES) && count($_FILES) && isset($_FILES['file_name'])) {
			foreach ($_FILES['file_name']['error'] as $k => $v) {
				if ($v) {
					continue;
				}
				$_ext = explode('.', $_FILES['file_name']['name'][$k]);
				$ext = $_ext[count($_ext) - 1];
				$src = $_FILES['file_name']['tmp_name'][$k];
				$file_name = $this->_generate_random_number() . '.' . $ext;
				$dest = APP . DS . 'webroot' . DS . 'files' . DS . 'documents' . DS . $file_name;
				if (move_uploaded_file($src, $dest)) {
					$document = array(
						'Document' => array(
							'name' => $_FILES['file_name']['name'][$k],
							'title' => $_FILES['file_name']['name'][$k],
							'filename' => $file_name,
							'status' => 1,
							'message_id' => $this->message_id
						)
					);
					$this->Document->create();
					if ($this->Document->save($document)) {
						$documents++;
					}
				}
			}
		}
		return $documents;
	}

	function _save_message() {
		$message = array('Message' => array('message' => $this->request->data['Message']['description']));
		$message['Message']['user_id'] = $this->logged_in_user['id'];
		if ($this->logged_in_user['group_id'] == 1) {
			if ($this->request->data['Message']['_core_type'] == 1) {
				$message['Message']['user2id'] = 0;
				$message['Message']['folder_id'] = 0;
			}
			if ($this->request->data['Message']['_core_type'] == 2) {
				$message['Message']['user2id'] = $this->request->data['Message']['_staff_users'];
				$message['Message']['folder_id'] = $this->request->data['Message']['_staff_folders'];
			}
			if ($this->request->data['Message']['_core_type'] == 3) {
				$message['Message']['user2id'] = $this->request->data['Message']['_client_users'];
				$message['Message']['folder_id'] = $this->request->data['Message']['_client_folders'];
			}
		}
		if ($this->logged_in_user['group_id'] == 2) {
			if ($this->request->data['Message']['_core_type'] == 1) {
				$message['Message']['user2id'] = 1;
				$message['Message']['folder_id'] = $this->request->data['Message']['_staff_folders'];
			}
			if ($this->request->data['Message']['_core_type'] == 0) {
				$message['Message']['user2id'] = 0;
				$message['Message']['folder_id'] = $this->request->data['Message']['_staff_folders'];
			}
		}
		if ($this->logged_in_user['group_id'] == 3) {
			if ($this->request->data['Message']['_core_type'] == 1) {
				$message['Message']['user2id'] = 1;
				$message['Message']['folder_id'] = $this->request->data['Message']['_client_folders'];
			}
			if ($this->request->data['Message']['_core_type'] == 0) {
				$message['Message']['user2id'] = 0;
				$message['Message']['folder_id'] = $this->request->data['Message']['_client_folders'];
			}
		}
		$this->Message->create();
		$this->Message->save($message);
		$this->message_id = $this->Message->getLastInsertID();
		return;
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {
		if (!$this->Message->exists($id)) {
			throw new NotFoundException(__('Invalid message'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Message->save($this->request->data)) {
				$this->Session->setFlash(__('The message has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The message could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Message.' . $this->Message->primaryKey => $id));
			$this->request->data = $this->Message->find('first', $options);
		}
		$users = $this->Message->User->find('list');
		$folders = $this->Message->Folder->find('list');
		$documents = $this->Message->Document->find('list');
		$this->set(compact('users', 'folders', 'documents'));
	}

	/**
	 * delete method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function delete($id = null) {
		$this->Message->id = $id;
		if (!$this->Message->exists()) {
			throw new NotFoundException(__('Invalid message'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Message->delete()) {
			$this->Session->setFlash(__('The message has been deleted.'));
		} else {
			$this->Session->setFlash(__('The message could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	function load_folders() {
		$this->Folder = new Folder();
		$folders = $this->Folder->find(
				'list', array(
			'conditions' => array(
				'Folder.type' => $this->logged_in_user['group_id']
			)
				)
		);
		$this->set('folders', $folders);
	}

}
