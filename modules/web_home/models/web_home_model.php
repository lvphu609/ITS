<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Web_home_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('api/post','api/account','file_model'));
    }

    function changePass($account_id,$old_pass,$new_pass){
        //check old_pass
        $query = $this->db->get_where('accounts',array('id'=>$account_id,'password' => $old_pass));
        if($query->num_rows() == 1){
            $update = $this->db->update('accounts',array('password' => $new_pass),array('id' => $account_id));
            if($update){
                return 3; //update true
            }
            return 4; //update fail
        }else{
            return 2; //password wrong
        }
    }

}