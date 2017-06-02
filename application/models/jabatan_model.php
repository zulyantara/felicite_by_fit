<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jabatan_model extends CI_Model
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
    function get_all_data($limit="", $start="")
    {
        if(empty($limit) AND empty($start))
        {
            $sql = "select * from jabatan order by jabatan_ket asc";
        }
        else
        {
            $sql = "select * from jabatan order by jabatan_ket asc limit ".$start.", ".$limit;
        }
        
        $query = $this->db->query($sql);
        
        return ($query->num_rows() > 0) ? $query->result() : array();
    }
    
    /*
     * untuk menyimpan data
     * @param string $jabatan_ket keterangan jabatan yang diambil dari form inputan
     */
    function save_data($jabatan_ket)
    {
        return $this->db->query("insert into jabatan (jabatan_ket) values ('".strtolower($jabatan_ket)."')");
    }
    
    /*
     * untuk mengubah data
     * @param string $jabatan_id id jabatan yang diambil dari form inputan
     * @param string $jabatan_ket keterangan jabatan yang diambil dari form inputan
     */
    function update_data($jabatan_id, $jabatan_ket)
    {
        return $this->db->query("update jabatan set jabatan_ket='".strtolower($jabatan_ket)."' where jabatan_id=".$jabatan_id);
    }
    
    /*
     * untuk menghapus data berdasarkan jabatan_id
     * @param $id id jabatan
     */
    function delete_data($id)
    {
        return $this->db->delete('jabatan', array('jabatan_id' => $id));
    }
    
    /*
     * untuk mengambil data berdasarkan id
     * @param string $id id jabatan yang diambil dari table
     */
    function get_curr_data($id)
    {
        $sql = "select * from jabatan where jabatan_id=".$id;
        $query = $this->db->query($sql);
        
        return ($query->num_rows() > 0) ? $query->row() : FALSE;
    }
    
    /*
     * untuk mengecek data kembar
     * @param string $jabatan_ket
     */
    function check_double_data($jabatan_ket)
    {
        $sql = "select * from jabatan where jabatan_ket='".$jabatan_ket."'";
        $query = $this->db->query($sql);
        
        return $query->num_rows();
    }
    
    /*
     * untuk mencari data
     * @param string $txt_search keterangan jabatan yang dicari
     */
    function get_search_data($txt_search)
    {
        $sql = "select * from jabatan where jabatan_ket like '%".$txt_search."%' order by jabatan_ket asc";
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
            $this->db->from("jabatan");
        }
        else
        {
            $this->db->like("jabatan_ket", $where);
            $this->db->from("jabatan");
        }
        
        return $this->db->count_all_results();
    }
}

/* End of file jabatan_model.php */
/* Location: ./application/models/jabatan_model.php */