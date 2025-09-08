<?php
include_once('./_common.php');
$sql_where =  makeSearchContQuery()   ;
//영업(6) 이하는 본인것만 가능
if($member['mb_level'] <= 6 ) {
    $sql_where .= " and a.sale_prsn  = '".$member['mb_no'] ."'";
}

/*
 *
① 자사미디어 : 매체별 '매출 금액' 표기

② 종합대행 : 매체별 '정산 금액 (매출 - 매입)' 표기
③ 방송대행 : 매체별 '정산 금액 (매출 - 매입)' 표기
④ 옥외대행 : 매체별 '정산 금액 (매출 - 매입)' 표기
⑤ 디지털대행 : 매체별 '정산 금액 (매출 - 매입)' 표기
⑥ 인쇄대행 : 매체별 '정산 금액 (매출 - 매입)' 표기

⑦ 제작대행 : 매체별 '매출 금액' 표기
⑧ 설치대행 : 매체별 '매출 금액' 표기
⑨ 영업수수료 매출 : 매체별 '매출 금액' 표기
⑩ 기타서비스 : 매체별 '매출 금액' 표기

BAB	계약구분
BAB01	자사미디어
BAB02	종합대행
BAB03	방송대행
BAB04	옥외대행
BAB05	디지털대행
BAB06	인쇄대행
BAB07	제작대행
BAB08	설치대행
BAB09	기타서비스
BAB10	영업대행수수료 매출
 * */

$sql = "  
 select   
          cli_seq
       , agncy_seq
       , mda_type_code 
       , brnd_nm
       , deal_type_code 
       , sale_prsn 
       , cont_stat   
       , cont_type_code  
        , sum( if(yearmon_rank =1,  mda_amt, 0 ) ) amt1
        , sum( if(yearmon_rank =2,	mda_amt, 0 ) ) amt2
        , sum( if(yearmon_rank =3,	mda_amt, 0 ) ) amt3
        , sum( if(yearmon_rank =4,	mda_amt, 0 ) ) amt4
        , sum( if(yearmon_rank =5,	mda_amt, 0 ) ) amt5
        , sum( if(yearmon_rank =6,	mda_amt, 0 ) ) amt6
        , sum( if(yearmon_rank =7,	mda_amt, 0 ) ) amt7
        , sum( if(yearmon_rank =8,	mda_amt, 0 ) ) amt8
        , sum( if(yearmon_rank =9,	mda_amt, 0 ) ) amt9
        , sum( if(yearmon_rank =10,	mda_amt, 0 ) ) amt10
        , sum( if(yearmon_rank =11,	mda_amt, 0 ) ) amt11
        , sum( if(yearmon_rank =12,	mda_amt, 0 ) ) amt12 
        , sum( mda_amt ) amtTot         
        ,ifnull((select comm_cd_nm from tb_code where comm_cd = mda_type_code  and comm_type_cd ='AAB' ),'') mda_nm 
        ,ifnull((select comm_cd_nm from tb_code where comm_cd = cont_stat and comm_type_cd ='BAC'),'') cont_stat_nm 
        ,ifnull((select comm_cd_nm from tb_code where comm_cd = deal_type_code and comm_type_cd ='BAG'),'') deal_type_nm   
        ,ifnull((select comm_cd_nm from tb_code where comm_cd = cont_type_code and comm_type_cd ='BAB'),'') cont_type_code_nm 
        ,ifnull(comp_nm ,'') cli_nm    
        ,ifnull((select comp_nm from tb_comp where comp_seq = agncy_seq),'') agncy_nm   
        ,ifnull((select mb_name from g5_member where mb_no = sale_prsn),'') sale_prsn_nm    
        , ifnull((select comm_cd_nm from tb_code where comm_cd = rep_indst_div and comm_type_cd ='CAA'),'')  rep_indst_nm            
      from 
         ( select  
                a.cli_seq
               , a.agncy_seq
               , b.mda_type_code 
               , a.brnd_nm
               , a.deal_type_code 
               , a.sale_prsn 
               , a.cont_stat   
               ,  a.cont_type_code  
               ,  (case when  cont_type_code in ( 'BAB02' ,'BAB03' ,'BAB04' ,'BAB05' ,'BAB06' )  then  mda_amt - mda_cmms_amt
                           else  mda_amt
                           end 
                   ) mda_amt 
               , c.rep_indst_div
               , c.comp_nm  
               , d.yearmon
               , d.yearmon_rank 
            from tb_cont a 
         ,  (  select 
                   cont_seq 
                  , mda_type_code
                  , mda_amt 
                  , mda_cmms_amt
              from  tb_cont_mdatype 
            )b 
         ,  tb_comp c          
         ,   (
               select  yearmon  
                    , @RANK := @RANK + 1   yearmon_rank
                    from  vi_yearmon  , (SELECT  @RANK := 0) X0  
                    where  yearmon  between '{$_GET['fr_date']}' and   '{$_GET['to_date']}'   
         ) d
       where  a.cli_seq = c.comp_seq  
          and a.cont_seq = b.cont_seq  
          and a.cont_yearmon = d.yearmon
          {$sql_where }
       ) x 
 group by    cli_seq
       , agncy_seq
       , mda_type_code 
       , brnd_nm
       , deal_type_code 
       , sale_prsn 
       , cont_stat   
       ,  cont_type_code  
       , comp_nm  
       , rep_indst_div
 order by   cli_seq
       , agncy_seq
       , mda_type_code 
       , brnd_nm
       , deal_type_code 
       , sale_prsn 
       , cont_stat   
       ,  cont_type_code  
       , comp_nm  
       , rep_indst_div   
   "  ; 

$result = sql_query_json($sql); //질의.
echo $result ;
?>
