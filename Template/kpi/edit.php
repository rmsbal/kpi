<div class="page-header">

    <h2><?= t('Edit KPI') ?></h2>

</div>

<form method="post" action="<?= $this->url->href(
    'KPIController',
    'update',
    ['id' => $values['id']],
    'KPI'
) ?>">

    <?= $this->form->csrf() ?>

    <?= $this->render('KPI:kpi/form', [
        'values' => $values,
        'errors' => $errors,
    ]) ?>

</form>