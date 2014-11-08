<?php

/**
 * Class Schedule
 *
 * @property integer $id
 * @property integer $group_id
 * @property-read \Group $group
 * @property-read \Illuminate\Database\Eloquent\Collection|\Pair[] $pairs
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
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
