<?php 

class Tna_model extends CI_Model{

    public function __construct(){
        parent::__construct(); 

    }

    public function get_tna(){

        $data['orders'] = $this->db->query("select pono,buyername, season, nvl(merch, 'No Name')merch, ordqty qty, shipdt,
                                CASE
                                    WHEN MAX(CASE WHEN ACTEDDT > REVPLANED AND COMPPER > 0 THEN 1 ELSE 0 END) = 1
                                    THEN 'delayed'
                                    WHEN MAX(CASE WHEN ACTEDDT <= REVPLANED AND COMPPER > 0 THEN 1 ELSE 0 END) = 1
                                    THEN 'ontime'
                                    WHEN MAX(CASE WHEN COMPPER = 0 THEN 1 ELSE 0 END) = 1
                                    THEN 'running'
                                    ELSE 'starting'
                                END AS status,
                                avg( CASE WHEN compper > 100 then 100 else nvl(compper,0) end)progress,
                                companyid
                                 from tb_tna_dashboard t1   
                                group by pono, buyername, season, merch, ordqty, shipdt,companyid")->result_array();   

        $data['seasons'] = $this->db->query("select distinct season from tb_tna_dashboard order by season")->result_array();
        $data['buyers'] = $this->db->query("select distinct buyername from tb_tna_dashboard order by buyername")->result_array();
        $data['company'] = $this->db->query("select distinct companyid from tb_tna_dashboard order by companyid")->result_array();


        // echo '<pre>'; print_r($data['buyer']);exit;
        return $data;

    }

    public function get_tna_by_pono($pono){

        $data = $this->db->query("select companyid, buyername, pono, season, ordqty, merch, sno, proname,shipdt, revplaned, acteddt , 
                                  case when compper > 100 then 100 else compper end compper, case when compper > 0 then 1 else 0 end as prostatus,
                                  case 
                                      when sum(case when compper > 0 then 1 else 0 end)
                                           over (partition by pono) > 0
                                          then 
                                              case when acteddt > revplaned then 'Delayed'
                                                   when acteddt <= revplaned then 'On Time' else 'Running'  end
                                          else 'Starting' end as status, nvl((acteddt-revplaned),0) deldays from tb_tna_dashboard
                                  where pono = '".$pono."'
                                  order by sno")->result_array();


        // echo '<pre>'; print_r($data);exit;
        return $data;
                                
    
    

    }






}

?>