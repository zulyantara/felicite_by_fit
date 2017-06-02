<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pegawai extends CI_Controller
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
        $this->load->model("Pegawai_model");
        $this->load->library('pagination');
        
        $config['base_url'] = base_url("pegawai/index/");
        $config['total_rows'] = $this->hitung_data();
        $config['per_page'] = 5;
        $config['uri_segment'] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = round($choice);
        
        $this->pagination->initialize($config);
        
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        $data["panel_title"] = "Pegawai";
        $data["content"] = "pegawai/home";
        $data["res_pegawai"] = $this->Pegawai_model->get_all_data($config['per_page'], $page);
        $data["qty_row"] = $this->hitung_data();
        $data["links"] = $this->pagination->create_links();
        
        $this->load->view("template", $data);
    }
    
    /*
     * menampilkan form data baru
     */
    function data_baru()
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('txt_pegawai_nama', 'Nama Pegawai', 'required');
        $this->form_validation->set_rules('opt_jabatan', 'Jabatan Pegawai', 'required');
        $this->form_validation->set_rules('txt_pegawai_alamat', 'Alamat Pegawai', 'required');
        $this->form_validation->set_rules('txt_pegawai_telp', 'Telp Pegawai', 'required');
        
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->model("jabatan_model", "jm");
            
            $data["res_jabatan"] = $this->jm->get_all_data();
            $data["panel_title"] = "Pegawai &rarr; Tambah Data";
            $data["content"] = "pegawai/form";
            $this->load->view("template", $data);
        }
        elseif($this->input->post("txt_pegawai_id"))
        {
            $this->ubah_data($this->input->post("txt_pegawai_id"));
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
        $data["txt_pegawai_nama"] = $this->input->post("txt_pegawai_nama");
        $data["opt_jabatan"] = $this->input->post("opt_jabatan");
        $data["txt_pegawai_alamat"] = $this->input->post("txt_pegawai_alamat");
        $data["txt_pegawai_telp"] = $this->input->post("txt_pegawai_telp");
        
        /*
         * pastikan data yang dikirim melalui tombol btn_simpan
         */
        if($this->input->post("btn_simpan"))
        {
            $this->load->model("Pegawai_model");
            
            /*
             * cek txt_pegawai_nama sudah ada di database atau belum
             */
            $cek_data_kembar = $this->Pegawai_model->check_double_data($data["txt_pegawai_nama"]);
            
            if($cek_data_kembar == 0)
            {
                $this->load->model("jabatan_model", "jm");
                $data["query_simpan"] = $this->Pegawai_model->save_data($data);
                
                $data["res_jabatan"] = $this->jm->get_all_data();
                $data["panel_title"] = "Pegawai &rarr; Simpan Data";
                $data["content"] = "pegawai/form";
                $data["err_msg"] = "Data berhasil disimpan";
                $this->load->view("template", $data);
            }
            else
            {
                $data["panel_title"] = "Pegawai &rarr; Simpan Data";
                $data["content"] = "pegawai/form";
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
        $data["txt_pegawai_id"] = $id;
        $data["txt_pegawai_nama"] = $this->input->post("txt_pegawai_nama");
        $data["txt_pegawai_alamat"] = $this->input->post("txt_pegawai_alamat");
        $data["txt_pegawai_telp"] = $this->input->post("txt_pegawai_telp");
        
        /*
         * pastikan data yang dikirim melalui tombol btn_simpan
         */
        if($this->input->post("btn_simpan"))
        {
            $this->load->model("Pegawai_model");
            
            $data["query_simpan"] = $this->Pegawai_model->update_data($data);
            
            $data["panel_title"] = "Pegawai &rarr; Ubah Data";
            $data["content"] = "pegawai/form";
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
        $this->load->model("Pegawai_model");
        
        $this->form_validation->set_rules('txt_pegawai_nama', 'Nama Pegawai', 'required');
        $this->form_validation->set_rules('txt_pegawai_alamat', 'Alamat Pegawai', 'required');
        $this->form_validation->set_rules('txt_pegawai_telp', 'Telp Pegawai', 'required');
        
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->model("Jabatan_pegawai_model", "jp");
            
            $data["query_edit"] = $this->Pegawai_model->get_curr_data($this->uri->segment(3));
            $data["res_jp"] = $this->jp->get_all_data($this->uri->segment(3));
            $data["panel_title"] = "Pegawai &rarr; Edit Data";
            $data["content"] = "pegawai/form";
            $data["data_id"] = $this->uri->segment(3);
            $this->load->view("template", $data);
        }
        else
        {
            $this->simpan_data();
        }
    }
    
    /*
     * untuk menghapus data berdasarkan id yang dikirim
     */
    function hapus_data()
    {
        $this->load->model("Pegawai_model");
        $this->Pegawai_model->delete_data($this->uri->segment(3));
        $this->index();
    }
    
    /*
     * untuk cari data
     */
    function cari_data()
    {
        $this->load->model("Pegawai_model");
        
        $data["panel_title"] = "Pegawai";
        $data["content"] = "pegawai/home";
        $data["res_pegawai"] = $this->Pegawai_model->get_search_data($this->input->post("txt_search"));
        $data["qty_row"] = $this->hitung_data($this->input->post("txt_search"));
        $this->load->view("template", $data);
    }
    
    /*
     * untuk menghitung jumlah data
     */
    function hitung_data($where = "")
    {
        $this->load->model("Pegawai_model");
        $jml_data = $this->Pegawai_model->get_sum_data($where);
        return $jml_data;
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

/* End of file pegawai.php */
/* Location: ./application/controllers/pegawai.php */