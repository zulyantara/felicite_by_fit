<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller
{
    function index()
    {
        if($this->session->userdata('is_logged_in') == FALSE)
        {
            $this->load->view('login/home');
        }
        else
        {
            redirect('home');
        }
    }
    
    function validate_credential()
    {
		if($this->input->post("btn_login") AND $this->input->post("btn_login") == "Login")
		{
			$this->load->model('auth_model');
			
			$txt_user_name = str_replace("'", 0, $this->input->post("txt_user_name"));
			$txt_user_password = str_replace("'", 0, $this->input->post("txt_user_password"));
			
			$query = $this->auth_model->validate($txt_user_name, $txt_user_password);
			
			if($query)
			{
				$data = array(
					'userid' => $query->user_id,
					'username' => $query->user_name,
					'userlevelid' => $query->user_type,
					'userlevel' => $query->ul_ket,
					'pegawaiid' => $query->pegawai_id,
					'pegawainama' => $query->pegawai_nama,
					'is_logged_in' => TRUE
				);
				
				$this->session->set_userdata($data);
				redirect("home");
			}
			else
			{
				$data['error'] = "<div class=\"alert alert-danger\">Username atau Password salah</div>";
				$this->load->view('login/home', $data);
			}
		}
		else
		{
			$this->load->view('login/home');
		}
    }
	
	function ubah_password()
	{
		$this->load->library("form_validation");
		
		$this->form_validation->set_rules("txt_password_old", "Password Lama", "required|min_length[5]");
		$this->form_validation->set_rules("txt_password", "Password", "required|matches[txt_password_conf]");
		$this->form_validation->set_rules("txt_password_conf", "Confirm Password", "required");
		
		if($this->form_validation->run() == FALSE)
		{
			$data["panel_title"] = "User &rarr; Ubah Password";
			$data["content"] = "login/ubah_password";
			$this->load->view("template", $data);
		}
		elseif($this->input->post("btn_simpan"))
		{
			$this->load->model("Auth_model", "am");
			
			$data["user_id"] = $this->session->userdata("userid");
			$data["txt_password_old"] = $this->input->post("txt_password_old");
			$data["txt_password"] = $this->input->post("txt_password");
			
			//cek password lama
			$cek_password_old = $this->am->check_old_pass($data);
			
			if($cek_password_old > 0)
			{
				//update password
				$qry = $this->am->update_password($data);
				if($qry === 1)
				{
					$data["err_msg"] = "Password berhasil diubah";
				}
				else
				{
					$data["err_msg"] = "Password tidak berhasil diubah";
				}
				$data["panel_title"] = "User &rarr; Ubah Password";
				$data["content"] = "login/ubah_password";
				$this->load->view("template", $data);
			}
			else
			{
				$data["err_msg"] = "Password lama tidak sama";
				$data["panel_title"] = "User &rarr; Ubah Password";
				$data["content"] = "login/ubah_password";
				$this->load->view("template", $data);
			}
		}
		else
		{
			redirect("home");
		}
	}
    
    function logout()
	{
		$this->load->model("auth_model", "am");
		$this->am->update_logout();
		$this->session->sess_destroy();
		$this->load->view('login/home');
	}
}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */
