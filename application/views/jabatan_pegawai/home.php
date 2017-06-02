<?php
if($this->uri->segment(2)=="cari_data")
{
    ?>
    <a href="<?php echo base_url("jabatan"); ?>" class="uk-button uk-button-primary">Refresh</a>
    <?php
}
?>
<a href="<?php echo base_url("jabatan/data_baru"); ?>" class="uk-button uk-button-primary">Data Baru</a>
<form class="uk-search" data-uk-search method="post" action="<?php echo base_url("jabatan/cari_data"); ?>">
    <input class="uk-search-field" type="search" placeholder="Cari ..." name="txt_search" id="txt_search" autofocus="autofocus">
</form>
<table class="uk-table uk-table-hover uk-table-striped uk-table-condensed tara-table">
    <caption>List Jabatan | Jumlah data: <?php echo $qty_row; ?></caption>
    <thead>
        <tr>
            <th style="width: 5%;">No</th>
            <th style="width: 80%;">Jabatan</th>
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
    if(empty($res_jabatan))
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
        foreach($res_jabatan as $row_jabatan)
        {
            //$js_id = $this->encrypt->encode($row_jabatan->js_id);
            $id = $row_jabatan->jabatan_id;
            ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo ucwords($row_jabatan->jabatan_ket); ?></td>
                <td>
                    <a href="<?php echo base_url("jabatan/edit_data/".$id); ?>" class="uk-button uk-button-primary">Edit</a>
                    <a href="<?php echo base_url("jabatan/hapus_data/".$id); ?>" class="uk-button uk-button-danger" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">Hapus</a>
                </td>
            </tr>
            <?php
            $no++;
        }
    }
    ?>
</table>