<?php
namespace TwentyTwoEstore\Libs\Investor;

use TwentyTwoEstore\Libs;
use Decimal\Decimal;

class GoldShare
{
	/**
	 * @var Decimal
	 */
	private $price;

	/**
	 * @var int
	 */
	private $amount;

	public function __construct (Decimal $price, $amount)
	{
		$this->price($price);
		$this->amount($amount);
	}

	/**
	 * Set or Get the GoldShare price
	 * @param Decimal $value
	 * @return Decimal
	 */
	public function price (Decimal $value = null)
	{
		if (isset($value)) {
			$this->price = $value;
		}
		return $this->price;
	}

	/**
	 * Set or Get the GoldShare amount
	 * @param int $value
	 * @return int
	 * @throws Libs\ExecuteException
	 */
	public function amount ($value = null)
	{
		if (isset($value)) {
			if (!is_int($value)){
				throw new Libs\ExecuteException("\$value has to be int; provided type: ".gettype($value));
			}
			$this->amount = $value;
		}
		return $this->amount;
	}
}
