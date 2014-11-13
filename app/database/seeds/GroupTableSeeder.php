<?php

class GroupTableSeeder extends DatabaseSeeder {

	public function run()
	{
		DB::table('group')->delete();

		Group::create(array('mesi_id' => 1, 'name' => 'ДКП-123б'));
		Group::create(array('mesi_id' => 2, 'name' => 'ДКП-123бс'));
	}

} 