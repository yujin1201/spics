<?php
$sub_menu = "100400";
include_once('./_common.php');
include_once('./cont_form_common.php');

$jsonInput  = json_decode(stripslashes(file_get_contents('php://input')),  true );
$sql_common = "   
        account_cnt  ='{$jsonInput['account_cnt']}',
        equip_cnt='{$jsonInput['equip_cnt']}',
        guarant_pos  ='{$jsonInput['guarant_pos']}',
        multi_yn ='{$jsonInput['multi_yn']}',
        st_dt='{$jsonInput['st_dt']}',
        ed_dt='{$jsonInput['ed_dt']}',
        act_st_time  ='{$jsonInput['act_st_time']}',
        act_ed_time  ='{$jsonInput['act_ed_time']}',
        report_opt='{$jsonInput['report_opt']}',
        toss_dt  ='{$jsonInput['toss_dt']}', 
        bigo = '{$jsonInput['bigo']}'  ";

$cont_mda_seq = $jsonInput['cont_mda_seq'] ;
$cont_stat = $jsonInput['cont_stat'] ;

if(empty($cont_mda_seq )  ||  $cont_mda_seq  == ""  ) {
    //계약상품 등록
        $sql =" insert into tb_cont_mda 
            set  cont_seq ='{$jsonInput['cont_seq']}'
               ,  mda_seq  ='{$jsonInput['mda_seq']}'
               , entr_dt = now()
               , entr_prsn ='{$member['mb_no']}'
               , {$sql_common} "  ;
        $result = sql_query($sql );
        if($result)  $cont_mda_seq = sql_insert_id();

        //금지업종 등록
       if($jsonInput['excpt_cnt']=="N") {
           for ($i = 1; $i <= 3; $i++) {
               if ( $jsonInput['comp_seq'.$i] != "") {
                   $sql1 = " insert into tb_cont_excpt 
                          set  cont_mda_seq ='{$cont_mda_seq}'
                               , comp_seq  ='{$jsonInput['comp_seq'.$i]}'
                               , entr_dt = now()
                               , entr_prsn ='{$member['mb_no']}'  ";
                   $result = sql_query($sql1);
               }
           }
       }
    //작성중 아닐경우 운행 등록
    $value = array('cont_mda_seq'=> $cont_mda_seq, 'cont_seq' => $jsonInput['cont_seq'] );
    if($cont_stat != 'BAC01'){
        $rst  = fn_inputContMdaAsn("", $cont_mda_seq) ;
        if($rst['ERRMSG'] !=  "" ){
            $sql_where = " where cont_mda_seq = {$cont_mda_seq}   " ;

            //금지매체 삭제
            $sql_excpt_d = " delete  from tb_cont_excpt {$sql_where}   "  ;
            $result = sql_query($sql_excpt_d );
            //상품삭제
            $sql_mda = " delete  from tb_cont_mda  {$sql_where}   "  ;
            $result = sql_query($sql_mda );

            $value['ERRMSG'] = $rst['ERRMSG']  ;
        }
    }
    echo json_encode($value);
}else{
    $value = array('cont_mda_seq'=> $cont_mda_seq, 'cont_seq' => $jsonInput['cont_seq'] );
    //삭제
    if( $jsonInput['submissionId']  == "subDel")  {
        $rst = fn_removeContMda($jsonInput['cont_seq'], $cont_mda_seq) ;
        if($rst['ERRMSG'] !=  "" ){
            $value['ERRMSG'] = $rst['ERRMSG']  ;
        }
    }else{
        $sql = " update tb_cont_mda  
             set  updt_dt = now()
                , updt_prsn ='{$member['mb_no']}'  
                , {$sql_common}  
             where cont_mda_seq = {$cont_mda_seq}   "  ;
        $result = sql_query($sql );
    }
    echo json_encode($value);
}
?>