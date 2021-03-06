<?php
require_once 'PHPUnit/Framework/TestCase.php';

use \TwentyTwoEstore\Libs\Investor\BoundaryBalance;
use \TwentyTwoEstore\Libs\Investor\GoldShare;
use \Decimal\Decimal;

/**
 * BoundaryBalance test case.
 */
class BoundaryBalanceTest extends PHPUnit_Framework_TestCase
{
	/**
	 *
	 * @var BoundaryBalance
	 */
	private $BoundaryBalance;

	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp()
	{
		parent::setUp ();

		$this->BoundaryBalance = new BoundaryBalance(new \DateTime(), new Decimal(0));
	}

	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown()
	{
		// TODO Auto-generated BoundaryBalanceTest::tearDown()
		$this->BoundaryBalance = null;

		parent::tearDown ();
	}

	/**
	 * Constructs the test case.
	 */
	public function __construct()
	{
		require_once 'bootstrap.php';
	}

	/**
	 * Tests BoundaryBalance->dateTime()
	 */
	public function testDateTime()
	{
		$setDateTime = new \DateTime();
		$getDateTime = $this->BoundaryBalance->dateTime($setDateTime);

		$this->assertSame($setDateTime, $getDateTime);
	}

	/**
	 * Tests BoundaryBalance->money()
	 */
	public function testMoney()
	{
		$setMoney = new Decimal(5);
		$getMoney = $this->BoundaryBalance->money($setMoney);

		$this->assertSame($setMoney, $getMoney);
	}

	/**
	 * Tests BoundaryBalance->gold()
	 */
	public function testGold()
	{
		$setGold = new GoldShare(new Decimal(5), 20);
		$getGold = $this->BoundaryBalance->gold($setGold);

		$this->assertSame($setGold, $getGold);
	}

	/**
	 * Tests BoundaryBalance->countTotal()
	 */
	public function testCountTotal()
	{
		$setGold = new GoldShare(new Decimal(5), 20);
		$getGold = $this->BoundaryBalance->gold($setGold);

		$actual = $this->BoundaryBalance->countTotal();

		$expected = new Decimal(100);
		$this->assertEquals($expected->toFloat(), $actual->toFloat());
	}
}
