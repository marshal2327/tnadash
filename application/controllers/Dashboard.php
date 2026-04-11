<?php

class Dashboard extends CI_Controller{


    public function __construct(){
        parent::__construct();

    }

    public function index(){

        // RUN DASHBOARD FIRST
        $orders = $this->Tna_model->get_tna();

        foreach($orders['orders'] as $idx => $order){
            $orders['orders'][$idx]['dd'] = [];
        }
        // echo '<pre>'; print_r($orders['buyer']);exit;

        $this->load->view('pages/dashboard', $orders);

    }

    public function getdelayDetails(){

        $pono = $_GET['pono'];

        $data = $this->Tna_model->get_tna_by_pono($pono);

        if(!empty($data)){
            echo json_encode($data);
        }else{
            echo json_encode(false);
        }

    }






}


?>