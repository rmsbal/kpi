<?= $this->render('app/flash_message') ?>
<?= $this->projectHeader->render($project,'KPIController','project',false,'KPI');?> 
<div class="dashboard-panel">

    <div class="panel-header">

        <h3><?= t('Key Performance Indicators') ?></h3>

       <?= $this->modal->small(
            'plus',
            t('Add KPI'),
            'KPIController', 
            'create',
            [
                'tasks' => $tasks,
                'project_id' => $project['id'],
                'plugin' => 'KPI'
            ]
        ) ?>

    </div>

    <div class="kb-table-panel">

    <div class="kb-table-header mt-3 p-1">
        <?= t('Major KPIs') ?>
    </div>

    <div class="kb-table-container">

        <table class="kb-table kb-table-striped">

            <thead>
                <tr>
                    <th><?= t('Activities / Task') ?></th>
                    <th><?= t('Expected Outcome') ?></th>
                    <th><?= t('Target') ?></th>
                    <th><?= t('Actual') ?></th>
                    <th><?= t('Status') ?></th>
                    <th><?= t('Action') ?></th>
                </tr>
            </thead>

            <tbody>

            <?php foreach ($kpis as $kpi): ?>

                <?php if ($kpi['type'] !== 'MAJOR') continue; ?>

                <tr>

                    <td><?= $this->text->e($kpi['title']) ?></td>

                    <td><?= $this->text->e($kpi['output']) ?></td>

                    <td class="kb-text-center">
                        <?= number_format($kpi['target']) ?>
                    </td>

                    <td class="kb-text-center">
                        <?= number_format($kpi['actual']) ?>
                    </td>

                    <td class="kb-text-center">

                        <?php if ($kpi['status'] === 'DONE'): ?>
                            <span class="kb-success"><?= t('DONE') ?></span>
                        <?php elseif($kpi['status'] === 'ONGOING'): ?>
                            <span class="kb-warning"><?= t('ONGOING') ?></span>
                        <?php else: ?>
                            <span class="kb-danger"><?= t('PENDING') ?></span>
                        <?php endif ?>

                    </td>

                    <td class="kb-actions kb-text-center">

                        <?= $this->modal->small(
                            'pencil',
                            '',
                            'KPIController',
                            'edit',
                            [
                                'id' => $kpi['id'],
                                'values' => $kpi,
                                'plugin' => 'KPI'
                            ]
                        ) ?>

                        <?= $this->modal->small(
                            'trash',
                            '',
                            'KPIController',
                            'confirm',
                            [
                                'kpi_id' => $kpi['id'],
                                'kpi_name' => $kpi['name'],
                                'plugin' => 'KPI'
                            ]
                        ) ?>

                    </td>

                </tr>

            <?php endforeach ?>

            </tbody>

        </table>

    </div>

</div>


<div class="kb-table-panel">

    <div class="kb-table-header mt-3 p-1">
        <?= t('Minor KPIs') ?>
    </div>

    <div class="kb-table-container">

        <table class="kb-table kb-table-striped">
              <thead>
                <tr>
                    <th><?= t('Activities / Task') ?></th>
                    <th><?= t('Expected Outcome') ?></th>
                    <th><?= t('Target') ?></th>
                    <th><?= t('Actual') ?></th>
                    <th><?= t('Status') ?></th>
                    <th><?= t('Action') ?></th>
                </tr>
            </thead>

            <tbody>

             <?php foreach ($kpis as $kpi): ?>

                <?php if ($kpi['type'] !== 'MINOR') continue; ?>

                <tr>

                    <td><?= $this->text->e($kpi['title']) ?></td>

                    <td><?= $this->text->e($kpi['output']) ?></td>

                    <td class="kb-text-center">
                        <?= number_format($kpi['target']) ?>
                    </td>

                    <td class="kb-text-center">
                        <?= number_format($kpi['actual']) ?>
                    </td>

                    <td class="kb-text-center">
                        <?php if ($kpi['status'] === 'DONE'): ?>
                            <span class="kb-success"><?= t('DONE') ?></span>
                        <?php elseif($kpi['status'] === 'ONGOING'): ?>
                            <span class="kb-warning"><?= t('ONGOING') ?></span>
                        <?php else: ?>
                            <span class="kb-danger"><?= t('PENDING') ?></span>
                        <?php endif ?>
                    </td>

                    <td class="kb-actions kb-text-center">

                        <?= $this->modal->small(
                            'pencil',
                            '',
                            'KPIController',
                            'edit',
                            [
                                'id' => $kpi['id'],
                                'values' => $kpi,
                                'plugin' => 'KPI'
                            ]
                        ) ?>

                        <?= $this->modal->small(
                            'trash',
                            '',
                            'KPIController',
                            'confirm',
                            [
                                'kpi_id' => $kpi['id'],
                                'kpi_name' => $kpi['name'],
                                'plugin' => 'KPI'
                            ]
                        ) ?>

                    </td>

                </tr>

            <?php endforeach ?>
            </tbody>

        </table>

    </div>

</div>

</div>