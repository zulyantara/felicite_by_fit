<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Presensi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->output->enable_profiler(FALSE);
    }
    
    function index()
    {
        $this->load->model('presensi_model', 'pm');
        
        $data["panel_title"] = "Presensi Pegawai";
        $data['sql_absen'] = $this->pm->get_all_absensi();
        $data['content'] = 'presensi/home';
        $this->load->view('template', $data);
    }
    
    function input_absensi()
    {
        $this->load->model('presensi_model', 'pm');
        
        $cekPegawai = $this->pm->cek_pegawai($this->input->post('txt_npp'));
        
        if($cekPegawai->jumlah == 1)
        {
            $this->pm->insert_absen($this->input->post('txt_npp'));
            $this->index();
        }
        else
        {
            $this->index();
        }
    }
    
    function rekap_presensi()
    {
        //pertama2 cek sudah login atau belum dan user level = administrator
        $this->check_loggin();
        
        $this->load->database();
        $this->load->model("pegawai_model", "pgm");
        $this->load->model("presensi_model", "pm");
        
        $data["pegawai_pilih"] = ($this->input->post("opt_pegawai")) ? $this->input->post("opt_pegawai") : NULL;
        $data["thn_pilih"] = ($this->input->post("opt_tahun")) ? $this->input->post("opt_tahun") : date("Y");
        $data["bln_pilih"] = ($this->input->post("opt_bulan")) ? $this->input->post("opt_bulan") : date("m");
        
        $data["sql_pegawai"] = $this->pgm->get_all_data();
        $data["panel_title"] = "Rekap Presensi";
        $data["content"] = "presensi/rekap";
        $this->load->view("template", $data);
    }
    
    /*
     * cek sudah login atau belum
     * atau level user = administrator
     */
	private function check_loggin()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
        $userLevel = $this->session->userdata('userlevel');
        
		if( ! $is_logged_in OR $is_logged_in != TRUE OR $userLevel != 0)
		{
			redirect('auth');
		}
	}
}

/* End of file presensi.php */
/* Location: ./application/controllers/presensi.php */