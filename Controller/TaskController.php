<?php
namespace Kanboard\Plugin\KPI\Controller;

use Kanboard\Controller\BaseController;

class TaskController extends BaseController
{
    public function task_open()
    {
        $project = $this->getProject();
        $tasks   = $this->dashboardService->getProjectTable($project['id'], 'open');

        $this->response->html(
            $this->helper->layout->app(
                'KPI:kpi/task_open',
                [
                    'project'     => $project,
                    'tasks'       => $tasks,
                    'title'       => $project['name'],
                    'description' => $this->helper->projectHeader->getDescription($project),
                ]
            )
        );
    }

    public function task_overdue()
    {
        $project = $this->getProject();
        $tasks   = $this->dashboardService->getProjectTable($project['id'], 'overdue');

        $this->response->html(
            $this->helper->layout->app(
                'KPI:kpi/task_overdue',
                [
                    'project'     => $project,
                    'tasks'       => $tasks,
                    'title'       => $project['name'],
                    'description' => $this->helper->projectHeader->getDescription($project),
                ]
            )
        );
    }

    public function task_completed()
    {
        $project = $this->getProject();
        $tasks   = $this->dashboardService->getProjectTable($project['id'], 'completed');

        $this->response->html(
            $this->helper->layout->app(
                'KPI:kpi/task_complete',
                [
                    'project'     => $project,
                    'tasks'       => $tasks,
                    'title'       => $project['name'],
                    'description' => $this->helper->projectHeader->getDescription($project),
                ]
            )
        );
    }

    public function comments()
    {
        $taskId = $this->request->getIntegerParam('task_id');

        $task = $this->taskFinderModel->getById($taskId);

        if (empty($task)) {
            throw new \Kanboard\Core\Controller\PageNotFoundException(t('Task not found.'));
        }

        $comments = $this->commentModel->getAll($taskId);

        $this->response->html(
            $this->template->render('KPI:kpi/task_comments', [
                'task' => $task,
                'comments' => $comments,
            ])
        );
    }
}
