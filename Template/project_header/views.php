
<li <?= $this->app->checkMenuSelection('KPIController') ?>>
    <?= $this->url->icon('line-chart', t('KPI'), 'KPIController', 'project', array('project_id' => $project['id'], 'search' => $filters['search'], 'plugin' => 'KPI'), false, 'view-kpi', t('Keyboard shortcut: "%s"', 'v k')) ?> 
</li>