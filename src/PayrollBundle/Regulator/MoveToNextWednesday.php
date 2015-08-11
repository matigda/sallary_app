<?php

namespace PayrollBundle\Regulator;

use ConditionalBundle\Regulator;

class MoveToNextWednesday extends Regulator
{
    /**
     * Changes DateTime to next wednesday from given date
     * @param $subject
     */
    public function apply($subject)
    {
        if(!($subject instanceof \DateTime)) {
            throw new \InvalidArgumentException();
        }

        $subject->modify('next wednesday');
    }
}