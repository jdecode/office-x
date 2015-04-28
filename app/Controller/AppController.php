<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');
App::uses('User', 'Model');
App::uses('Folder', 'Model');
App::uses('Message', 'Model');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

class AppController extends Controller {

	public $paginate = array(
		'limit' => 10,
	);
	var $helpers = array('Html', 'Form', 'Session', 'Js', 'Time');
	var $components = array('RequestHandler', 'Session', 'Cookie', 'Paginator');
	var $_admin_data = array();
	var $_staff_data = array();
	var $_client_data = array();
	var $logged_in_user = array();

	/**
	 * beforeRender method
	 */
	function beforeRender() {

		$_admin_data = $this->Session->read('admin.User');
		$this->set('_admin_data', $_admin_data);

		$_staff_data = $this->Session->read('staff.User');
		$this->set('_staff_data', $_staff_data);

		$_client_data = $this->Session->read('client.User');
		$this->set('_client_data', $_client_data);

		if ($_admin_data) {
			$this->set('logged_in_user', $_admin_data);
			$this->load_admin_counters();
		} else if ($_staff_data) {
			$this->set('logged_in_user', $_staff_data);
			$this->load_staff_counters();
		} else if ($_client_data) {
			$this->set('logged_in_user', $_client_data);
			$this->load_client_counters();
		}


		/**
		 * Load Folders
		 */
		//$this->load_folders();
	}

	/**
	 * beforeFilter method
	 */
	function beforeFilter() {
		$_staff_data = $this->Session->read('staff.User');
		$this->_staff_data = $_staff_data;

		$_client_data = $this->Session->read('client.User');

		$this->_client_data = $_client_data;

		$_admin_data = $this->Session->read('admin.User');
		$this->_admin_data = $_admin_data;


		if ($_admin_data) {
			$this->logged_in_user = $_admin_data;
		} else if ($_staff_data) {
			$this->logged_in_user = $_staff_data;
		} else if ($_client_data) {
			$this->logged_in_user = $_client_data;
		}

		$this->_paginatorURL();
	}

	/**
	 * _admin_auth_check method
	 * 
	 * @return true, if logged in as admin, false otherwise
	 */
	function _admin_auth_check() {
		$_user = $this->Session->read('admin.User');
		if (isset($_user['id']) && is_numeric($_user['id']) && $_user['group_id'] == ADMIN_GROUP_ID) { // Admin group_id is 1
			$this->layout = 'admin_dashboard';
			return true;
		} else {
			$this->layout = 'login';
			return false;
		}
	}

	/**
	 * _staff_auth_check method
	 *
	 * @return boolean, if logged in as staff, false otherwise
	 */
	function _staff_auth_check() {
		$_user = $this->Session->read('staff.User');
		if (
				isset($_user['id']) &&
				is_numeric($_user['id']) &&
				( $_user['group_id'] == STAFF_GROUP_ID)
		) {
			$this->layout = 'staff_dashboard';
			//$this->_get_staff_folders();
			return true;
		} else {
			$this->layout = 'login';
			return false;
		}
	}

	/**
	 * _client_auth_check method
	 *
	 * @return true, if logged in as client, false otherwise
	 */
	function _client_auth_check() {

		$_user = $this->Session->read('client.User');

		if (
				isset($_user['id']) &&
				is_numeric($_user['id']) &&
				( $_user['group_id'] == CLIENT_GROUP_ID )
		) {
			$this->layout = 'client_dashboard';
			return true;
		} else {
			$this->layout = 'login';
			return false;
		}
	}

	function _deny_url() {
		$action = $this->params->params['action'];

		/*
		  dpr($this->_deny['admin']);
		  dpr($this->_deny['staff']);
		  dpr($this->_deny['client']);
		  decho('Admin:');
		  dvd($this->_admin_auth_check());
		  decho('Staff:');
		  dvd($this->_staff_auth_check());
		  decho('Client:');
		  dvd($this->_client_auth_check());
		 */
		//die;
		// If method requires login then redirect to login page[if logged out] with referer URL, and to dashboard otherwise
		if (!empty($this->_deny['admin'])) {
			if (in_array($action, $this->_deny['admin'])) {
				if (!$this->_admin_auth_check()) {
					$this->Session->write('admin_redirect', "/" . $this->params->url);
					$this->redirect('/login');
				}
			}
		}
		// If method requires login then redirect to login page[if logged out] with referer URL, and to homepage otherwise
		if (!empty($this->_deny['staff'])) {
			if (in_array($action, $this->_deny['staff'])) {
				if (!$this->_staff_auth_check()) {
					$this->Session->write('redirect', "/" . $this->params->url);
					$this->redirect('/login');
				}
			}
		}
		// If method requires login then redirect to login page[if logged out] with referer URL, and to homepage otherwise
		if (!empty($this->_deny['client'])) {
			if (in_array($action, $this->_deny['client'])) {
				if (!$this->_client_auth_check()) {
					$this->Session->write('redirect', "/" . $this->params->url);
					$this->redirect('/login');
				}
			}
		}
	}

	public function _isArrayReadyToUse($array = array()) {
		if (isset($array) && is_array($array) && count($array)) {
			return true;
		}
		return false;
	}

	function _paginatorURL() {
		$passed = "";
		$retain = $this->params['url'];
		unset($retain['url']);
		$this->set('paginatorURL', array($passed, '?' => http_build_query($retain)));
	}

	function load_folders() {
		$this->loadModel('Folder');
		$folders = $this->Folder->find(
				'list', array(
			'conditions' => array(
				'Folder.type' => $this->logged_in_user['group_id']
			),
				)
		);
		$this->set('folders', $folders);
	}

	function _generate_random_number() {
		return sha1(rand() . time() . microtime() . rand() . sha1(time()));
	}

	function _get_staff_folders() {
		$this->load_folders();
	}

	function _find_message_count($_conditions = array()) {
		$this->Message = new Message();
		$conditions = array(
			'conditions' => $_conditions
		);
		return $this->Message->find('count', $conditions);
	}

	function load_admin_counters() {
		$this->set('admin_inbox_count', $this->_get_admin_inbox_count());
		$this->set('admin_sent_count', $this->_get_admin_sent_count());
		$this->set('admin_draft_count', $this->_get_admin_draft_count());
	}

	function _get_admin_inbox_count() {
		return $this->_find_message_count(
						array(
							'Message.user2id' => $this->logged_in_user['id']
						)
		);
	}

	function _get_admin_sent_count() {
		return $this->_find_message_count(
						array(
							'Message.user_id' => $this->logged_in_user['id'],
							'Message.folder_id !=' => 0,
						)
		);
	}

	function _get_admin_draft_count() {
		return $this->_find_message_count(
						array(
							'Message.user_id' => $this->logged_in_user['id'],
							'Message.folder_id' => 0,
						)
		);
	}

	function load_staff_counters() {

		$this->set('staff_received_count', $this->_get_staff_received_count());
		$this->set('staff_sent_count', $this->_get_staff_sent_count());
		$this->set('staff_uploaded_count', $this->_get_staff_uploaded_count());
		$this->set('staff_shared_count', $this->_get_staff_shared_count());
	}

	function _get_staff_received_count() {
		return $this->_get_staff_folder_count(24);
	}

	function _get_staff_uploaded_count() {
		return $this->_get_staff_folder_count(26);
	}

	function _get_staff_shared_count() {
		return $this->_get_staff_folder_count(27);
	}

	function _get_staff_folder_count($folder_id) {
		return $this->_get_folder_count($folder_id);
	}
	
	function _get_folder_count($folder_id) {
		return $this->_find_message_count(
						array(
							'OR' => array(
								array(
									'Message.user_id' => $this->logged_in_user['id'],
									'Message.user2id' => 0,
									'Message.folder_id' => $folder_id,
								),
								array(
									'Message.user2id' => $this->logged_in_user['id'],
									'Message.folder_id' => $folder_id,
								)
							)
						)
		);
	}

	function _get_staff_sent_count() {
		return $this->_find_message_count(
						array(
							'Message.user_id' => $this->logged_in_user['id'],
							'Message.user2id !=' => 0,
						)
		);
	}

	function load_client_counters() {
		  $this->set('client_invoices_count', $this->_get_client_invoices_count());
		  $this->set('client_sent_count', $this->_get_client_sent_count());
		  $this->set('client_quotation_count', $this->_get_client_quotation_count());
		  $this->set('client_hseupdate_count', $this->_get_client_hseupdate_count());
		  $this->set('client_ppap_count', $this->_get_client_ppap_count());
		  $this->set('client_others_count', $this->_get_client_others_count());
	}
	
	function _get_client_invoices_count() {
		return $this->_get_folder_count(19);
	}
	
	function _get_client_quotation_count() {
		return $this->_get_folder_count(20);
	}
	
	function _get_client_hseupdate_count() {
		return $this->_get_folder_count(21);
	}
	
	function _get_client_ppap_count() {
		return $this->_get_folder_count(22);
	}
	
	function _get_client_others_count() {
		return $this->_get_folder_count(23);
	}


	function _get_client_sent_count() {
		return $this->_find_message_count(
						array(
							'Message.user_id' => $this->logged_in_user['id'],
							'Message.user2id !=' => 0,
						)
		);
	}
}
