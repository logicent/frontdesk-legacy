<?= render('reports/header', array('report'=>$report)); ?>
<!-- body -->

<table class="table">
    <thead>
        <tr>
            <th>Description</th>
            <th>Amount</th>
        </tr>
    </thead>

    <tbody>
        <tr><th colspan=2>Unit Revenue</th></tr>
        <tr>
            <td>Unit Rent</td>
            <td><?= number_format($row_results['unit_rent'][0]['total_rent']); ?></td>
        </tr>
        <tr>
            <td>Discount</td>
            <td><?= number_format($row_results['discount'][0]['total_discount']); ?></td>
        </tr>
        <!-- <tr><th colspan=2>Extra Charges</th></tr>
        <tr><th colspan=2>Payment Information</th></tr> -->
        <tr><th colspan=2>Unit Summary</th></tr>
        <tr>
            <td>Sold Units / Nights</td>
            <td>
                <?= $row_results['sold_units'][0]['sold_rm_count']; ?> /
                <?= $row_results['sold_nights'][0]['sold_nights_count']; ?>
            </td>
        </tr>
        <!-- <tr>
            <td>Blocked Units</td>
            <td></td>
        </tr> -->
        <tr>
            <td>No. of Guests (Adults only)</td>
            <td><?= $row_results['guests'][0]['guest_count']; ?></td>
        </tr>
        <!-- <tr>
            <td>Complimentary Units</td>
            <td></td>
        </tr> -->
        <tr><th colspan=2>Statistics</th></tr>
        <tr>
            <td>Occupancy Rate (%)</td>
            <td>
                <?php if ($row_results['sold_units'][0]['sold_rm_count'] > 0) : ?>
                <?= round($row_results['sold_units'][0]['sold_rm_count'] / ($row_results['sold_units'][0]['sold_rm_count'] + $row_results['available_units'][0]['vacant_rm_count']) * 100); ?> %
                <?php else: 0 ?>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <td>Average Daily Rate (ADR)</td>
            <td>
                <?php if ($row_results['sold_units'][0]['sold_rm_count'] > 0) : ?>
                <?= number_format($row_results['unit_rent'][0]['total_rent'] / $row_results['sold_nights'][0]['sold_nights_count'], 2); ?>
                <?php endif; ?>
            </td>
        </tr>
        <!-- <tr>
            <td>Revenue per Available Unit</td>
            <td><?php //= round($row_results['sold_units'][0]['sold_rm_count'] / ($row_results['sold_units'][0]['sold_rm_count'] + $row_results['available_units'][0]['vacant_rm_count']) * 100) * ($row_results['unit_rent'][0]['total_rent'] / $row_results['sold_units'][0]['sold_rm_count']); ?></td>
        </tr> -->
        <!-- <tr><th colspan=2>Guest Ledger</th></tr> -->
        <tr><th colspan=2>Accounts Summary</th></tr>
        <!-- <tr>
            <td>Opening Balance</td>
            <td><?php //echo ; ?></td>
        </tr> -->
        <tr>
            <!-- <td>Charge Posted to Ledger</td> -->
            <td>Settlement by Guests</td>
            <td><?= number_format($row_results['receipts'][0]['total_receipts']); ?></td>
        </tr>
        <!-- <tr>
            <td>Advance Deposit Collected</td>
            <td><?php //echo $advances[0]['advances']; ?></td>
        </tr> -->
        <tr>
            <td>Cash Expenses</td>
            <td><?= number_format($row_results['expenses'][0]['total_expenses']); ?></td>
        </tr>
        <tr>
            <td>Bank Deposit Total</td>
            <td><?= number_format($row_results['deposits'][0]['total_deposits']); ?></td>
        </tr>
        <tr>
            <th>Cash in Hand</th>
            <th><?= number_format($row_results['cash_in_hand']); ?></th>
        </tr>
    </tbody>

    <tfoot></tfoot>
</table>

<!-- footer -->
