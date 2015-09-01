<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Web_dashboard extends MX_Controller {
    public function __construct()
    {
        parent::__construct();

    }
    public function index(){
          $data = array(
              'header_title' => 'Daskboard',
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
                  'web_dashboard/assets/css/style.css'
              )
          );
          $this->load->view('dashboard_view',$data, false);
    }
}
