<?php

$sub_menu = "100600";
include_once('./_common.php');

$jsonInput  = json_decode(file_get_contents('php://input') ,  true );

$bigo = str_replace( '\'', '"' , $jsonInput['bigo']) ;

$sql_common = " 
  bld_seq= '{$jsonInput['bld_seq']}'
 ,ins_code= '{$jsonInput['ins_code']}'
 ,ins_nm= '{$jsonInput['ins_nm']}'
 ,ins_poi= '{$jsonInput['ins_poi']}'
 ,ins_condi = '{$jsonInput['ins_condi']}'
 ,mda_type= '{$jsonInput['mda_type']}'
 ,ins_cnt= '{$jsonInput['ins_cnt']}'
 ,use_yn= '{$jsonInput['use_yn']}'
 ,use_st_dt = '{$jsonInput['use_st_dt']}'
 ,use_ed_dt = '{$jsonInput['use_ed_dt']}'
 ,comm_seq= '{$jsonInput['comm_seq']}'
 ,comm_type_cd= '{$jsonInput['comm_type_cd']}'
 ,etc1= '{$jsonInput['etc1']}'
 ,etc2= '{$jsonInput['etc2']}'
 ,etc3= '{$jsonInput['etc3']}'
 ,ins_ev1= '{$jsonInput['ins_ev1']}'
 ,ins_ev2= '{$jsonInput['ins_ev2']}'
 ,ins_ev = '{$jsonInput['ins_ev']}'
 ,ins_ad_y n= '{$jsonInput['ins_ad_yn']}'
 ,ins_div = '{$jsonInput['ins_div']}'
 ,bigo= '{$bigo}'   
";



$ins_seq = $jsonInput['ins_seq'] ;
$sql = "";
if(empty($ins_seq)  ||  $ins_seq == ""  ) {
    $sql =" insert into tb_bld_ins
            set   entr_dt=now()
             , entr_prsn ='{$member['mb_no']}' 
             , {$sql_common} "  ;

    $result = sql_query($sql );
    if($result)  $last_seq_no = sql_insert_id();
    $value = array('ins_seq'=>$last_seq_no);
}else{
    $err = "" ;
    $errFlag = ""  ;

    $sql_update =  " update tb_bld_ins  
            set  updt_dt = now()
               , updt_prsn ='{$member['mb_no']}'    " ;

    switch ( $jsonInput['submissionId'] ) {
        //수정
        case "subForm":
            $sql = $sql_update . "
                 , {$sql_common} 
                  where ins_seq = {$ins_seq}   ";
            break;
        //삭제
        case "subDel":
            $sql = $sql_update . "
                 ,  del_yn ='Y' 
                  where ins_seq = {$ins_seq}   ";
            break;
    }

    $result = sql_query($sql );
    $value = array('bld_seq'=>$ins_seq );

} 
echo json_encode($value);
?>
