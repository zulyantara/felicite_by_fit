<link rel="stylesheet" href="<?php echo base_url("asset/css/uikit.min.css"); ?>" />

<div class="tara-middle">
    <div class="uk-container uk-container-center">
        <div class="uk-grid">
            <div class="tara-main uk-width-medium-1-1">
                <div class="uk-panel uk-panel-header">
                    <h3 class="uk-panel-title"><?php echo $panel_title; ?></h3>
                    <table class="uk-table">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Customer</th>
                                <th>Pegawai</th>
                                <th>Service</th>
                                <th class="uk-text-center">Jumlah</th>
                                <th class="uk-text-right">Harga</th>
                                <th class="uk-text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //var_dump($qry_laporan);
                            if(isset($qry_laporan) && $qry_laporan != NULL)
                            {
                                $grand_total = 0;
                                foreach($qry_laporan as $key => $row_laporan)
                                {
                                    $total = $row_laporan->td_qty * $row_laporan->td_harga;
                                    ?>
                                    <tr>
                                        <td><?php echo $row_laporan->th_tgl; ?></td>
                                        <td><?php echo $row_laporan->th_customer; ?></td>
                                        <td><?php echo $row_laporan->pegawai_nama; ?></td>
                                        <td><?php echo $row_laporan->service_nama; ?></td>
                                        <td class="uk-text-center"><?php echo $row_laporan->td_qty; ?></td>
                                        <td class="uk-text-right">Rp. <?php echo number_format($row_laporan->td_harga,0,',','.'); ?></td>
                                        <td class="uk-text-right">Rp. <?php echo number_format($total,0,',','.'); ?></td>
                                    </tr>
                                    <?php
                                    $grand_total = $grand_total + $total;
                                }
                                ?>
                                <tr>
                                    <td class="uk-text-right" colspan="6"><span class="uk-text-bold uk-text-large">GRAND TOTAL</span></td>
                                    <td class="uk-text-right"><span class="uk-text-bold uk-text-large">Rp. <?php echo number_format($grand_total,0,',','.'); ?></span></td>
                                </tr>
                                <?php
                            }
                            else
                            {
                                ?>
                                <tr>
                                    <td><span class="uk-text-bold uk-text-large uk-text-danger">Tidak Ada Transaksi</span></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>