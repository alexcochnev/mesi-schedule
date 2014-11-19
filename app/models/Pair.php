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
	 * Return pair start time in minutes
	 *
	 * @param integer $num
	 * @return integer|null
	 */
	public function getStartTime ()
	{
		$time = null;
		if ($this->num > 0 AND $this->num < 9) {
			$time = 510 + ($this->num-1)*self::PAIR_LENGTH + ($this->num-1)*self::BREAK_LENGTH +
				($this->num < 4 ? 0 : 20);
		}

		return $time;
	}

	/**
	 * @param $num
	 * @return integer $minutes
	 */
	public function getFinishTime ()
	{
		$start_time = $this->getStartTime();
		return $start_time ? $start_time + self::PAIR_LENGTH : $start_time;
	}
}
