<?php

declare(strict_types=1);

namespace Statistics\Calculator;

use DateTime;
use SocialPost\Dto\SocialPostTo;
use Statistics\Dto\StatisticsTo;

class AveragePostsNumberPerUserPerMonth extends AbstractCalculator
{
    protected const UNITS = 'posts';

    private array $totals = [];

    protected function doAccumulate(SocialPostTo $postTo): void
    {
        $key = sprintf(
            "%s - %s",
            $postTo->getAuthorName(),
            $postTo->getDate()->format('M, Y')
        );

        $this->totals[$key]['amount'] =
            ($this->totals[$key]['amount'] ?? 0)
            + 1;

        $mutablePostDate = DateTime::createFromFormat('Y-m-d', $postTo->getDate()->format('Y-m-d'));
        $this->totals[$key]['count'] = (int)$mutablePostDate->modify('last day of this month')->format('d');
    }

    protected function doCalculate(): StatisticsTo
    {
        $stats = new StatisticsTo();
        foreach ($this->totals as $splitPeriod => $total) {
            $child = (new StatisticsTo())
                ->setSplitPeriod($splitPeriod)
                ->setValue(round($total['amount'] / $total['count'], 2))
                ->setUnits(self::UNITS);

            $stats->addChild($child);
        }

        return $stats;
    }
}
