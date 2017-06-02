<p><a href="<?php echo base_url("transaksi"); ?>" class="uk-button uk-button-primary">Input Transaksi</a></p>
<hr>
<table class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
    <caption>Transaksi tanggal <?php echo date("d-m-Y"); ?></caption>
    <thead>
        <tr>
            <th>No Faktur</th>
            <th>Nama Customer</th>
            <th>Jam</th>
            <th>Detail</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if($sql_th === FALSE)
        {
            ?>
            <tr>
                <td colspan="4"><b>Belum ada transaksi</b></td>
            </tr>
            <?php
        }
        else
        {
            foreach($sql_th as $row_th)
            {
                ?>
                <tr>
                    <td><?php echo $row_th->th_no_faktur; ?></td>
                    <td><?php echo ucwords($row_th->th_customer); ?></td>
                    <td><?php echo substr($row_th->th_tgl,11,5); ?></td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>