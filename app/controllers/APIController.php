<?php

use Eluceo\iCal\Component\Calendar;
use Eluceo\iCal\Component\Event;
use Eluceo\iCal\Property\Event\RecurrenceRule;

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

	public function getSchedule($id) {
		$pairs = Schedule::find($id)->pairs;
		$cal = new Calendar('mguesi.ru');
		// setup data
		$now = new \DateTime();
		$pairs->each(function(Pair $pair) use (&$cal) {
			$event = new Event();
			$event->setDtStart(new \DateTime('2014-11-11 13:00:00')); // @TODO: change datetime
			$event->setDtEnd(new \DateTime('2014-11-11 13:30:00')); // @TODO: change datetime
			$event->setSummary($pair->name); // @TODO: add type
			$event->setDescription($pair->teacher);
			$event->setLocation($pair->location);
			$recurrenceRule = new RecurrenceRule();
			$recurrenceRule->setFreq(RecurrenceRule::FREQ_WEEKLY);
			$recurrenceRule->setInterval(2);
			$recurrenceRule->setCount(10);
			$event->setRecurrenceRule($recurrenceRule);
			$cal->addComponent($event);
		});
		$response = Response::make($cal->render(), 200, [
			'Content-Type' => 'text/calendar; charset=utf-8',
			'Content-Disposition' => 'attachment; filename="cal.ics"'
		]);

		return $response;
	}

}