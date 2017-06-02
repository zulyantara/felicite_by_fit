<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service_model extends CI_Model
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
    function get_all_data($limit=NULL, $start=NULL)
    {
        if(empty($limit) AND empty($start))
        {
            $sql = "select s.service_id, s.service_nama, s.service_harga, js.js_ket from service s left join jenis_service js on s.service_jenis=js.js_id";
        }
        else
        {
            $sql = "select s.service_id, s.service_nama, s.service_harga, js.js_ket from service s left join jenis_service js on s.service_jenis=js.js_id limit ".$start.", ".$limit;
        }
        
        $query = $this->db->query($sql);
        
        return ($query->num_rows() > 0) ? $query->result() : array();
    }
    
    /*
     * untuk menyimpan data
     * @param string $txt_service_nama keterangan service yang diambil dari form inputan
     */
    function save_data($service_nama, $service_harga, $service_jenis)
    {
        $sql = "insert into service (service_nama, service_harga, service_jenis) values ('".strtolower($service_nama)."', ".$service_harga.", ".$service_jenis.")";
        return $this->db->query($sql);
    }
    
    /*
     * untuk mengubah data
     * @param string $service_id id service yang diambil dari form inputan
     * @param string $service_nama nama service yang diambil dari form inputan
     * @param string $service_nama harga service yang diambil dari form inputan
     * @param string $service_jenis jenis service yang diambil dari form inputan
     */
    function update_data($service_id, $service_nama, $service_harga, $service_jenis)
    {
        $sql = "update service set service_nama='".strtolower($service_nama)."', service_harga=".$service_harga.", service_jenis=".$service_jenis." where service_id=".$service_id;
        return $this->db->query($sql);
    }
    
    /*
     * untuk menghapus data berdasarkan js_id
     * @param $id id service
     */
    function delete_data($id)
    {
        return $this->db->delete('service', array('service_id' => $id));
    }
    
    /*
     * untuk mengambil data berdasarkan id
     * @param string $id id service yang diambil dari table
     */
    function get_curr_data($id)
    {
        $sql = "select * from service where service_id=".$id;
        $query = $this->db->query($sql);
        
        return ($query->num_rows() > 0) ? $query->row() : FALSE;
    }
    
    /*
     * untuk mengecek data kembar
     * @param string $service_nama
     */
    function check_double_data($service_nama)
    {
        $sql = "select * from service where service_nama='".$service_nama."'";
        $query = $this->db->query($sql);
        
        return $query->num_rows();
    }
    
    /*
     * untuk mencari data
     * @param string $txt_search keterangan service yang dicari
     */
    function get_search_data($txt_search)
    {
        $sql = "select * from service left join jenis_service on service_jenis=js_id where service_nama like '%".$txt_search."%'";
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
            $this->db->from("service");
        }
        else
        {
            $this->db->like("service_nama", $where);
            $this->db->from("service");
        }
        
        return $this->db->count_all_results();
    }
    
    /*
     * mengambil data berdasarkan ID
     */
    function get_data_by_id($id)
    {
        $sql = "select * from service left join jenis_service on service_jenis=js_id where service_id = ".$id."";
        $query = $this->db->query($sql);
        
        return ($query->num_rows() > 0) ? $query->row() : array();
    }
}

/* End of file service_model.php */
/* Location: ./application/models/service_model.php */