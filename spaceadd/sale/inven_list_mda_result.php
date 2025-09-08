<?php
include_once('./_common.php');

$sql_cont = ""  ;
if(isset($_GET['cont_stat']) &&  $_GET['cont_stat'] != ''){
    if($_GET['cont_stat'] == 'BAC99' ){
        $sql_cont .= " and g.cont_stat   in  ('BAC03','BAC04','BAC05') "  ;
    }else{
        $sql_cont .= " and g.cont_stat  = '{$_GET['cont_stat']}'";
    }
}

$sql_where = ""  ;
if(isset($_GET['comp_seq']) &&  $_GET['comp_seq'] != ''){
    $sql_where .= " and a.comp_seq  = '{$_GET['comp_seq']}' ";
}
if(isset($_GET['comp_nm']) &&  $_GET['comp_nm'] != ''){
    $sql_where .= " and a.comp_nm  like  '%{$_GET['comp_nm']}%'";
}


$sql = "  

select    
   a.*
   , round((cont_asg_cnt / mda_cnt ) * 100 ) asg_per 
From (
        select 
             a.comp_seq
             , a.comp_nm 
             , d.m1
             , ifnull(d.m2, '') m2
             , ifnull(d.m3, '') m3
             , ifnull(d.m4, '') m4
             , ifnull(d.m5, '') m5
             , ifnull(d.m1_nm, '') m1_nm
             , ifnull(d.m2_nm, '') m2_nm
             , ifnull(d.m3_nm, '') m3_nm
             , ifnull(d.m4_nm, '') m4_nm
             , ifnull(d.m5_nm, '') m5_nm
             , d.full_nm 
             , b.mda_seq 
             , b.mda_nm
             , b.mda_cnt  
            , b.asg_use_yn 
            , ifnull(( select group_concat(y.comm_cd_nm) from tb_comp_excpt x, tb_code y   where a.comp_seq = x.comp_seq   and x.item_code = y.comm_cd  and y.use_yn ='Y' and x.del_yn ='N'  ), '') comp_excpt
           ,ifnull( ( 
              select  sum(account_cnt)
               from tb_cont_mda f ,  tb_cont  g  
               where  b.prod_seq = f.prod_seq  and f.op_yn='Y' and f.cont_seq = g.cont_seq and f.op_yn ='Y'
                 {$sql_cont} 
               and exists ( select '1' 
                  from tb_date x 
                  where  x.dt  between '{$_GET['fr_date']}' and '{$_GET['to_date']}' 
                      and x.dt between f.st_dt and f.ed_dt)  
           ), 0)  cont_asg_cnt
          from tb_comp a 
           inner join  tb_comp_mda b on a.comp_seq = b.comp_seq and ifnull(b.del_yn, 'N')  ='N' 
                         and exists ( select '1' 
                          from tb_date t
                          where  t.dt  between '{$_GET['fr_date']}' and '{$_GET['to_date']}' 
                              and t.dt between b.use_st_dt and b.use_ed_dt)  
           inner join  vi_media d  on b.mda_seq = d.mda_seq and d.mda_own_yn='Y'
          where ifnull(a.del_yn, 'N')  = 'N'   
           and b.use_yn  ='Y'
           and a.comp_type ='AAC02'
           and a.deal_sts_code ='BAA01'  
           and ifnull(d.show_yn, 'Y')  ='Y'
           and exists ( select '1' from tb_media x where b.mda_seq = x.mda_seq  and x.mda_div='AAA01')  
           {$sql_where}  
   ) a
    order by  mda_seq  , comp_nm  
 ";


$result = sql_query_json($sql); //질의.
echo $result ;
?>
