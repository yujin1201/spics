<?php
include_once('./_common.php');

$date_1 = date('Ym');
$date_2 = date('Ym',strtotime('+1 month'));
$date_3 = date('Ym',strtotime('+2 month'));

$date_1 = date('Ym') ;
$date_1_last_day = date("Ymd", mktime(0, 0, 0, intval(date('m'))+1, 0, intval(date('Y')) ));
$date_2 = date('Ym',strtotime('+1 month')) ;
$date_2_last_day = date("Ymd", mktime(0, 0, 0, intval(date('m'))+2, 0, intval(date('Y')) ));
$date_3 = date('Ym',strtotime('+2 month')) ;
$date_3_last_day = date("Ymd", mktime(0, 0, 0, intval(date('m'))+3, 0, intval(date('Y')) ));

if($_GET['mda_div'] == 'AAA02'){
$sql = "
 select 
   a.*
   ,  mda_cnt_1  - account_cnt_1  as  mi_cnt_1  
   ,  mda_cnt_2  - account_cnt_2  as  mi_cnt_2  
   ,  mda_cnt_3  - account_cnt_3  as  mi_cnt_3 
 From (
        select 
               a.comp_seq
             , if(a.comp_seq = 893, b.mda_nm,  a.comp_nm  ) comp_nm
             , ifnull(max(case when exists ( select '1' 
                  from tb_date t
                  where  t.dt  between '{$date_1}01'  and  '{$date_1_last_day}' 
                      and t.dt between b.use_st_dt and b.use_ed_dt )   then b.mda_cnt   else  0 end  ),0)  mda_cnt_1
              , ifnull(sum( case when exists ( select '1' 
                  from tb_date t
                  where  t.dt  between '{$date_1}01'  and  '{$date_1_last_day}' 
                      and t.dt between f.st_dt and f.ed_dt )   then  f.account_cnt    else  0 end  ),0)   account_cnt_1
             ,  ifnull(max(case when exists ( select '1' 
                  from tb_date t
                  where  t.dt  between '{$date_2}01'  and  '{$date_2_last_day}' 
                      and t.dt between b.use_st_dt and b.use_ed_dt )   then b.mda_cnt   else  0 end  ),0)  mda_cnt_2
              , ifnull(sum( case when exists ( select '1' 
                  from tb_date t
                  where  t.dt  between '{$date_2}01'  and  '{$date_2_last_day}' 
                      and t.dt between f.st_dt and f.ed_dt )   then  f.account_cnt    else  0 end  ),0)   account_cnt_2
             ,  ifnull(max(case when exists ( select '1' 
                  from tb_date t
                  where  t.dt  between '{$date_3}01'  and  '{$date_3_last_day}' 
                      and t.dt between b.use_st_dt and b.use_ed_dt )   then b.mda_cnt   else  0 end  ),0)  mda_cnt_3
              , ifnull(sum( case when exists ( select '1' 
                  from tb_date t
                  where  t.dt  between '{$date_3}01'  and  '{$date_3_last_day}' 
                      and t.dt between f.st_dt and f.ed_dt )   then  f.account_cnt    else  0 end  ) ,0)   account_cnt_3
          from tb_comp a 
           inner join  tb_comp_mda b on a.comp_seq = b.comp_seq and ifnull(b.del_yn, 'N')  ='N' 
           inner join  vi_media d  on b.mda_seq = d.mda_seq and d.mda_own_yn='Y'
           left outer join tb_cont_mda f on b.prod_seq = f.prod_seq  and f.op_yn='Y'   and f.op_yn ='Y'
                          and exists ( select '1' 
                  from tb_date x 
                  where  x.dt  between  '{$date_1}01'  and  '{$date_3_last_day}' 
                      and x.dt between f.st_dt and f.ed_dt)  
           left outer join tb_cont g  on  f.cont_seq = g.cont_seq
          where ifnull(a.del_yn, 'N')  = 'N'   
           and ifnull(d.show_yn, 'Y')  = 'Y'   
           and b.use_yn  ='Y'
           and a.comp_type ='AAC02'
           and a.deal_sts_code ='BAA01'  
           and exists ( select '1' from tb_media x where b.mda_seq = x.mda_seq  and x.mda_div='{$_GET['mda_div']}') 
            and exists ( select '1' 
                  from tb_date t
                  where  t.dt  between  '{$date_1}01'  and  '{$date_3_last_day}' 
                      and t.dt between b.use_st_dt and b.use_ed_dt )  
   group by a.comp_seq, if(a.comp_seq = 893, b.mda_nm,  a.comp_nm  )
  ) a
" ;
}else{

    $sql = "
 select 
   a.*
   ,  mda_cnt_1  - account_cnt_1  as  mi_cnt_1  
   ,  mda_cnt_2  - account_cnt_2  as  mi_cnt_2  
   ,  mda_cnt_3  - account_cnt_3  as  mi_cnt_3 
 From (
        select 
               a.comp_seq
             , a.comp_nm  
             , ifnull(max(case when b.mda_seq = '68'  then b.mda_cnt   else  0 end  ),0)  mda_cnt_1
             , ifnull(sum( case when b.mda_seq = '68' then  f.account_cnt    else  0 end  ),0)   account_cnt_1
             , ifnull(max(case when  b.mda_seq = '69'  then b.mda_cnt   else  0 end  ),0)  mda_cnt_2
             , ifnull(sum(case when  b.mda_seq = '69' then  f.account_cnt    else  0 end  ),0)   account_cnt_2
             , ifnull(max(case when b.mda_seq = '70'  then b.mda_cnt   else  0 end  ),0)  mda_cnt_3
             , ifnull(sum( case when b.mda_seq = '70'    then  f.account_cnt    else  0 end  ) ,0)   account_cnt_3
          from tb_comp a 
           inner join  tb_comp_mda b on a.comp_seq = b.comp_seq and ifnull(b.del_yn, 'N')  ='N' 
           inner join  vi_media d  on b.mda_seq = d.mda_seq and d.mda_own_yn='Y'
           left outer join tb_cont_mda f on b.prod_seq = f.prod_seq  and f.op_yn='Y'   and f.op_yn ='Y'
                          and exists ( select '1' 
                  from tb_date x 
                  where  x.dt  between  '{$date_1}01'  and   '{$date_1_last_day}'  
                      and x.dt between f.st_dt and f.ed_dt)  
           left outer join tb_cont g  on  f.cont_seq = g.cont_seq
          where ifnull(a.del_yn, 'N')  = 'N'   
           and ifnull(d.show_yn, 'Y')  = 'Y'   
           and b.use_yn  ='Y'
           and a.comp_type ='AAC02'
           and a.deal_sts_code ='BAA01'  
           and exists ( select '1' from tb_media x where b.mda_seq = x.mda_seq  and x.mda_div='{$_GET['mda_div']}') 
            and exists ( select '1' 
                  from tb_date t
                  where  t.dt  between  '{$date_1}01'  and   '{$date_1_last_day}'  
                      and t.dt between b.use_st_dt and b.use_ed_dt )  
   group by a.comp_seq, a.comp_nm 
  ) a
" ;
}

$result = sql_query($sql); //질의.



$num2 = 1;
$rows2 = array();

while($row = sql_fetch_array($result)) {
    $rows2[] = $row;
}
$output = json_encode($rows2,JSON_UNESCAPED_UNICODE);

echo $output;
?>


