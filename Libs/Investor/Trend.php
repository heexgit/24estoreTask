<?php
namespace TwentyTwoEstore\Libs\Investor;

use TwentyTwoEstore\Libs;

class Trend
{
	/**
	 * @var ExchangeRate
	 */
	private $startExchangeRate;

	/**
	 * @var ExchangeRate
	 */
	private $endExchangeRate;

	/**
	 * @var bool
	 */
	private $isRising;

	public function __construct (ExchangeRate $startExchangeRate, $isRising = null)
	{
		$this->startExchangeRate($startExchangeRate);
		$this->isRising($isRising);
	}

	/**
	 * Set or Get the isRising value
	 * @param bool $value
	 * @return bool
	 * @throws Libs\ExecuteException
	 */
	public function isRising ($value = null)
	{
		if (isset($value)) {
			if (!is_bool($value)){
				throw new Libs\ExecuteException("\$value has to be bool; provided type: ".gettype($value));
			}
			$this->isRising = $value;
		}
		return $this->isRising;
	}

	/**
	 * Set or Get the startExchangeRate value
	 * @param ExchangeRate $value
	 * @return ExchangeRate
	 */
	public function startExchangeRate (ExchangeRate $value = null)
	{
		if (isset($value)) {
			$this->startExchangeRate = $value;
		}
		return $this->startExchangeRate;
	}

	/**
	 * Set or Get the endExchangeRate value
	 * @param ExchangeRate $value
	 * @return ExchangeRate
	 */
	public function endExchangeRate (ExchangeRate $value = null)
	{
		if (isset($value)) {
			$this->endExchangeRate = $value;
		}
		return $this->endExchangeRate;
	}
}
