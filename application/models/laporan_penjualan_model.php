<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_penjualan_model extends CI_Model
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
     * @description function untuk mengambil data laporan berdasarkan bulan yang dipilih
     * @param $tgl = tahun-bulan sekarang
     * @return if num row > 0 array else false
     */
    function get_laporan_by_bulan($tgl)
    {
        $sql = "select * from v_penjualan where th_tgl like '".$tgl."%'";
        $qry = $this->db->query($sql);
        return ($qry->num_rows() > 0) ? $qry->result() : FALSE;
    }
}

/* End of file laporan_penjualan_model.php */
/* Location: ./application/models/laporan_penjualan_model.php */