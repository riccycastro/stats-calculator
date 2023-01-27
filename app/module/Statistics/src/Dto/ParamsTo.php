<?php

namespace Statistics\Dto;

use DateTime;

/**
 * Class OptionTo
 *
 * @package Statistics\Dto
 */
class ParamsTo
{

    /**
     * @var string
     */
    private $statName;

    /**
     * @var DateTime
     */
    private $startDate;

    /**
     * @var DateTime
     */
    private $endDate;

    public function __construct(string $statName)
    {
        $this->statName = $statName;
    }

    /**
     * @return string|null
     */
    public function getStatName(): ?string
    {
        return $this->statName;
    }

    /**
     * @return DateTime|null
     */
    public function getStartDate(): ?DateTime
    {
        return $this->startDate;
    }

    /**
     * @return DateTime|null
     */
    public function getEndDate(): ?DateTime
    {
        return $this->endDate;
    }

    /**
     * @param DateTime $startDate
     *
     * @return $this
     */
    public function setStartDate(DateTime $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * @param DateTime $endDate
     *
     * @return $this
     */
    public function setEndDate(DateTime $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }
}
