<?php

namespace ConditionalBundle;

abstract class ConditionalService
{
    private $conditions;

    public function addCondition(Condition $condition, array $regulators)
    {
        $this->conditions[] = array('condition' => $condition, 'regulators' => $regulators);
    }

    /**
     * Passes regulator for every conditions and resolves them
     * @param $subject
     */
    protected function applyConditions($subject)
    {
        foreach($this->conditions as $dataSet) {
            $condition = $dataSet['condition'];
            $regulators = $dataSet['regulators'];

            $condition->setSubject($subject);

            $condition->resolve($regulators);
        }
    }

    public function resetConditions()
    {
        $this->conditions = array();
    }
}