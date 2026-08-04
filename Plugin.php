<?php
namespace Kanboard\Plugin\KPI;

use Kanboard\Core\Plugin\Base;

class Plugin extends Base
{
    public function initialize()
    {
        $this->route->addRoute('/kpi', 'KPIController', 'index', 'KPI');
        $this->route->addRoute('/kpi/create', 'KPIController', 'create', 'KPI');
        $this->route->addRoute('/kpi/save', 'KPIController', 'save', 'KPI');
        $this->route->addRoute('/kpi/edit/:id', 'KPIController', 'edit', 'KPI');
        $this->route->addRoute('/kpi/update/:id', 'KPIController', 'update', 'KPI');
        $this->route->addRoute('/kpi/remove/:id', 'KPIController', 'remove', 'KPI');

        // Task Routes
        $this->route->addRoute('/kpi/task_open', 'TaskController', 'task_open', 'KPI');
        $this->route->addRoute('/kpi/task_overdue', 'TaskController', 'task_overdue', 'KPI');
        $this->route->addRoute('/kpi/task_completed', 'TaskController', '       task_completed', 'KPI');    

        $this->container['dashboardService'] = $this->container->factory(function ($c) {
            return new \Kanboard\Plugin\KPI\Service\DashboardService($c);
        });

        $this->container['dashboardService'] = function ($c) {
            return new \Kanboard\Plugin\KPI\Service\DashboardService($c);
        };

        // Register Assets
        $this->hook->on('template:layout:js', [
            'template' => 'plugins/KPI/Asset/js/chart.min.js',
        ]);

        $this->hook->on('template:layout:js', [
            'template' => 'plugins/KPI/Asset/js/dashboard.js',
        ]);

        $this->hook->on('template:layout:css', ['template' => 'plugins/KPI/Asset/css/dashboard.css']);
        $this->hook->on('template:layout:css', ['template' => 'plugins/KPI/Asset/css/plugin.css']);
         $this->hook->on('template:layout:css', ['template' => 'plugins/KPI/Asset/css/table.css']);

        $this->hook->on('template:layout:js', ['template' => 'plugins/KPI/Asset/js/kpi.js']);
        // Dashboard Menu
        $this->template->hook->attach('template:dashboard:sidebar', 'KPI:dashboard/sidebar');

        // Top Menu
        //$this->template->hook->attach('template:header:dropdown', 'KPI:dashboard/menu');
        $this->template->hook->attach('template:project-header:view-switcher', 'KPI:project_header/views');
    }

    public function getPluginName()
    {
        return 'KPI';
    }

    public function getPluginDescription()
    {
        return 'Employee and Project KPI Dashboard for Kanboard';
    }

    public function getPluginAuthor()
    {
        return 'Rey Mark S. Baload';
    }

    public function getPluginVersion()
    {
        return '1.0.0';
    }

    public function getCompatibleVersion()
    {
        return '>=1.2.40';
    }
}
