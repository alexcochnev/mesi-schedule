<?php

/**
 * Class Pair
 *
 * @property integer $id
 * @property integer $schedule_id
 * @property string $week
 * @property integer $day
 * @property integer $num
 * @property string $name
 * @property string $teacher
 * @property string $type
 * @property string $location
 * @property-read \Schedule $schedule
 */
class Pair extends Eloquent {

	protected $table = 'pair';

	protected $guarded = array('id');

	public $timestamps = false;

	public function schedule()
	{
		return $this->belongsTo('Schedule');
	}
}
