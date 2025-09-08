<?php
include_once('./_common.php');

//조회시 생성(임대료)
/*
$sql_i = " 
      insert into tb_mda_fin 
        (prod_seq , adj_type , adj_yearmon , sell_amt , adj_yn , adj_dt , adj_num , bill_dt , bill_yn , bill_rsv , send_dt 
       , stl_condi_code , stl_condi_cntnts , tret_yn ,   bigo , del_yn , auto_yn , entr_prsn , entr_dt) 
      select   
          b.prod_seq
        , 'AAE01' adj_type
        , c.yearmon adj_yearmon
        , b.rent_amt sell_amt   
        , 'N' adj_yn
        , CASE WHEN b.rent_adj_day ='ABC99'  THEN date_format(LAST_DAY(concat(c.yearmon, '01')) ,'%Y%m%d')
                ELSE  (select concat(c.yearmon, bigo1) from tb_code where comm_cd =b.rent_adj_day )  
          END adj_dt 
        , concat( right(c.yearmon, 4) 
                 , '_B_'  
                 ,LPAD(( select   ifnull( max(CAST(right(adj_num, 4) AS UNSIGNED)), 0)+ ( @rownum:=@rownum+1 )   num  
                    from tb_mda_fin e
                    where e.adj_num  like  concat(right(c.yearmon, 4), '_B_', '%')
                 ) , 4, '0' ) )  adj_num
        , CASE WHEN b.rent_adj_day ='ABC99'  THEN date_format(LAST_DAY(concat(c.yearmon, '01')) ,'%Y%m%d')
                ELSE  (select concat(c.yearmon, bigo1) from tb_code where comm_cd =b.rent_adj_day )  
           END  bill_dt 
        , 'N' bill_yn
        , '' bill_rsv
        , '' send_dt
        , a.bill_type stl_condi_code
        , '' stl_condi_cntnts
        , 'N' tret_yn 
        , (select comm_cd_nm from tb_code where comm_cd = b.rent_adj_type_code) bigo
        , 'N' del_yn
        , 'Y' auto_yn
        , '{$member['mb_no']}'  entr_prsn
        , now() entr_dt    
       From tb_comp a, tb_comp_mda b , vi_yearmon c  , (SELECT @rownum:=0) TMP 
       where a.comp_seq = b.comp_seq
          and a.del_yn ='N'
          and b.del_yn ='N'
          and b.use_yn ='Y'   
          and ifnull(b.rent_adj_yn , 'Y') ='Y'
          and c.yearmon  between '{$_GET['fr_date']}'  and '{$_GET['to_date']}'
          and c.yearmon between substr(b.use_st_dt, 0, 6) and substr(b.use_ed_dt, 0, 6)  
          and ( case when b.rent_adj_type_code ='ABA01' Then 'Y'  
                when (b.rent_adj_type_code ='ABA02' and mod(cast(c.yearmon as unsigned), 3) = 0 )  Then 'Y' 
                when (b.rent_adj_type_code ='ABA03' and mod(cast(c.yearmon as unsigned), 6) = 0 )   Then 'Y' 
                when (b.rent_adj_type_code ='ABA04' and mod(cast(c.yearmon as unsigned), 12) = 0 )   Then 'Y'  
                else 'N'  end ) ='Y'
          and not exists ( select '1' from  tb_mda_fin x where  x.prod_seq = b.prod_seq  and x.adj_type  = 'AAE01' and x.adj_yearmon = c.yearmon and x.auto_yn ='Y' ) 
      "  ;
sql_query($sql_i );
*/

$sql = " 
   select  
          a.comp_seq
        , a.comp_nm
        , a.fin_nm  
        , a.fin_no  
        , a.fin_email  
        , a.busi_nm
        , a.busi_no
        , b.mda_seq
        , b.mda_nm
        , b.mda_cnt
        , b.use_yn
        , b.use_st_dt
        , b.use_ed_dt
        , b.use_st_time
        , b.use_ed_time
        , b.rent_adj_type_code
        , b.rent_adj_day
        , b.rent_amt
        , b.ad_adj_type_code
        , b.ad_adj_day
        , b.ad_amt
        , b.ad_rt 
        , b.del_yn
        , b.asg_use_yn
        , b.mda_position
        , c.mda_fin_seq
        , c.prod_seq
        , c.adj_type
        , ifnull((select comm_cd_nm from tb_code where comm_cd = c.adj_type),'')  adj_type_nm
        , c.adj_yearmon
        , c.sell_amt
        , c.adj_yn
        , c.adj_dt
        , c.adj_num
        , c.bill_dt
        , c.bill_yn
        , c.bill_rsv
        , c.bill_snd  
        , c.send_dt
        , c.out_dt
        , c.stl_condi_code
        , ifnull((select comm_cd_nm from tb_code where comm_cd = c.stl_condi_code and comm_type_cd ='BAD'),'')  stl_condi_nm
        , c.stl_condi_cntnts
        , c.tret_yn
        , ifnull(c.cont_seq,'')  cont_seq
        , ifnull(c.cont_amt,'')  cont_amt
        , ifnull(c.cont_cmms_rt,'')  cont_cmms_rt
        , ifnull(c.bigo ,'')  bigo
        , ifnull((select mb_name from g5_member where mb_no = ifnull(nullif(c.updt_prsn,''), c.entr_prsn)),'')  entr_prsn_nm 
        , date_format(ifnull(c.updt_dt, c.entr_dt), '%Y-%m-%d %H:%i' ) entr_dt
        , ifnull(d.cont_nm,'') cont_nm
        , ifnull(d.cli_seq,'') cli_seq
        , ifnull((select comp_nm from tb_comp where comp_seq = d.cli_seq),'')  cli_nm 
        ,ifnull(d.agncy_seq,'') agncy_seq
        ,ifnull((select comp_nm from tb_comp where comp_seq = d.agncy_seq),'')  agncy_nm 
        ,ifnull(d.rep_seq,'') rep_seq
        ,ifnull((select comp_nm from tb_comp where comp_seq = d.rep_seq),'')  rep_nm 
        ,ifnull(d.sale_prsn,'') sale_prsn
        ,ifnull((select mb_name from g5_member where mb_no = d.sale_prsn),'')  sale_prsn_nm  
       , e.m1_nm
       , d.cont_yearmon
       , d.cont_st_dt
       , d.cont_ed_dt    
       , c.rsv_comp_seq 
       , g.comp_nm  rsv_comp_nm     
       , g.busi_no rsv_busi_no 
       , g.busi_nm  rsv_busi_nm 
       , c.snd_comp_seq
       , f.comp_nm  snd_comp_nm 
       , f.busi_no snd_busi_no 
       , f.busi_nm  snd_busi_nm 
    From tb_comp a, tb_comp_mda b , vi_media e, tb_mda_fin c
      left outer join tb_cont d on c.cont_seq = d.cont_seq  and d.cont_stat not in ('BAC01','BAC02') 
      left outer join tb_comp g  on g.comp_seq = c.rsv_comp_seq 
      left outer join tb_comp f  on f.comp_seq = c.snd_comp_seq     
    where a.comp_seq = b.comp_seq
      and b.prod_seq = c.prod_seq   
      and b.mda_seq = e.mda_seq
      and c.del_yn ='N'
      and b.del_yn='N'
      and (c.cont_seq = 0 or d.cont_seq is not null ) 
    ";

if(isset($_GET['fr_date']) &&  $_GET['fr_date'] != ''){
    $sql .= " and c.adj_yearmon  between '{$_GET['fr_date']}'  and '{$_GET['to_date']}'  ";
}
if(isset($_GET['sch_name']) &&  $_GET['sch_name'] != ''){
    $sql .= " and a.comp_nm  like  '%{$_GET['sch_name']}%'  ";
}
$sql .= " order by c.adj_yearmon desc,  ifnull(c.updt_dt, c.entr_dt) desc ";


$result = sql_query_json($sql); //질의.
echo $result ;
?>


