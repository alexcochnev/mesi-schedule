<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Butthurthead\MesiAPI\MesiAPI;

class GroupsUpdateCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'mesi:update-groups';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Update groups from mesi.ru';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @TODO: check for errors
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$mesi_api = new MesiAPI();
		$groups = $mesi_api->groups();

		foreach ($groups as $group) {
			$group_record = Group::firstOrNew(array('name' => $group['name']));
			$group_record->mesi_id = $group['id'];
			$group_record->save();
		}
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array();
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array();
	}

}
