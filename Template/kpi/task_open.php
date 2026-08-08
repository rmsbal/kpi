<?= $this->projectHeader->render($project,'TaskController','task_open',false,'KPI');?>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-0"><?= t('Open Tasks') ?> (<?= count($tasks) ?>)</h2>
        </div>
    </div>
    <?php if (empty($tasks)): ?>
        <div class="alert alert-info">
            <?= t('No open tasks found.') ?>
        </div>
    <?php else: ?>
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <?= t('Task List') ?>
            </div>
            <div class="kb-table-container">
                <table class="kb-table">
                    <thead class="table-light">
                    <tr>
                        <th width="70">#</th>
                        <th><?= t('Title') ?></th>
                        <th><?= t('Assignee') ?></th>
                        <th><?= t('Column') ?></th>
                        <th><?= t('Start Date') ?></th>
                        <th><?= t('Due Date') ?></th>
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
                                <?= $task['column_name'] ?>
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
