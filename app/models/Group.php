<?php

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
