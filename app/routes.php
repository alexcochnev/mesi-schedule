<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function() {
	$groups = Group::all();
	return View::make('index', array('groups' => $groups));
});

Route::post('schedule', function()
{
	if (Input::has('groups')) {
		$groups = Input::get('groups');
		$schedules = Schedule::with('pairs')->whereIn('group_id', $groups)->get();
		$schedule = [];
		foreach ($schedules as $s) {
			foreach ($s->pairs as $pair) {
				$schedule[$pair->week][$pair->day][] = [
					'num' => $pair->num,
					'name' => $pair->name,
					'type' => $pair->type,
					'teacher' => $pair->teacher,
					'aud' => $pair->location
				];
			}
		}
		return $schedule;
	}
	App::abort(404);
});
