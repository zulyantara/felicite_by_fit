<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Presensi_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function get_all_absensi()
    {
        $sql = "select absensi_pegawai, min(DATE_FORMAT(absensi_tgl, '%T')) as JamMasuk, max(DATE_FORMAT(absensi_tgl, '%T')) as JamKeluar, absensi_tgl, pegawai_nama, jabatan_ket from absensi left join pegawai on absensi_pegawai=pegawai_id left join jabatan_pegawai on pegawai_id=jp_pegawai and jp_isactive=1 left join jabatan on jp_jabatan=jabatan_id where date(absensi_tgl)=CURDATE() group by absensi_pegawai, pegawai_nama, jabatan_ket order by max(DATE_FORMAT(absensi_tgl, '%T')) desc";
        
        $query = $this->db->query($sql);
        
        return ($query->num_rows > 0) ? $query->result() : NULL;
    }
    
    function insert_absen($npp)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:i:s', time());
        $sql_insert = "insert into absensi(absensi_pegawai, absensi_tgl) values('".$npp."', '".$date."')";
        
        return $this->db->query($sql_insert);
    }
    
    function cek_pegawai($npp)
    {
        $sql = "select count(*) as jumlah from pegawai where pegawai_id='".$npp."'";
        $query = $this->db->query($sql);
        return ($query->num_rows > 0) ? $query->row() : NULL;
    }
    
    function get_selected_absen($npp, $tgl)
    {
        $sql = "select absensi_pegawai, min(DATE_FORMAT(absensi_tgl, '%T')) as JamMasuk, max(DATE_FORMAT(absensi_tgl, '%T')) as JamKeluar from absensi where absensi_pegawai='".$npp."' and absensi_tgl like '".$tgl."%' group by absensi_pegawai";
        $qry = $this->db->query($sql);
        return ($qry->num_rows > 0) ? $qry->row() : FALSE;
    }
}
/* End of file presensi_model.php */
/* Location: ./application/models/presensi_model.php */