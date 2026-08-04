<?= $this->projectHeader->render($project,'TaskController','task_overdue',false,'KPI');?>

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-0"><?= t('Overdue Tasks') ?> (<?= count($tasks) ?>)</h2>
        </div>
    </div>

    <?php if (empty($tasks)): ?>

        <div class="alert alert-info">
            <?= t('No overdue tasks found.') ?>
        </div>

    <?php else: ?>

        <div class="card shadow-sm">

            <div class="card-header bg-primary text-white">
                <?= t('Task List') ?>
            </div>

            <div class="table-responsive">

                <table class="table table-hover table-striped align-middle mb-0">

                    <thead class="table-light">
                    <tr>
                        <th width="70">#</th>
                        <th><?= t('Title') ?></th>
                        <th width="150"><?= t('Assignee') ?></th>
                        <th width="200"><?= t('Start Date') ?></th>
                        <th width="200"><?= t('Due Date') ?></th>
                    </tr>
                    </thead>

                    <tbody>

                    <?php foreach ($tasks as $task): ?>

                        <tr>

                            <td><?= $task['id'] ?></td>

                            <td>
                                <?= $this->url->link(
                                    $this->text->e($task['title']),
                                    'TaskViewController',
                                    'show',
                                    [
                                        'task_id' => $task['id'],
                                        'project_id' => $project['id'],
                                    ]
                                ) ?>
                            </td>

                            <td>
                                <?= $task['owner_id'] ?: '-' ?>
                            </td>

                            <td>
                                <?= $task['date_started'] > 0
                                    ? date('l, F j, Y', $task['date_started'])
                                    : '-' ?>
                            </td>

                            <td>
                                <?= $task['date_due'] > 0
                                    ? date('l, F j, Y', $task['date_due'])
                                    : '-' ?>
                            </td>

                        </tr>

                    <?php endforeach ?>

                    </tbody>

                </table>

            </div>

        </div>

    <?php endif; ?>
</div>