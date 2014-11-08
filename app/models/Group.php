<?php

/**
 * Class Group
 *
 * @property integer $id
 * @property integer $mesi_id
 * @property string  $name
 * @property-read \Schedule $schedule
 */
class Group extends Eloquent {

	protected $table = 'group';

	protected $guarded = array('id');

	protected $hidden = array('mesi_id');

	public $timestamps = false;

	public function schedule()
	{
		return $this->hasOne('Schedule');
	}
}
