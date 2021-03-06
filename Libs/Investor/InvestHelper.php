<?php
namespace TwentyTwoEstore\Libs\Investor;

use TwentyTwoEstore\Libs;
use Decimal\Decimal;

class InvestHelper
{
	private $startAmount;

	const PRECISION = 4;

	public function __construct ($startAmount)
	{
		if (!isset($startAmount) || !is_int($startAmount) || $startAmount <= 0){
			throw new Libs\ExecuteException("\$startAmount has to be int and be greater than 0");
		}
		$this->startAmount = new Decimal($startAmount);
	}

	public function investByTrends (array $trends)
	{
		if (empty($trends)){
			throw new Libs\ExecuteException("\$trends is empty");
		}

		/* @var $previousTrend Trend */
		$previousTrend = $trends[0];
		if (!($previousTrend instanceof Trend)){
			throw new Libs\ExecuteException("\$trends has to be array of Trend");
		}

		// balance before the first day
		$dayBefore = clone $previousTrend->startExchangeRate()->dateTime();
		$oneDay = new \DateInterval('P1D');
		$oneDay->invert = 1;
		$dayBefore->add($oneDay);
		$currentBalance = new BoundaryBalance($dayBefore, $this->startAmount);

		$balances = array($currentBalance);

		if ($previousTrend->isRising()){
			$currentBalance = $this->buy($previousTrend->startExchangeRate(), $currentBalance);
		}

		/* @var $trend Trend */
		foreach ($trends as $trend){
			if ($trend->isRising()){
				$currentBalance = $this->sell($trend->endExchangeRate(), $currentBalance);
			}
			else{
				$currentBalance = $this->buy($trend->endExchangeRate(), $currentBalance);
			}

			$balances[] = $currentBalance;
		}

		$currentBalance = $this->sell($trend->endExchangeRate(), $currentBalance);
		$balances[] = $currentBalance;

		return $balances;
	}

	private function sell (ExchangeRate $exchangeRate, BoundaryBalance $currentBalance)
	{
		/* @var $sellCourse Decimal */
		$sellCourse = $exchangeRate->value();

		$moneyReceived = $sellCourse->mul($currentBalance->gold()->amount(), self::PRECISION);

		$newBalance = new BoundaryBalance($exchangeRate->dateTime(), $moneyReceived);
		return $newBalance;
	}

	private function buy (ExchangeRate $exchangeRate, BoundaryBalance $currentBalance)
	{
		/* @var $buyCourse Decimal */
		$buyCourse = $exchangeRate->value();

		$goldBought = (int)(string)$currentBalance->money()->div($buyCourse, self::PRECISION)->quantize(0);
		$moneySpent = $buyCourse->mul($goldBought, self::PRECISION);
		$moneyLeft = $currentBalance->money()->sub($moneySpent, self::PRECISION);

		$newBalance = new BoundaryBalance($exchangeRate->dateTime(), $moneyLeft, new GoldShare($buyCourse, $goldBought));
		return $newBalance;
	}
}
