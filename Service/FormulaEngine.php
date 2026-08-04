<?php

namespace Kanboard\Plugin\KPI\Service;

class FormulaEngine
{
    public function compute(string $formula, float $actual, float $target): float
    {
        switch ($formula) {

            case 'ratio':

                return $target == 0 ? 0 : ($actual/$target)*100;

            case 'reverse':

                return $actual == 0 ? 100 : ($target/$actual)*100;

            case 'difference':

                return max(0,100-abs($actual-$target));

            default:

                return 0;
        }
    }
}