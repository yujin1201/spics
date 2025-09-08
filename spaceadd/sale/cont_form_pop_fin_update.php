<?php
$sub_menu = "100400";
include_once('./_common.php');
$jsonInput  = json_decode(stripslashes(file_get_contents('php://input')),  true );

$fin_seq = $jsonInput['fin_seq'] ;
$sql_common = "    
        adj_yearmon  =   '{$jsonInput['adj_yearmon']}',
        sell_amt  =   '{$jsonInput['sell_amt']}',
        agnt_cmms_rt  =   '{$jsonInput['agnt_cmms_rt']}',
        cnsg_cmms_rt  =   '{$jsonInput['cnsg_cmms_rt']}',
        agnt_cmms_amt  =   '{$jsonInput['agnt_cmms_amt']}',
        cnsg_cmms_amt  =   '{$jsonInput['cnsg_cmms_amt']}',
        rep_cmms_rt  =   '{$jsonInput['rep_cmms_rt']}',
        rep_cmms_amt  =   '{$jsonInput['rep_cmms_amt']}',
        adj_yn  =   '{$jsonInput['adj_yn']}',
        adj_dt  =   '{$jsonInput['adj_dt']}', 
        bill_dt  =   '{$jsonInput['bill_dt']}',
        bill_yn  =   '{$jsonInput['bill_yn']}',
        bill_rsv  =   '{$jsonInput['bill_rsv']}',
        bill_snd  =   '{$jsonInput['bill_snd']}', 
        stl_condi_code  =   '{$jsonInput['stl_condi_code']}',
        stl_condi_cntnts  =   '{$jsonInput['stl_condi_cntnts']}',
        tret_yn  =   '{$jsonInput['tret_yn']}',
        inout_type  =   '{$jsonInput['inout_type']}',
        bigo  =   '{$jsonInput['bigo']}', 
        snd_comp_seq  = '{$jsonInput['snd_comp_seq']}',  
 "; 

//매출
   if($jsonInput['inout_type'] == "ABD01") {
       $sql_common .= "  in_amt  = 0  ,
                         send_dt  =   '{$jsonInput['send_dt']}',
                         out_dt  =   ''  ";
       if(!empty($fin_seq )  ) {
           $sql_common .= " , out_amt  =  '{$jsonInput['out_amt']}'  ";
           $sql_common .= " , rsv_comp_seq  =  '{$jsonInput['rsv_comp_seq']}'  ";
       }
   }else{
       $sql_common .= "  out_amt  =  0 , 
                         in_amt  = '{$jsonInput['in_amt']}' ,
                         send_dt  =   '',
                         out_dt  =   '{$jsonInput['out_dt']}',  
                         rsv_comp_seq  =  '{$jsonInput['rsv_comp_seq']}'  ";
   }


if(empty($fin_seq )  ||  $fin_seq  == ""  ) {
    //정산 번호
    $adj_n = substr($jsonInput['adj_yearmon'],-4)."_M_".$jsonInput['cont_seq']."_"  ;

    //정산번호
    $sql_adj = " select ifnull( max(CAST(right(adj_num, 4) AS UNSIGNED)), 0)+1  num  
                 from tb_cont_fin  
                 where adj_num  like '{$adj_n}%'    " ;
    $db_adj = sql_fetch($sql_adj);

    /*
    $sql_ck=" select count(*) cnt 
              from tb_cont_fin 
              where cont_seq  = {$jsonInput['cont_seq']}
                 and adj_yearmon =   '{$jsonInput['adj_yearmon']}'  "  ;
    $result1 = sql_fetch($sql_ck );
    if($result1['cnt'] != "0"){
    */
    if(false){
        $value = array('ERRMSG'=> '해당월은 이미 등록되어 있습니다. ', 'cont_seq' => $jsonInput['cont_seq'] );
    }else{
        if($jsonInput['inout_type'] == "ABD01") {
            $arr = $jsonInput['rsv_comp_arr']  ;
            $i = 0 ;
            foreach ($arr as $key => $vals) {
                $adj_num = $adj_n.str_pad($db_adj['num']+$i , 4 , '0', STR_PAD_LEFT) ;
                $sql =" insert into tb_cont_fin 
                        set  cont_seq  = {$jsonInput['cont_seq']}
                           , entr_dt=now()
                           , entr_prsn ='{$member['mb_no']}' 
                           , out_amt  =  {$vals['out_amt']} 
                           , {$sql_common} 
                           , adj_num = '{$adj_num}'
                           , rsv_comp_seq  =  '{$vals['comp_seq']}'
                           , adj_type_code  =   '{$jsonInput['adj_type_code']}'  
                           "   ;
                $result = sql_query($sql );
                if($result)  $last_seq_no = sql_insert_id();
                $value = array('fin_seq'=> $last_seq_no, 'cont_seq' => $jsonInput['cont_seq'] );
                $i++ ;
            }
        }else{
            $adj_num = $adj_n.str_pad($db_adj['num'] , 4 , '0', STR_PAD_LEFT) ;
            $sql =" insert into tb_cont_fin 
            set  cont_seq  = {$jsonInput['cont_seq']}
               , entr_dt=now()
               , entr_prsn ='{$member['mb_no']}' 
               , adj_num = '{$adj_num}' 
               , adj_type_code  =   '{$jsonInput['adj_type_code']}'  
               , {$sql_common} "  ;
            $result = sql_query($sql );
            if($result)  $last_seq_no = sql_insert_id();
            $value = array('fin_seq'=> $last_seq_no, 'cont_seq' => $jsonInput['cont_seq'] );
        }
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
                , adj_type_code = '{$jsonInput['adj_type_code']}'  
                , {$sql_common}  
             where fin_seq = {$fin_seq}   "  ; 
    }

    $result = sql_query($sql );
    $value = array('fin_seq'=> $fin_seq, 'cont_seq' => $jsonInput['cont_seq'] );
    echo json_encode($value);
}
?>