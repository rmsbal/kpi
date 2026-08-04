<?= $this->projectHeader->render($project,'KPIController','project',false,'KPI');?>

<div class="dashboard-panel">

    <div class="panel-header">

        <h3><?= t('Configured KPIs') ?></h3>

       <?= $this->modal->small(
            'plus',
            t('Add KPI'),
            'KPIController', 
            'create',
            array(
                'project_id' => $project['id'],
                'plugin' => 'KPI'
            )
        ) ?>

    </div>

    <table class="table-striped">

        <thead>

            <tr>
                <th><?= t('KPI') ?></th>
                <th><?= t('Metric') ?></th>
                <th><?= t('Target') ?></th>
                <th><?= t('Weight') ?></th>
                <th><?= t('Status') ?></th>
                <th width="80"><?= t('Action') ?></th>
            </tr>

        </thead>

        <tbody>

            <?php foreach ($kpis as $kpi): ?>

            <tr>

                <td><?= $this->text->e($kpi['name']) ?></td>

                <td><?= $this->text->e($kpi['metric']) ?></td>

                <td><?= $kpi['target'] ?></td>

                <td><?= $kpi['weight'] ?>%</td>

                <td>

                    <?php if ($kpi['active']): ?>

                    <span class="status-closed"><?= t('Active') ?></span>

                    <?php else: ?>

                    <span class="status-open"><?= t('Inactive') ?></span>

                    <?php endif ?>

                </td> 

                <td>
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
                </td>

            </tr>

            <?php endforeach ?>

        </tbody>

    </table>

</div>