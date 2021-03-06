<?php
namespace TwentyTwoEstore\Libs\Investor;

use TwentyTwoEstore\Libs;

class TrendDetector
{
	public function analyzeExchangeRates (array $exchangeRates)
	{
		if (empty($exchangeRates)){
			throw new Libs\ExecuteException("\$exchangeRates is empty");
		}
		if (!($exchangeRates[0] instanceof ExchangeRate)){
			throw new Libs\ExecuteException("\$exchangeRates has to be array of ExchangeRate");
		}

		$trends = array();
		$currentTrend = null;
		$previousItem = null;

		/* @var $previousItem ExchangeRate */
		/* @var $item ExchangeRate */
		foreach ($exchangeRates as $item){
			if (isset($previousItem)){
				// the second iteration = current trend direction is not specified
				if ($currentTrend->isRising() === null){
					// determine the first trend direction
					$currentTrend->isRising($previousItem->value()->lt($item->value()));
				}
				// if the current trend is going up
				elseif ($currentTrend->isRising()){
					// trend direction is changing
					if ($item->value()->lt($previousItem->value())){
						$currentTrend->endExchangeRate($previousItem);

						$currentTrend = new Trend($previousItem, false);
						$trends[] = $currentTrend;
					}
				}
				// if the current trend is going down
				// and trend direction is changing
				elseif ($item->value()->gt($previousItem->value())){
					$currentTrend->endExchangeRate($previousItem);

					$currentTrend = new Trend($previousItem, true);
					$trends[] = $currentTrend;
				}
			}
			// the first iteration
			else{
				$currentTrend = new Trend($item);
				$trends[] = $currentTrend;
			}

			$previousItem = $item;
		}

		$currentTrend->endExchangeRate($previousItem);
		return $trends;
	}
}
