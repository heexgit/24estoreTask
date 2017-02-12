<?php
namespace TwentyTwoEstore\Libs\Investor;

interface IExchangeConnector
{
	/**
	 * Get exchange rates of Gold
	 * @param \DateTime $startDate
	 * @param \DateTime $endDate
	 * @return array
	 */
	public function getGoldExchangeRates (\DateTime $startDate, \DateTime $endDate);
}
