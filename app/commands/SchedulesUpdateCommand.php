<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Butthurthead\MesiAPI\MesiAPI;

class SchedulesUpdateCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'mesi:update-schedules';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Updates schedules from mesi.ru';

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
		$api = new MesiAPI();
		$groups = Group::all();
		foreach ($groups as $group) {
			// find or create schedule for group
			$schedule = Schedule::firstOrNew(array('group_id' => $group->id));
			$schedule->save();

			// drop pairs in schedule
			Pair::where('schedule_id', '=', $schedule->id)->delete();

			$new_schedule = $api->schedule($group->mesi_id);
			foreach ($new_schedule as $week => $days) {
				foreach ($days as $day => $pairs) {
					foreach ($pairs as $pair) {
						$p = new Pair();
						$p->schedule_id = $schedule->id;
						$p->week = $week;
						$p->day = $day;
						$p->num = $pair['num'];
						$p->name = $pair['subj'];
						$p->type = $pair['kind'];
						$p->teacher = $pair['teacher'];
						$p->location = $pair['aud'];
						$p->save();
					}
				}
			}
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
