<?php

class PairModelTest extends TestCase {

	public function startTimeProvider()
	{
		return array(
			array(1, 8*60+30),
			array(2, 8*60+30+1*100),
			array(5, 8*60+30+4*100+20),
			array(8, 8*60+30+7*100+20),
			array(9, null),
			array(0, null),
			array(-1, null)
		);
	}

	public function finishTimeProvider()
	{
		return array(
			array(1, 8*60+30+90),
			array(2, 8*60+30+1*100+90),
			array(5, 8*60+30+4*100+20+90),
			array(8, 8*60+30+7*100+20+90),
			array(9, null),
			array(0, null),
			array(-1, null)
		);
	}

	/**
	 * @param $num
	 * @param $time
	 * @dataProvider startTimeProvider
	 */
	public function testGetStartTimeMethod($num, $time)
	{
		$pair = new Pair();

		$pair->num = $num;
		$this->assertEquals($time, $pair->getStartTime());
	}

	/**
	 * @param $num
	 * @param $time
	 * @dataProvider finishTimeProvider
	 */
	public function testGetFinishTimeMethod($num, $time)
	{
		$pair = new Pair();

		$pair->num = $num;
		$this->assertEquals($time, $pair->getFinishTime());
	}


} 