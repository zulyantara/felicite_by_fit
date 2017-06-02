<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends CI_Controller
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
        $this->load->model("Customer_model");
        $this->load->library('pagination');
        
        $config['base_url'] = base_url("customer/index/");
        $config['total_rows'] = $this->hitung_data();
        $config['per_page'] = 5;
        $config['uri_segment'] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = round($choice);
        
        $this->pagination->initialize($config);
        
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        $data["panel_title"] = "Customer";
        $data["content"] = "customer/home";
        $data["res_customer"] = $this->Customer_model->get_all_data($config['per_page'], $page);
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
        
        $this->form_validation->set_rules('txt_customer_nama', 'Nama Customer', 'required');
        $this->form_validation->set_rules('txt_customer_alamat', 'Alamat Customer', 'required');
        $this->form_validation->set_rules('txt_customer_telp', 'Telp Customer', 'required');
        
        if ($this->form_validation->run() === FALSE)
        {
            $data["panel_title"] = "Customer &rarr; Tambah Data";
            $data["content"] = "customer/form";
            $this->load->view("template", $data);
        }
        elseif($this->input->post("txt_customer_id"))
        {
            $this->ubah_data($this->input->post("txt_customer_id"));
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
        $input = array();
        $input['txt_customer_nama'] = $this->input->post("txt_customer_nama");
        $input['txt_customer_alamat'] = $this->input->post("txt_customer_alamat");
        $input['txt_customer_telp'] = $this->input->post("txt_customer_telp");
        
        /*
         * pastikan data yang dikirim melalui tombol btn_simpan
         */
        if($this->input->post("btn_simpan"))
        {
            $this->load->model("Customer_model");
            
            /*
             * cek txt_customer_nama sudah ada di database atau belum
             */
            $cek_data_kembar = $this->Customer_model->check_double_data($input['txt_customer_nama']);
            
            if($cek_data_kembar == 0)
            {
                $data["query_simpan"] = $this->Customer_model->save_data($input);
                
                $data["panel_title"] = "Customer &rarr; Simpan Data";
                $data["content"] = "customer/form";
                $data["err_msg"] = "Data berhasil disimpan";
                $this->load->view("template", $data);
            }
            else
            {
                $data["panel_title"] = "Customer &rarr; Simpan Data";
                $data["content"] = "customer/form";
                $data["err_msg"] = "Data sudah ada";
                $this->load->view("template", $data);
            }
        }
        else
        {
            $data["panel_title"] = "Customer";
            $data["content"] = "customer/home";
            $this->load->view("template", $data);
        }
    }
    
    /*
     * mengubah ke database
     * @param $id id jenis service
     */
    function ubah_data($id)
    {
        $input = array();
        $input['txt_customer_id'] = $id;
        $input['txt_customer_nama'] = $this->input->post("txt_customer_nama");
        $input['txt_customer_alamat'] = $this->input->post("txt_customer_alamat");
        $input['txt_customer_telp'] = $this->input->post("txt_customer_telp");
        
        /*
         * pastikan data yang dikirim melalui tombol btn_simpan
         */
        if($this->input->post("btn_simpan"))
        {
            $this->load->model("Customer_model");
            
            $data["query_simpan"] = $this->Customer_model->update_data($input);
            
            $data["panel_title"] = "Customer &rarr; Ubah Data";
            $data["content"] = "customer/form";
            $data["err_msg"] = "Data berhasil diubah";
            $this->load->view("template", $data);
        }
        else
        {
            $data["panel_title"] = "Customer";
            $data["content"] = "customer/home";
            $this->load->view("template", $data);
        }
    }
    
    /*
     * menampilkan form edit yang berisi data sesuai id yang dikirim melalui url segment ke 3
     */
    function edit_data()
    {
        $this->load->library('form_validation');
        $this->load->model("Customer_model");
        
        $this->form_validation->set_rules('txt_customer_nama', 'Nama Customer', 'required');
        $this->form_validation->set_rules('txt_customer_alamat', 'Alamat Customer', 'required');
        $this->form_validation->set_rules('txt_customer_telp', 'Telp Customer', 'required');
        
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->model("Jabatan_customer_model", "jp");
            
            $data["query_edit"] = $this->Customer_model->get_curr_data($this->uri->segment(3));
            $data["res_jp"] = $this->jp->get_all_data($this->uri->segment(3));
            $data["panel_title"] = "Customer &rarr; Tambah Data";
            $data["content"] = "customer/form";
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
        $this->load->model("Customer_model");
        $this->Customer_model->delete_data($this->uri->segment(3));
        $this->index();
    }
    
    /*
     * untuk cari data
     */
    function cari_data()
    {
        $this->load->model("Customer_model");
        
        $data["panel_title"] = "Customer";
        $data["content"] = "customer/home";
        $data["res_customer"] = $this->Customer_model->get_search_data($this->input->post("txt_search"));
        $data["qty_row"] = $this->hitung_data($this->input->post("txt_search"));
        $this->load->view("template", $data);
    }
    
    /*
     * untuk menghitung jumlah data
     */
    function hitung_data($where = "")
    {
        $this->load->model("Customer_model");
        $jml_data = $this->Customer_model->get_sum_data($where);
        return $jml_data;
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

/* End of file customer.php */
/* Location: ./application/controllers/customer.php */