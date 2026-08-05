<?= $this->projectHeader->render($project,'TaskController','task_completed',false,'KPI');?>

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-0"><?= t('Completed Tasks') ?> (<?= count($tasks) ?>)</h2>
        </div>
    </div>

    <?php if (empty($tasks)): ?>

        <div class="alert alert-info">
            <?= t('No completed tasks found.') ?>
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
                        <th><?= t('Assignee') ?></th>
                        <th><?= t('Start Date') ?></th>
                        <th><?= t('Due Date') ?></th>
                        <th><?= t('Comments') ?></th>
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
                                <?= $task['assignee_name'] ?: '-' ?>
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

                            <td>
                                <?php if (!empty($task['comment_count'])): ?>
                                <?= $this->modal->small(
                                    'comments',
                                    t('Read'). ' ('.$task['comment_count'].')',
                                    'TaskController', 
                                    'comments',
                                    array(
                                        'task_id' => $task['id'],
                                        'plugin' => 'KPI'
                                    )
                                ) ?>
                                <?php else: ?>
                                    <?= t('-') ?>
                                <?php endif; ?>
                            </td>

                        </tr>

                    <?php endforeach ?>

                    </tbody>

                </table>

            </div>

        </div>

    <?php endif; ?>
</div>