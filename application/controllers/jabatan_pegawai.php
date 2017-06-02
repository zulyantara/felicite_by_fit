<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jabatan_pegawai extends CI_Controller
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
        redirect('home', 'refresh');
    }
    
    /*
     * menampilkan form data baru
     */
    function data_baru()
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('txt_jp_pegawai', 'Nama Pegawai', 'required');
        $this->form_validation->set_rules('opt_jp_jabatan', 'Jabatan', 'required');
        $this->form_validation->set_rules('chk_jp_isactive', 'Aktif', 'required');
        
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->model("Jabatan_model");
            
            $data["res_jabatan"] = $this->Jabatan_model->get_all_data();
            $data["panel_title"] = "Jabatan Pegawai &rarr; Tambah Data";
            $data["content"] = "jabatan_pegawai/form";
            $this->load->view("template", $data);
        }
        elseif($this->input->post("txt_jp_id"))
        {
            $this->ubah_data($this->input->post("txt_jp_id"));
        }
        else
        {
            $this->simpan_data();
        }
    }
    
    /*
     * menyimpan ke database
     */
    function simpan_data()
    {
        $txt_jp_pegawai = $this->input->post("txt_jppegawai");
        $opt_jp_jabatan = $this->input->post("opt_jp_jabatan");
        $chk_jp_isactive = $this->input->post("chk_jp_isactive");
        
        /*
         * pastikan data yang dikirim melalui tombol btn_simpan
         */
        if($this->input->post("btn_simpan"))
        {
            $this->load->model("Jabatan_pegawai_model", "jp");
            
            /*
             * cek txt_pegawai_nama sudah ada di database atau belum
             */
            $cek_data_kembar = $this->jp->check_double_data($txt_jp_pegawai, $opt_jp_jabatan);
            
            if($cek_data_kembar == 0)
            {
                $data["query_simpan"] = $this->jp->save_data($txt_jp_pegawai, $opt_jp_jabatan, $chk_jp_isactive);
                
                $data["panel_title"] = "Jabatan Pegawai &rarr; Simpan Data";
                $data["content"] = "jabatan_pegawai/form";
                $data["err_msg"] = "Data berhasil disimpan";
                $this->load->view("template", $data);
            }
            else
            {
                $data["panel_title"] = "Jabatan Pegawai &rarr; Simpan Data";
                $data["content"] = "jabatan_pegawai/form";
                $data["err_msg"] = "Data sudah ada";
                $this->load->view("template", $data);
            }
        }
        else
        {
            $data["panel_title"] = "Pegawai";
            $data["content"] = "pegawai/home";
            $this->load->view("template", $data);
        }
    }
    
    /*
     * mengubah ke database
     * @param $id id jenis service
     */
    function ubah_data($id)
    {
        $txt_jp_pegawai = $this->input->post("txt_jp_pegawai");
        $opt_jp_jabatan = $this->input->post("opt_jp_jabatan");
        $chk_jp_isactive = $this->input->post("chk_jp_isactive");
        
        /*
         * pastikan data yang dikirim melalui tombol btn_simpan
         */
        if($this->input->post("btn_simpan"))
        {
            $this->load->model("Jabatan_pegawai_model", "jp");
            
            $data["query_simpan"] = $this->jp->update_data($id, $txt_jp_pegawai, $opt_jp_jabatan, $chk_jp_isactive);
            
            $data["panel_title"] = "Jabatan Pegawai &rarr; Ubah Data";
            $data["content"] = "jabatan_pegawai/form";
            $data["err_msg"] = "Data berhasil diubah";
            $this->load->view("template", $data);
        }
        else
        {
            $data["panel_title"] = "Pegawai";
            $data["content"] = "pegawai/home";
            $this->load->view("template", $data);
        }
    }
    
    /*
     * menampilkan form edit yang berisi data sesuai id yang dikirim melalui url segment ke 3
     */
    function edit_data()
    {
        $this->load->library('form_validation');
        $this->load->model("Jabatan_pegawai_model", "jp");
        
        $this->form_validation->set_rules('txt_jp_pegawai', 'Nama Pegawai', 'required');
        $this->form_validation->set_rules('opt_jp_jabatan', 'Jabatan Pegawai', 'required');
        $this->form_validation->set_rules('chk_jp_isactive', 'Isactive', 'required');
        
        if ($this->form_validation->run() === FALSE)
        {
            $data["query_edit"] = $this->jp->get_all_data($this->uri->segment(3));
            $data["panel_title"] = "Jabatan Pegawai &rarr; Tambah Data";
            $data["content"] = "jabatan_pegawai/form";
            $data["data_id"] = $this->uri->segment(3);
            $this->load->view("template", $data);
        }
        else
        {
            $this->simpan_data();
        }
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

/* End of file jabatan_pegawai.php */
/* Location: ./application/controllers/jabatan_pegawai.php */