<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Web_home extends MX_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->info_user   = $this->session->userdata('web_user_login');
        if(!$this->info_user){
            redirect(base_url('home/register'));
        }
        $model = array('web_home_model','api/account','ad_account/ad_account_model','api/history');
        $this->load->models($model);

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

    public function index()
    {
        if(empty($this->info_user)){
            redirect(base_url('home'));
        }

        $data = array(
            'header_title' => 'Trang chủ',
            'js_file' => array(
                'includes/sb2/dist/js/sb-web-2.js'
            ),
            'css_file' => array(
                'includes/sb2/dist/css/sb-web-2.css'
            ),
            'js_file_module' => array(
                'web_auth/assets/js/jquery.backstretch.min.js'
            ),
            'css_file_module' => array(
                'web_auth/assets/css/style.css',
            ),
            'active' => 'login'
        );
        $this->load->view('templates/web/header',$data);
        $this->load->view('templates/web/container');
        $this->load->view('templates/web/menu');
        $this->load->view('home_view');
        $this->load->view('templates/web/footer');
    }

    public function account_info(){
        if(empty($this->info_user)){
            redirect(base_url('home'));
        }

        $account = $this->info_user;
        $data = array(
            'header_title' => 'Trang chủ',
            'breadcrumbs' => array(
                array(
                    'name' => 'Tài khoản của tôi',
                    'href' => '#',
                    'active' => false
                ),
                array(
                    'name' => 'Thông tin tài khoản',
                    'href' => '#',
                    'active' => true
                )
            ),
            'js_file' => array(
                'includes/sb2/dist/js/sb-web-2.js'
            ),
            'css_file' => array(
                'includes/sb2/dist/css/sb-web-2.css'
            ),
            'js_file_module' => array(
                'web_auth/assets/js/jquery.backstretch.min.js',
                'web_home/assets/js/common.js',
                'ad_login/assets/js/jquery.md5.js'
            ),
            'css_file_module' => array(
                'web_auth/assets/css/style.css',
                'web_home/assets/css/style.css'
            ),
            'active' => 'login',
            'account_info' => $this->account->getAccountInfoById($account['id'])
        );

        $this->load->view('templates/web/header',$data);
        $this->load->view('templates/web/container');
        $this->load->view('templates/web/menu');
        $this->load->view('account_info',$data);
        $this->load->view('templates/web/footer');
    }

    function view_history(){
        if(empty($this->info_user)){
            redirect(base_url('home'));
        }
        $account = $this->info_user;
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
        $config['base_url'] = base_url('home/account/history?search='.$search.'&');
        $config['total_rows'] = $this->history->countHistoryRecord($account['id'],$search);
        $config['per_page'] = DEFIND_ADMIN_PER_PAGE_DEFAULT;
        $config['cur_page'] =$page;
        $this->my_paging->initialize($config);
        $pagination = $this->my_paging->create_links();

        $data = array(
            'header_title' => 'Danh sách lịch sử hoạt động',
            'breadcrumbs' => array(
                array(
                    'name' => 'Hoạt động',
                    'href' => '#',
                    'active' => false
                ),
                array(
                    'name' => 'Danh sách lịch sử hoạt động',
                    'href' => '#',
                    'active' => true
                )
            ),
            'js_file' => array(
                'includes/sb2/dist/js/sb-web-2.js'
            ),
            'css_file' => array(
                'includes/sb2/dist/css/sb-web-2.css'
            ),
            'js_file_module' => array(
                'web_auth/assets/js/jquery.backstretch.min.js'
            ),
            'css_file_module' => array(
                'web_auth/assets/css/style.css',
            ),
            'active' => 'login',
            'history_list' => $this->history->historyList(DEFIND_ADMIN_PER_PAGE_DEFAULT,$page,$search,$account['id']),
            'pagination' => $pagination,
            'search' => $search,
            'page_stt' => ($page-1)*DEFIND_ADMIN_PER_PAGE_DEFAULT
        );

        $this->load->view('templates/web/header',$data);
        $this->load->view('templates/web/container');
        $this->load->view('templates/web/menu');
        $this->load->view('history',$data);
        $this->load->view('templates/web/footer');
    }

    function change_pass(){
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
            $checkPass = $this->web_home_model->changePass($account['id'],$old_pass,$new_pass);
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

    function update_account_form(){
        if(empty($this->info_user)){
            redirect(base_url('home'));
        }

        $account = $this->info_user;
        $data = array(
            'header_title' => 'Trang chủ',
            'breadcrumbs' => array(
                array(
                    'name' => 'Tài khoản của tôi',
                    'href' => '#',
                    'active' => false
                ),
                array(
                    'name' => 'Cập nhật tài khoản',
                    'href' => '#',
                    'active' => true
                )
            ),
            'js_file' => array(
                'includes/sb2/dist/js/sb-web-2.js',
                'js/jquery.cropit.js',
                'includes/bootstrap/js/bootstrap-datepicker.js',
                'includes/bootstrap/js/locales/bootstrap-datepicker.vi.js'
            ),
            'css_file' => array(
                'includes/sb2/dist/css/sb-web-2.css',
                'includes/bootstrap/css/bootstrap-datepicker.css'
            ),
            'js_file_module' => array(
                'web_auth/assets/js/jquery.backstretch.min.js',
                'web_home/assets/js/common.js',
                'ad_login/assets/js/jquery.md5.js',
                'web_home/assets/js/account.js'
            ),
            'css_file_module' => array(
                'web_auth/assets/css/style.css',
                'web_home/assets/css/style.css'
            ),
            'active' => 'login',
            'account_info' => $this->account->getAccountInfoById($account['id'])
        );

        $this->load->view('templates/web/header',$data);
        $this->load->view('templates/web/container');
        $this->load->view('templates/web/menu');
        $this->load->view('account_form_update',$data);
        $this->load->view('templates/web/footer');
    }

    function update_account(){
        /*update account--------------------------------------------------------------------------*/
        if(empty($this->info_user)){
            redirect(base_url('home'));
        }
        $account = $this->info_user;


        /*Set the form validation rules*/
        $rules = array(
            array('field' => 'email', 'label' => 'lang:email', 'rules' => 'required|valid_email|callback_check_email_unique|htmlspecialchars'),
            array('field' => 'full_name', 'label' => 'lang:full_name', 'rules' => 'required|htmlspecialchars'),
            array('field' => 'date_of_birth', 'label' => 'lang:date_of_birth', 'rules' => 'required|callback_date_valid|callback_check_current_date|htmlspecialchars'),
            array('field' => 'gender', 'label' => 'lang:gender', 'rules' => 'required|htmlspecialchars'),
            array('field' => 'identity_card_id', 'label' => 'lang:identity_card_id', 'rules' => 'required|is_natural|callback_check_card_id_unique|htmlspecialchars'),
            array('field' => 'phone_number', 'label' => 'lang:phone_number', 'rules' => 'required|is_natural|min_length[10]|htmlspecialchars'),
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
                'header_title' => 'Trang chủ',
                'breadcrumbs' => array(
                    array(
                        'name' => 'Tài khoản của tôi',
                        'href' => '#',
                        'active' => false
                    ),
                    array(
                        'name' => 'Cập nhật tài khoản',
                        'href' => '#',
                        'active' => true
                    )
                ),
                'js_file' => array(
                    'includes/sb2/dist/js/sb-web-2.js',
                    'js/jquery.cropit.js',
                    'includes/bootstrap/js/bootstrap-datepicker.js',
                    'includes/bootstrap/js/locales/bootstrap-datepicker.vi.js'
                ),
                'css_file' => array(
                    'includes/sb2/dist/css/sb-web-2.css',
                    'includes/bootstrap/css/bootstrap-datepicker.css'
                ),
                'js_file_module' => array(
                    'web_auth/assets/js/jquery.backstretch.min.js',
                    'web_home/assets/js/common.js',
                    'ad_login/assets/js/jquery.md5.js',
                    'web_home/assets/js/account.js'
                ),
                'css_file_module' => array(
                    'web_auth/assets/css/style.css',
                    'web_home/assets/css/style.css'
                ),
                'active' => 'login',
                'account_info' => $this->account->getAccountInfoById($account['id']),
                'validation' => $validation,
                'set_value' => $set_value
            );

            $this->load->view('templates/web/header',$data);
            $this->load->view('templates/web/container');
            $this->load->view('templates/web/menu');
            $this->load->view('account_form_update',$data);
            $this->load->view('templates/web/footer');

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
            $isUpdate = $this->account->createAccount($accountRecord,$account['id']);

            if (!$isUpdate) {
                //delete avatar
                $this->file_model->deleteFileById($file_id);
            }

            redirect(base_url('home/account/info'));
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
     * Check identity_card_id validate
     *
     */
    public function check_card_id_unique(){
        $account = $this->info_user;
        $cardId = $this->input->post('identity_card_id');
        $check = $this->account->checkCardIdUniqueToUpdateAccount($account['id'],$cardId);
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




}