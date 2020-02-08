<?= render('reports/header', array('report'=>$report)); ?>

<!-- detail -->

<table class="table">
    <thead>
        <tr>
            <?php foreach($column_headers as $ch) : ?>
                <th><?= $ch; ?>
            <?php endforeach; ?>
        </tr>
    </thead>

    <tbody>
        <?php foreach($row_results as $dr) : ?>
            <tr class="<?= isset($dr['amount_paid']) && $dr['amount_paid'] == 0 ? 'strikeout text-muted' : '' ?>">
                <?php foreach($dr as $col => $val): ?>
                    <td><?= $val; ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>

        <?php if (!empty($total_rows)) : ?>
            <tr>
                <th colspan="<?= count($column_headers) > 3 ? '3' : '2' ?>">Total Amount</th>
                <th colspan="<?= count($column_headers) - 2 ?>">
                    <?= $total_rows[0]['total_amount'] ?>
                </th>
            </tr>
        <?php endif ?>
    </tbody>

    <tfoot>
        <tr>
            <td colspan="<?= count($column_headers) ?>">Showing <?= count($row_results) ?> records.</td>
        </tr>
    </tfoot>
</table>

<!-- summary -->

<div class="row">
    <div class="col-md-6">
        <?php if (!empty($summary_rows)) : ?>
            <p class="lead">Summary</p>
        <?php endif ?>
        <table class="table small">
            <thead>
                <tr>
                    <?php foreach($summary_cols as $ch) : ?>
                        <th><?= $ch; ?>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach($summary_rows as $sr) : ?>
                    <tr>
                        <td><?= $sr['status'] ?></td>
                        <td><?= $sr['status_count'] ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
            <tfoot></tfoot>
        </table>
    </div>
</div>
