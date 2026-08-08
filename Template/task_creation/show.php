<div class="page-header">
    <h2>
        <?= $this->text->e($project['name']) ?>
        &gt;
        <?= t('New task') ?>
    </h2>
</div>

<form
    method="post"
    action="<?= $this->url->href(
        'TaskCreationController',
        'save',
        array(
            'project_id' => $project['id']
        )
    ) ?>"
    autocomplete="off"
>

    <?= $this->form->csrf() ?>

    <div class="task-form-container">

        <!-- MAIN COLUMN -->

        <div class="task-form-main-column">

            <?= $this->task->renderTitleField(
                $values,
                $errors
            ) ?>

            <?= $this->task->renderDescriptionField(
                $values,
                $errors
            ) ?>

            <?= $this->task->renderDescriptionTemplateDropdown(
                $project['id']
            ) ?>

            <?= $this->task->renderTagField(
                $project
            ) ?>

            <?= $this->hook->render(
                'template:task:form:first-column',
                array(
                    'values' => $values,
                    'errors' => $errors
                )
            ) ?>

        </div>


        <!-- SECOND COLUMN -->

        <div class="task-form-secondary-column">

            <?= $this->task->renderColorField(
                $values
            ) ?>

            <?= $this->task->renderAssigneeField(
                $users_list,
                $values,
                $errors
            ) ?>

            <?= $this->task->renderCategoryField(
                $categories_list,
                $values,
                $errors
            ) ?>

            <?= $this->task->renderSwimlaneField(
                $swimlanes_list,
                $values,
                $errors
            ) ?>

            <?= $this->task->renderColumnField(
                $columns_list,
                $values,
                $errors
            ) ?>

            <?= $this->task->renderPriorityField(
                $project,
                $values
            ) ?>

            <?= $this->hook->render(
                'template:task:form:second-column',
                array(
                    'values' => $values,
                    'errors' => $errors
                )
            ) ?>

        </div>


        <!-- THIRD COLUMN -->

        <div class="task-form-secondary-column">

            <?php
            /*
             * Get KPIs belonging to this project.
             */
            $kpis = $this->kpiModel->getAll(
                $project['id']
            );
            ?>


            <!-- KPI -->

            <div class="form-group">

                <label for="kpi_id">
                    <?= t('KPI') ?>
                </label>

                <select
                    name="kpi_id"
                    id="kpi_id"
                    class="form-control"
                >

                    <option value="">
                        <?= t('Select KPI') ?>
                    </option>

                    <?php foreach ($kpis as $kpi): ?>

                        <option
                            value="<?= (int) $kpi['id'] ?>"
                            data-points="<?= (int) $kpi['points'] ?>"
                            <?= isset($values['kpi_id']) &&
                                $values['kpi_id'] == $kpi['id']
                                ? 'selected'
                                : '' ?>
                        >
                            <?= $this->text->e(
                                $kpi['title']
                            ) ?>
                        </option>

                    <?php endforeach ?>

                </select>

            </div>


            <!-- KPI POINTS -->

            <div class="form-group">

                <label for="kpi_points">
                    <?= t('KPI Points') ?>
                </label>

                <input
                    type="number"
                    name="kpi_points"
                    id="kpi_points"
                    class="form-control"
                    value="<?= isset($values['kpi_points'])
                        ? $values['kpi_points']
                        : '' ?>"
                    readonly
                >

            </div>


            <!-- ORIGINAL THIRD COLUMN -->

            <?= $this->task->renderDueDateField(
                $values,
                $errors
            ) ?>

            <?= $this->task->renderStartDateField(
                $values,
                $errors
            ) ?>

            <?= $this->task->renderTimeEstimatedField(
                $values,
                $errors
            ) ?>

            <?= $this->task->renderTimeSpentField(
                $values,
                $errors
            ) ?>

            <?= $this->task->renderScoreField(
                $values,
                $errors
            ) ?>

            <?= $this->task->renderReferenceField(
                $values,
                $errors
            ) ?>

            <?= $this->hook->render(
                'template:task:form:third-column',
                array(
                    'values' => $values,
                    'errors' => $errors
                )
            ) ?>

        </div>


        <!-- BOTTOM -->

        <div class="task-form-bottom">

            <details class="accordion-section">

                <summary class="accordion-title">
                    <?= t('Add attachments') ?>
                </summary>

                <div class="accordion-content">

                    <?= $this->task->renderFileUpload(
                        $screenshot,
                        $files
                    ) ?>

                </div>

            </details>


            <?= $this->hook->render(
                'template:task:form:bottom-before-buttons',
                array(
                    'values' => $values,
                    'errors' => $errors
                )
            ) ?>


            <?php if (! isset($duplicate)): ?>

                <?= $this->form->checkbox(
                    'another_task',
                    t('Create another task'),
                    1,
                    isset($values['another_task']) &&
                    $values['another_task'] == 1,
                    '',
                    array(
                        'tabindex' => '16'
                    )
                ) ?>

                <?= $this->form->checkbox(
                    'duplicate_multiple_projects',
                    t('Duplicate to multiple projects'),
                    1,
                    false,
                    '',
                    array(
                        'tabindex' => '17'
                    )
                ) ?>

            <?php endif ?>


            <?= $this->modal->submitButtons() ?>

        </div>

    </div>

</form>


<script>

document.addEventListener('DOMContentLoaded', function () {

    const kpiSelect =
        document.getElementById('kpi_id');

    const kpiPoints =
        document.getElementById('kpi_points');

    if (!kpiSelect || !kpiPoints) {
        return;
    }

    function updateKpiPoints() {

        const option =
            kpiSelect.options[kpiSelect.selectedIndex];

        if (!option || !option.value) {
            kpiPoints.value = '';
            return;
        }

        kpiPoints.value =
            option.dataset.points || '';
    }

    kpiSelect.addEventListener(
        'change',
        updateKpiPoints
    );

    updateKpiPoints();

});

</script>