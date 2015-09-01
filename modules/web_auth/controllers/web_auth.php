<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Web_auth extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->info_user = $this->session->userdata('web_user_login');

        $this->load->model(array('web_auth/web_auth_model','api/account','file_model'));


        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');
        $this->lang->load('api_common','vn');

        $this->form_validation->set_error_delimiters('', '');

        // custom lang of the form validation
        $set_message = array(
            'required'=>$this->lang->line('is_required'),
            'valid_email'=>$this->lang->line('is_valid_email'),
            'matches'=>$this->lang->line('matches_field'),
            'min_length'=>$this->lang->line('min_length'),
            'is_unique'=>$this->lang->line('is_unique')
        );
        $this->form_validation->set_message($set_message);
    }
    function index($error = false){
        if(!empty($this->info_user)){
            redirect(base_url('home'));
        }
        $data = array(
            'header_title' => 'Đăng nhập',
            'js_file' => array(
                'includes/bootstrap/js/bootstrap-datepicker.js',
                //'js/jquery-validate.bootstrap-tooltip.js'
            ),
            'css_file' => array(
                'includes/bootstrap/css/bootstrap-datepicker.css'
            ),
            'js_file_module' => array(
                'web_auth/assets/js/jquery.backstretch.min.js',
                'web_auth/assets/js/jquery.bootstrap.wizard.js',
                'ad_login/assets/js/jquery.md5.js',
                'web_auth/assets/js/login.js'

            ),
            'css_file_module' => array(
                'web_home/assets/css/style.css',
                'web_auth/assets/css/style.css',
                'web_auth/assets/css/gsdk-base.css'
            ),
            'active' => 'login',
            'error' => $error
        );
        $this->load->view('templates/web/header',$data);
        $this->load->view('templates/web/container');
        $this->load->view('templates/web/menu');
        $this->load->view('login');
        $this->load->view('templates/web/footer');
    }

    function check_login(){
        if(!empty($this->info_user)){
            redirect(base_url('home'));
        }
        /*Set the form validation rules*/
        $rules = array(
            array('field'=>'username', 'label'=>'lang:username', 'rules'=>'trim|required'),
            array('field'=>'password', 'label'=>'lang:password', 'rules'=>'trim|required'),
        );
        $this->form_validation->set_rules($rules);

//        var_dump($this->input->post());

        /*Check if the form passed its validation */
        if ($this->form_validation->run() == FALSE) {
            //reload page login
            $this->index(true);
        }
        else{
            $checkLogin = $this->web_auth_model->checkLogin();
            if($checkLogin){
                redirect(base_url('home'));
            }else{
                $this->index(true);
            }
        }
    }

    function logout()
    {
        /*$this->session->sess_destroy();*/
        $this->session->unset_userdata(array('web_user_login' => $this->info_user));
        redirect(base_url('home/login'));
    }

    function register(){
        if(!empty($this->info_user)){
            redirect(base_url('home'));
        }

        $data = array(
            'header_title' => 'Đăng ký',
            'js_file' => array(
                'includes/bootstrap/js/bootstrap-datepicker.js',
                'includes/bootstrap/js/locales/bootstrap-datepicker.vi.js',
                /*'js/jquery-validate.bootstrap-tooltip.js'*/
            ),
            'css_file' => array(
                'includes/bootstrap/css/bootstrap-datepicker.css'
            ),
            'js_file_module' => array(
                'web_auth/assets/js/jquery.backstretch.min.js',
                'web_auth/assets/js/jquery.bootstrap.wizard.js',
                'web_auth/assets/js/register.js'
            ),
            'css_file_module' => array(
                'web_home/assets/css/style.css',
                'web_auth/assets/css/style.css',
                'web_auth/assets/css/gsdk-base.css'
            ),
            'active' => 'register'
        );
        $this->load->view('templates/web/header',$data);
        $this->load->view('templates/web/container');
        $this->load->view('templates/web/menu');
        $this->load->view('register_view');
        $this->load->view('templates/web/footer');
    }

    function create_account(){
        if(!empty($this->info_user)){
            redirect(base_url('home'));
        }
        /*create account--------------------------------------------------------------------------*/
        $input = $this->input->post();
        /*Set the form validation rules*/
        $rules = array(
            array('field' => 'username', 'label' => 'lang:username', 'rules' => 'required|min_length[5]|is_unique[accounts.username]|htmlspecialchars'),
            array('field' => 'password', 'label' => 'lang:password', 'rules' => 'required|htmlspecialchars'),
            array('field' => 'confirm_password', 'label' => 'lang:confirm_password', 'rules' => 'required|matches[password]|htmlspecialchars'),
            array('field' => 'email', 'label' => 'lang:email', 'rules' => 'required|valid_email|is_unique[accounts.email]|htmlspecialchars'),
            array('field' => 'full_name', 'label' => 'lang:full_name', 'rules' => 'required|htmlspecialchars'),
            array('field' => 'date_of_birth', 'label' => 'lang:date_of_birth', 'rules' => 'required|callback_date_valid|htmlspecialchars'),
            array('field' => 'gender', 'label' => 'lang:gender', 'rules' => 'required|htmlspecialchars'),
            array('field' => 'identity_card_id', 'label' => 'lang:identity_card_id', 'rules' => 'required|is_unique[accounts.identity_card_id]|htmlspecialchars'),
            array('field' => 'phone_number', 'label' => 'lang:phone_number', 'rules' => 'required|htmlspecialchars'),
            array('field' => 'blood_group_id', 'label' => 'lang:blood_group_id', 'rules' => 'required|htmlspecialchars'),
            array('field' => 'blood_group_rh_id', 'label' => 'lang:blood_group_rh_id', 'rules' => 'required|htmlspecialchars'),
            array('field' => 'avatar', 'label' => 'lang:avatar', 'rules' => 'required|htmlspecialchars'),
            array('field' => 'account_type', 'label' => 'lang:account_type', 'rules' => 'required|integer|htmlspecialchars'),
            array('field' => 'contact_phone', 'label' => 'lang:contact_phone', 'rules' => 'is_natural|htmlspecialchars'),
            array('field' => 'address', 'label' => 'lang:address', 'rules' => 'htmlspecialchars'),
            array('field' => 'contact_name', 'label' => 'lang:contact_name', 'rules' => 'htmlspecialchars')
        );

        $this->form_validation->set_rules($rules);

        /*Check if the form passed its validation */
        if ($this->form_validation->run() == FALSE) {
            $validation = array(
                'username' => $this->form_validation->error('username'),
                'password' => $this->form_validation->error('password'),
                'confirm_password' => $this->form_validation->error('confirm_password'),
                'email' => $this->form_validation->error('email'),
                'full_name' => $this->form_validation->error('full_name'),
                'date_of_birth' => $this->form_validation->error('date_of_birth'),
                'gender' => $this->form_validation->error('gender'),
                'identity_card_id' => $this->form_validation->error('identity_card_id'),
                'phone_number' => $this->form_validation->error('phone_number'),
                'blood_group_id' => $this->form_validation->error('blood_group_id'),
                'blood_group_rh_id' => $this->form_validation->error('blood_group_rh_id'),
                'avatar' => $this->form_validation->error('avatar'),
                'account_type' => $this->form_validation->error('account_type'),
                'contact_phone' => $this->form_validation->error('contact_phone')
            );

            $set_value = array(
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'confirm_password' => $this->input->post('confirm_password'),
                'email' => $this->input->post('email'),
                'full_name' => $this->input->post('full_name'),
                'date_of_birth' => $this->input->post('date_of_birth'),
                'gender' => $this->input->post('gender'),
                'identity_card_id' => $this->input->post('identity_card_id'),
                'phone_number' => $this->input->post('phone_number'),
                'blood_group_id' => $this->input->post('blood_group_id'),
                'blood_group_rh_id' => $this->input->post('blood_group_rh_id'),
                'address' => $this->input->post('ac_address'),
                'contact_name' => $this->input->post('contact_name'),
                'contact_phone' => $this->input->post('contact_phone'),
                'account_type' => $this->input->post('account_type'),
                'avatar' => $this->input->post('avatar')
            );

            //reload form
            $data = array(
                'header_title' => $this->lang->line('header_title'),
                'js_file' => array(
                    'includes/bootstrap/js/bootstrap-datepicker.js',
                    'includes/bootstrap/js/locales/bootstrap-datepicker.vi.js',
                    /*'js/jquery-validate.bootstrap-tooltip.js'*/
                ),
                'css_file' => array(
                    'includes/bootstrap/css/bootstrap-datepicker.css'
                ),
                'js_file_module' => array(
                    'web_auth/assets/js/jquery.backstretch.min.js',
                    'web_auth/assets/js/jquery.bootstrap.wizard.js',
                    'web_auth/assets/js/register.js'
                ),
                'css_file_module' => array(
                    'web_auth/assets/css/style.css',
                    'web_auth/assets/css/gsdk-base.css'
                ),
                'active' => 'register',
                'validation' => $validation,
                'set_value' => $set_value
            );
            $this->load->view('templates/web/header',$data);
            $this->load->view('templates/web/container');
            $this->load->view('templates/web/menu');
            $this->load->view('register_view');
            $this->load->view('templates/web/footer');

        } //validate success
        else {
            //call model save account data
            $file_id = $this->file_model->do_upload('accounts', TRUE);
            $dataInput = $this->input->post();

            $accountRecord = array(
                'username' => $dataInput['username'],
                'password' => md5(trim($dataInput['password'])),
                'email' => $dataInput['email'],
                'full_name' => $dataInput['full_name'],
                'date_of_birth' => $dataInput['date_of_birth'],
                'gender' => $dataInput['gender'],
                'identity_card_id' => $dataInput['identity_card_id'],
                'phone_number' => $dataInput['phone_number'],
                'blood_group_id' => $dataInput['blood_group_id'],
                'blood_group_rh_id' => $dataInput['blood_group_rh_id'],
                'avatar' => $file_id,
                'address' => !empty($dataInput['ac_address']) ? $dataInput['ac_address'] : "",
                'contact_name' => !empty($dataInput['contact_name']) ? $dataInput['contact_name'] : "",
                'contact_phone' => !empty($dataInput['contact_phone']) ? $dataInput['contact_phone'] : "",
                'account_type' => $dataInput['account_type']
            );
            //save record account
            $isInsert = $this->account->createAccount($accountRecord);

            if (!$isInsert) {
                //delete avatar
                $this->file_model->deleteFileById($file_id);
            }

            redirect(base_url('home/login'));
        }
    }
}


?>