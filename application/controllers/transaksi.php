<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transaksi extends CI_Controller
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
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('txt_customer', 'Customer', 'required');
        
        if ($this->form_validation->run() === FALSE)
        {
            $data["res_customer"] = $this->Customer_model->get_all_data();
            $data["panel_title"] = "Transaksi &rarr; Head";
            $data["content"] = "transaksi/home";
            
            $this->load->view("template", $data);
        }
        elseif($this->input->post("btn_simpan_head"))
        {
            $this->simpan_data();
        }
    }
    
    /*
     * validasi form transaksi detail
     */
    function form_td()
    {
        $this->load->model("Service_model");
        $this->load->model("Pegawai_model", "pm");
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('opt_service', 'Service', 'required');
        $this->form_validation->set_rules('opt_pegawai', 'Pegawai', 'required');
        $this->form_validation->set_rules('txt_qty', 'Quantity', 'required');
        
        if($this->form_validation->run() === FALSE)
        {
            $data["res_pegawai"] = $this->pm->get_all_data();
            $data["res_service"] = $this->Service_model->get_all_data();
            $data["panel_title"] = "Transaksi &rarr; Detail";
            $data["content"] = "transaksi/detail";
            $this->load->view("template", $data);
        }
    }
    
    /*
     * untuk menghitung jumlah data
     */
    function hitung_data_trans_head($where = "")
    {
        $this->load->model("Transaksi_model");
        $jml_data = $this->Transaksi_model->get_sum_trans_head($where);
        return $jml_data;
    }
    
    /*
     * menyimpan ke database
     */
    function simpan_data()
    {
        $this->load->model("Pegawai_model", "pm");
        $this->load->model("Customer_model");
        $this->load->model("Service_model");
        $this->load->model("Transaksi_model");
        /*
         * pastikan data yang dikirim melalui tombol btn_simpan_head
         */
        if($this->input->post("btn_simpan_head"))
        {
            $data_input = array();
            $data_input["txt_customer"] = $this->input->post("txt_customer");
            
            $row_max_th = $this->Transaksi_model->get_last_data();
            $no_max = substr($row_max_th->th_no_faktur, -3);
            //echo $row_max_th->th_no_faktur;exit;
            $jml_th = $no_max+1;
            
            // cek jumlah digit dari jumlah data transaksi head untuk menambahkan angka 000
            if(strlen($jml_th) == 1)
            {
                $no_urut = "00".$jml_th;
            }
            elseif(strlen($jml_th) == 2)
            {
                $no_urut = "0".$jml_th;
            }
            elseif(strlen($jml_th) == 3)
            {
                $no_urut = $jml_th;
            }
            $data_input["txt_no_faktur"] = "FBF/".date("Y")."/".date("m")."/".$no_urut;
            
            // simpan transaksi head
            $data["query_simpan"] = $this->Transaksi_model->save_th($data_input);
            
            $data["res_pegawai"] = $this->pm->get_all_data(15, 0, "and jabatan_ket !='staf kasir'");
            $data["res_service"] = $this->Service_model->get_all_data();
            $data["no_faktur"] = $data_input["txt_no_faktur"];
            $data["panel_title"] = "Transaksi &rarr; Detail";
            $data["content"] = "transaksi/detail";
            $this->load->view("template", $data);
        }
        
        /*
         * data yang dikirim melalui tombol tambah detail
         */
        elseif($this->input->post("btn_tambah_detail"))
        {
            $data = array();
            $data["txt_no_faktur"] = $this->input->post("txt_no_faktur");
            $data["opt_service"] = $this->input->post("opt_service");
            $data["opt_pegawai"] = $this->input->post("opt_pegawai");
            $data["txt_qty"] = $this->input->post("txt_qty");
            $harga = $this->Service_model->get_data_by_id($data["opt_service"]);
            $data["txt_harga"] = $harga->service_harga;
            
            // cek transaksi detail, klo no faktur sama, opt_service sama maka update qty
            $cek_td = $this->Transaksi_model->get_td_by_faktur($data);
            if($cek_td === 1)
            {
                // update transaksi detail
                $this->Transaksi_model->update_td($data);
            }
            else
            {
                // simpan transaksi detail
                $this->Transaksi_model->save_td($data);
            }
            
            $data["res_pegawai"] = $this->pm->get_all_data(15, 0, "and jabatan_ket !='staf kasir'");
            $data["res_service"] = $this->Service_model->get_all_data();
            $data["res_td"] = $this->Transaksi_model->get_data_td($data["txt_no_faktur"]);
            $data["no_faktur"] = $data["txt_no_faktur"];
            $data["panel_title"] = "Transaksi &rarr; Detail";
            $data["content"] = "transaksi/detail";
            $this->load->view("template", $data);
        }
        elseif($this->input->post("btn_selesai") === "btn_selesai")
        {
            $this->load->model("transaksi_model", "tm");
            $data["no_faktur"] = $this->input->post("txt_no_faktur");
            $data["qry_transaksi"] = $this->tm->get_data_td($data["no_faktur"]);
            $this->load->view("transaksi/cetak",$data);
        }
        /*
         * tidak menekan tombol apa2
         */
        else
        {
            redirect("transaksi");
        }
    }
    
    /*
     * untuk cari data
     */
    function cari_data()
    {
        $this->load->model("Service_model");
        
        $data["panel_title"] = "Service";
        $data["content"] = "service/home";
        $data["res_service"] = $this->Service_model->get_search_data($this->input->post("txt_search"));
        $data["qty_row"] = $this->hitung_data($this->input->post("txt_search"));
        $this->load->view("template", $data);
    }
    
    /*
     * mengubah ke database
     * @param $id id service
     */
    function ubah_data($id)
    {
        $txt_service_name = $this->input->post("txt_service_nama");
        $txt_service_harga = $this->input->post("txt_service_harga");
        $opt_service_harga = $this->input->post("opt_service_jenis");
        /*
         * pastikan data yang dikirim melalui tombol btn_simpan
         */
        if($this->input->post("btn_simpan"))
        {
            $this->load->model("Service_model");
            
            $data["query_simpan"] = $this->Service_model->update_data($id, $txt_service_name, $txt_service_harga, $opt_service_harga);
            
            $data["panel_title"] = "Service &rarr; Ubah Data";
            $data["content"] = "service/form";
            $data["err_msg"] = "Data berhasil diubah";
            $this->load->view("template", $data);
        }
        else
        {
            $data["panel_title"] = "Service";
            $data["content"] = "service/home";
            $this->load->view("template", $data);
        }
    }
    
    /*
     * menampilkan form edit yang berisi data sesuai id yang dikirim melalui url segment ke 3
     */
    function edit_data()
    {
        $this->load->library('form_validation');
        $this->load->model("Service_model");
        $this->load->model("Jenis_service_model");
        
        $this->form_validation->set_rules('txt_service_nama', 'Nama Service', 'required');
        $this->form_validation->set_rules('txt_service_harga', 'Harga Service', 'required');
        $this->form_validation->set_rules('opt_service_jenis', 'Jenis Service', 'required');
        
        if ($this->form_validation->run() === FALSE)
        {
            $data["query_edit"] = $this->Service_model->get_curr_data($this->uri->segment(3));
            $data["res_jenis_service"] = $this->Jenis_service_model->get_all_data();
            $data["panel_title"] = "Service &rarr; Tambah Data";
            $data["content"] = "service/form";
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
        $this->load->model("Service_model");
        $this->Service_model->delete_data($this->uri->segment(3));
        $this->index();
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

/* End of file transaksi.php */
/* Location: ./application/controllers/transaksi.php */