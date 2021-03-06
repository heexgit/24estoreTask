<?php
namespace TwentyTwoEstore\Libs\Investor;

use Decimal\Decimal;

class BoundaryBalance
{
	/**
	 * @var \DateTime
	 */
	private $dateTime;

	/**
	 * @var Decimal
	 */
	private $money;

	/**
	 * @var GoldShare
	 */
	private $gold;

	public function __construct (\DateTime $dateTime, Decimal $money, GoldShare $gold = null)
	{
		$this->dateTime($dateTime);
		$this->money($money);
		$this->gold($gold);
	}

	/**
	 * Set or Get the BoundaryBalance dateTime
	 * @param \DateTime $value
	 * @return \DateTime
	 */
	public function dateTime (\DateTime $value = null)
	{
		if (isset($value)) {
			$this->dateTime = $value;
		}
		return $this->dateTime;
	}

	/**
	 * Set or Get the BoundaryBalance money
	 * @param Decimal $value
	 * @return Decimal
	 */
	public function money (Decimal $value = null)
	{
		if (isset($value)) {
			$this->money = $value;
		}
		return $this->money;
	}

	/**
	 * Set or Get the Balance gold
	 * @param GoldShare $value
	 * @return GoldShare
	 */
	public function gold (GoldShare $value = null)
	{
		if (isset($value)) {
			$this->gold = $value;
		}
		return $this->gold;
	}

	/**
	 * Count the BoundaryBalance total
	 * @return Decimal
	 */
	public function countTotal()
	{
		$total = $this->money;
		$gold = $this->gold();
		if (isset($gold)){
			$total = $total->add($gold->price()->mul($gold->amount()));
		}
		return $total;
	}
}
