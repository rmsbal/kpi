<?php
namespace Kanboard\Plugin\KPI\Controller;

use Kanboard\Controller\BaseController;

class KPIController extends BaseController
{
    public function index()
    {
        $kpis = $this->db
            ->table('kpi_definition')
            ->asc('name')
            ->findAll();
        
        $project = $this->getProject();
        $projects = $this->projectModel->getAll();

        $this->response->html(
            $this->helper->layout->app(
                'KPI:kpi/index',
                [
                    'project'     => $project,
                    'projects'    => $projects,
                    'kpis'        => $kpis,
                    'title'       => $project['name'],
                    'description' => $this->helper->projectHeader->getDescription($project),
                ]
            )
        );
    }

    public function project()
    {
        $project = $this->getProject();
        $projects = $this->projectModel->getAll();

        $stats = $this->dashboardService->getProjectStats($project['id']);

        $kpis = $this->db
            ->table('kpi_definition')
            ->eq('project_id', $project['id'])
            ->findAll();

        $this->response->html(
            $this->helper->layout->app(
                'KPI:project/index',
                [
                    'project'     => $project,
                    'projects'    => $projects,
                    'stats'       => $stats,
                    'kpis'        => $kpis,
                    'title'       => $project['name'],
                    'description' => $this->helper->projectHeader->getDescription($project),
                ]
            )
        );
    }
    public function create()
    {
        $this->response->html(
            $this->template->render('KPI:kpi/create', [
                'values' => [
                    'project_id' => $this->request->getIntegerParam('project_id'),
                    'active' => 1,
                ],
                'errors' => [],
            ])
        );
    }

    public function save()
    {
        $values = $this->request->getValues();
        
        $values['created_at'] = time();
        $values['updated_at'] = time();
        
        // $this->logger->info(print_r($values, true));
        // $this->logger->info(print_r($project, true));

        $this->db->table('kpi_definition')->insert($values);

        $this->flash->success(t('KPI created successfully.'));

        $this->response->redirect(
            $this->helper->url->to('KPIController', 'index', [], 'KPI')
        );
    }

    public function edit()
    {
        $id = $this->request->getIntegerParam('id');

        $kpi = $this->db
            ->table('kpi_definition')
            ->eq('id', $id)
            ->findOne();

        if (! $kpi) {
            throw new \RuntimeException('KPI not found');
        }

        $this->response->html(
            $this->template->render('KPI:kpi/edit', [
                'values' => $kpi,
                'errors' => [],
            ])
        );
    }

    public function update()
    {
        $id = $this->request->getIntegerParam('id');

        $values               = $this->request->getValues();
        $values['updated_at'] = time();

        $this->db
            ->table('kpi_definition')
            ->eq('id', $id)
            ->update($values);

        $this->flash->success(t('KPI updated successfully.'));

        $this->response->redirect(
            $this->helper->url->to('KPIController', 'index', [], 'KPI')
        );
    }

    public function remove()
    {
        $id = $this->request->getIntegerParam('id');

        $this->db
            ->table('kpi_definition')
            ->eq('id', $id)
            ->remove();

        $this->flash->success(t('KPI deleted successfully.'));

        $this->response->redirect(
            $this->helper->url->to('KPIController', 'index', [], 'KPI')
        );
    }
}
