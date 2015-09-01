<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ad_home extends MX_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->info_user   = $this->session->userdata('user_login');
        if(!$this->info_user){
            redirect(base_url('admin/login'));
        }
        $model = array('ad_home_model');
        $this->load->models($model);
    }

    public function index()
    {
        $data = array(
            'header_title' => $this->lang->line('header_title'),
            'page_header' => $this->lang->line('page_title_dashboard')
        );

        $this->load->view('templates/admin/header',$data);
        $this->load->view('templates/admin/container');
        $this->load->view('templates/admin/menu');
        $this->load->view('home_view');
        $this->load->view('templates/admin/footer');
    }

    function change_password(){
        if(empty($this->info_user)){
            $result = array(
                'status' => 'failure',
                'message' => 'Bạn chưa đăng nhập'
            );
            header('Content-Type: application/x-json; charset=utf-8');
            echo (json_encode($result));
        }
        $account = $this->info_user;
        $status = 'failure';
        $message= '';

        $old_pass = $this->input->post('old_pass');
        $new_pass = $this->input->post('new_pass');
        $cf_pass = $this->input->post('cf_pass');

        if(empty($old_pass)){
            $message = 'Bạn chưa nhập mật khẩu cũ.';
        }else if(empty($new_pass)){
            $message = 'Bạn chưa nhập mật khẩu mới.';
        }else if(empty($cf_pass)){
            $message = 'Bạn chưa nhập xác nhận mật khẩu mới.';
        }else if($new_pass != $cf_pass){
            $message = 'Mật khẩu mới và xác nhận mật khẩu không khớp.';
        }else{
            //check old_pass
            $checkPass = $this->ad_home_model->changePass($account['id'],$old_pass,$new_pass);
            if($checkPass === 2){
                $message = 'Mật khẩu cũ không đúng.';
            }else if($checkPass === 4){
                $message = 'Đổi mật khẩu không thành công.';
            }else{
                $status = 'success';
            }
        }

        $message ='<div class="alert alert-warning" role="alert">'.$message.'</div>';
        /*$message ='<div class="alert alert-warning" role="alert">
                        <strong>Cảnh báo!</strong>Loại yêu cầu <strong>'. $isDelete['title'] .'</strong> đang được sử dụng.
                    </div>';*/

        $result = array(
            'status' => $status,
            'message' => $message
        );
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($result));
    }


}