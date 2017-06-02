<?php
if($this->uri->segment(2)=="cari_data")
{
    ?>
    <a href="<?php echo base_url("service"); ?>" class="uk-button uk-button-primary">Refresh</a>
    <?php
}
?>
<a href="<?php echo base_url("service/data_baru"); ?>" class="uk-button uk-button-primary">Data Baru</a>
<form class="uk-search" data-uk-search method="post" action="<?php echo base_url("service/cari_data"); ?>">
    <input class="uk-search-field" type="search" placeholder="Cari ..." name="txt_search" id="txt_search" autofocus="autofocus">
</form>
<table class="uk-table uk-table-hover uk-table-striped uk-table-condensed tara-table">
    <caption>List Service | Jumlah data: <?php echo $qty_row; ?></caption>
    <thead>
        <tr>
            <th style="width: 5%;">No</th>
            <th style="width: 40%;">Nama Service</th>
            <th style="width: 20%;">Harga</th>
            <th style="width: 20%;">Jenis Service</th>
            <th style="width: 20%;">Option</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <td colspan="3">
                <?php
                if($this->uri->segment(2) != "cari_data")
                {
                    echo $links;
                }
                ?>
            </td>
        </tr>
        <tr>
        </tr>
    </tfoot>
    <?php
    if(empty($res_service))
    {
        ?>
        <tr>
            <td colspan="5">Data Kosong</td>
        </tr>
        <?php
    }
    else
    {
        $no = 1 + $this->uri->segment(3);
        foreach($res_service as $row_service)
        {
            //$js_id = $this->encrypt->encode($row_jenis_service->js_id);
            $js_id = $row_service->service_id;
            ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo ucwords($row_service->service_nama); ?></td>
                <td><?php echo number_format($row_service->service_harga); ?> IDR</td>
                <td><?php echo ucwords($row_service->js_ket); ?></td>
                <td>
                    <a href="<?php echo base_url("service/edit_data/".$js_id); ?>" class="uk-button uk-button-primary">Edit</a>
                    <a href="<?php echo base_url("service/hapus_data/".$js_id); ?>" class="uk-button uk-button-danger" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">Hapus</a>
                </td>
            </tr>
            <?php
            $no++;
        }
    }
    ?>
</table>