<div class="kb-form">

    <div class="kb-form-panel">

        <div class="kb-form-header">
            <?= t('KPI Information') ?>
        </div>

        <div class="kb-form-body">

            <input type="hidden"
                   name="project_id"
                   value="<?= $this->text->e($values['project_id']) ?>">

            <!-- Title -->
            <div class="kb-row">
                <div class="kb-col">
                    <?= $this->form->label(t('Title'), 'title') ?>
                    <?= $this->form->text('title', $values, $errors) ?>
                </div>
            </div>

            <!-- Description -->
            <div class="kb-row">
                <div class="kb-col">
                    <?= $this->form->label(t('Description'), 'description') ?>
                    <?= $this->form->textArea(
                        'description',
                        $values,
                        $errors,
                        ['rows' => 5]
                    ) ?>
                </div>
            </div>

            <!-- Outcome + Type -->
            <div class="kb-row">

                <div class="kb-col-2">
                    <?= $this->form->label(t('Output'), 'output') ?>
                    <?= $this->form->text('output', $values, $errors) ?>
                </div>

                <div class="kb-col-2">
                    <?= $this->form->label(t('Type'), 'type') ?>
                    <?= $this->form->select(
                        'type',
                        [
                            'MAJOR' => t('MAJOR'),
                            'MINOR' => t('MINOR'),
                        ],
                        $values,
                        $errors
                    ) ?>
                </div>

            </div>

            <!-- Target + Actual -->
            <div class="kb-row">

                <div class="kb-col-2">
                    <?= $this->form->label(t('Target'), 'target') ?>
                    <?= $this->form->text('target', $values, $errors) ?>
                </div>

                <div class="kb-col-2">
                    <?= $this->form->label(t('Actual'), 'actual') ?>
                    <?= $this->form->text('actual', $values, $errors) ?>
                </div>

                <div class="kb-col-2">
                        <?= $this->form->label(t('Status'), 'status') ?>
                        <?= $this->form->select(
                            'status',
                            [
                                'PENDING' => t('PENDING'),
                                'ONGOING' => t('ONGOING'),
                                'DONE' => t('DONE'),
                            ],
                            $values,
                            $errors
                        ) ?>
                    </div>

            </div>

        </div>

        <div class="kb-form-footer">

            <button type="submit" class="btn btn-blue">
                <?= t('Save KPI') ?>
            </button>

            <a href="#" class="btn js-modal-close">
                <?= t('Cancel') ?>
            </a>

        </div>

    </div>

</div>