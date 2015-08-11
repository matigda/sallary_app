<?php

namespace PayrollBundle\Service;

use ConditionalBundle\ConditionalService;

class MonthsGenerator extends ConditionalService
{
    /**
     * Applies conditions for every month
     * @return array of DateTimes
     */
    public function execute()
    {
        $arrayOfDateTimes = $this->generateMonthsLeftList();

        foreach ($arrayOfDateTimes as $dateTime) {
            $this->applyConditions($dateTime);
        }

        return $arrayOfDateTimes;
    }

    /**
     * @return array of DateTimes with every month till end of this year
     */
    private function generateMonthsLeftList()
    {
        $dateTime = new \DateTime();

        $arrayOfDateTimes = array();
        $arrayOfDateTimes[] = $dateTime;

        $monthsLeft = $this->getMonthsAmountTillYearEnd();

        for($i=1; $i <= $monthsLeft; $i++) {
            $dateTime = clone $dateTime;
            $dateTime->modify('first day of next month');
            $arrayOfDateTimes[] = $dateTime;
        }

        return $arrayOfDateTimes;
    }

    /**
     * @return int
     */
    public function getMonthsAmountTillYearEnd()
    {
        return 12 - (new \DateTime())->format('n');
    }
}