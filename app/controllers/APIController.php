<?php

use Carbon\Carbon;
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

		$ss = $this->getSemesterStart(new Carbon());
		$pairs->each(function(Pair $pair) use (&$cal, $ss) {
			$event = new Event();

			$day = $ss->copy();
			$day->day += $pair->day + ($pair->week === 'even' ? 0: 7);
			$pair_start = $day->copy();
			$pair_start->addMinutes($pair->getStartTime());
			$pair_end = $pair_start->copy();
			$pair_end->addMinutes(90);

			// init event
			$event->setDtStart($pair_start);
			$event->setDtEnd($pair_end);
			$event->setSummary($pair->type . ' ' . $pair->name); // @TODO: short type
			$event->setDescription($pair->teacher);
			$event->setLocation($pair->location);

			// add recurrence rule
			$recurrenceRule = new RecurrenceRule();
			$recurrenceRule->setFreq(RecurrenceRule::FREQ_WEEKLY);
			$recurrenceRule->setInterval(2);
			$recurrenceRule->setCount(10); // @FIXME
			$event->setRecurrenceRule($recurrenceRule);

			$event->setUseTimezone(true);

			// add event to calendar
			$cal->addComponent($event);
		});
		$response = Response::make($cal->render(), 200, [
			'Content-Type' => 'text/calendar; charset=utf-8',
			'Content-Disposition' => 'attachment; filename="cal.ics"'
		]);

		return $response;
	}

	/**
	 * @param Carbon $date
	 * @return Carbon
	 */
	protected function getSemesterStart(Carbon $date)
	{
		$semester_start = Carbon::now();

		if ($date->month >= 9) {
			$semester_start->setDate($date->year, 9, 1);
		} else if ($date->month < 2) {
			$semester_start->setDate($date->year-1, 9, 1);
		} else {
			$semester_start->setDate($date->year, 2, 1);
		}
		$semester_start->setTime(0, 0, 0);

		return $semester_start;
	}

}