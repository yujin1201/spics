<?php
include_once('./_common.php');
$sql_where =  makeSearchContQuery()   ;
if(isset($_GET['inout_type']) &&  $_GET['inout_type'] != '' &&  $_GET['inout_type'] != 'ABD03' ){
    $sql_where .= " and b.inout_type  = '{$_GET['inout_type']}'";
}
//영업(6) 이하는 본인것만 가능
if($member['mb_level'] <= 6 ) {
    $sql_where .= " and a.sale_prsn  = '".$member['mb_no'] ."'";
}


$sql = " 
  select   a.cli_seq
    , a.agncy_seq 
    , a.brnd_nm
    , a.deal_type_code
    , a.sale_prsn 
    , a.cont_stat 
    , a.cont_type_code
    ,ifnull((select comm_cd_nm from tb_code where comm_cd = a.cont_stat and comm_type_cd ='BAC'),'') cont_stat_nm 
    ,ifnull((select comm_cd_nm from tb_code where comm_cd = a.deal_type_code and comm_type_cd ='BAG'),'') deal_type_nm   
    ,ifnull((select comm_cd_nm from tb_code where comm_cd = a.cont_type_code and comm_type_cd ='BAB'),'') cont_type_code_nm 
    ,ifnull(a.comp_nm ,'') cli_nm    
    ,ifnull((select comp_nm from tb_comp where comp_seq = a.agncy_seq),'') agncy_nm   
    ,ifnull((select mb_name from g5_member where mb_no = a.sale_prsn),'') sale_prsn_nm    
    , ifnull((select comm_cd_nm from tb_code where comm_cd = a.rep_indst_div and comm_type_cd ='CAA'),'')  rep_indst_nm 
    , sum( if(yearmon_rank =1,     	sell_amt, 0 ) ) amt1
    , sum( if(yearmon_rank =2,	sell_amt, 0 ) ) amt2
    , sum( if(yearmon_rank =3,	sell_amt, 0 ) ) amt3
    , sum( if(yearmon_rank =4,	sell_amt, 0 ) ) amt4
    , sum( if(yearmon_rank =5,	sell_amt, 0 ) ) amt5
    , sum( if(yearmon_rank =6,	sell_amt, 0 ) ) amt6
    , sum( if(yearmon_rank =7,	sell_amt, 0 ) ) amt7
    , sum( if(yearmon_rank =8,	sell_amt, 0 ) ) amt8
    , sum( if(yearmon_rank =9,	sell_amt, 0 ) ) amt9
    , sum( if(yearmon_rank =10,	sell_amt, 0 ) ) amt10
    , sum( if(yearmon_rank =11,	sell_amt, 0 ) ) amt11
    , sum( if(yearmon_rank =12,	sell_amt, 0 ) ) amt12 
    , sum( sell_amt ) amtTot   
   from ( 
       select 
         a.cont_type_code 
       , a.cli_seq
       , a.agncy_seq
       , a.rep_seq 
       , a.brnd_nm
       , a.deal_type_code 
       , a.sale_prsn 
       , a.cont_stat  
       , b.inout_type     
       , ( case when '{$_GET['inout_type']}' = 'ABD03'  then   ( case when b.inout_type ='ABD01'  then b.out_amt else b.in_amt *(-1) end )  
                else ( case when b.inout_type ='ABD01'  then b.out_amt else b.in_amt end )   end  )  sell_amt 
       , c.comp_nm  
       , c.rep_indst_div
       , d.yearmon_rank
      from tb_cont a , tb_cont_fin b, tb_comp c 
        , (
               select  yearmon  
                    , @RANK := @RANK + 1   yearmon_rank
                    from  vi_yearmon  , (SELECT  @RANK := 0) X0  
                    where  yearmon  between '{$_GET['fr_date']}' and   '{$_GET['to_date']}'  
         ) d
      where  a.cli_seq = c.comp_seq  
          and a.cont_seq = b.cont_seq  
          and b.adj_yearmon = d.yearmon 
          {$sql_where }
     ) a
 group by   
     a.cli_seq
   , a.agncy_seq 
   , a.brnd_nm
   , a.deal_type_code     
   , a.sale_prsn
   , a.comp_nm  
   , a.rep_indst_div
   , a.cont_stat
   , a.cont_type_code  
 order by   
     a.cli_seq
   , a.agncy_seq 
   , a.brnd_nm
   , a.deal_type_code     
   , a.sale_prsn
   , a.comp_nm  
   , a.rep_indst_div
   , a.cont_stat
   , a.cont_type_code  
   "   ;
$result = sql_query_json($sql); //질의.
echo $result ;
?>
