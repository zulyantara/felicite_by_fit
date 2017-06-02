<!DOCTYPE html>
<html>
    <head>
        <title>Print Struk</title>
        <link rel="stylesheet" href="<?php echo base_url("asset/css/uikit.min.css"); ?>" />
        <script src="<?php echo base_url("asset/js/jquery.js"); ?>"></script>
        <script src="<?php echo base_url("asset/js/uikit.min.js"); ?>"></script>
    </head>
    <body>
        <table class="uk-table uk-table-condensed uk-text-nowrap">
            <tr>
                <th>Felicite By Fit</th>
            </tr>
            <tr>
                <th><span class="uk-text-small"><?php echo $no_faktur; ?></span></th>
            </tr>
            <tr style="border-bottom: 1px solid #000;">
                <td><span class="uk-text-small"><?php echo date("d-m-Y H:i"); ?></span></td>
            </tr>
            <?php
            $total=0;
            foreach($qry_transaksi as $row_transaksi)
            {
                ?>
                <tr>
                    <td><span class="uk-text-small"><?php echo $row_transaksi->pegawai_nama; ?></span></td>
                </tr>
                <tr style="border-bottom: 1px solid #000;">
                    <td><span class="uk-text-small"><?php echo $row_transaksi->service_nama." | ".$row_transaksi->td_qty." | ".$row_transaksi->td_harga; ?></span></td>
                </tr>
                <hr>
                <?php
                $sub_total = $row_transaksi->td_qty*$row_transaksi->td_harga;
                $total = $total+$sub_total;
            }
            ?>
            <tr>
                <th><span class="uk-text-small">TOTAL</span></th>
            </tr>
            <tr>
                <th><span class="uk-text-small"><?php echo $total; ?></span></th>
            </tr>
        </table>
        
        <script type="text/javascript">
        // Do print the page
        window.onload = function() {
            if (typeof(window.print) != 'undefined') {
                window.print('A4');
            }
        }
        </script>
    </body>
</html>