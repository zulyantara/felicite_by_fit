<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jenis_service extends CI_Controller
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
        $this->load->model("Jenis_service_model");
        $this->load->library('pagination');
        
        $config['base_url'] = base_url("jenis_service/index/");
        $config['total_rows'] = $this->hitung_data();
        $config['per_page'] = 5;
        $config['uri_segment'] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = round($choice);
        
        $this->pagination->initialize($config);
        
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        $data["panel_title"] = "Jenis Service";
        $data["content"] = "jenis_service/home";
        $data["res_jenis_service"] = $this->Jenis_service_model->get_all_data($config['per_page'], $page);
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
        
        $this->form_validation->set_rules('txt_jenis_service_ket', 'Jenis Service', 'required');
        
        if ($this->form_validation->run() === FALSE)
        {
            $data["panel_title"] = "Jenis Service &rarr; Tambah Data";
            $data["content"] = "jenis_service/form";
            $this->load->view("template", $data);
        }
        elseif($this->input->post("txt_jenis_service_id"))
        {
            $this->ubah_data($this->input->post("txt_jenis_service_id"));
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
        /*
         * pastikan data yang dikirim melalui tombol btn_simpan
         */
        if($this->input->post("btn_simpan"))
        {
            $this->load->model("Jenis_service_model");
            
            /*
             * cek txt_jenis_service_ket sudah ada di database atau belum
             */
            $cek_data_kembar = $this->Jenis_service_model->check_double_data($this->input->post("txt_jenis_service_ket"));
            
            if($cek_data_kembar == 0)
            {
                $data["query_simpan"] = $this->Jenis_service_model->save_data($this->input->post("txt_jenis_service_ket"));
                
                $data["panel_title"] = "Jenis Service &rarr; Simpan Data";
                $data["content"] = "jenis_service/form";
                $data["err_msg"] = "Data berhasil disimpan";
                $this->load->view("template", $data);
            }
            else
            {
                $data["panel_title"] = "Jenis Service &rarr; Simpan Data";
                $data["content"] = "jenis_service/form";
                $data["err_msg"] = "Data sudah ada";
                $this->load->view("template", $data);
            }
        }
        else
        {
            $data["panel_title"] = "Jenis Service";
            $data["content"] = "jenis_service/home";
            $this->load->view("template", $data);
        }
    }
    
    /*
     * mengubah ke database
     * @param $id id jenis service
     */
    function ubah_data($id)
    {
        /*
         * pastikan data yang dikirim melalui tombol btn_simpan
         */
        if($this->input->post("btn_simpan"))
        {
            $this->load->model("Jenis_service_model");
            
            $data["query_simpan"] = $this->Jenis_service_model->update_data($id, $this->input->post("txt_jenis_service_ket"));
            
            $data["panel_title"] = "Jenis Service &rarr; Ubah Data";
            $data["content"] = "jenis_service/form";
            $data["err_msg"] = "Data berhasil diubah";
            $this->load->view("template", $data);
        }
        else
        {
            $data["panel_title"] = "Jenis Service";
            $data["content"] = "jenis_service/home";
            $this->load->view("template", $data);
        }
    }
    
    /*
     * menampilkan form edit yang berisi data sesuai id yang dikirim melalui url segment ke 3
     */
    function edit_data()
    {
        $this->load->library('form_validation');
        $this->load->model("Jenis_service_model");
        
        $this->form_validation->set_rules('txt_jenis_service_ket', 'Jenis Service', 'required');
        
        if ($this->form_validation->run() === FALSE)
        {
            $data["query_edit"] = $this->Jenis_service_model->get_curr_data($this->uri->segment(3));
            $data["panel_title"] = "Jenis Service &rarr; Tambah Data";
            $data["content"] = "jenis_service/form";
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
        $this->load->model("Jenis_service_model");
        $this->Jenis_service_model->delete_data($this->uri->segment(3));
        $this->index();
    }
    
    /*
     * untuk cari data
     */
    function cari_data()
    {
        $this->load->model("Jenis_service_model");
        
        $data["panel_title"] = "Jenis Service";
        $data["content"] = "jenis_service/home";
        $data["res_jenis_service"] = $this->Jenis_service_model->get_search_data($this->input->post("txt_search"));
        $data["qty_row"] = $this->hitung_data($this->input->post("txt_search"));
        $this->load->view("template", $data);
    }
    
    /*
     * untuk menghitung jumlah data
     */
    function hitung_data($where = "")
    {
        $this->load->model("Jenis_service_model");
        $jml_data = $this->Jenis_service_model->get_sum_data($where);
        return $jml_data;
    }
    
    /*
     * cek sudah login atau belum
     * atau level user = administrator
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

/* End of file jenis_service.php */
/* Location: ./application/controllers/jenis_service.php */