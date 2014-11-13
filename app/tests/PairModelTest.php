<?php

class PairModelTest extends TestCase {

	public function testGetStartTimeMethod()
	{
		$pair = new Pair();

		$pair->num = 1;
		$this->assertEquals(8*60+30, $pair->getStartTime(), 'pair #1 start time wrong');

		$pair->num = 2;
		$this->assertEquals(8*60+30+1*100, $pair->getStartTime(), 'pair #2 start time wrong');

		$pair->num = 5;
		$this->assertEquals(8*60+30+4*100+20, $pair->getStartTime(), 'pair #5 start time wrong');

		$pair->num = 8;
		$this->assertEquals(8*60+30+7*100+20, $pair->getStartTime(), 'pair #8 start time wrong');

		$pair->num = 9;
		$this->assertEquals(null, $pair->getStartTime(), 'pair #9 should return null on getStartTime');

		$pair->num = 0;
		$this->assertEquals(null, $pair->getStartTime(), 'pair #0 should return null on getStartTime');

		$pair->num = -1;
		$this->assertEquals(null, $pair->getStartTime(), 'pair #-1 should return null on getStartTime');
	}

	public function testGetFinishTimeMethod()
	{
		$pair = new Pair();

		$pair->num = 1;
		$this->assertEquals(8*60+30+90, $pair->getFinishTime(), 'pair #1 finish time wrong');

		$pair->num = 2;
		$this->assertEquals(8*60+30+1*100+90, $pair->getFinishTime(), 'pair #2 finish time wrong');

		$pair->num = 5;
		$this->assertEquals(8*60+30+4*100+20+90, $pair->getFinishTime(), 'pair #5 finish time wrong');

		$pair->num = 8;
		$this->assertEquals(8*60+30+7*100+20+90, $pair->getFinishTime(), 'pair #8 finish time wrong');

		$pair->num = 9;
		$this->assertEquals(null, $pair->getFinishTime(), 'pair #9 should return null on getFinishTime');

		$pair->num = 0;
		$this->assertEquals(null, $pair->getFinishTime(), 'pair #0 should return null on getFinishTime');

		$pair->num = -1;
		$this->assertEquals(null, $pair->getFinishTime(), 'pair #-1 should return null on getFinishTime');
	}


} 