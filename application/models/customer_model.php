<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_model extends CI_Model
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
            $sql = "select * from customer order by customer_nama asc";
        }
        else
        {
            $sql = "select * from customer order by customer_nama asc limit ".$start.", ".$limit;
        }
        
        $query = $this->db->query($sql);
        
        return ($query->num_rows() > 0) ? $query->result() : array();
    }
    
    /*
     * untuk menyimpan data
     * @param string $data_insert array data customer yang diambil dari form inputan
     */
    function save_data($data_insert = array())
    {
        $customer_nama = $data_insert['txt_customer_nama'];
        $customer_alamat = $data_insert['txt_customer_alamat'];
        $customer_telp = $data_insert['txt_customer_telp'];
        
        return $this->db->query("insert into customer (customer_nama, customer_alamat, customer_telp) values ('".strtolower($customer_nama)."', '".$customer_alamat."', '".$customer_telp."')");
    }
    
    /*
     * untuk mengubah data
     * @param string $data_update data customer yang diambil dari form inputan
     */
    function update_data($data_update = array())
    {
        $customer_id = $data_update["txt_customer_id"];
        $customer_nama = $data_update['txt_customer_nama'];
        $customer_alamat = $data_update['txt_customer_alamat'];
        $customer_telp = $data_update['txt_customer_telp'];
        
        return $this->db->query("update customer set customer_nama='".strtolower($customer_nama)."', customer_alamat='".$customer_alamat."', customer_telp='".$customer_telp."' where customer_id=".$customer_id);
    }
    
    /*
     * untuk menghapus data berdasarkan customer_id
     * @param $id id customer
     */
    function delete_data($id)
    {
        return $this->db->delete('customer', array('customer_id' => $id));
    }
    
    /*
     * untuk mengambil data berdasarkan id
     * @param string $id id customer yang diambil dari table
     */
    function get_curr_data($id)
    {
        $sql = "select * from customer where customer_id=".$id;
        $query = $this->db->query($sql);
        
        return ($query->num_rows() > 0) ? $query->row() : FALSE;
    }
    
    /*
     * untuk mengecek data kembar
     * @param string $customer_nama
     */
    function check_double_data($customer_nama)
    {
        $sql = "select * from customer where customer_nama='".$customer_nama."'";
        $query = $this->db->query($sql);
        
        return $query->num_rows();
    }
    
    /*
     * untuk mencari data
     * @param string $txt_search keterangan customer yang dicari
     */
    function get_search_data($txt_search)
    {
        $sql = "select * from customer where customer_nama like '%".$txt_search."%' order by customer_nama asc";
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
            $this->db->from("customer");
        }
        else
        {
            $this->db->like("customer_nama", $where);
            $this->db->from("customer");
        }
        
        return $this->db->count_all_results();
    }
}

/* End of file customer_model.php */
/* Location: ./application/models/customer_model.php */