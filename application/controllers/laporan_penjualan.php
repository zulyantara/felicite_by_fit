<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_penjualan extends CI_Controller
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
    
    function index()
    {
        $this->load->model("laporan_penjualan_model", "lpm");
        
        if($this->input->post("btn_pilih") === "btn_pilih")
        {
            $tanggal = $this->input->post("opt_thn")."-".$this->input->post("opt_bln");
            $data["thn_pilih"] = $this->input->post("opt_thn");
            $data["bln_pilih"] = $this->input->post("opt_bln");
            $data["qry_laporan"] = $this->lpm->get_laporan_by_bulan($tanggal);
        }
        else
        {
            $data["qry_laporan"] = $this->lpm->get_laporan_by_bulan(date("Y-m"));
        }
        
        $data["panel_title"] = "Laporan Penjualan Per Bulan ".$this->input->post("opt_bln")."-".$this->input->post("opt_thn");
        $data["content"] = "laporan/view_penjualan";
        $this->load->view("template", $data);
    }
    
    function cetak()
    {
        $this->load->model("laporan_penjualan_model", "lpm");
        $this->load->library('dompdf_gen');
        
        $thn_pilih = $this->uri->segment(3);
        $bln_pilih = $this->uri->segment(4);
        
        $data["panel_title"] = "Laporan Penjualan Per Bulan Periode $bln_pilih - $thn_pilih";
        $data["qry_laporan"] = $this->lpm->get_laporan_by_bulan($thn_pilih."-".$bln_pilih);
        
        $this->load->view("laporan/cetak_penjualan", $data);
        
        $html = $this->output->get_output();
        $this->dompdf->load_html($html);
        $this->dompdf->render();
		$this->dompdf->stream("laporan_bulan_$bln_pilih_$thn_pilih.pdf");
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

/* End of file laporan_penjualan.php */
/* Location: ./application/controllers/laporan_penjualan.php */