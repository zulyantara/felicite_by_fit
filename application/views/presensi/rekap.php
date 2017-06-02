<?php
$arr_bulan = array("01"=>"Januari","02"=>"Februari","03"=>"Maret","04"=>"April","05"=>"Mei","06"=>"Juni","07"=>"Juli","08"=>"Agustus","09"=>"September","10"=>"Oktober","11"=>"November","12"=>"Desember");

$tgl_last = 31;
$check_tgl = checkdate($bln_pilih, $tgl_last, $thn_pilih);
if($check_tgl === FALSE)
{
    $tgl_last = 30;
}
else
{
    $tgl_last = 31;
}
?>
<form class="uk-form" method="post" action="<?php echo base_url("presensi/rekap_presensi"); ?>">
    <select name="opt_pegawai">
        <?php
        foreach($sql_pegawai as $row_pegawai)
        {
            ?>
            <option value="<?php echo $row_pegawai->pegawai_id; ?>"><?php echo $row_pegawai->pegawai_id." | ".$row_pegawai->pegawai_nama; ?></option>
            <?php
        }
        ?>
    </select>
    <select name="opt_bulan">
        <?php
        foreach($arr_bulan as $key=>$row_bulan)
        {
            $selected_bln = (date("m") == $key) ? "selected=\"selected\"" : "";
            ?>
            <option <?php echo $selected_bln; ?> value="<?php echo $key; ?>"><?php echo $row_bulan; ?></option>
            <?php
        }
        ?>
    </select>
    <select name="opt_tahun">
        <?php
        for($thn = date("Y")-5; $thn <= date("Y")+5; $thn++)
        {
            $selected_thn = (date("Y") == $thn) ? "selected=\"selected\"" : "";
            ?>
            <option value="<?php echo $thn; ?>" <?php echo $selected_thn; ?>><?php echo $thn; ?></option>
            <?php
        }
        ?>
    </select>
    <button type="submit" name="btn_load" id="btn_load" value="load" class="uk-button uk-button-primary">Tampilkan</button>
</form>

<table class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
    <thead>
        <tr>
            <th colspan="2">Tanggal</th>
            <th>Jam Masuk</th>
            <th>Jam Keluar</th>
        </tr>
    </thead>
        <?php
        for($i=1; $i <= $tgl_last; $i++)
        {
            $tgl = (strlen($i)==1) ? "0".$i : $i;
            $tanggal_sekarang = $thn_pilih."-".$bln_pilih."-".$tgl;
            
            $timestamp = strtotime($tanggal_sekarang);
            $day = date('D',$timestamp);
            $dayArr = array('Mon'=>'Senin','Tue'=>'Selasa','Wed'=>'Rabu','Thu'=>'Kamis','Fri'=>'Jum\'at','Sat'=>'Sabtu', 'Sun'=>'Minggu');
            
            $absen_pegawai = $this->pm->get_selected_absen($pegawai_pilih, $tanggal_sekarang);
            
            $jam_masuk = ($absen_pegawai === FALSE) ? "" : $absen_pegawai->JamMasuk;
            $jam_keluar = ($absen_pegawai === FALSE) ? "" : $absen_pegawai->JamKeluar;
            ?>
            <tr>
                <td style="width: 10px;"><?php echo $dayArr[$day]; ?></td>
                <td><?php echo $tanggal_sekarang; ?></td>
                <td><?php echo $jam_masuk; ?></td>
                <td><?php echo $jam_keluar; ?></td>
            </tr>
            <?php
        }
        ?>
</table>