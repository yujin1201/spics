<?php
$sub_menu = "100400";
include_once('./_common.php');

$jsonInput  = json_decode(stripslashes(file_get_contents('php://input')),  true );
$cont_seq = "" ;
$stop_date = $jsonInput['stop_date']  ;
$arr = $jsonInput['mdaList']  ;
foreach ($arr as $key => $vals) {

    $cont_seq = $vals['cont_seq'] ;
    //중지등록
    $sql_i = " insert into tb_cont_mda_stop 
            set   
            cont_mda_seq  ='{$vals['cont_mda_seq']}',
            cont_seq='{$vals['cont_seq']}',
            mda_comp_seq  ='{$vals['mda_comp_seq']}',
            stop_dt ='{$stop_date }', 
            ed_dt='{$vals['ed_dt']}', 
            entr_dt = now() ,
            entr_prsn ='{$member['mb_no']}' ";
    $result = sql_query($sql_i);

    //  운행삭제
    $sql = "delete
          FROM tb_opa 
          where opa_dt >= '{$stop_date }'
              and  cont_asg_seq in  ( select cont_asg_seq
                           from   tb_cont_mda_assign b  
                           where  b.cont_mda_seq = {$vals['cont_mda_seq']} ) ";
    sql_query($sql );

    //구좌 update
    $sql0 = "update tb_cont_mda_assign set 
                  ed_dt = date_format(DATE_ADD(STR_TO_DATE('{$stop_date}', '%Y%m%d') ,  INTERVAL -1 DAY),'%Y%m%d')  
                , updt_dt = now()
                , updt_prsn ='{$member['mb_no']}'  
           where cont_mda_seq  ={$vals['cont_mda_seq']}
               and ed_dt >= '{$stop_date }' ";
    sql_query($sql0 );

    //상품 update
    $sql1 = "update tb_cont_mda  set 
               ed_dt = date_format(DATE_ADD(STR_TO_DATE('{$stop_date}', '%Y%m%d') ,  INTERVAL -1 DAY),'%Y%m%d')
             , updt_dt = now()
             , updt_prsn ='{$member['mb_no']}'  
           where cont_mda_seq  ={$vals['cont_mda_seq']}
               and ed_dt >= '{$stop_date }' ";
    sql_query($sql1 );

    //중지일이 시작일보다 작으면 삭제
    if($stop_date <= $vals['st_dt']) {
        $sql_d= "delete from  tb_cont_mda_assign   
                 where cont_mda_seq  ={$vals['cont_mda_seq']} ";
        sql_query($sql_d );

        $sql_d1= "delete from  tb_cont_mda   
                 where cont_mda_seq  ={$vals['cont_mda_seq']} ";
        sql_query($sql_d1 );
    }
}

$value = array('cont_seq'=>$cont_seq);
echo json_encode($value);
?>