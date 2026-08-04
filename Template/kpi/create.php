<div class="page-header">
    <h2><?php echo t('Create KPI') ?></h2>
</div>

<form method="post"
    action="<?php echo $this->url->href(
    'KPIController',
    'save',
    ['plugin'=>'KPI']
) ?>"
      autocomplete="off">

    <?php echo $this->form->csrf() ?>

    <?php echo $this->render('KPI:kpi/form', [
    'values' => $values,
    'errors' => $errors,
]) ?>

</form>