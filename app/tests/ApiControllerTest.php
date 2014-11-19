<?php

class ApiControllerTest extends TestCase {

	public function setUp()
	{
		parent::setUp();
		Artisan::call('migrate');
		Artisan::call('db:seed');
	}

	public function tearDown()
	{
		parent::tearDown();
		Artisan::call('migrate:reset');
	}

	public function testGetGroups()
	{
		$response = $this->call('GET', 'api/groups');
		$this->assertEquals(json_encode(array(
			array('id' => '1', 'name' => 'ДКП-123б'),
			array('id' => '2', 'name' => 'ДКП-123бс')
		)), $response->getContent());
	}

}
