<?php

class APIController extends Controller {

	public function getGroups()
	{
		return Group::all();
	}

	public function postSchedule()
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
	}

}