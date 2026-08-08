<?php

namespace Kanboard\Plugin\KPI\Controller;

use Kanboard\Controller\BaseController;

class KpiTaskCreationController extends BaseController
{
    /**
     * Display the task creation form.
     */
    public function show(
        array $values = array(),
        $screenshot = '',
        array $files = array(),
        array $errors = array()
    ) {
        $project = $this->getProject();

        $swimlanesList = $this->swimlaneModel->getList(
            $project['id'],
            false,
            true
        );

        $values += $this->prepareValues(
            $project['is_private'],
            $swimlanesList
        );

        $values = $this->hook->merge(
            'controller:task:form:default',
            $values,
            array(
                'default_values' => $values
            )
        );

        $values = $this->hook->merge(
            'controller:task-creation:form:default',
            $values,
            array(
                'default_values' => $values
            )
        );

        /*
         * Get KPI list for this project.
         */
        $kpis = $this->kpiModel->getAll(
            $project['id']
        );

        /*
         * Convert KPI records into a list:
         *
         * [
         *     1 => 'Tree Survival Rate',
         *     2 => 'Area Planted'
         * ]
         */
        $kpiList = array();

        /*
         * Separate points so we can use them
         * in JavaScript.
         */
        $kpiPoints = array();

        foreach ($kpis as $kpi) {

            $kpiList[$kpi['id']] = $kpi['title'];

            $kpiPoints[$kpi['id']] = $kpi['points'];
        }

        $this->response->html(
            $this->template->render(
                'task_creation/show',
                array(

                    'project' => $project,

                    'values' => $values + array(
                        'project_id' => $project['id']
                    ),

                    'errors' => $errors,

                    /*
                     * KPI data
                     */
                    'kpis' => $kpiList,

                    'kpi_points' => $kpiPoints,

                    /*
                     * Normal Kanboard fields
                     */
                    'columns_list' =>
                        $this->columnModel->getList(
                            $project['id']
                        ),

                    'users_list' =>
                        $this->projectUserRoleModel
                            ->getAssignableUsersList(
                                $project['id'],
                                true,
                                false,
                                $project['is_private'] == 1
                            ),

                    'categories_list' =>
                        $this->categoryModel->getList(
                            $project['id']
                        ),

                    'swimlanes_list' =>
                        $swimlanesList,

                    'screenshot' =>
                        $screenshot,

                    'files' =>
                        $files,
                )
            )
        );
    }


    /**
     * Save task.
     */
    public function save()
    {
        $project = $this->getProject();

        $values = $this->request->getValues();

        /*
         * Always use the current project.
         */
        $values['project_id'] = $project['id'];

        $files = $this->request->getFileInfo('files');

        $screenshot = null;

        if (array_key_exists('screenshot', $values)) {

            $screenshot = $values['screenshot'];

            unset($values['screenshot']);
        }


        /*
         * Validate task.
         */
        list($valid, $errors) =
            $this->taskValidator->validateCreation(
                $values
            );

        if (! $valid) {

            $this->flash->failure(
                t('Unable to create your task.')
            );

            $this->show(
                $values,
                $screenshot,
                $files,
                $errors
            );

            return;
        }


        /*
         * Create the Kanboard task.
         */
        $taskId = $this->taskCreationModel->create(
            $values
        );

        if ($taskId === 0) {

            $this->flash->failure(
                t('Unable to create this task.')
            );

            $this->response->redirect(
                $this->helper->url->to(
                    'BoardViewController',
                    'show',
                    array(
                        'project_id' => $project['id']
                    )
                ),
                true
            );

            return;
        }


        /*
         * TODO:
         * Save KPI relationship here.
         *
         * $values['kpi_id']
         */


        /*
         * Upload screenshot.
         */
        if ($screenshot) {

            $this->taskFileModel->uploadScreenshot(
                $taskId,
                $screenshot
            );
        }


        /*
         * Upload files.
         */
        if (
            isset($files['name'][0]) &&
            $files['name'][0] !== ''
        ) {

            $this->taskFileModel->uploadFiles(
                $taskId,
                $files
            );
        }


        $this->flash->success(
            t('Task created successfully.')
        );


        $this->response->redirect(
            $this->helper->url->to(
                'BoardViewController',
                'show',
                array(
                    'project_id' => $project['id']
                )
            ),
            true
        );
    }


    /**
     * Prepare default task values.
     */
    protected function prepareValues(
        $isPrivateProject,
        array $swimlanesList
    ) {
        $values = array(
            'swimlane_id' =>
                $this->request->getIntegerParam(
                    'swimlane_id',
                    key($swimlanesList)
                ),

            'column_id' =>
                $this->request->getIntegerParam(
                    'column_id'
                ),

            'color_id' =>
                $this->colorModel->getDefaultColor(),
        );

        if ($isPrivateProject) {

            $values['owner_id'] =
                $this->userSession->getId();
        }

        return $values;
    }
}