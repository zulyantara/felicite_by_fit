<?php
if($this->uri->segment(2)=="cari_data")
{
    ?>
    <a href="<?php echo base_url("pegawai"); ?>" class="uk-button uk-button-primary">Refresh</a>
    <?php
}
?>
<a href="<?php echo base_url("pegawai/data_baru"); ?>" class="uk-button uk-button-primary">Data Baru</a>
<form class="uk-search" data-uk-search method="post" action="<?php echo base_url("pegawai/cari_data"); ?>">
    <input class="uk-search-field" type="search" placeholder="Cari ..." name="txt_search" id="txt_search" autofocus="autofocus">
</form>
<table class="uk-table uk-table-hover uk-table-striped uk-table-condensed tara-table">
    <caption>List Pegawai | Jumlah data: <?php echo $qty_row; ?></caption>
    <thead>
        <tr>
            <th style="width: 5%;">No</th>
            <th style="width: 40%;">Nama</th>
            <th style="width: 20%;">Jabatan</th>
            <th style="width: 20%;">Telp</th>
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
    if(empty($res_pegawai))
    {
        ?>
        <tr>
            <td colspan="3">Data Kosong</td>
        </tr>
        <?php
    }
    else
    {
        $no = 1 + $this->uri->segment(3);
        foreach($res_pegawai as $row_pegawai)
        {
            //$js_id = $this->encrypt->encode($row_pegawai->js_id);
            $id = $row_pegawai->pegawai_id;
            ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo ucwords($row_pegawai->pegawai_nama); ?></td>
                <td><?php echo ucwords($row_pegawai->jabatan_ket); ?></td>
                <td><?php echo $row_pegawai->pegawai_telp; ?></td>
                <td>
                    <a href="<?php echo base_url("pegawai/edit_data/".$id); ?>" class="uk-button uk-button-primary">Edit</a>
                    <a href="<?php echo base_url("pegawai/hapus_data/".$id); ?>" class="uk-button uk-button-danger" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">Hapus</a>
                </td>
            </tr>
            <?php
            $no++;
        }
    }
    ?>
</table>