<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{
    /*
     * @author Zulyantara <zulyantara@gmail.com>
     * @copyright Copyright 2014, Zulyantara
     */
    
    function __construct()
    {
        parent::__construct();
        $this->check_loggin();
        $this->output->enable_profiler(FALSE);
    }
    
    /*
     * @property $data['panel_title'] = untuk menampilkan panel title di header
     * @property $data['content'] = untuk menampilkan content
     */
    function index()
    {
        $this->load->model("transaksi_model", "tm");
        
        $data["sql_th"] = $this->tm->get_all_trans_head("th_tgl like '".date("Y-m-d")."%'");
        $data["panel_title"] = "Beranda";
        $data["content"] = "home";
        $this->load->view("template", $data);
    }
    
    /*
     * cek sudah login atau belum
     */
	private function check_loggin()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if( ! $is_logged_in OR $is_logged_in != TRUE)
		{
			redirect('auth');
		}
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */