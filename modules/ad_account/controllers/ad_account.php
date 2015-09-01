<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ad_account extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->info_user = $this->session->userdata('user_login');
        if(!$this->info_user){
            redirect(base_url('admin/login'));
        }

        $this->load->helper(array('form'));
        $this->load->library('form_validation');
        $this->load->model(array('ad_account/ad_account_model','api/history'));

        $this->lang->load('api_common','vn');

        $this->form_validation->set_error_delimiters('', '');

        // custom lang of the form validation
        $set_message = array(
            'required'=>$this->lang->line('is_required'),
            'valid_email'=>$this->lang->line('is_valid_email'),
            'matches'=>$this->lang->line('matches_field'),
            'min_length'=>$this->lang->line('min_length'),
            'is_unique'=>$this->lang->line('is_unique'),
            'is_natural' => $this->lang->line('is_natural')
        );
        $this->form_validation->set_message($set_message);

    }

    function accounts(){
        //paging----
        $page = 1;
        $search = "";
        if(isset($_GET['page'])){
            if(!empty($_GET['page'])&&$_GET['page']!=""&&$_GET['page']!=null&&  is_numeric($_GET['page'])){
                $page = intval($_GET['page']);
            }
        }

        if(isset($_GET['search'])){
            if(!empty($_GET['search'])&&$_GET['search']!=""){
                $search = trim($_GET['search']);
            }
        }


        $this->load->library('my_paging');
        $config['base_url'] = base_url('admin/accounts?search='.$search.'&');
        $config['total_rows'] = $this->ad_account_model->countRecord('accounts',$search);
        $config['per_page'] = DEFIND_ADMIN_PER_PAGE_DEFAULT;
        $config['cur_page'] =$page;
        $this->my_paging->initialize($config);
        $pagination = $this->my_paging->create_links();


        $data = array(
            'header_title' => $this->lang->line('config_header_title'),
            'page_header' => $this->lang->line('page_title_account'),
            'js_file_module' => array(
                'ad_account/assets/js/mod_account.js'
            ),
            'css_file_module' => array(
                'ad_account/assets/css/style.css'
            ),
            'post_type_list' => $this->ad_account_model->accountList(DEFIND_ADMIN_PER_PAGE_DEFAULT,$page,$search),
            'pagination' => $pagination,
            'search' => $search,
            'page_stt' => ($page-1)*DEFIND_ADMIN_PER_PAGE_DEFAULT
        );

        $this->load->view('templates/admin/header',$data);
        $this->load->view('templates/admin/container');
        $this->load->view('templates/admin/menu');
        $this->load->view('accounts',$data);
        $this->load->view('templates/admin/footer');
    }

    function account_history($id){
        //paging----
        $page = 1;
        $search = "";
        if(isset($_GET['page'])){
            if(!empty($_GET['page'])&&$_GET['page']!=""&&$_GET['page']!=null&&  is_numeric($_GET['page'])){
                $page = intval($_GET['page']);
            }
        }

        if(isset($_GET['search'])){
            if(!empty($_GET['search'])&&$_GET['search']!=""){
                $search = trim($_GET['search']);
            }
        }

        $this->load->library('my_paging');
        $config['base_url'] = base_url('admin/accounts/history/'.$id.'?search='.$search.'&');
        $config['total_rows'] = $this->history->countHistoryRecord($id,$search);
        $config['per_page'] = DEFIND_ADMIN_PER_PAGE_DEFAULT;
        $config['cur_page'] =$page;
        $this->my_paging->initialize($config);
        $pagination = $this->my_paging->create_links();

//        var_dump($config['total_rows'] ); die();

        $data = array(
            'header_title' => 'Danh sách lịch sử hoạt động',
            'page_header' => 'Danh sách lịch sử hoạt động',
            'js_file_module' => array(
                'ad_config/assets/js/mod_config.js'
            ),
            'css_file_module' => array(
                'ad_config/assets/css/style.css'
            ),
            'history_list' => $this->history->historyListAdmin(DEFIND_ADMIN_PER_PAGE_DEFAULT,$page,$search,$id),
            'pagination' => $pagination,
            'search' => $search,
            'page_stt' => ($page-1)*DEFIND_ADMIN_PER_PAGE_DEFAULT
        );

        $this->load->view('templates/admin/header',$data);
        $this->load->view('templates/admin/container');
        $this->load->view('templates/admin/menu');
        $this->load->view('account_history',$data);
        $this->load->view('templates/admin/footer');
    }

    function edit_account($id){
        $data = array(
            'header_title' => 'Tài khoản',
            'page_header' => 'Cập nhật tài khoản',
            'js_file' => array(
                'js/jquery.cropit.js',
                'includes/bootstrap/js/bootstrap-datepicker.js',
                'includes/bootstrap/js/locales/bootstrap-datepicker.vi.js'
            ),
            'css_file' => array(
                'includes/bootstrap/css/bootstrap-datepicker.css'
            ),
            'js_file_module' => array(
                'ad_account/assets/js/mod_account.js'
            ),
            'css_file_module' => array(
                'ad_account/assets/css/style.css'
            ),
            'account_info' => $this->account->getAccountInfoById($id)
        );

        $this->load->view('templates/admin/header',$data);
        $this->load->view('templates/admin/container');
        $this->load->view('templates/admin/menu');
        $this->load->view('account_form_update',$data);
        $this->load->view('templates/admin/footer');
    }

    function update_account(){
        $account_id = $this->input->post('id');


        /*Set the form validation rules*/
        $rules = array(
            array('field' => 'email', 'label' => 'lang:email', 'rules' => 'required|valid_email|callback_check_email_unique|htmlspecialchars'),
            array('field' => 'full_name', 'label' => 'lang:full_name', 'rules' => 'required|htmlspecialchars'),
            array('field' => 'date_of_birth', 'label' => 'lang:date_of_birth', 'rules' => 'required|callback_date_valid|callback_check_current_date|htmlspecialchars'),
            array('field' => 'gender', 'label' => 'lang:gender', 'rules' => 'required|htmlspecialchars'),
            array('field' => 'identity_card_id', 'label' => 'lang:identity_card_id', 'rules' => 'required|is_natural|htmlspecialchars'),
            array('field' => 'phone_number', 'label' => 'lang:phone_number', 'rules' => 'required|is_natural|htmlspecialchars'),
            array('field' => 'blood_group_id', 'label' => 'lang:blood_group_id', 'rules' => 'required|htmlspecialchars'),
            array('field' => 'blood_group_rh_id', 'label' => 'lang:blood_group_rh_id', 'rules' => 'required|htmlspecialchars'),
            array('field' => 'contact_phone', 'label' => 'lang:contact_phone', 'rules' => 'is_natural|htmlspecialchars'),
            array('field' => 'address', 'label' => 'lang:address', 'rules' => 'htmlspecialchars'),
            array('field' => 'contact_name', 'label' => 'lang:contact_name', 'rules' => 'htmlspecialchars')
        );

        $this->form_validation->set_rules($rules);
        /*Check if the form passed its validation */
        if ($this->form_validation->run() == FALSE) {
            $validation = array(
                'email' => $this->form_validation->error('email'),
                'full_name' => $this->form_validation->error('full_name'),
                'date_of_birth' => $this->form_validation->error('date_of_birth'),
                'gender' => $this->form_validation->error('gender'),
                'identity_card_id' => $this->form_validation->error('identity_card_id'),
                'phone_number' => $this->form_validation->error('phone_number'),
                'blood_group_id' => $this->form_validation->error('blood_group_id'),
                'blood_group_rh_id' => $this->form_validation->error('blood_group_rh_id'),
                'contact_phone' => $this->form_validation->error('contact_phone')
            );

            $set_value = array(
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
                'contact_phone' => $this->input->post('contact_phone')
            );

            $data = array(
                'header_title' => 'Tài khoản',
                'page_header' => 'Cập nhật tài khoản',
                'js_file' => array(
                    'js/jquery.cropit.js',
                    'includes/bootstrap/js/bootstrap-datepicker.js',
                    'includes/bootstrap/js/locales/bootstrap-datepicker.vi.js'
                ),
                'css_file' => array(
                    'includes/bootstrap/css/bootstrap-datepicker.css'
                ),
                'js_file_module' => array(
                    'ad_account/assets/js/mod_account.js'
                ),
                'css_file_module' => array(
                    'ad_account/assets/css/style.css'
                ),
                'account_info' => $this->account->getAccountInfoById($account_id),
                'validation' => $validation,
                'set_value' => $set_value
            );

            $this->load->view('templates/admin/header',$data);
            $this->load->view('templates/admin/container');
            $this->load->view('templates/admin/menu');
            $this->load->view('account_form_update',$data);
            $this->load->view('templates/admin/footer');

        } //validate success
        else {
            //call model save account data
            $dataInput = $this->input->post();
            $accountRecord = array(
                'email' => $dataInput['email'],
                'full_name' => $dataInput['full_name'],
                'date_of_birth' => $dataInput['date_of_birth'],
                'gender' => $dataInput['gender'],
                'identity_card_id' => $dataInput['identity_card_id'],
                'phone_number' => $dataInput['phone_number'],
                'blood_group_id' => $dataInput['blood_group_id'],
                'blood_group_rh_id' => $dataInput['blood_group_rh_id'],
                'address' => !empty($dataInput['ac_address']) ? $dataInput['ac_address'] : "",
                'contact_name' => !empty($dataInput['contact_name']) ? $dataInput['contact_name'] : "",
                'contact_phone' => !empty($dataInput['contact_phone']) ? $dataInput['contact_phone'] : ""
            );
            if(!empty($dataInput['avatar'])) {
                $file_id = $this->file_model->do_upload('accounts', TRUE);
                $accountRecord['avatar'] = $file_id;
            }
            //save record account
            $isUpdate = $this->account->createAccount($accountRecord,$account_id);

            if (!$isUpdate) {
                //delete avatar
                $this->file_model->deleteFileById($file_id);
            }

            redirect(base_url('admin/accounts'));
        }
    }

    /**
     * Check email validate
     *
     */
    public function check_email_unique(){
        $account = $this->info_user;
        $email = $this->input->post('email');
        $check = $this->account->checkEmailUniqueToUpdateAccount($account['id'],$email);
        return $check;
    }

    /**
     * Validate dd/mm/yyyy
     */
    public function date_valid($date)
    {
        $parts = explode("-", $date);
        if (count($parts) == 3) {
            if (checkdate($parts[1], $parts[0], $parts[2]))
            {
                return TRUE;
            }
        }
        $this->form_validation->set_message('date_valid', $this->lang->line('date_valid'));
        return false;
    }

    /**
     * Validate dd/mm/yyyy
     */
    public function check_current_date($date)
    {
        $date1 = new DateTime($date);
        $date2 = new DateTime(date("d-m-Y"));

        if($date1 <= $date2){
            return true;
        }
        $this->form_validation->set_message('check_current_date','Ngày sinh phải nhỏ hơn hoặc bằng ngày hiện tại' );//$this->lang->line('check_current_date'));*/
        return false;
    }


    public function delete_account(){
        $id = $this->input->post('id');
        $isDelete = $this->ad_account_model->delAccount($id);
        $message = "";
        $status = WEB_ADMIM_FAILURE;
        if(!is_array($isDelete)){
            $status = WEB_ADMIM_SUCCESS;
        }else{
            $message ='Không xóa được tài khoản '.$isDelete['full_name'];
        }

        $message ='<div class="alert alert-warning" role="alert">'.$message.'</div>';

        $result = array(
            WEB_ADMIM_STATUS => $status,
            WEB_ADMIM_RESULTS => $id,
            WEB_ADMIM_MESSAGE => $message
        );
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($result));
    }

}


?>