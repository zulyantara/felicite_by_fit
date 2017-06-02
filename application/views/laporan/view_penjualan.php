<?php
$bulan = array("01"=>"Januari","02"=>"Febtuari","03"=>"Maret","04"=>"April","05"=>"Mei","06"=>"Juni","07"=>"Juli","08"=>"Agustus","09"=>"September","10"=>"Oktober","11"=>"November","12"=>"Desember");
$txt_thn_pilih = (isset($thn_pilih)) ? $thn_pilih : "";
$txt_bln_pilih = (isset($bln_pilih)) ? $bln_pilih : "";
?>

<form class="uk-form" method="post" action="<?php echo base_url("laporan_penjualan"); ?>">
    <select name="opt_thn">
        <?php
        for($thn = date("Y")-5; $thn <= date("Y")+5; $thn++)
        {
            $selected_thn = ($thn == date('Y')) ? "selected=\"selected\"": "";
            ?>
            <option value="<?php echo $thn; ?>" <?php echo $selected_thn; ?>><?php echo $thn; ?></option>
            <?php
        }
        ?>
    </select>
    <select name="opt_bln">
        <?php
        foreach ($bulan as $key_bln => $row_bln)
        {
            $selected_bln = ($key_bln == date('m')) ? "selected=\"selected\"": "";
            ?>
            <option value="<?php echo $key_bln; ?>" <?php echo $selected_bln; ?>><?php echo $row_bln; ?></option>
            <?php
        }
        ?>
    </select>
    <button type="submit" name="btn_pilih" id="btn_pilih" value="btn_pilih" class="uk-button uk-button-primary">Pilih</button> | 
    <a href="<?php echo base_url("laporan_penjualan/cetak/".$txt_thn_pilih."/".$txt_bln_pilih); ?>" class="uk-button uk-button-primary">Print</a>
</form>

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