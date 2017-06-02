<?php
$txt_no_faktur = (isset($no_faktur)) ? $no_faktur : "";
?>
<form class="uk-form tara-form" method="post" action="<?php echo base_url("transaksi/simpan_data"); ?>">
    <input type="hidden" name="txt_no_faktur" id="txt_no_faktur" value="<?php echo $txt_no_faktur; ?>">
    <fieldset>
        <legend>Transaksi No. Faktur: <?php echo $txt_no_faktur; ?></legend>
        <label for="opt_service" class="uk-form-label">Service</label>
        <select name="opt_service" id="opt_service">
            <?php
            foreach($res_service as $row_service)
            {
                $service_nama = $row_service->service_nama;
                ?>
                <option value="<?php echo $row_service->service_id; ?>"><?php echo $service_nama; ?></option>
                <?php
            }
            ?>
        </select>
        <select name="opt_pegawai" id="opt_pegawai">
            <?php
            foreach($res_pegawai as $row_pegawai)
            {
                $pegawai_nama = $row_pegawai->pegawai_nama;
                ?>
                <option value="<?php echo $row_pegawai->pegawai_id; ?>"><?php echo $pegawai_nama; ?></option>
                <?php
            }
            ?>
        </select>
        <label for="txt_qty" class="uk-form-label">Quantity</label>
        <input type="text" name="txt_qty" id="txt_qty" value="0" class="uk-form-width-mini">
        
        <button type="submit" name="btn_tambah_detail" id="btn_tambah_detail" value="tambah" class="uk-button uk-button-primary">Tambah</button>
    </fieldset>
</form>

<table class="uk-table uk-table-hover uk-table-striped uk-table-condensed tara-table">
    <?php
    /*
     * klo belum ada transaksi detail
     */
    if(empty($res_td))
    {
        ?>
        <tbody>
            <tr>
                <td>Belum ada transaksi</td>
            </tr>
        </tbody>
        <?php
    }
    else
    {
        ?>
        <thead>
            <tr>
                <th style="width: 5%;">ID</th>
                <th style="width: 35%;">Nama Service</th>
                <th style="width: 5%;">Jumlah</th>
                <th style="width: 15%; text-align: right;">Harga</th>
                <th style="width: 15%; text-align: right;">Total</th>
                <th style="width: 15%;">Option</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $grand_total = 0;
            foreach($res_td as $row_td)
            {
                $td_id = $row_td->td_id;
                //menghitung total
                $total = $row_td->td_harga * $row_td->td_qty;
                
                //menghitung grand total
                $grand_total = $grand_total + $total;
                ?>
                <tr>
                    <td><?php echo $row_td->service_id; ?></td>
                    <td><?php echo $row_td->service_nama; ?></td>
                    <td><?php echo $row_td->td_qty; ?></td>
                    <td style="text-align: right;"><?php echo number_format($row_td->td_harga); ?></td>
                    <td style="text-align: right;"><?php echo number_format($total); ?></td>
                    <td><a href="<?php echo base_url("transaksi/hapus_td/".$td_id); ?>" class="uk-button uk-button-danger">Hapus</a></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
        <tfoot style="border-top: 1px double #000;">
            <tr>
                <td colspan="4"><h2>GRAND TOTAL</h2></td>
                <td style="text-align: right;"><h2><?php echo number_format($grand_total); ?></h2></td>
            </tr>
            <tr style="border-top: 1px double #000;">
                <td colspan="4">Uang Dibayar</td>
                <td style="text-align: right;"><input type="txt_uang_dibayar" id="txt_uang_dibayar" onblur="RecalcTotal(<?php echo $grand_total; ?>)" value="0" style="text-align: right;"></td>
            </tr>
            <tr>
                <td colspan="4">Kembalian</td>
                <td style="text-align: right;"><input type="txt_kembalian" id="txt_kembalian" value="0" style="text-align: right;"></td>
            </tr>
            <tr>
                <td colspan="4"><a href="<?php echo base_url("transaksi"); ?>" class="uk-button uk-button-primary">Kembali</a></td>
                <td style="text-align: right;">
                    <form method="post" action="<?php echo base_url("transaksi/simpan_data"); ?>" target="_blank">
                        <input type="hidden" name="txt_no_faktur" value="<?php echo $txt_no_faktur;?>">
                        <button type="submit" name="btn_selesai" value="btn_selesai" class="uk-button uk-button-primary">Simpan</button>
                    </form>
                </td>
            </tr>
        </tfoot>
        <?php
    }
    ?>
</table>

<script type="text/javascript">
function RecalcTotal(tot_pembelian) {
    var Kembali = 0;
    var uangDibayar = parseInt(document.getElementById("txt_uang_dibayar").value);

    Kembali = uangDibayar - tot_pembelian;

    document.getElementById("txt_kembalian").value = number_format(Kembali,0,".",",");
}

function number_format(number, decimals, dec_point, thousands_sep) {
    // discuss at: http://phpjs.org/functions/number_format/
    // original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // improved by: davook
    // improved by: Brett Zamir (http://brett-zamir.me)
    // improved by: Brett Zamir (http://brett-zamir.me)
    // improved by: Theriault
    // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // bugfixed by: Michael White (http://getsprink.com)
    // bugfixed by: Benjamin Lupton
    // bugfixed by: Allan Jensen (http://www.winternet.no)
    // bugfixed by: Howard Yeend
    // bugfixed by: Diogo Resende
    // bugfixed by: Rival
    // bugfixed by: Brett Zamir (http://brett-zamir.me)
    // revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // revised by: Luke Smith (http://lucassmith.name)
    // input by: Kheang Hok Chin (http://www.distantia.ca/)
    // input by: Jay Klehr
    // input by: Amir Habibi (http://www.residence-mixte.com/)
    // input by: Amirouche
    // example 1: number_format(1234.56);
    // returns 1: '1,235'
    // example 2: number_format(1234.56, 2, ',', ' ');
    // returns 2: '1 234,56'
    // example 3: number_format(1234.5678, 2, '.', '');
    // returns 3: '1234.57'
    // example 4: number_format(67, 2, ',', '.');
    // returns 4: '67,00'
    // example 5: number_format(1000);
    // returns 5: '1,000'
    // example 6: number_format(67.311, 2);
    // returns 6: '67.31'
    // example 7: number_format(1000.55, 1);
    // returns 7: '1,000.6'
    // example 8: number_format(67000, 5, ',', '.');
    // returns 8: '67.000,00000'
    // example 9: number_format(0.9, 0);
    // returns 9: '1'
    // example 10: number_format('1.20', 2);
    // returns 10: '1.20'
    // example 11: number_format('1.20', 4);
    // returns 11: '1.2000'
    // example 12: number_format('1.2000', 3);
    // returns 12: '1.200'
    // example 13: number_format('1 000,50', 2, '.', ' ');
    // returns 13: '100 050.00'
    // example 14: number_format(1e-8, 8, '.', '');
    // returns 14: '0.00000001'
    number = (number + '')
    .replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function (n, prec) {
    var k = Math.pow(10, prec);
    return '' + (Math.round(n * k) / k)
    .toFixed(prec);
    };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
    .split('.');
    if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '')
    .length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1)
    .join('0');
    }
    return s.join(dec);
}
</script>