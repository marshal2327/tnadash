<?php

defined('BASEPATH') or exit('No Direct Script Access Allowed!');


class Auth extends CI_Controller{

    public function __construct(){
        parent::__construct();      

        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST , PUT, OPTIONS, DELETE');
        header('Access-Control-Allow-Headers: Content-Type, Authorization');

        $method = $this->router->fetch_method();

        if($this->session->userdata('is_login')){
            redirect('Dashboard', 'refresh');
        }


    }

    public function index(){

        $this->load->view('auth/login');

    }

}


?>