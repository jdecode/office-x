<?php
App::uses('Folder', 'Model');

/**
 * Folder Test Case
 *
 */
class FolderTest extends CakeTestCase {

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Folder = ClassRegistry::init('Folder');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Folder);

		parent::tearDown();
	}

}
