<?= render('reports/header', array('report'=>$report)); ?>
<!-- body -->

<table class="table">
    <thead>
        <tr>
            <th>Description</th>
            <th>Unit no(s).</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>Occupied Units</td>
            <td>
                <?php
                    foreach ($data_rows as $dr)
                    {
                        if ($dr['status'] == 'CI')
                            continue;
                        echo $dr['name'].',&nbsp;';
                    }
                ?>
            </td>
        </tr>
        <tr>
            <td>Vacant Units</td>
            <td>
            <?php
                foreach ($data_rows as $dr)
                {
                    if ($dr['status'] == 'CO')
                        continue;
                    echo $dr['name'].',&nbsp;';
                }
            ?>
            </td>
        </tr>
        <tr>
            <td>Departure Units</td>
            <td></td>
        </tr>
        <tr>
            <td>Checked Out Units</td>
            <td></td>
        </tr>
        <tr>
            <td>Blocked Units</td>
            <td>
            <?php
                foreach ($data_rows as $dr)
                {
                    if ($dr['status'] != 'CI' && $dr['status'] != 'CO')
                        continue;
                    echo $dr['name'].',&nbsp;';
                }
            ?>
            </td>
        </tr>

    </tbody>

    <tfoot></tfoot>
</table>

<!-- footer -->
