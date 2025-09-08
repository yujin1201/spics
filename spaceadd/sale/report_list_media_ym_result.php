<?php
include_once('./_common.php');
$sql_where =  makeSearchContQuery()   ;
//팀장7 이하는 본인것만 가능
if($member['mb_level'] <= 6 ) {
    $sql_where .= " and a.sale_prsn  = '".$member['mb_no'] ."'";
}


$sql = "  
 select   a.cli_seq
       , a.agncy_seq
       , b.mda_type_code 
       , a.brnd_nm
       , a.deal_type_code 
       , a.sale_prsn 
       , a.cont_stat   
       ,  a.cont_type_code  
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
        , sum( b.mda_amt ) amtTot         
        ,ifnull((select comm_cd_nm from tb_code where comm_cd = b.mda_type_code  and comm_type_cd ='AAB' ),'') mda_nm 
        ,ifnull((select comm_cd_nm from tb_code where comm_cd = a.cont_stat and comm_type_cd ='BAC'),'') cont_stat_nm 
        ,ifnull((select comm_cd_nm from tb_code where comm_cd = a.deal_type_code and comm_type_cd ='BAG'),'') deal_type_nm   
        ,ifnull((select comm_cd_nm from tb_code where comm_cd = a.cont_type_code and comm_type_cd ='BAB'),'') cont_type_code_nm 
        ,ifnull(c.comp_nm ,'') cli_nm    
        ,ifnull((select comp_nm from tb_comp where comp_seq = a.agncy_seq),'') agncy_nm   
        ,ifnull((select mb_name from g5_member where mb_no = a.sale_prsn),'') sale_prsn_nm    
        , ifnull((select comm_cd_nm from tb_code where comm_cd = c.rep_indst_div and comm_type_cd ='CAA'),'')  rep_indst_nm            
      from tb_cont a 
         ,  (  select 
                   cont_seq 
                  , mda_type_code
                  , ifnull( if( {$_GET['amt_flag']} = 1 , mda_amt  , mda_cmms_amt ) ,0)  mda_amt
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
 group by    a.cli_seq
       , a.agncy_seq
       , b.mda_type_code 
       , a.brnd_nm
       , a.deal_type_code 
       , a.sale_prsn 
       , a.cont_stat   
       ,  a.cont_type_code  
       , c.comp_nm  
       , c.rep_indst_div
 order by   a.cli_seq
       , a.agncy_seq
       , b.mda_type_code 
       , a.brnd_nm
       , a.deal_type_code 
       , a.sale_prsn 
       , a.cont_stat   
       ,  a.cont_type_code  
       , c.comp_nm  
       , c.rep_indst_div       
   "   ;

$result = sql_query_json($sql); //질의.
echo $result ;
?>
