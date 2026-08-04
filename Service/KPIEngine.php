<?php

namespace Kanboard\Plugin\KPI\Service;

use Kanboard\Core\Base;

class KPIEngine extends Base
{
    public function score($actual, $target, $weight)
    {
        if ($target <= 0) {
            return 0;
        }

        $percent = ($actual / $target) * 100;

        return round(($percent * $weight) / 100, 2);
    }
}