<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transaksi_model extends CI_Model
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
    function get_all_trans_head($where=NULL, $limit=20, $start=0)
    {
        if($where === NULL)
        {
            $sql = "select th.th_no_faktur, th.th_tgl, th.th_status, p.pegawai_nama from transaksi_head th left join pegawai p on th.th_pegawai=p.pegawai_id order by th.th_tgl desc limit ".$start.", ".$limit;
        }
        else
        {
            $sql = "select th.th_no_faktur, th.th_tgl, th_customer, th.th_status, p.pegawai_nama from transaksi_head th left join pegawai p on th.th_pegawai=p.pegawai_id where ".$where." order by th.th_tgl desc limit ".$start.", ".$limit;
        }
        
        $query = $this->db->query($sql);
        
        return ($query->num_rows() > 0) ? $query->result() : FALSE;
    }
    
    /*
     * mengambil data transaksi detail berdasarkan no faktur
     */
    function get_data_td($no_faktur)
    {
        $sql = "select td_id, td.td_head, s.service_id, s.service_nama, td.td_qty, td.td_harga, pegawai_nama from transaksi_detail td left join service s on td.td_service=s.service_id left join pegawai on td_pegawai=pegawai_id where td.td_head='".$no_faktur."' order by td.td_id asc";
        
        $query = $this->db->query($sql);
        
        return ($query->num_rows() > 0) ? $query->result() : FALSE;
    }
    
    /*
     * mengambil no faktur terakhir
     */
    function get_last_data()
    {
        //$this->db->select_max("th_no_faktur");
        //$this->db->like("th_no_faktur", "FBF/".date("Y")."/".date("m")."/", "before");
        //$query = $this->db->get("transaksi_head");
        $thnbln = date("Y/m");
        $sql = "select max(th_no_faktur) as th_no_faktur from transaksi_head where th_no_faktur like 'FBF/".$thnbln."/%'";
        $query = $this->db->query($sql);
        return $query->row();
    }
    
    /*
     * untuk menyimpan transaksi head
     * @param array $data_input parameter transaksi head yang diambil dari form inputan
     */
    function save_th($data_input = array())
    {
        $th_no_faktur = $data_input["txt_no_faktur"];
        $th_customer = $data_input["txt_customer"];
        $th_tgl = date("Y-m-d H:i:s");
        $th_pegawai = $this->session->userdata("pegawaiid");
        $th_status = 0;
        
        $sql = "insert into transaksi_head (th_no_faktur, th_tgl, th_customer, th_pegawai, th_status) values ('".$th_no_faktur."', '".$th_tgl."', '".$th_customer."', '".$th_pegawai."', ".$th_status.")";
        return $this->db->query($sql);
    }
    
    /*
     * menyimpan transaksi detail
     */
    function save_td($data = array())
    {
        $td_head = $data["txt_no_faktur"];
        $td_service = $data["opt_service"];
        $td_pegawai = $data["opt_pegawai"];
        $td_qty = $data["txt_qty"];
        $td_harga = $data["txt_harga"];
        
        $sql = "insert into transaksi_detail (td_head, td_service, td_pegawai, td_qty, td_harga) values ('".$td_head."', ".$td_service.", '".$td_pegawai."', ".$td_qty.", ".$td_harga.")";
        return $this->db->query($sql);
    }
    
    function update_td($data = array())
    {
        $td_head = $data["txt_no_faktur"];
        $td_service = $data["opt_service"];
        $td_pegawai = $data["opt_pegawai"];
        $td_qty = $data["txt_qty"];
        $td_harga = $data["txt_harga"];
        
        $sql = "update transaksi_detail set td_qty=".$td_qty." where td_head='".$td_head."' and td_service=".$td_service;
        $qry = $this->db->query($sql);
        return $this->db->affected_rows();
    }
    
    function get_td_by_faktur($data = array())
    {
        $td_head = $data["txt_no_faktur"];
        $td_service = $data["opt_service"];
        
        $sql = "select * from transaksi_detail where td_head='".$td_head."' and td_service=".$td_service;
        $qry = $this->db->query($sql);
        return $qry->num_rows();
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
        
        return ($query->num_rows() > 0) ? $query->result() : FALSE;
    }
    
    /*
     * untuk menghitung jumlah data
     * @param string $where parameter pencarian
     */
    function get_sum_trans_head($where=NULL)
    {
        if($where==NULL)
        {
            $this->db->from("transaksi_head");
        }
        else
        {
            $this->db->like("th_no_faktur", $where);
            $this->db->from("service");
        }
        
        return $this->db->count_all_results();
    }
}

/* End of file transaksi_model.php */
/* Location: ./application/models/transaksi_model.php */