<?php

class Schedule extends Eloquent {

	protected $table = 'schedule';

	protected $fillable = array('group_id');

	public function group()
	{
		return $this->belongsTo('Group');
	}

	public function pairs()
	{
		return $this->hasMany('Pair');
	}

}
