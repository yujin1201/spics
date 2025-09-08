<?php
$sub_menu = "100400";
include_once('./_common.php');

$jsonInput  = json_decode(stripslashes(file_get_contents('php://input')),  true );
$cont_seq = "" ;
$arr = $jsonInput['mdaList']  ;

foreach ($arr as $key => $vals) {

    //  운행삭제
    $sql = "delete
          FROM tb_opa 
          where cont_asg_seq in  ( select cont_asg_seq
                           from   tb_cont_mda_assign b  
                           where  b.cont_mda_seq = {$vals['cont_mda_seq']} ) ";
    sql_query($sql );

    //구좌 삭제
    $sql_d3= "delete from  tb_cont_mda_assign   
             where cont_mda_seq  ={$vals['cont_mda_seq']} ";
    sql_query($sql_d3 );

    //비고 삭제
    $sql_d0= "delete from  tb_cont_mda_bigo   
             where cont_mda_seq  ={$vals['cont_mda_seq']} ";
    sql_query($sql_d0);

    //소재 삭제
    $sql_d1= "delete from  tb_cont_mtrl   
             where cont_mda_seq  ={$vals['cont_mda_seq']} ";
    sql_query($sql_d1);

    //중지 삭제
    $sql_d2= "delete from  tb_cont_mda_stop   
             where cont_mda_seq  ={$vals['cont_mda_seq']} ";
    sql_query($sql_d2);

    //매체 정산 삭제
    $sql_d4= "delete from  tb_mda_fin   
             where cont_mda_seq  ={$vals['cont_mda_seq']} ";
    sql_query($sql_d4 );

    //상품 삭제
    $sql_d5= "delete from  tb_cont_mda   
             where cont_mda_seq  ={$vals['cont_mda_seq']} ";
    sql_query($sql_d5);
}

$value = array('cont_seq'=>'');
echo json_encode($value);
?>