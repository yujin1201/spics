<?php

$sub_menu = "100600";
include_once('./_common.php');

$jsonInput  = json_decode(file_get_contents('php://input') ,  true );

$bigo = str_replace( '\'', '"' , $jsonInput['bigo']) ;

$sql_common = " 
  bld_seq= '{$jsonInput['bld_seq']}'
 ,ins_sec= '{$jsonInput['ins_sec']}'   
 ,st_dt = '{$jsonInput['st_dt']}'
 ,ed_dt = '{$jsonInput['ed_dt']}' 
 ,use_yn= '{$jsonInput['use_yn']}'
 ,bigo= '{$bigo}'   
";

$bld_qty_seq = $jsonInput['bld_qty_seq'] ;
$sql = "";
if(empty($bld_qty_seq)  ||  $bld_qty_seq == ""  ) {
    $sql =" insert into tb_bld_qty
            set   entr_dt=now()
             , entr_prsn ='{$member['mb_no']}' 
             , {$sql_common} "  ;

    $result = sql_query($sql );
    if($result)  $last_seq_no = sql_insert_id();
    $value = array('bld_qty_seq'=>$last_seq_no);
}else{
    $err = "" ;
    $errFlag = ""  ;

    $sql_update =  " update tb_bld_qty  
            set  updt_dt = now()
               , updt_prsn ='{$member['mb_no']}'    " ;

    switch ( $jsonInput['submissionId'] ) {
        // 수정
        case "subForm":
            $sql = $sql_update . "
                 , {$sql_common} 
                  where bld_qty_seq = {$bld_qty_seq}   ";
            break;
        //삭제
        case "subDel":
            $sql = $sql_update . "
                 ,  del_yn ='Y' 
                  where bld_qty_seq = {$bld_qty_seq}   ";
            break;
    }

    $result = sql_query($sql );
    $value = array('bld_qty_seq'=>$bld_qty_seq );

} 
echo json_encode($value);
?>
