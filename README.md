# Assertis sample application #

## **Task explanation**: ##

The task was to generate payroll schedule and export it to .csv file.

Conditions were:
 - salaries should be paid at last day of given month, if this day is between monday and friday. Otherwise should be paid on last friday of given month.
 - bonuses should be paid at 15th each month, if this day is between monday and friday. Otherwise should be paid at closest wednesday after 15th. 

## **Instruction**: ##


All You have to do is clone repo, install vendors and run **php app/console payroll:generate:schedule** command

This will generate **data.csv** file in data/ directory

