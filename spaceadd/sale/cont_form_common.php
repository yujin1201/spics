<?php
function fn_contInfo($cont_seq){
    $sql = "select 
                a.cont_seq,
                a.cont_nm,
                a.cont_type_code,
                a.mda_type,
                a.cont_yearmon,
                a.cont_stat,
                a.cli_seq,  
                (select comp_nm from tb_comp where comp_seq = a.cli_seq) cli_nm ,
                a.agncy_seq,
                (select comp_nm from tb_comp where comp_seq = a.agncy_seq) agncy_nm ,
                a.rep_seq,
                (select comp_nm from tb_comp where comp_seq = a.rep_seq) rep_nm ,
                a.sale_prsn,
                (select mb_name from g5_member where mb_no =  a.sale_prsn) sale_prsn_nm,
                a.cont_sale_type , 
                a.cont_st_dt,
                a.cont_ed_dt,
                a.cont_amt,
                a.bigo,
                a.brnd_nm ,
                a.campgn_nm ,
                a.deal_type_code ,
                a.entr_prsn,
                (select mb_name from g5_member where mb_no =  a.entr_prsn) entr_prsn_nm,
                a.entr_dt, 
                a.updt_prsn,
                (select mb_name from g5_member where mb_no =  a.updt_prsn) updt_prsn_nm,
                a.updt_dt
            from tb_cont a
            where cont_seq='{$cont_seq}'";
    $cont = sql_fetch($sql);
    return $cont ;
}

/**
 * 상품의 구좌 및 운행 등록
 * @param $cont_mda_seq
 * @return array
 */
function fn_inputContMdaAsn( $cont_seq, $cont_mda_seq ){
    $rst  = [] ;
    $sql_where = "" ;

   if($cont_seq != ""){
       $sql_where  =" and a.cont_seq = {$cont_seq}  " ;
   }
    if($cont_mda_seq !=""){
        $sql_where = " and a.cont_mda_seq = {$cont_mda_seq}  " ;
    }
    $sql01 =" select count(*) cnt 
             from tb_cont_mda a
             where  a.op_yn ='N'
                    {$sql_where}  " ;
    $result01 = sql_fetch($sql01 ) ;

    //운행등록 가능 상품이 있을 경우
    if($result01['cnt']  >  0 ) {

        //재원 체크 안 하는 상품 확정 처리
        $sql_op_yn = " update  tb_cont_mda a set 
                             op_yn='Y' 
                           , updt_dt = now()
                           , updt_prsn ='{$member['mb_no']}'   
                         where  a.asg_use_yn ='N' and  a.op_yn ='N' 
                                {$sql_where} ";
        $result = sql_query($sql_op_yn);


/*
            $sql0 = " select count(*) cnt 
                 from tb_cont_mda a
                 where st_dt <=  date_format(now() , '%Y%m%d') and  a.op_yn ='N' and a.asg_use_yn ='Y' 
                        {$sql_where}  ";
            $result = sql_fetch($sql0);
            if ($result['cnt'] > 0) {
                $rst = array('ERRMSG' => '운행시작일이 오늘 이전은 운행할 수 없습니다.  ', 'cont_mda_seq' => $cont_mda_seq, 'cont_seq' => $cont_seq);
                return $rst;
            }
*/

            //계약상품 구좌 등록
            $sql_asg_i = "insert into tb_cont_mda_assign
                  ( cont_mda_seq, asg_seq, st_dt, ed_dt, act_st_time, act_ed_time, entr_prsn, entr_dt ) 
                select 
                    cont_mda_seq, asg_seq, st_dt,ed_dt, act_st_time, act_ed_time, '{$member['mb_no']}' , now()
                from  (
                   select  a.* 
                       , CASE @GROUPING WHEN grp THEN @RANK := @RANK + 1 ELSE @RANK := 1 END  AS RANKING
                       , @GROUPING :=  grp
                   From ( 
                            select  
                               a.cont_mda_seq, a.cont_seq , a.mda_comp_seq , a.prod_seq, a.account_cnt, a.st_dt, a.ed_dt, a.act_st_time, a.act_ed_time 
                               , b.asg_seq , c.mda_seq  ,c.use_st_dt , c.use_ed_dt
                               , concat( cast(a.cont_mda_seq as char) , '-' ,cast(b.prod_seq as char))  grp
                            from tb_cont_mda a, tb_mda_assign b, tb_comp_mda c, tb_comp d 
                            where  a.prod_seq = b.prod_seq and b.use_yn ='Y'  
                              and b.prod_seq = c.prod_seq and b.use_yn ='Y'  and a.st_dt between c.use_st_dt and c.use_ed_dt and a.ed_dt between c.use_st_dt and c.use_ed_dt  
                              and c.comp_seq = d.comp_seq 
                              and d.comp_type ='AAC02' 
                              and d.deal_sts_code ='BAA01' 
                            /*이미 운행등록 된건 제외 */
                              and a.prod_seq > 0 
                              and not exists ( select '1' from tb_cont_mda_assign x where a.cont_mda_seq = x.cont_mda_seq )
                            /*운행체크 */   
                             and not exists  (select  '1'  From tb_opa x , tb_date y 
                                              where x.opa_dt = y.dt 
                                                  and b.asg_seq = x.asg_seq 
                                                  and y.dt between a.st_dt and a.ed_dt) 
                             /*광고주 금지업종 체크 */      
                             and not exists ( select '1' 
                                              from tb_cont x, tb_comp y,  tb_comp_excpt z 
                                              where x.cont_seq = a.cont_seq 
                                                 and x.cli_seq = y.comp_seq 
                                                 and y.excpt_div = z.item_code  
                                                 and z.use_yn='Y'
                                                 and z.del_yn='N'
                                                 and d.comp_seq  = z.comp_seq
                                              )  
                             and a.op_yn ='N'
                             and a.asg_use_yn ='Y' 
                             {$sql_where}
                            order by a.cont_mda_seq , b.prod_seq, b.asg_seq  , b.ord   
                         ) a , (SELECT @GROUPING := '', @RANK := 0) XX
                  ) b
                  where ranking  <= account_cnt  
                ";
           // echo $sql_asg_i ;
            $result = sql_query($sql_asg_i);

            /*일별 운행 등록 */
            $sql_op_i = "
                  insert into tb_opa 
                    ( opa_dt, asg_seq, mtrl_seq, cont_seq, cont_asg_seq, cli_seq, prod_seq, mda_seq, entr_prsn, entr_dt )
                   select  
                         distinct 
                         e.dt opa_dt 
                       , c.asg_seq 
                       , '' mtrl_seq 
                       , b.cont_seq
                       , x.cont_asg_seq 
                       , b.cli_seq
                       , c.prod_seq 
                       , d.mda_seq
                       , '{$member['mb_no']}' entr_prsn
                       , now() entr_dt 
                    from tb_cont_mda_assign x,  tb_cont_mda a, tb_cont b , tb_mda_assign c, tb_comp_mda d, tb_date e
                    where x.cont_mda_seq = a.cont_mda_seq
                      and a.cont_seq = b.cont_seq
                      and x.asg_seq = c.asg_seq
                      and c.prod_seq = d.prod_seq
                      and a.op_yn='N'
                      and a.asg_use_yn ='Y' 
                      and e.dt between x.st_dt and x.ed_dt
                       {$sql_where}     ";
            $result = sql_query($sql_op_i);

            /*운행확정*/
            $sql_op_yn = " update  tb_cont_mda a set 
                             op_yn='Y' 
                           , updt_dt = now()
                           , updt_prsn ='{$member['mb_no']}'   
                         where  exists ( select '1' from tb_cont_mda_assign b where a.cont_mda_seq = b.cont_mda_seq)
                                and a.op_yn ='N' 
                                and a.asg_use_yn ='Y' 
                                {$sql_where} ";
            $result = sql_query($sql_op_yn);

            $sql_ck = " select count(*) cnt 
                     from tb_cont_mda a
                     where  a.op_yn ='N' and a.asg_use_yn ='Y' 
                            {$sql_where}  ";
            $result = sql_fetch($sql_ck);
            if ($result['cnt'] > 0) {
                $rst = array('ERRMSG' => '', 'cont_mda_seq' => $cont_mda_seq, 'cont_seq' => $cont_seq);
            } else {
                $rst = array('ERRMSG' => '등록가능한 상품이 없습니다. ', 'cont_mda_seq' => $cont_mda_seq, 'cont_seq' => $cont_seq);
            }
       }else{
          $rst = array('ERRMSG' => '', 'cont_mda_seq' => $cont_mda_seq, 'cont_seq' => $cont_seq);
       }
       return $rst ;
    }

/**
 * 운행여부 체크
 * @param $cont_seq
 * @param $cont_mda_seq
 * @return mixed|string
 */
    function fn_checkMdaAsg($cont_seq, $cont_mda_seq){
        $sql_ck = "  SELECT count(*) cnt 
                        FROM tb_opa a, tb_cont_mda_assign  b, tb_cont_mda c 
                        where  a.cont_asg_seq = b.cont_asg_seq  
                           and a.opa_dt <= date_format(now() , '%Y%m%d')   
                           and b.cont_mda_seq = c.cont_mda_seq  
                           and c.op_yn='Y' 
                           and c.asg_use_yn ='Y' 
                  " ;
         if( !(empty($cont_seq )  ||  $cont_seq  == ""  )) {
             $sql_ck = $sql_ck ." and c.cont_seq = {$cont_seq}   " ;
         }
        if( !(empty($cont_mda_seq )  ||  $cont_mda_seq  == ""  )) {
            $sql_ck = $sql_ck ." and c.cont_mda_seq = {$cont_mda_seq}   " ;
        }
        $result = sql_fetch($sql_ck ) ;
        return $result['cnt'];
    }

/**
 *
 * 상품의 구좌 및 운행 삭제
 * @param $cont_seq
 * @param $cont_mda_seq
 * @return void
 */
    function fn_removeContMda($cont_seq, $cont_mda_seq){
       $cont = fn_contInfo($cont_seq) ;
       $removeAble = "Y" ;
       $rst = array('ERRMSG'=> '', 'cont_mda_seq' => $cont_mda_seq );

        //작성중 일 경우 전체 삭제 가능
       if($cont['cont_stat'] == 'BAC01'){
           $removeAble = "Y" ;

       //가확정, 확정의 경우 운행 체크
       }else if($cont['cont_stat'] == 'BAC02' || $cont['cont_stat'] == 'BAC03') {
           $result1 = fn_checkMdaAsg($cont_seq, $cont_mda_seq) ;
           if($result1  >  0 ){
               $removeAble = "N" ;
               return array('ERRMSG'=> '이미 운행중인 상품이 있습니다. 삭제할수 없습니다. ', 'cont_mda_seq' => $cont_mda_seq );
           }
       // 확정 이후 삭제 불가
       }else{
           $removeAble = "N" ;
           return  array('ERRMSG'=> '삭제할수 없는 계약 상태 입니다.', 'cont_mda_seq' => $cont_mda_seq );
       }

       if($removeAble == "Y"){
           //운행삭제
           fn_removeContMdaOp($cont_seq, $cont_mda_seq) ;
           $sql_where = "" ;
           if( !(empty($cont_mda_seq )  ||  $cont_mda_seq  == ""  )) {
               $sql_where = " where cont_mda_seq = {$cont_mda_seq}   " ;
           }else{
               $sql_where = " where cont_mda_seq in ( select cont_mda_seq from  tb_cont_mda where cont_seq  =  {$cont_seq}  )   " ;
           }

           //매체 정산 삭제
           $sql_fin_d= "delete from  tb_mda_fin  {$sql_where}   "  ;
           $result = sql_query($sql_fin_d );

           //소재삭제
           $sql_mtrl_d = " delete  from tb_cont_mtrl  {$sql_where}   "  ;
           $result = sql_query($sql_mtrl_d );

           //금지매체 삭제
           $sql_excpt_d = " delete  from tb_cont_excpt {$sql_where}   "  ;
           $result = sql_query($sql_excpt_d );
           //상품삭제
           $sql_mda = " delete  from tb_cont_mda  {$sql_where}   "  ;
           $result = sql_query($sql_mda );
       }

       return $rst ;
    }

/**
 * 운행삭제
 * @param $cont_seq
 * @param $cont_mda_seq
 * @return void
 */
    function fn_removeContMdaOp($cont_seq, $cont_mda_seq){
        $sql_where = "" ;

        if($cont_seq != ""){
            $sql_where  =" and a.cont_seq = {$cont_seq}  " ;
        }
        if($cont_mda_seq !=""){
            $sql_where = " and a.cont_mda_seq = {$cont_mda_seq}  " ;
        }

        //운행 삭제
        $sql_op_d = " delete 
             from tb_opa   
             where cont_asg_seq in ( select b.cont_asg_seq 
                                      from  tb_cont_mda a ,tb_cont_mda_assign b
                                      where a.cont_mda_seq = b.cont_mda_seq   {$sql_where }   ) "  ;
        $result = sql_query($sql_op_d );

        //계약상품 계좌
        $sql_asg_d = " delete 
                       from tb_cont_mda_assign   ";
        if( !(empty($cont_mda_seq )  ||  $cont_mda_seq  == ""  )) {
            $sql_asg_d = $sql_asg_d  ." where cont_mda_seq = {$cont_mda_seq}   " ;
        }else{
            $sql_asg_d = $sql_asg_d  ." where cont_mda_seq in ( select cont_mda_seq from  tb_cont_mda where cont_seq  =  {$cont_seq}  )   " ;
        }
       $result = sql_query($sql_asg_d );

        /*운행 미확정 처리 */
        $sql_op_yn =" update  tb_cont_mda a set 
                         op_yn='N'
                       , updt_dt = now()
                       , updt_prsn ='{$member['mb_no']}'   
                     where  a.op_yn ='Y' 
                            {$sql_where} ";
        $result = sql_query($sql_op_yn );
    }

/**
 * 매체사 광고료 등록
 * @param $cont_seq
 * @return void
 * "정산 번호 구조 변경
* 청구년월_M_계약 일련번호_000 → 등록된 계약 청구 내역에 부여
* 청구년월_S_계약 일련번호_000 → 매체사 정산 내역에 부여 (광고비 전용)
* 청구년월_B_계약 일련번호_000 → 매체사 정산 내역에 부여 (임대료 전용)"
 *
 * 계약확정 -> 매체사 정산 *
 * 청구년월    매체상품의 청구기준(운행시작일 월, 운행종료일 월)
 * 정산일    청구년월 말일
 * 정산번호    청구년월 기준으로 조합
 * 계산서 발행일    청구년월 말일
 * 입금일    공란
 * 출금일    청구년월 말일
 */
function fn_insertMadFin($cont_seq){
    $sql_i="
      insert into tb_mda_fin 
        (prod_seq , adj_type , adj_yearmon , sell_amt , adj_yn , adj_dt , adj_num , bill_dt , bill_yn , bill_rsv , send_dt , out_dt 
       , stl_condi_code , stl_condi_cntnts , tret_yn , cont_seq , cont_mda_seq, cont_amt , cont_cmms_rt , bigo ,del_yn , auto_yn ,entr_prsn , entr_dt)
        select 
             a.prod_seq
            , 'AAE02' adj_type
            , adj_yearmon
            , a.sell_amt 
            , 'N' adj_yn
            , adj_dt
            , concat( right(a.adj_yearmon, 4) 
                        , '_S_'  , a.cont_seq ,'_'
                        , LPAD(( select   ifnull( max(CAST(right(adj_num, 4) AS UNSIGNED)), 0)+ ( @rownum:=@rownum+1 )   num  
                                from tb_mda_fin e
                                where e.adj_num  like  concat(right(a.adj_yearmon, 4), '_S_'  , a.cont_seq ,'_', '%')
                                ) , 4, '0' ) )  adj_num 
            , adj_dt   bill_dt 
            , 'N' bill_yn
            , '' bill_rsv
            , '' send_dt
            , date_format(LAST_DAY(concat(adj_yearmon, '01' )) ,'%Y%m%d')  out_dt
            , a.bill_type stl_condi_code
            , '' stl_condi_cntnts
            , 'N' tret_yn
            , a.cont_seq
            , a.cont_mda_seq
            , a.cont_amt
            , null cont_cmms_rt
            , '' bigo
            , 'N' del_yn 
            , 'Y' auto_yn 
            , '{$member['mb_no']}'  entr_prsn
            , now() entr_dt   
        From ( 
            select  
                     b.prod_seq
                    , b.ad_date_type_code   
                    , left( if(b.ad_date_type_code ='AAF01',  d.cont_st_dt, d.cont_ed_dt) ,6)   adj_yearmon
                    , if(b.ad_adj_type_code ='ABB01' , 0 , b.ad_amt)   sell_amt         
                    , a.bill_type stl_condi_code
                    , d.cont_seq
                    , c.cont_mda_seq
                    , 0 cont_amt
                    , b.ad_rt cont_cmms_rt                
                    , b.ad_adj_day  
                    , a.bill_type 
                    , CASE WHEN b.ad_adj_day ='ABC99'  THEN date_format(LAST_DAY( if(b.ad_date_type_code ='AAF01',  d.cont_st_dt, d.cont_ed_dt) ) ,'%Y%m%d')
                           ELSE  (select concat(left( if(b.ad_date_type_code ='AAF01',  d.cont_st_dt, d.cont_ed_dt) ,6), bigo1) from tb_code where comm_cd =b.ad_adj_day )  
                       END  adj_dt            
             From tb_comp a, tb_comp_mda b , tb_cont_mda c, tb_cont d 
                   where a.comp_seq = b.comp_seq
                      and b.prod_seq = c.prod_seq
                      and c.cont_seq = d.cont_seq           
                      and a.del_yn ='N'
                      and b.del_yn ='N'
                      and b.use_yn ='Y'
                      and ifnull(b.ad_adj_yn , 'Y') ='Y' /*광고료 청구여부 */
                      and d.cont_seq = {$cont_seq}    
                      and not exists ( select '1' from  tb_mda_fin x where  x.cont_seq = d.cont_seq  and adj_type  = 'AAE02' and  x.del_yn='N' )          
        )  a , (SELECT @rownum:=0) TMP 
        where a.sell_amt > 0  " ;
    $result = sql_query($sql_i );
}

/**
 * 매체사 광고료  삭제
 * @param $cont_seq
 * @return void
 */
function fn_removeMadFin($cont_seq){

    $sql_d="
      update  tb_mda_fin  a  set 
       del_yn  ='Y'
      , updt_dt = now()
      , updt_prsn ='{$member['mb_no']}'       
      where cont_seq ={$cont_seq}  
        and adj_type  = 'AAE02'        
        and del_yn='N'
        /*and exists ( select '1' from tb_cont_mda x where  x.cont_seq = a.cont_seq and x.prod_seq = a.prod_seq )*/
      " ;
    $result = sql_query($sql_d);
}


// 잔디로 보내기
function jandi_post($data, $data_url){
    $data = json_encode($data);

    $headers[] = "Accept: application/vnd.tosslab.jandi-v2+json"; // 신규 API 키
    $headers[] = "Content-type: Application/json";

    $url  = "" ;
    if(empty($data_url)  ||  $data_url == ""  ) {
        $url = "https://wh.jandi.com/connect-api/webhook/28477738/059970ca084fc9e45bd045a762220cc5"; // API URL
    }else{
        $url = $data_url   ;
    }

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_VERBOSE, true);

    $response = curl_exec($curl);

    curl_close($curl);

    $response = json_decode($response, true);

    return $response;
}

?>
