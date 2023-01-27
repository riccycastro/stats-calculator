<?php

namespace Tests\unit\Calculator;

use DateTime;
use PHPUnit\Framework\TestCase;
use Statistics\Calculator\AveragePostsNumberPerUserPerMonth;
use Statistics\Dto\ParamsTo;
use Statistics\Enum\StatsEnum;
use Tests\unit\Calculator\Util\LoadSocialPostTrait;

class AveragePostsNumberPerUserPerMonthTest extends TestCase
{
    use LoadSocialPostTrait;

    public function testCalculateShouldReturnExpectedValue(): void
    {
        $paramsTo = (new ParamsTo(StatsEnum::AVERAGE_POSTS_NUMBER_PER_USER_PER_MONTH))
            ->setStartDate(DateTime::createFromFormat('Y-m-d', '2018-08-01'))
            ->setEndDate(DateTime::createFromFormat('Y-m-d', '2018-08-31'));
        $averagePostNumberPerUserPerMonth = new AveragePostsNumberPerUserPerMonth($paramsTo);

        $averagePostNumberPerUserPerMonth = $this->fillData($averagePostNumberPerUserPerMonth);

        $statisticsTo = $averagePostNumberPerUserPerMonth->calculate();

        $this->assertCount(4, $statisticsTo->getChildren()); // check that the 4 results are returned

        $this->assertEquals('average-posts-per-user', $statisticsTo->getName()); // check that the name is not changed


        $expectedResults = [
            [
                'value' => 0.03,
                'splitPeriod' => 'Regenia Boice - Aug, 2018',
                'units' => 'posts',
            ],
            [
                'value' => 0.03,
                'splitPeriod' => 'Isidro Schuett - Aug, 2018',
                'units' => 'posts',
            ],
            [
                'value' => 0.03,
                'splitPeriod' => 'Lael Vassel - Aug, 2018',
                'units' => 'posts',
            ],
            [
                'value' => 0.03,
                'splitPeriod' => 'Woodrow Lindholm - Aug, 2018',
                'units' => 'posts',
            ],
        ];

        foreach ($statisticsTo->getChildren() as $key => $child) {
            $expectedResult = $expectedResults[$key];

            // validate the output is according to expectations
            $this->assertEquals($expectedResult['value'], $child->getValue());
            $this->assertEquals($expectedResult['splitPeriod'], $child->getSplitPeriod());
            $this->assertEquals($expectedResult['units'], $child->getUnits());
        }
    }

    public function testCalculateShouldReturnEmptyIfDateOutOfRange(): void
    {
        $paramsTo = (new ParamsTo(StatsEnum::AVERAGE_POSTS_NUMBER_PER_USER_PER_MONTH))
            ->setStartDate(DateTime::createFromFormat('Y-m-d', '2020-01-01'))
            ->setEndDate(DateTime::createFromFormat('Y-m-d', '2020-03-31'));
        $averagePostNumberPerUserPerMonth = new AveragePostsNumberPerUserPerMonth($paramsTo);

        $averagePostNumberPerUserPerMonth = $this->fillData($averagePostNumberPerUserPerMonth);

        $statisticsTo = $averagePostNumberPerUserPerMonth->calculate();

        $this->assertCount(0, $statisticsTo->getChildren());
    }
}
