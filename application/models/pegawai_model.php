<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pegawai_model extends CI_Model
{
    /*
     * @author Zulyantara <zulyantara@gmail.com>
     * @copyright Copyright 2014, Zulyantara
     */
    
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    /*
     * untuk mengambil semua data dari database
     */
    function get_all_data($limit=15, $start=0, $where = '')
    {
        if(empty($where))
        {
            $sql = "select p.*, j.jabatan_ket from pegawai p left join jabatan_pegawai jp on p.pegawai_id=jp.jp_pegawai left join jabatan j on jp.jp_jabatan=j.jabatan_id where jp.jp_isactive=1 order by pegawai_nama asc limit ".$start.", ".$limit;
        }
        else
        {
            $sql = "select p.*, j.jabatan_ket from pegawai p left join jabatan_pegawai jp on p.pegawai_id=jp.jp_pegawai left join jabatan j on jp.jp_jabatan=j.jabatan_id where jp.jp_isactive=1 ".$where." order by pegawai_nama asc limit ".$start.", ".$limit;
        }
        
        $query = $this->db->query($sql);
        
        return ($query->num_rows() > 0) ? $query->result() : array();
    }
    
    /*
     * untuk menyimpan data
     * @param string $pegawai_nama nama pegawai yang diambil dari form inputan
     * @param string $pegawai_alamat alamat pegawai yang diambil dari form inputan
     * @param string $pegawai_telp telp pegawai yang diambil dari form inputan
     */
    function save_data($data = array())
    {
        $pegawai_nama = $data["txt_pegawai_nama"];
        $jabatan = $data["opt_jabatan"];
        $pegawai_alamat = $data["txt_pegawai_alamat"];
        $pegawai_telp = $data["txt_pegawai_telp"];
        
        $row_npp = $this->get_last_npp();
        $last_no_urut = substr($row_npp->pegawai_id, -3);
        $no_urut = $last_no_urut + 1;
        if(strlen($no_urut) == 1)
        {
            $txt_no_urut = "00".$no_urut;
        }
        elseif(strlen($no_urut) == 2)
        {
            $txt_no_urut = "0".$no_urut;
        }
        elseif(strlen($no_urut) == 3)
        {
            $txt_no_urut = $no_urut;
        }
        $pegawai_id = "p".date("m").date("Y").$txt_no_urut;
        
        //insert ke table jabatan_pegawai
        $this->db->query("insert into jabatan_pegawai(jp_pegawai, jp_jabatan, jp_isactive) values(".$this->db->escape($pegawai_id).", $jabatan, 1)");
        
        // insert ke table pegawai
        return $this->db->query("insert into pegawai (pegawai_id, pegawai_nama, pegawai_alamat, pegawai_telp) values (".$this->db->escape($pegawai_id).", '".strtolower($pegawai_nama)."', '".$pegawai_alamat."', '".$pegawai_telp."')");
    }
    
    /*
     * untuk mengubah data
     * @param string $pegawai_id id pegawai yang diambil dari form inputan
     * @param string $pegawai_nama keterangan pegawai yang diambil dari form inputan
     * @param string $pegawai_alamat alamat pegawai yang diambil dari form inputan
     * @param string $pegawai_telp telp pegawai yang diambil dari form inputan
     */
    function update_data($data = array())
    {
        $pegawai_id = $data["txt_pegawai_id"];
        $pegawai_nama = $data["txt_pegawai_nama"];
        $pegawai_alamat = $data["txt_pegawai_alamat"];
        $pegawai_telp = $data["txt_pegawai_telp"];
        
        return $this->db->query("update pegawai set pegawai_nama='".strtolower($pegawai_nama)."', pegawai_alamat='".$pegawai_alamat."', pegawai_telp='".$pegawai_telp."' where pegawai_id=".$this->db->escape($pegawai_id));
    }
    
    /*
     * untuk menghapus data berdasarkan pegawai_id
     * @param $id id pegawai
     */
    function delete_data($id)
    {
        return $this->db->delete('pegawai', array('pegawai_id' => $id));
    }
    
    /*
     * untuk mengambil data berdasarkan id
     * @param string $id id pegawai yang diambil dari table
     */
    function get_curr_data($id)
    {
        $sql = "select * from pegawai where pegawai_id=".$this->db->escape($id);
        $query = $this->db->query($sql);
        
        return ($query->num_rows() > 0) ? $query->row() : FALSE;
    }
    
    /*
     * untuk mengecek data kembar
     * @param string $pegawai_nama
     */
    function check_double_data($pegawai_nama)
    {
        $sql = "select * from pegawai where pegawai_nama='".$pegawai_nama."'";
        $query = $this->db->query($sql);
        
        return $query->num_rows();
    }
    
    /*
     * untuk mencari data
     * @param string $txt_search keterangan pegawai yang dicari
     */
    function get_search_data($txt_search)
    {
        $sql = "select * from pegawai where pegawai_nama like '%".$txt_search."%' order by pegawai_nama asc";
        $query = $this->db->query($sql);
        
        return ($query->num_rows() > 0) ? $query->result() : array();
    }
    
    /*
     * untuk menghitung jumlah data
     * @param string $where parameter pencarian
     */
    function get_sum_data($where=NULL)
    {
        if($where==NULL)
        {
            $this->db->from("pegawai");
        }
        else
        {
            $this->db->like("pegawai_nama", $where);
            $this->db->from("pegawai");
        }
        
        return $this->db->count_all_results();
    }
    
    /*
     * get last no urut pegawai
     */
    function get_last_npp()
    {
        $sql = "select max(pegawai_id) as pegawai_id from pegawai";
        $qry = $this->db->query($sql);
        return ($qry->num_rows() > 0) ? $qry->row() : FALSE;
    }
}

/* End of file pegawai_model.php */
/* Location: ./application/models/pegawai_model.php */