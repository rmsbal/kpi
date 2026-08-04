<?php

namespace Kanboard\Plugin\KPI\Controller;

use Kanboard\Controller\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        $this->response->html(
            $this->template->render(
                'KPI:dashboard/index',
                [
                    'title' => 'KPI Dashboard'
                ]
            )
        );
    }
}