<?php

namespace Kanboard\Plugin\KPI\Controller;

use Kanboard\Controller\BaseController;

class AssignmentController extends BaseController
{
    public function index()
    {
        $assignments = $this->db
            ->table('kpi_assignment')
            ->findAll();

        $users = $this->userModel->getAll();

        $kpis = $this->db
            ->table('kpi_definition')
            ->findAll();

        $this->response->html(
            $this->template->render(
                'KPI:assignment/index',
                [
                    'assignments' => $assignments,
                    'users' => $users,
                    'kpis' => $kpis,
                ]
            )
        );
    }

    public function save()
    {
        $values = $this->request->getValues();

        $values['created_at'] = time();
        $values['updated_at'] = time();

        $this->db
            ->table('kpi_assignment')
            ->insert($values);

        $this->flash->success(t('Assignment saved'));

        $this->response->redirect(
            $this->helper->url->to(
                'AssignmentController',
                'index',
                [],
                'KPI'
            )
        );
    }
}