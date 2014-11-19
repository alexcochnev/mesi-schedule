<?php

class PairModelTest extends TestCase {

	public function pairTimeProvider()
	{
		return array(
			array(1, 510, 600),
			array(2, 610, 700),
			array(5, 930, 1020),
			array(8, 1230, 1320),
			array(9, null, null),
			array(0, null, null),
			array(-1, null, null)
		);
	}

	/**
	 * @param integer $pair_num
	 * @param integer $expected_start_time
	 * @dataProvider pairTimeProvider
	 */
	public function testGetStartTimeMethod($pair_num, $expected_start_time, $expected_finish_time)
	{
		$pair = new Pair(array('num' => $pair_num));

		$this->assertEquals($expected_start_time, $pair->getStartTime());
		$this->assertEquals($expected_finish_time, $pair->getFinishTime());
	}

} 