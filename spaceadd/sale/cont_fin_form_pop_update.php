<?php
$sub_menu = "100400";
include_once('./_common.php');
$jsonInput  = json_decode(stripslashes(file_get_contents('php://input')),  true );

$sql_common = "   
        adj_yearmon =   '{$jsonInput['adj_yearmon']}',
        sell_amt =  {$jsonInput['sell_amt']},
        agnt_cmms_rt  = '{$jsonInput['agnt_cmms_rt']}',
        cnsg_cmms_rt = '{$jsonInput['cnsg_cmms_rt']}',
        agnt_cmms_amt  = '{$jsonInput['agnt_cmms_amt']}',
        cnsg_cmms_amt  = '{$jsonInput['cnsg_cmms_amt']}',
        adj_yn = '{$jsonInput['adj_yn']}',
        bill_dt  =  '{$jsonInput['bill_dt']}',  
        send_dt =  '{$jsonInput['send_dt']}',
        stl_condi_code  = '{$jsonInput['stl_condi_code']}',
        stl_condi_cntnts  = '{$jsonInput['stl_condi_cntnts']}',
        bigo = '{$jsonInput['bigo']}'  ";

$fin_seq = $jsonInput['fin_seq'] ;

if(empty($fin_seq )  ||  $fin_seq  == ""  ) {
    $sql_ck=" select count(*) cnt 
              from tb_cont_fin 
              where cont_seq  = {$jsonInput['cont_seq']}
                 and adj_yearmon =   '{$jsonInput['adj_yearmon']}'  "  ;
    $result1 = sql_fetch($sql_ck );
    if($result1['cnt'] != "0"){
        $value = array('ERRMSG'=> '해당월은 이미 등록되어 있습니다. ', 'cont_seq' => $jsonInput['cont_seq'] );
    }else{
        $sql =" insert into tb_cont_fin 
            set  cont_seq  = {$jsonInput['cont_seq']}
               , entr_dt=now()
               , entr_prsn ='{$member['mb_no']}'
               , {$sql_common} "  ;
        $result = sql_query($sql );
        if($result)  $last_seq_no = sql_insert_id();
        $value = array('fin_seq'=> $last_seq_no, 'cont_seq' => $jsonInput['cont_seq'] );
    }
    echo json_encode($value);

}else{
    if( $jsonInput['submissionId']  == "subDel")  {
        $sql = " delete 
                 from tb_cont_fin   
                 where fin_seq = {$fin_seq}   "  ;
    }else{
        $sql = " update tb_cont_fin  
             set  updt_dt = now()
                , updt_prsn ='{$member['mb_no']}'  
                , {$sql_common}  
             where fin_seq = {$fin_seq}   "  ;
    }

    $result = sql_query($sql );
    $value = array('fin_seq'=> $fin_seq, 'cont_seq' => $jsonInput['cont_seq'] );
    echo json_encode($value);
}
?>