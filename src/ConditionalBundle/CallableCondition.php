<?php

namespace ConditionalBundle;

class CallableCondition extends Condition
{
    public function resolveCondition()
    {
        if(!is_callable($this->condition)) {
            throw new \InvalidArgumentException(sprintf('Condition has to be callable and is ' . gettype($this->condition)));
        }

        $condition = $this->condition;
        return $condition($this->subject);
    }
}