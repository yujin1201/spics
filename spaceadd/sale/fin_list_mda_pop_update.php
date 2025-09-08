<?php
$sub_menu = "100400";
include_once('./_common.php');
$jsonInput  = json_decode(stripslashes(file_get_contents('php://input')),  true );

$sql_common = "  
        sell_amt='{$jsonInput['sell_amt']}',
        cont_amt='{$jsonInput['cont_amt']}' , 
        adj_yn='{$jsonInput['adj_yn']}',
        adj_dt='{$jsonInput['adj_dt']}',
        bill_dt='{$jsonInput['bill_dt']}', 
        bill_yn='{$jsonInput['bill_yn']}',
        bill_rsv='{$jsonInput['bill_rsv']}',
        bill_snd  =   '{$jsonInput['bill_snd']}',
        send_dt  =   '{$jsonInput['send_dt']}',
        out_dt  =   '{$jsonInput['out_dt']}', 
        stl_condi_code='{$jsonInput['stl_condi_code']}',
        stl_condi_cntnts='{$jsonInput['stl_condi_cntnts']}',
        tret_yn='{$jsonInput['tret_yn']}',   
        cont_cmms_rt='{$jsonInput['cont_cmms_rt']}',
        rsv_comp_seq='{$jsonInput['rsv_comp_seq']}',
        snd_comp_seq='{$jsonInput['snd_comp_seq']}',
        bigo='{$jsonInput['bigo']}' 

 ";
$mda_fin_seq = $jsonInput['mda_fin_seq'] ;
if(empty($mda_fin_seq )  ||  $mda_fin_seq  == ""  ) {

    //자사미디어
    $adj_n = substr($jsonInput['adj_yearmon'],-4)    ;
    if($jsonInput['m1'] == "53"){   /*자사매체*/
        $adj_n  .= "_D_" ;
    }else{
        $adj_n .= "_R_" ;
    }
    //정산번호
    $sql_adj = " select ifnull( max(CAST(right(adj_num, 4) AS UNSIGNED)), 0)+1  num  
                 from tb_mda_fin  
                 where adj_num  like '{$adj_n}%'  and length(adj_num) =11 and del_yn='N'  " ;
    $db_adj = sql_fetch($sql_adj);
    $adj_num = $adj_n.str_pad($db_adj['num'] , 4 , '0', STR_PAD_LEFT) ;
    $sql_common .=", adj_num = '{$adj_num}' " ;

        $sql =" insert into  tb_mda_fin 
            set  
                prod_seq='{$jsonInput['prod_seq']}',
                adj_type='{$jsonInput['adj_type']}',
                adj_yearmon='{$jsonInput['adj_yearmon']}',
                cont_seq='{$jsonInput['cont_seq']}',
                cont_mda_seq='{$jsonInput['cont_mda_seq']}'
               , entr_dt=now()
               , entr_prsn ='{$member['mb_no']}'
               , del_yn='N'
               , auto_yn='N'
               , {$sql_common} "
        ;

        $result = sql_query($sql );
        if($result)  $last_seq_no = sql_insert_id();
        $value = array('mda_fin_seq'=> $last_seq_no  );
    echo json_encode($value);
}else{
    if( $jsonInput['submissionId']  == "subDel")  {
        $sql = " delete from  tb_mda_fin  
                 where mda_fin_seq = {$mda_fin_seq}   "  ;
    }else{
        $sql = " update tb_mda_fin  
             set  updt_dt = now()
                , updt_prsn ='{$member['mb_no']}'  
                , {$sql_common}  
                , adj_yearmon='{$jsonInput['adj_yearmon']}'
             where mda_fin_seq = {$mda_fin_seq}   "  ;
    }
    $result = sql_query($sql );
    $value = array('mda_fin_seq'=> $mda_fin_seq);
    echo json_encode($value);
}
?>