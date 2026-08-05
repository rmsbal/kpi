<div class="form-column">
    <input type="hidden" name="project_id" value="<?= $this->text->e($values['project_id']) ?>">
    
    <?= $this->form->label(t('Name'), 'name') ?>

    <?= $this->form->text(
        'name',
        $values,
        $errors
    ) ?>


    <?= $this->form->label(t('Description'), 'description') ?>

    <?= $this->form->textArea(
        'description',
        $values,
        $errors
    ) ?>


    <?= $this->form->label(t('Metric'), 'metric') ?>

    <?= $this->form->select(
        'metric',
        array(
            'completed_tasks'         => t('Completed Tasks'),
            'open_tasks'              => t('Open Tasks'),
            'overdue_tasks'           => t('Overdue Tasks'),
            'average_completion_days' => t('Average Completion'),
            'blocked_tasks'           => t('Blocked Tasks'),
        ),
        $values,
        $errors
    ) ?>


    <?= $this->form->label(t('Target'), 'target') ?>

    <?= $this->form->text(
        'target',
        $values,
        $errors
    ) ?>


    <?= $this->form->label(t('Weight'), 'weight') ?>

    <?= $this->form->text(
        'weight',
        $values,
        $errors
    ) ?>


    <?= $this->form->label(t('Period'), 'period') ?>

    <?= $this->form->select(
        'period',
        array(
            'daily'   => t('Daily'),
            'weekly'  => t('Weekly'),
            'monthly' => t('Monthly'),
            'yearly'  => t('Yearly'),
        ),
        $values,
        $errors
    ) ?>


    <div class="form-row">

        <?= $this->form->checkbox(
            'active',
            t('Active'),
            1,
            !empty($values['active'])
        ) ?>

    </div>


    <div class="form-actions">

        <button type="submit" class="btn btn-blue">
            <?= t('Save KPI') ?>
        </button>

        <?= t('or') ?>

        <a href="#" class="js-modal-close">
            <?= t('Cancel') ?>
        </a>

    </div>

</div>