<?php

namespace ConditionalBundle;

abstract class Regulator
{
    /**
     * @var bool
     */
    protected $isPositive;

    public function __construct($isPositive)
    {
        $this->isPositive = $isPositive;
    }

    /**
     * Applies regulation for subjects
     * @param $subject
     */
    abstract public function apply($subject);

    /**
     * @return bool
     */
    public function isPositive()
    {
        return (bool) $this->isPositive;
    }
}