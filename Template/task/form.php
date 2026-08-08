<div class="form-group mt-3">
    <label for="kpi_id">
        <?= t('KPI related to task') ?>
    </label>

    <select
        name="kpi_id"
        id="kpi_id"
        class="form-control"
    >
        <option value="">
            <?= t('Select KPI') ?>
        </option>

        <?php foreach ($kpis as $kpi): ?>

            <option
                value="<?= (int) $kpi['id'] ?>"
                <?= (int) $selected_kpi === (int) $kpi['id']
                    ? 'selected'
                    : '' ?>
            >
                <?= $this->text->e($kpi['title']) ?>
            </option>

        <?php endforeach ?>
    </select>
</div>


<div class="form-group mt-3">
    <label for="kpi_points">
        <?= t('Task KPI Points') ?>
    </label>

    <input
        type="number"
        name="kpi_points"
        id="kpi_points"
        class="form-control"
        min="0"
        step="0.01"
        value="<?= $kpi_points !== null
            ? $kpi_points
            : 0 ?>"
    >
</div>