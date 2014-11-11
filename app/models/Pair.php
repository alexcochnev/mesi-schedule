<?php

class Pair extends Eloquent {

	protected $table = 'pair';

	protected $guarded = array('id');

	public $timestamps = false;

	public function schedule()
	{
		return $this->belongsTo('Schedule');
	}
}
