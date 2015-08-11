<?php

namespace PayrollBundle\Regulator;

use ConditionalBundle\Regulator;

class MoveToLastFriday extends Regulator
{
    /**
     * Changes DateTime to last friday in month in given date
     * @param $subject
     */
    public function apply($subject)
    {
        if(!($subject instanceof \DateTime)) {
            throw new \InvalidArgumentException();
        }

        $subject->modify('last fri of this month');
    }
}