<?php
include_once('./_common.php');
$sql_where = ""  ;
$sql_where1 = ""  ;
if(isset($_GET['cont_stat']) &&  $_GET['cont_stat'] != ''){
    $sql_where .= " and t.cont_stat  = '{$_GET['cont_stat']}'";
    $sql_where1 .= " and x1.cont_stat  = '{$_GET['cont_stat']}'";
}
$sql = "
    select 
        if(flag ='01',   ifnull( b.comm_cd_nm,  '합계 ' )  , '')   mda_type_nm
       ,(case when flag = '01'  then  '매출'  when flag = '02' then '매출원가'  when flag = '03'  then  '매출이익'  when flag = '04' then '(%)'  end ) flag_nm
       , ifnull(b.ord, 9999) ord
       , a.*
  From   (
        select
              mda_type_code,  flag
            , sum( if(yearmon_rank =1,    (case when flag = '01'  then  amt01   when flag = '02' then amt02  when flag = '03'  then  amt03  when flag = '04' then  amt04  end )  , 0) )  amt1
           , sum( if(yearmon_rank =2,     (case when flag = '01'  then  amt01   when flag = '02' then amt02  when flag = '03'  then  amt03  when flag = '04' then amt04  end )  , 0) )  amt2
            , sum( if(yearmon_rank =3,	  (case when flag = '01'  then  amt01   when flag = '02' then amt02  when flag = '03'  then  amt03  when flag = '04' then amt04  end )  , 0) )  amt3
            , sum( if(yearmon_rank =4,	  (case when flag = '01'  then  amt01   when flag = '02' then amt02  when flag = '03'  then  amt03  when flag = '04' then amt04  end )  , 0) )  amt4
            , sum( if(yearmon_rank =5,	  (case when flag = '01'  then  amt01   when flag = '02' then amt02  when flag = '03'  then  amt03  when flag = '04' then amt04  end )  , 0) )  amt5
            , sum( if(yearmon_rank =6,	  (case when flag = '01'  then  amt01   when flag = '02' then amt02  when flag = '03'  then  amt03  when flag = '04' then amt04  end )  , 0) )  amt6
            , sum( if(yearmon_rank =7,	  (case when flag = '01'  then  amt01   when flag = '02' then amt02  when flag = '03'  then  amt03  when flag = '04' then amt04  end )  , 0) )  amt7
            , sum( if(yearmon_rank =8,	  (case when flag = '01'  then  amt01   when flag = '02' then amt02  when flag = '03'  then  amt03  when flag = '04' then amt04  end )  , 0) )  amt8
            , sum( if(yearmon_rank =9,	  (case when flag = '01'  then  amt01   when flag = '02' then amt02  when flag = '03'  then  amt03  when flag = '04' then amt04  end )  , 0) )  amt9
            , sum( if(yearmon_rank =10,	  (case when flag = '01'  then  amt01   when flag = '02' then amt02  when flag = '03'  then  amt03  when flag = '04' then amt04  end )  , 0) )  amt10
            , sum( if(yearmon_rank =11,	  (case when flag = '01'  then  amt01   when flag = '02' then amt02  when flag = '03'  then  amt03  when flag = '04' then amt04  end )  , 0) )  amt11
            , sum( if(yearmon_rank =12,	  (case when flag = '01'  then  amt01   when flag = '02' then amt02  when flag = '03'  then  amt03  when flag = '04' then amt04  end )  , 0) )  amt12
           ,  case when flag = '01'  then  sum(amt01)  when flag = '02' then sum(amt02)  when flag = '03' then sum(amt03)   when flag = '04' then   ifnull(round( sum(amt03)/sum(amt01)  * 100, 2),0) end   amtTot
    From (
       select * From (
        select * From (
        select
               yearmon
             , yearmon_rank             
             , ifnull(mda_type_code  , 'AAB00' ) mda_type_code
             , sum(amt01) amt01
             , sum(amt02) amt02
             , sum(amt03) amt03
             , ifnull(round( sum(amt03)/sum(amt01)  * 100, 2),0)   amt04
          from (
                     select
                        a.yearmon
                        , a.yearmon_rank
                        , a.mda_type_code                        
                        ,  ifnull(b.mda_amt , 0)  amt01
                        ,  ifnull(b.mda_cmms_amt , 0)  +  ifnull(c.mda_sell_amt , 0)  amt02
                        ,  ifnull(b.mda_amt , 0) -  ifnull(b.mda_cmms_amt , 0) -   ifnull(c.mda_sell_amt , 0)  amt03
                        ,  ifnull(b.mda_cmms_amt , 0)  mda_cmms_amt
                        ,  ifnull(b.mda_cost , 0)  mda_cost
                        ,  ifnull(c.mda_sell_amt , 0)  mda_sell_amt
                     from
                      (
                             select yearmon
                                    ,  yearmon_rank
                                    ,  comm_cd  mda_type_code                                   
                            from  (
                                          select yearmon
                                                , @RANK := @RANK + 1   yearmon_rank
                                          from   vi_yearmon  , (SELECT  @RANK := 0) X0
                                          where yearmon  between  '{$_GET['fr_date']}' and   '{$_GET['to_date']}'
                                       ) a
                                ,  tb_code b 
                              where  comm_type_cd ='AAB'
                                and up_comm_seq is not null
                    ) a
                       left outer join  (
                                 select
                                      t.cont_yearmon   cont_yearmon 
                                   , ifnull(t1.mda_type_code , 'AAB98')  mda_type_code
                                   , sum(ifnull(t1.mda_amt ,0) )  mda_amt
                                   , sum(ifnull(t1.mda_cmms_amt ,0) )  mda_cmms_amt
                                   , sum(ifnull(t1.mda_cost ,0) )  mda_cost
                                  from tb_cont t , tb_cont_mdatype  t1
                                  where  t.cont_seq = t1.cont_seq  and t1.mda_amt > 0  and t.cont_yearmon   between '{$_GET['fr_date']}' and   '{$_GET['to_date']}'
                                       and  t.cont_stat not in ( 'BAC01','BAC02')
                                        {$sql_where}
                                  group by   t.cont_yearmon ,   t1.mda_type_code
                            )  b
                            on   a.yearmon = b.cont_yearmon     and a.mda_type_code  = b.mda_type_code   
                     left outer join  (
                                     select   x.adj_yearmon 
                                              , ifnull(x2.mda_type_code , 'AAB98')  mda_type_code
                                              , sum(sell_amt) mda_sell_amt
                                     from tb_mda_fin x, tb_cont x1 ,  tb_comp_mda x2
                                    where x.adj_yearmon   between  '{$_GET['fr_date']}' and   '{$_GET['to_date']}'
                                       and   x.cont_seq = x1.cont_seq
                                       and   x.prod_seq = x2.prod_seq
                                       and x.del_yn ='N'
                                       and x2.del_yn ='N'
                                       and sell_amt > 0 
                                       and  x1.cont_stat not in ( 'BAC01','BAC02')
                                        {$sql_where1}
                                    group by x.adj_yearmon ,   x2.mda_type_code
                            )  c
                    on   a.yearmon =c.adj_yearmon     and a.mda_type_code  = c.mda_type_code 
          ) a
          where amt01 > 0  or amt02 > 0 or amt03 > 0
             and yearmon is not null
             and yearmon_rank is not null
          group by  yearmon,  yearmon_rank,     mda_type_code   with rollup
          ) a
          where yearmon is not null and yearmon_rank is not null
        ) a
          join    (
            select '01' flag
            union all
            select '02' flag
            union all
            select '03' flag
            union all
            select '04' flag
          ) b
        ) a
    group by   mda_type_code ,   flag
    ) a
  left outer join  tb_code b on  a.mda_type_code = b.comm_cd
  order by    ord, mda_type_code, flag
 
" ;

$result = sql_query_json($sql); //질의.
echo $result ;
?>
