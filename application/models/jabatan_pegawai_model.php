<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jabatan_pegawai_model extends CI_Model
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
    function get_all_data($jp_pegawai)
    {
        $sql = "select pegawai_nama, jabatan_id, jabatan_ket, jp_isactive from jabatan_pegawai left join pegawai on jp_pegawai=pegawai_id left join jabatan on jp_jabatan=jabatan_id where jp_pegawai=".$this->db->escape($jp_pegawai)." order by jabatan_ket asc";
        
        $query = $this->db->query($sql);
        
        return ($query->num_rows() > 0) ? $query->result() : array();
    }
    
    /*
     * untuk menyimpan data
     * @param string $pegawai_nama nama pegawai yang diambil dari form inputan
     * @param string $pegawai_alamat alamat pegawai yang diambil dari form inputan
     * @param string $pegawai_telp telp pegawai yang diambil dari form inputan
     */
    function save_data($jp_pegawai, $jp_jabatan, $jp_isactive)
    {
        return $this->db->query("insert into jabatan_pegawai (jp_pegawai, jp_jabatan, jp_isactive) values (".$jp_pegawai.", ".$jp_jabatan.", ".$jp_isactive.")");
    }
    
    /*
     * untuk mengubah data
     * @param string $pegawai_id id pegawai yang diambil dari form inputan
     * @param string $pegawai_nama keterangan pegawai yang diambil dari form inputan
     * @param string $pegawai_alamat alamat pegawai yang diambil dari form inputan
     * @param string $pegawai_telp telp pegawai yang diambil dari form inputan
     */
    function update_data($jp_id, $jp_pegawai, $jp_jabatan, $jp_isactive)
    {
        return $this->db->query("update jabatan_pegawai set jp_pegawai=".$jp_pegawai.", jp_jabatan=".$jp_jabatan.", jp_isactive=".$jp_isactive." where jp_id=".$jp_id);
    }
    
    /*
     * untuk mengecek data kembar
     * @param string $pegawai_nama
     */
    function check_double_data($jp_pegawai, $jp_jabatan)
    {
        $sql = "select * from jabatan_pegawai where jp_pegawai=".$jp_pegawai." and jp_jabatan=".$jp_jabatan;
        $query = $this->db->query($sql);
        
        return $query->num_rows();
    }
    
    /*
     * untuk menghitung jumlah data
     * @param string $where parameter pencarian
     */
    function get_sum_data($where=NULL)
    {
        if($where==NULL)
        {
            $this->db->from("jabatan_pegawai");
        }
        else
        {
            $this->db->like("jp_pegawai", $where);
            $this->db->from("jabatan_pegawai");
        }
        
        return $this->db->count_all_results();
    }
}

/* End of file jabatan_pegawai_model.php */
/* Location: ./application/models/jabatan_pegawai_model.php */