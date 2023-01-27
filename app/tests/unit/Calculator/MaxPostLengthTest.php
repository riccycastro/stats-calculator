<?php

namespace Tests\unit\Calculator;

use DateTime;
use PHPUnit\Framework\TestCase;
use Statistics\Calculator\MaxPostLength;
use Statistics\Dto\ParamsTo;
use Statistics\Enum\StatsEnum;
use Tests\unit\Calculator\Util\LoadSocialPostTrait;

class MaxPostLengthTest extends TestCase
{
    use LoadSocialPostTrait;

    public function testCalculateShouldReturnExpectedValue(): void
    {
        $paramsTo = (new ParamsTo(StatsEnum::MAX_POST_LENGTH))
            ->setStartDate(DateTime::createFromFormat('Y-m-d', '2018-08-01'))
            ->setEndDate(DateTime::createFromFormat('Y-m-d', '2018-08-31'));

        $maxPostLength = new MaxPostLength($paramsTo);

        $maxPostLength = $this->fillData($maxPostLength);

        $statisticsTo = $maxPostLength->calculate();

        $this->assertEmpty($statisticsTo->getChildren());
        $this->assertEquals('max-character-length', $statisticsTo->getName());
        $this->assertEquals(638, $statisticsTo->getValue());
        $this->assertEquals('characters', $statisticsTo->getUnits());
    }
}
