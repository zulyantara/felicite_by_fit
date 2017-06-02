<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jenis_service_model extends CI_Model
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
            $sql = "select * from jenis_service order by js_ket asc";
        }
        else
        {
            $sql = "select * from jenis_service order by js_ket asc limit ".$start.", ".$limit;
        }
        
        $query = $this->db->query($sql);
        
        return ($query->num_rows() > 0) ? $query->result() : array();
    }
    
    /*
     * untuk menyimpan data
     * @param string $txt_jenis_service_ket keterangan jenis service yang diambil dari form inputan
     */
    function save_data($txt_jenis_service_ket)
    {
        return $this->db->query("insert into jenis_service (js_ket) values ('".strtolower($txt_jenis_service_ket)."')");
    }
    
    /*
     * untuk mengubah data
     * @param string $txt_jenis_service_id id jenis service yang diambil dari form inputan
     * @param string $txt_jenis_service_ket keterangan jenis service yang diambil dari form inputan
     */
    function update_data($txt_jenis_service_id, $txt_jenis_service_ket)
    {
        return $this->db->query("update jenis_service set js_ket='".strtolower($txt_jenis_service_ket)."' where js_id=".$txt_jenis_service_id);
    }
    
    /*
     * untuk menghapus data berdasarkan js_id
     * @param $id id jenis service
     */
    function delete_data($id)
    {
        return $this->db->delete('jenis_service', array('js_id' => $id));
    }
    
    /*
     * untuk mengambil data berdasarkan id
     * @param string $id id jenis service yang diambil dari table
     */
    function get_curr_data($id)
    {
        $sql = "select * from jenis_service where js_id=".$id;
        $query = $this->db->query($sql);
        
        return ($query->num_rows() > 0) ? $query->row() : FALSE;
    }
    
    /*
     * untuk mengecek data kembar
     * @param string $jenis_service_ket
     */
    function check_double_data($jenis_service_ket)
    {
        $sql = "select * from jenis_service where js_ket='".$jenis_service_ket."'";
        $query = $this->db->query($sql);
        
        return $query->num_rows();
    }
    
    /*
     * untuk mencari data
     * @param string $txt_search keterangan jenis service yang dicari
     */
    function get_search_data($txt_search)
    {
        $sql = "select * from jenis_service where js_ket like '%".$txt_search."%' order by js_ket asc";
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
            $this->db->from("jenis_service");
        }
        else
        {
            $this->db->like("js_ket", $where);
            $this->db->from("jenis_service");
        }
        
        return $this->db->count_all_results();
    }
}

/* End of file jenis_service_model.php */
/* Location: ./application/models/jenis_service_model.php */