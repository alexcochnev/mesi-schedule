<?php

class Pair extends Eloquent {

	const PAIR_LENGTH = 90;
	const BREAK_LENGTH = 10;

	protected $table = 'pair';

	protected $guarded = array('id');

	public $timestamps = false;

	public function schedule()
	{
		return $this->belongsTo('Schedule');
	}

	/**
	 * @param integer $num
	 * @return integer minutes
	 */
	public function getStartTime ()
	{
		return 510 + ($this->num-1)*self::PAIR_LENGTH + ($this->num-1)*self::BREAK_LENGTH + ($this->num < 4 ? 0 : 20);
	}

	/**
	 * @param $num
	 * @return integer $minutes
	 */
	public function getFinishTime ()
	{
		return 510 + $this->num*self::PAIR_LENGTH + + ($this->num-1)*self::BREAK_LENGTH + ($this->num < 4 ? 0 : 20);
	}
}
