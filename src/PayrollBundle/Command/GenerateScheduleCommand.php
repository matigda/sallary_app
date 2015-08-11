<?php

namespace PayrollBundle\Command;

use ConditionalBundle\CallableCondition;
use PayrollBundle\Service\CsvGenerator;
use PayrollBundle\Service\MonthsGenerator;
use PayrollBundle\Regulator\MoveToLastFriday;
use PayrollBundle\Regulator\MoveToNextWednesday;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class GenerateScheduleCommand extends Command
{
    protected function configure()
    {
        $this->setName("payroll:generate:schedule")
            ->setDescription("Generate payroll schedule.");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $monthsGenerator = new MonthsGenerator();
        $monthsGenerator->addCondition(new CallableCondition(function(\DateTime $date){
            return $date->modify('last day of this month')->format('N') < 6;
        }), array(new MoveToLastFriday(false)));

        $paymentDates = $monthsGenerator->execute();

        $monthsGenerator->resetConditions();

        $monthsGenerator->addCondition(new CallableCondition(function(\DateTime $date){
            return $date->modify('first day of this month')->modify('+14 days')->format('N') < 6;
        }), array(new MoveToNextWednesday(false)));


        $bonusDates = $monthsGenerator->execute();

        $csvData = array('headers' => array('month name', 'payment date', 'bonus date'), 'data' => array());

        for($i=0; $i< count($paymentDates); $i++) {
            $csvData['data'][] = array(
                'monthName' => $paymentDates[$i]->format('F'),
                'paymentDate' => $paymentDates[$i]->format('d-m-Y'),
                'bonusDate' => $bonusDates[$i]->format('d-m-Y'),
            );
        }

        $csvGenerator = new CsvGenerator();
        $csvGenerator->createCsvFile(__DIR__ . '/../../../data/', 'data.csv', $csvData);
    }

}
