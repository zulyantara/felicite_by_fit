<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Divisi_model extends CI_Model
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
            $sql = "select * from divisi order by divisi_ket asc";
        }
        else
        {
            $sql = "select * from divisi order by divisi_ket asc limit ".$start.", ".$limit;
        }
        
        $query = $this->db->query($sql);
        
        return ($query->num_rows() > 0) ? $query->result() : array();
    }
    
    /*
     * untuk menyimpan data
     * @param string $divisi_ket keterangan divisi yang diambil dari form inputan
     */
    function save_data($divisi_ket)
    {
        return $this->db->query("insert into divisi (divisi_ket) values ('".strtolower($divisi_ket)."')");
    }
    
    /*
     * untuk mengubah data
     * @param string $divisi_id id divisi yang diambil dari form inputan
     * @param string $divisi_ket keterangan divisi yang diambil dari form inputan
     */
    function update_data($divisi_id, $divisi_ket)
    {
        return $this->db->query("update divisi set divisi_ket='".strtolower($divisi_ket)."' where divisi_id=".$divisi_id);
    }
    
    /*
     * untuk menghapus data berdasarkan divisi_id
     * @param $id id divisi
     */
    function delete_data($id)
    {
        return $this->db->delete('divisi', array('divisi_id' => $id));
    }
    
    /*
     * untuk mengambil data berdasarkan id
     * @param string $id id divisi yang diambil dari table
     */
    function get_curr_data($id)
    {
        $sql = "select * from divisi where divisi_id=".$id;
        $query = $this->db->query($sql);
        
        return ($query->num_rows() > 0) ? $query->row() : FALSE;
    }
    
    /*
     * untuk mengecek data kembar
     * @param string $divisi_ket
     */
    function check_double_data($divisi_ket)
    {
        $sql = "select * from divisi where divisi_ket='".$divisi_ket."'";
        $query = $this->db->query($sql);
        
        return $query->num_rows();
    }
    
    /*
     * untuk mencari data
     * @param string $txt_search keterangan divisi yang dicari
     */
    function get_search_data($txt_search)
    {
        $sql = "select * from divisi where divisi_ket like '%".$txt_search."%' order by divisi_ket asc";
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
            $this->db->from("divisi");
        }
        else
        {
            $this->db->like("divisi_ket", $where);
            $this->db->from("divisi");
        }
        
        return $this->db->count_all_results();
    }
}

/* End of file divisi_model.php */
/* Location: ./application/models/divisi_model.php */