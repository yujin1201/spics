<?php
$sub_menu = "100400";
include_once('./_common.php');
include_once('./cont_form_common.php');

$jsonInput  = json_decode(stripslashes(file_get_contents('php://input')),  true );





$cont_mda_seq = $jsonInput['cont_mda_seq'] ;
$cont_stat = $jsonInput['cont_stat'] ;

//소재등록 및 수정
function fn_inputMdaMtr($mda_mtrl, $num){
    if( $mda_mtrl['cont_mtrl_seq'.$num ] != ""  ){
        $sql_mtrl = " update  tb_cont_mtrl   
                          set   mtrl_seq  = '{$mda_mtrl['mtrl_seq'.$num ]}'  
                              , bigo  = '{$mda_mtrl['mtrl_bigo'.$num ]}' 
                              , updt_dt = now()
                              , updt_prsn ='{$member['mb_no']}' 
                      where cont_mtrl_seq  = '{$mda_mtrl['cont_mtrl_seq'.$num ]}'   ";
    }else{
        $sql_mtrl = " insert into tb_cont_mtrl 
                          set    cont_mda_seq = '{$mda_mtrl['cont_mda_seq']}'
                               , mtrl_seq  = '{$mda_mtrl['mtrl_seq'.$num ]}'  
                               , st_dt='{$mda_mtrl['st_dt']}'
                               , ed_dt='{$mda_mtrl['ed_dt']}' 
                               , bigo  = '{$mda_mtrl['mtrl_bigo'.$num ]}' 
                               , entr_dt = now()
                               , entr_prsn ='{$member['mb_no']}'  ";
    }
    sql_query($sql_mtrl);
}


//계약상품 등록
$sql_common = "  
        cont_seq ='{$jsonInput['cont_seq']}'  , 
        guarant_pos  ='{$jsonInput['guarant_pos']}',
        account_cnt  ='{$jsonInput['account_cnt']}',
        equip_cnt='{$jsonInput['equip_cnt']}',
        st_dt='{$jsonInput['st_dt']}',
        ed_dt='{$jsonInput['ed_dt']}',
        op_yn='N', 
        multi_yn ='{$jsonInput['multi_yn']}', 
        mtrl_sec ='{$jsonInput['mtrl_sec']}', 
        act_st_time  ='{$jsonInput['act_st_time']}',
        act_ed_time  ='{$jsonInput['act_ed_time']}',
        report_yn='{$jsonInput['report_yn']}',
        report_opt='{$jsonInput['report_opt']}',
        toss_dt  ='{$jsonInput['toss_dt']}', 
        mg_report_yn='{$jsonInput['mg_report_yn']}',
        mg_report='{$jsonInput['mg_report']}',
        mda_cmms_rt ='{$jsonInput['mda_cmms_rt']}', 
        mda_cmms_amt ='{$jsonInput['mda_cmms_amt']}', 
        bns_yn ='{$jsonInput['bns_yn']}', 
        bigo = '{$jsonInput['bigo']}'    ,
        entr_dt = now(),
        entr_prsn ='{$member['mb_no']}'
      ";

        $arr = $jsonInput['prod_seq']  ;
        foreach ($arr as $key => $vals) {
            $sql =" insert into tb_cont_mda 
            set  prod_seq  ='{$vals['prod_seq']}'
               , mda_comp_seq  ='{$vals['comp_seq']}'  
               , asg_use_yn = ifnull((select max(asg_use_yn) from tb_comp_mda where prod_seq = '{$vals['prod_seq']}'), 'N')  
               , {$sql_common} "  ;

            $result = sql_query($sql );
            if($result) $cont_mda_seq = sql_insert_id();

            //작성중 아닐경우 운행 등록
            $errFlag = "Y" ;
            $value = array('cont_mda_seq'=> $cont_mda_seq, 'cont_seq' => $jsonInput['cont_seq'] );
            if($cont_stat != 'BAC01'){
                $rst  = fn_inputContMdaAsn("", $cont_mda_seq) ;
                if($rst['ERRMSG'] !=  "" ){
                    $errFlag = "N" ;
                }
            }

            //소재등록
            if($errFlag == "Y"){
                $jsonInput['cont_mda_seq'] = $cont_mda_seq ;
                if($jsonInput['mtrl_seq1'] != ""  ) {
                    fn_inputMdaMtr($jsonInput, '1') ;
                }
                if($jsonInput['multi_yn'] == "Y" && $jsonInput['mtrl_seq2'] != ""  ) {
                    fn_inputMdaMtr($jsonInput, '2') ;
                }
            }
        }

    echo json_encode($value);
?>