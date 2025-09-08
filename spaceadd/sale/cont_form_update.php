<?php
$sub_menu = "100400";
include_once('./_common.php');
include_once('./cont_form_common.php');
$jsonInput  = json_decode(file_get_contents('php://input') ,  true );
$cont_bigo = str_replace( '\'', '"' , $jsonInput['bigo']) ;

$sql_common = "  
                cont_nm  = '{$jsonInput['cont_nm']}', 
                cont_type_code  = '{$jsonInput['cont_type_code']}', 
                mda_type  = '{$jsonInput['mda_type']}', 
                cont_yearmon  = replace('{$jsonInput['cont_yearmon']}', '-','') ,  
                cli_seq  = '{$jsonInput['cli_seq']}', 
                agncy_seq  = '{$jsonInput['agncy_seq']}', 
                rep_seq  = '{$jsonInput['agncy_seq1']}', 
                sale_prsn  = '{$jsonInput['sale_prsn']}', 
                cont_st_dt  = replace('{$jsonInput['cont_st_dt']}', '-',''), 
                cont_ed_dt  = replace('{$jsonInput['cont_ed_dt']}', '-',''), 
                cont_amt  = '{$jsonInput['cont_amt']}', 
                bigo  = '{$cont_bigo}' ,
                deal_type_code  = '{$jsonInput['deal_type_code']}', 
                brnd_nm  = '{$jsonInput['brnd_nm']}'  ,
                campgn_nm  = '{$jsonInput['campgn_nm']}'   ,
                cont_sale_type  = '{$jsonInput['cont_sale_type']}'    
                ";
$cont_seq = $jsonInput['cont_seq'] ;
if(empty($cont_seq)  ||  $cont_seq == ""  ) {

    $sql =" insert into tb_cont 
            set cont_stat ='BAC01'
             , entr_dt=now()
             , entr_prsn ='{$member['mb_no']}'
             , {$sql_common} "  ;
    $result = sql_query($sql );
    if($result)  $last_seq_no = sql_insert_id();

    $value = array('cont_seq'=>$last_seq_no);
    echo json_encode($value);

}else{
    $err = "" ;
    $errFlag = ""  ;

    $sql_update = " update tb_cont  
                    set  updt_dt = now()
                       , updt_prsn ='{$member['mb_no']}'  " ;
    switch ( $jsonInput['submissionId'] ) {
        //계약정보 수정
        case "subForm":
            $sql = $sql_update ."
               , {$sql_common} 
            where cont_seq = {$cont_seq}   "  ;
            break;
        //삭제
        case "subDel":
            $sql =  " delete from tb_cont_mda_assign  where cont_mda_seq in ( select cont_mda_seq  from tb_cont_mda  cont_seq = {$cont_seq}  )  "  ;
            $result = sql_query($sql);

            $sql =  " delete from tb_cont_mda_bigo  where cont_mda_seq in ( select cont_mda_seq  from tb_cont_mda  cont_seq = {$cont_seq}  )  "  ;
            $result = sql_query($sql);

            $sql =  " delete from tb_cont_mtrl  where cont_mda_seq in ( select cont_mda_seq  from tb_cont_mda  cont_seq = {$cont_seq}  )  "  ;
            $result = sql_query($sql);

            $sql =  " delete from tb_opa  where cont_seq = {$cont_seq}   "  ;
            $result = sql_query($sql);

            $sql =  " delete from tb_mda_fin  where cont_seq = {$cont_seq}   "  ;
            $result = sql_query($sql);

            $sql =  " delete from tb_cont_mda_stop  where cont_seq = {$cont_seq}   "  ;
            $result = sql_query($sql);

            $sql =  " delete from tb_cont_mda  where cont_seq = {$cont_seq}   "  ;
            $result = sql_query($sql);

            $sql =  " delete from tb_cont_fin  where cont_seq = {$cont_seq}   "  ;
            $result = sql_query($sql);

            $sql =  " delete from tb_cont_stats  where cont_seq = {$cont_seq}   "  ;
            $result = sql_query($sql);

            $sql =  " delete from tb_cont_mdatype  where cont_seq = {$cont_seq}   "  ;
            $result = sql_query($sql);

            $sql =  " delete from tb_cont_bld  where cont_seq = {$cont_seq}   "  ;
            $result = sql_query($sql);


            $sql0= $sql_update ." where cont_seq = {$cont_seq}   "  ;
            $result = sql_query($sql0);

            $sql =  " delete from tb_cont  
                     where cont_seq = {$cont_seq}   "  ;
            break;
        //상태변경
        case "subStat":
            $pState = $jsonInput['sub_stat'] ;
            $pFlag = $jsonInput['subFlag'] ;

            switch ( $pState ) {
                case "BAC02":   //가확정
                    if($pFlag == "U"){   //가확정
                        $rst = fn_inputContMdaAsn( $cont_seq ,"")  ;
                        if($rst['ERRMSG'] != "" ){
                            $errFlag = "Y"  ;
                            $err = $rst ;
                            break ;
                        }
                        $sql = $sql_update ."
                               , cont_stat  = '{$pState}'
                                where cont_seq = {$cont_seq}  and cont_stat  = 'BAC01' "  ;
                    }else{  //가확정 취소
                        if($member['mb_level'] < 9 ) {
                            $result1 = fn_checkMdaAsg($cont_seq, "");
                            if ($result1 > 0) {
                                $err = array('ERRMSG' => '이미 운행중인 상품이 있습니다. 삭제할수 없습니다. ', 'cont_seq' => $cont_seq);
                                $errFlag = "Y";
                                break;
                            }
                        }
                        //운행삭제
                        fn_removeContMdaOp($cont_seq, "") ;

                        //계약정보 변경
                        $sql = $sql_update ."
                               , cont_stat  = 'BAC01'
                               where cont_seq = {$cont_seq}  and cont_stat  = '{$pState}' "  ;
                    }
                    break ;
                case "BAC03":   //확정
                    if($pFlag == "U"){   //확    정
                        //확정전에 재원등록
                        fn_inputContMdaAsn( $cont_seq ,"")  ;

                        $sql_c =" select count(*) cnt  from tb_cont_mda where op_yn='N'  and cont_seq = {$cont_seq}    "  ;
                        $result = sql_fetch($sql_c ) ;
                        if($result['cnt']  >  0 ){
                            $err  =  array('ERRMSG'=> '운행 불가한 상품이 있습니다. 확정 불가합니다. ', 'cont_seq' => $cont_seq );
                            $errFlag = "Y"  ;
                            break ;
                        }
                        $sql = $sql_update ."
                               , cont_stat  = '{$pState}' 
                                where cont_seq = {$cont_seq}  and ( cont_stat  = 'BAC01' or cont_stat  = 'BAC02' ) "  ;

                        //Jandi 메시지 등록
                        $data = array();
                        $data['body'] = "계약확정";
                        $data['connectColor'] = "#F3282C";
                        $data_desr = "계약 코드 : {$jsonInput['cont_seq'] }
계약명 : {$jsonInput['cont_nm']}
청약기간 :  {$jsonInput['cont_st_dt']} ~ {$jsonInput['cont_ed_dt']}
담당자 : {$jsonInput['sale_prsn_nm']} 
청약금액 : ".number_format($jsonInput['cont_amt'])."원 
매체별 금액 : {$jsonInput['media_str']} 
수정자 : {$member['mb_name']} ( {$member['mb_id']} ) " ;
                        $data['connectInfo'][] = array("title" => $jsonInput['cont_nm'] , "description" => $data_desr  );
                        $response = jandi_post($data, "");
                        //매체사 정산 등록
                        fn_insertMadFin( $cont_seq) ;
                    }else{   //확정 취소

                        //Jandi 메시지 등록
                        $data = array();
                        $data['body'] = "계약확정 취소";
                        $data['connectColor'] = "#2321FF";
                        $data_desr = "계약 코드 : {$jsonInput['cont_seq'] }
계약명 : {$jsonInput['cont_nm']}
청약기간 :  {$jsonInput['cont_st_dt']} ~ {$jsonInput['cont_ed_dt']}
담당자 : {$jsonInput['sale_prsn_nm']} 
청약금액 : ".number_format($jsonInput['cont_amt'])."원 
매체별 금액 : {$jsonInput['media_str']}
수정자 : {$member['mb_name']} ( {$member['mb_id']} ) " ;
                        $data['connectInfo'][] = array("title" => $jsonInput['cont_nm'] , "description" => $data_desr  );
                        $response = jandi_post($data, "");



                        //매체사 정산 삭제
                        fn_removeMadFin( $cont_seq) ;

                        $sql = $sql_update ."
                               , cont_stat  = 'BAC02'  
                               where cont_seq = {$cont_seq}  and cont_stat  = '{$pState}' "  ;
                    }
                    break ;
                case "BAC04":   //정산요청
                    if($pFlag == "U"){   //정산요청
                        $sql = $sql_update ."
                               , cont_stat  = '{$pState}'
                                where cont_seq = {$cont_seq}  and  cont_stat  = 'BAC03'  "  ;
                    }else{       //정산요청  취소
                        $sql = $sql_update ."
                               , cont_stat  = 'BAC03' 
                               where cont_seq = {$cont_seq}  and cont_stat  = '{$pState}' "  ;
                    }
                    break ;
                case "BAC05":   //정산완료
                    if($pFlag == "U"){   //정산완료
                        $sql = $sql_update ."
                               , cont_stat  = '{$pState}'
                                where cont_seq = {$cont_seq}  and ( cont_stat  = 'BAC03' or cont_stat  = 'BAC04' )"  ;
                    }else{       //정산완료  취소
                        $sql = $sql_update ."
                               , cont_stat  = 'BAC03' 
                               where cont_seq = {$cont_seq}  and cont_stat  = '{$pState}' "  ;
                    }
                    break ;
            }
            break;
        default:
    }

    if($errFlag  == "" ){
        $result = sql_query($sql );

        //변경 이력 저장
        $sql2= "insert into tb_cont_stats 
           (  cont_seq, entr_dt, wrk_code, cont_stat, entr_prsn )
           values
        ({$cont_seq}, now(), '{$pFlag}', '{$pState}', '{$member['mb_no']}' )  ";
        $result = sql_query($sql2 );

        $value = array('cont_seq'=>$cont_seq);
        echo json_encode($value);
    }else{
        echo json_encode($err);
    }

}
?>