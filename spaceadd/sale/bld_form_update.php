<?php

$sub_menu = "100600";
include_once('./_common.php');

$jsonInput  = json_decode(file_get_contents('php://input') ,  true );

$bigo = str_replace( '\'', '"' , $jsonInput['bigo']) ;

$sql_common = "
 bld_num  = '{$jsonInput['bld_num']}'
, bld_nm  = '{$jsonInput['bld_nm']}'
, zipcode  = '{$jsonInput['zipcode']}'
, addr1  = '{$jsonInput['addr1']}'
, addr2  = '{$jsonInput['addr2']}'
, addr3  = '{$jsonInput['addr3']}'
, bld_type  = '{$jsonInput['bld_type']}'
, bld_level  = '{$jsonInput['bld_level']}'
, bld_floor  = '{$jsonInput['bld_floor']}'
, bld_ev1  = '{$jsonInput['bld_ev1']}'
, bld_ev2  = '{$jsonInput['bld_ev2']}'
, area1  = '{$jsonInput['area1']}'
, area2  = '{$jsonInput['area2']}'
, bld_pkg  = '{$jsonInput['bld_pkg']}' 
, ds_type  = '{$jsonInput['ds_type']}'
, ds_ev1  = '{$jsonInput['ds_ev1']}'
, ds_ev2  = '{$jsonInput['ds_ev2']}'
, ds_ev3  = '{$jsonInput['ds_ev3']}'
, ds_ev4  = '{$jsonInput['ds_ev4']}'
, disable_cnt  = '{$jsonInput['disable_cnt']}'
, ins_cnt  = '{$jsonInput['ins_cnt']}' 
, ins_sec  = '{$jsonInput['ins_sec']}'
, use_st_dt  = '{$jsonInput['use_st_dt']}'
, use_ed_dt  = '{$jsonInput['use_ed_dt']}'
, excpt_item  = '{$jsonInput['excpt_item']}'
, use_yn  = '{$jsonInput['use_yn']}' 
, bld_mda_type  = '{$jsonInput['bld_mda_type']}' 
, bigo  = '{$bigo}'   
";



$bld_seq = $jsonInput['bld_seq'] ;
$sql = "";
if(empty($bld_seq)  ||  $bld_seq == ""  ) {
    $sql =" insert into tb_bld
            set   entr_dt=now()
             , entr_prsn ='{$member['mb_no']}' 
             , {$sql_common} "  ;

    $result = sql_query($sql );
    if($result)  $last_seq_no = sql_insert_id();
    $value = array('bld_seq'=>$last_seq_no);
}else{
    $err = "" ;
    $errFlag = ""  ;

    $sql_update =  " update tb_bld  
            set  updt_dt = now()
               , updt_prsn ='{$member['mb_no']}'    " ;

    switch ( $jsonInput['submissionId'] ) {
        //수정
        case "subForm":
            $sql = $sql_update . "
                 , {$sql_common} 
                  where bld_seq = {$bld_seq}   ";
            break;
        //삭제
        case "subDel":
            $sql = $sql_update . "
                 ,  del_yn ='Y' 
                  where bld_seq = {$bld_seq}   ";
            break;
    }

    $result = sql_query($sql );
    $value = array('bld_seq'=>$bld_seq );

} 
echo json_encode($value);
?>
