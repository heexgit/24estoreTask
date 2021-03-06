<?php
namespace TwentyTwoEstore\Libs\Investor;

use Decimal\Decimal;

class ExchangeRate
{
	/**
	 * @var \DateTime
	 */
	private $dateTime;

	/**
	 * @var Decimal
	 */
	private $value;

	public function __construct (\DateTime $dateTime, Decimal $value)
	{
		$this->dateTime($dateTime);
		$this->value($value);
	}

	/**
	 * Set or Get the ExchangeRate dateTime
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
	 * Set or Get the ExchangeRate value
	 * @param Decimal $value
	 * @return Decimal
	 */
	public function value (Decimal $value = null)
	{
		if (isset($value)) {
			$this->value = $value;
		}
		return $this->value;
	}
}
