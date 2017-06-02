<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function validate($username, $userpassword)
    {
        $this->db->select("user_id, user_name, user_type, pegawai_id, pegawai_nama, ul_ket");
        $this->db->from("user");
        $this->db->join("user_pegawai", "user_id=up_user", "left");
        $this->db->join("pegawai", "up_pegawai=pegawai_id", "left");
        $this->db->join("user_level", "user_type=ul_id", "left");
        $this->db->where('user_name', $username);
        $this->db->where('user_password', md5($userpassword));
        $query = $this->db->get();
        
        return ($query->num_rows() == 1) ? $query->row() : array();
    }
    
    function update_logout()
    {
        $date = date("Y-m-d H:i:s");
        $sql = "update user set user_last_login='".$date."' where user_id=".$this->session->userdata("userid");
        return $this->db->query($sql);
    }
    
    function update_password($data = array())
    {
        $user_id = $data["user_id"];
        $password_baru = md5($data["txt_password"]);
        
        $sql = "update user set user_password='".$password_baru."' where user_id=".$user_id;
        $this->db->query($sql);
        return $this->db->affected_rows();
    }
    
    function check_old_pass($data)
    {
        $sql = "select * from user where user_id=".$data["user_id"]." and user_password='".md5($data["txt_password_old"])."'";
        $qry = $this->db->query($sql);
        return $qry->num_rows();
    }
}

/* End of file auth_model.php */
/* Location: ./application/controllers/auth_model.php */
