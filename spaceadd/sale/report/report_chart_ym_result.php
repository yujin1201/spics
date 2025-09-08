<?php
include_once('../_common.php');

$jsonInput  = json_decode(stripslashes(file_get_contents('php://input')),  true );
$sql_where =  makeSearchContQuerySub($jsonInput)   ;

$sql_mda_where = ""  ;
if(isset($jsonInput['mda_type_code']) &&  $jsonInput['mda_type_code'] != '' && count($jsonInput['mda_type_code']) > 0    ) {
    $sql_mda_where = " and  mda_type_code in ( ''  "  ;
    foreach ($jsonInput['mda_type_code'] as $key => $mda_type_code) {
        $sql_mda_where .= ", '".$mda_type_code."'" ;
    }
    $sql_mda_where .= "  )  "  ;
}

if(isset($jsonInput['inout_type']) &&  $jsonInput['inout_type'] != '' &&  $jsonInput['inout_type'] != 'ABD03' ){
    $sql_where .= " and b.inout_type  = '{$jsonInput['inout_type']}'";
}
//영업(6) 이하는 본인것만 가능
if($member['mb_level'] <= 6 ) {
    $sql_where .= " and a.sale_prsn  = '".$member['mb_no'] ."'";
}
$fr_date  = $jsonInput['fr_date']   ;
$st_date = $jsonInput['to_date'] ;


$sql = "  
select  
       a.cli_seq,
       a.agncy_seq,
       a.brnd_nm,
       a.deal_type_code,
       a.sale_prsn,
       a.cont_stat,
       a.cont_type_code,
       a.cont_yearmon yearmon , 
       a.cont_sale_type,
       a.mda_type_code  , 
        c. comp_nm   ,                                 
       ifnull(comp_nm ,'') cli_nm    
      , sum(mda_amt) mda_amt 
      , sum(in_amt)  in_amt  
      , case when  a. cont_type_code in (  'BAB01' )  then  sum(mda_amt)   else  sum(mda_amt - in_amt)    end  amtTot 
       ,ifnull((select comm_cd_nm from tb_code where comm_cd = mda_type_code  and comm_type_cd ='AAB' ),'') mda_nm 
       ,ifnull((select comm_cd_nm from tb_code where comm_cd = cont_stat and comm_type_cd ='BAC'),'') cont_stat_nm 
       ,ifnull((select comm_cd_nm from tb_code where comm_cd = deal_type_code and comm_type_cd ='BAG'),'') deal_type_nm   
       ,ifnull((select comm_cd_nm from tb_code where comm_cd = cont_type_code and comm_type_cd ='BAB'),'') cont_type_code_nm   
       ,ifnull((select comp_nm from tb_comp where comp_seq = agncy_seq),'') agncy_nm   
       ,ifnull((select mb_name from g5_member where mb_no = sale_prsn),'') sale_prsn_nm    
       ,ifnull((select comm_cd_nm from tb_code where comm_cd = rep_indst_div and comm_type_cd ='CAA'),'')  rep_indst_nm
       ,ifnull((select comm_cd_nm from tb_code where comm_cd = cont_sale_type and comm_type_cd ='BAK'),'') cont_sale_type_nm                                     
from (                   
       select a.cont_seq ,
               a.cli_seq ,
               a.agncy_seq ,
               a.brnd_nm ,
               a.deal_type_code ,
               a.sale_prsn ,
               a.cont_stat ,
               a.cont_type_code ,
               a.cont_yearmon ,
               ifnull( a.cont_sale_type , 'BAK01' ) cont_sale_type ,
               b.mda_type_code ,
               b.mda_amt mda_amt , 
               0 in_amt 
          from tb_cont a 
             inner join tb_cont_mdatype b on a.cont_seq = b.cont_seq   {$sql_mda_where}
         where a.cont_yearmon between '{$fr_date}' and   '{$st_date}'     
           {$sql_where}
         union all 
         select a.cont_seq ,
               a.cli_seq ,
               a.agncy_seq ,
               a.brnd_nm ,
               a.deal_type_code ,
               a.sale_prsn ,
               a.cont_stat ,
               a.cont_type_code ,
               b.adj_yearmon cont_yearmon  ,
               ifnull( a.cont_sale_type , 'BAK01' ) cont_sale_type ,
               (select mda_type_code from tb_cont_mdatype c where a.cont_seq = c.cont_seq  and mda_amt >0 ORDER BY mda_amt  DESC LIMIT 1 )  mda_type_code ,
               0 mda_amt , 
               b.in_amt 
          from tb_cont a , tb_cont_fin b  
         where  b.adj_yearmon between '{$fr_date}' and   '{$st_date}'     
           and a.cont_seq = b.cont_seq and b.in_amt   > 0  and b.adj_type_code !='BAH03'
           {$sql_where}
         ) a  ,  tb_comp c           
where  a.cli_seq = c.comp_seq  
  {$sql_mda_where}
group by   a.cli_seq,
       a.agncy_seq,
       a.brnd_nm,
       a.deal_type_code,
       a.sale_prsn,
       a.cont_stat,
       a.cont_type_code,
       a.cont_yearmon,
       a.cont_sale_type,
       a.mda_type_code   ,
       c. comp_nm   , 
       c.rep_indst_div
"   ;

/*


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
       , yearmon 
       , cont_sale_type
       , sum( mda_amt ) amtTot         
       ,ifnull((select comm_cd_nm from tb_code where comm_cd = mda_type_code  and comm_type_cd ='AAB' ),'') mda_nm 
       ,ifnull((select comm_cd_nm from tb_code where comm_cd = cont_stat and comm_type_cd ='BAC'),'') cont_stat_nm 
       ,ifnull((select comm_cd_nm from tb_code where comm_cd = deal_type_code and comm_type_cd ='BAG'),'') deal_type_nm   
       ,ifnull((select comm_cd_nm from tb_code where comm_cd = cont_type_code and comm_type_cd ='BAB'),'') cont_type_code_nm 
       ,ifnull(comp_nm ,'') cli_nm    
       ,ifnull((select comp_nm from tb_comp where comp_seq = agncy_seq),'') agncy_nm   
       ,ifnull((select mb_name from g5_member where mb_no = sale_prsn),'') sale_prsn_nm    
       ,ifnull((select comm_cd_nm from tb_code where comm_cd = rep_indst_div and comm_type_cd ='CAA'),'')  rep_indst_nm
       ,ifnull((select comm_cd_nm from tb_code where comm_cd = cont_sale_type and comm_type_cd ='BAK'),'') cont_sale_type_nm
      from 
         ( select  
                a.cli_seq
               , a.agncy_seq
               , b.mda_type_code 
               , a.brnd_nm
               , a.deal_type_code 
               , a.sale_prsn 
               , a.cont_stat   
               , a.cont_type_code  
               , a.cont_yearmon yearmon 
               , a.cont_sale_type 
               ,  (case when  cont_type_code in ( 'BAB02' ,'BAB03' ,'BAB04' ,'BAB05' ,'BAB06' )  then  mda_amt - mda_cmms_amt
                           else  mda_amt
                           end 
                   ) mda_amt 
               , c.rep_indst_div
               , c.comp_nm   
            from tb_cont a 
         ,  (  select 
                   cont_seq 
                  , mda_type_code
                  , mda_amt 
                  , mda_cmms_amt 

              from  tb_cont_mdatype 
            )b 
         ,  tb_comp c           
       where  a.cli_seq = c.comp_seq  
          and a.cont_seq = b.cont_seq  
          and a.cont_yearmon between '{$fr_date}' and   '{$st_date}'    
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
       , yearmon
       , cont_sale_type
   "   ;*/

$result = sql_query_json($sql); //질의.
echo json_encode($result);

?>
