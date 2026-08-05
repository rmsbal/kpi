<div class="page-header">
    <h2><?= t('Create KPI') ?></h2>
</div>

<form method="post"
    action="<?= $this->url->href(
    'KPIController',
    'save',
    ['plugin'=>'KPI']
) ?>"
      autocomplete="off">

    <?= $this->form->csrf() ?>

    <?= $this->render('KPI:kpi/form', [
    'values' => $values,
    'errors' => $errors,
]) ?>

</form>