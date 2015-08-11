<?php

namespace ConditionalBundle;

abstract class Condition
{
    protected $subject;
    protected $condition;

    /**
     * It can be whatever - array, anonymous function, object
     * @param $condition
     */
    public function __construct($condition)
    {
        $this->condition = $condition;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * Resolve condition and applies regulators that are the same type as result for the subject
     * @param $regulators
     */
    public function resolve($regulators)
    {
        $result = $this->resolveCondition();

        foreach($regulators as $regulator) {
            if(!($regulator instanceof Regulator)) {
                throw new \InvalidArgumentException(sprintf('Regulator have to be ConditionalBundle\\Regulator instance, %s given', get_class($regulator)));
            }

            // it could be written as $regulator->isPositive() == $result, but this way intentions are more clear
            if ($regulator->isPositive() && $result == true || !$regulator->isPositive() && $result == false) {
                $regulator->apply($this->subject);
            }
        }
    }

    /**
     * @return bool
     */
    abstract protected function resolveCondition();
}