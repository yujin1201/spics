<?php
include_once('./_common.php');
$sql_where =  makeSearchContQuery() ;

$sql = " 
    select  comm_cd , comm_cd_nm  , ord 
    , sum(ifnull(mda_cnt,  0))  tot_mda_cnt 
    , sum(ifnull(mda_amt,  0))  tot_mda_amt 
    , sum(ifnull(mda_prc,  0))  tot_mda_prc 
    , round(sum(ifnull(mda_amt,  0)) /  sum(ifnull(mda_prc,  0)) *100, 2)   tot_mda_per
    
    , sum( if(yearmon_rank =1	 ,mda_cnt,  0) ) m1_mda_cnt 
    , sum(if(yearmon_rank=1	 ,mda_unitprc, 0)) m1_mda_unitprc 
    , sum(if(yearmon_rank =1	 ,mda_prc,  0) ) m1_mda_prc 
    , sum( if(yearmon_rank =1	 ,mda_amt,  0) ) m1_mda_amt
    , sum(if(yearmon_rank =1	 ,mda_per,  0) ) m1_mda_per 
    , sum( if(yearmon_rank =2	 ,mda_cnt,  0) ) m2_mda_cnt
    , sum(if(yearmon_rank=2	 ,mda_unitprc, 0)) m2_mda_unitprc
    , sum(if(yearmon_rank =2	 ,mda_prc,  0) ) m2_mda_prc
    , sum( if(yearmon_rank =2	 ,mda_amt,  0) ) m2_mda_amt
    , sum(if(yearmon_rank =2	 ,mda_per,  0) ) m2_mda_per
    , sum( if(yearmon_rank =3	 ,mda_cnt,  0) ) m3_mda_cnt
    , sum(if(yearmon_rank=3	 ,mda_unitprc, 0)) m3_mda_unitprc
    , sum(if(yearmon_rank =3	 ,mda_prc,  0) ) m3_mda_prc
    , sum( if(yearmon_rank =3	 ,mda_amt,  0) ) m3_mda_amt
    , sum(if(yearmon_rank =3	 ,mda_per,  0) ) m3_mda_per
    , sum( if(yearmon_rank =4	 ,mda_cnt,  0) ) m4_mda_cnt
    , sum(if(yearmon_rank=4	 ,mda_unitprc, 0)) m4_mda_unitprc
    , sum(if(yearmon_rank =4	 ,mda_prc,  0) ) m4_mda_prc
    , sum( if(yearmon_rank =4	 ,mda_amt,  0) ) m4_mda_amt
    , sum(if(yearmon_rank =4	 ,mda_per,  0) ) m4_mda_per
    , sum( if(yearmon_rank =5	 ,mda_cnt,  0) ) m5_mda_cnt
    , sum(if(yearmon_rank=5	 ,mda_unitprc, 0)) m5_mda_unitprc
    , sum(if(yearmon_rank =5	 ,mda_prc,  0) ) m5_mda_prc
    , sum( if(yearmon_rank =5	 ,mda_amt,  0) ) m5_mda_amt
    , sum(if(yearmon_rank =5	 ,mda_per,  0) ) m5_mda_per
    , sum( if(yearmon_rank =6	 ,mda_cnt,  0) ) m6_mda_cnt
    , sum(if(yearmon_rank=6	 ,mda_unitprc, 0)) m6_mda_unitprc
    , sum(if(yearmon_rank =6	 ,mda_prc,  0) ) m6_mda_prc
    , sum( if(yearmon_rank =6	 ,mda_amt,  0) ) m6_mda_amt
    , sum(if(yearmon_rank =6	 ,mda_per,  0) ) m6_mda_per
    , sum( if(yearmon_rank =7	 ,mda_cnt,  0) ) m7_mda_cnt
    , sum(if(yearmon_rank=7	 ,mda_unitprc, 0)) m7_mda_unitprc
    , sum(if(yearmon_rank =7	 ,mda_prc,  0) ) m7_mda_prc
    , sum( if(yearmon_rank =7	 ,mda_amt,  0) ) m7_mda_amt
    , sum(if(yearmon_rank =7	 ,mda_per,  0) ) m7_mda_per
    , sum( if(yearmon_rank =8	 ,mda_cnt,  0) ) m8_mda_cnt
    , sum(if(yearmon_rank=8	 ,mda_unitprc, 0)) m8_mda_unitprc
    , sum(if(yearmon_rank =8	 ,mda_prc,  0) ) m8_mda_prc
    , sum( if(yearmon_rank =8	 ,mda_amt,  0) ) m8_mda_amt
    , sum(if(yearmon_rank =8	 ,mda_per,  0) ) m8_mda_per
    , sum( if(yearmon_rank =9	 ,mda_cnt,  0) ) m9_mda_cnt
    , sum(if(yearmon_rank=9	 ,mda_unitprc, 0)) m9_mda_unitprc
    , sum(if(yearmon_rank =9	 ,mda_prc,  0) ) m9_mda_prc
    , sum( if(yearmon_rank =9	 ,mda_amt,  0) ) m9_mda_amt
    , sum(if(yearmon_rank =9	 ,mda_per,  0) ) m9_mda_per
    , sum( if(yearmon_rank =10	 ,mda_cnt,  0) ) m10_mda_cnt
    , sum(if(yearmon_rank=10	 ,mda_unitprc, 0)) m10_mda_unitprc
    , sum(if(yearmon_rank =10	 ,mda_prc,  0) ) m10_mda_prc
    , sum( if(yearmon_rank =10	 ,mda_amt,  0) ) m10_mda_amt
    , sum(if(yearmon_rank =10	 ,mda_per,  0) ) m10_mda_per
    , sum( if(yearmon_rank =11	 ,mda_cnt,  0) ) m11_mda_cnt
    , sum(if(yearmon_rank=11	 ,mda_unitprc, 0)) m11_mda_unitprc
    , sum(if(yearmon_rank =11	 ,mda_prc,  0) ) m11_mda_prc
    , sum( if(yearmon_rank =11	 ,mda_amt,  0) ) m11_mda_amt
    , sum(if(yearmon_rank =11	 ,mda_per,  0) ) m11_mda_per
    , sum( if(yearmon_rank =12	 ,mda_cnt,  0) ) m12_mda_cnt
    , sum(if(yearmon_rank=12	 ,mda_unitprc, 0)) m12_mda_unitprc
    , sum(if(yearmon_rank =12	 ,mda_prc,  0) ) m12_mda_prc
    , sum( if(yearmon_rank =12	 ,mda_amt,  0) ) m12_mda_amt
    , sum(if(yearmon_rank =12	 ,mda_per,  0) ) m12_mda_per

from (    
    select     
       a.*
       ,if( mda_prc =0,  0, round( mda_amt / mda_prc * 100 , 2))  mda_per 
    From (    
        select    
             a.comm_cd , a.comm_cd_nm,   a.ord, b.yearmon_rank 
            , ifnull(c.mda_cnt, 0)  mda_cnt 
            , ifnull(c.mda_unitprc , 0)  mda_unitprc 
            , ifnull(c.mda_cnt, 0) * ifnull(c.mda_unitprc, 0)  mda_prc 
            , ifnull((
                select 
                   sum(ifnull(t1.mda_amt ,0) )  mda_amt  
              from tb_cont t , tb_cont_mdatype  t1 
              where  t.cont_seq = t1.cont_seq  and t.cont_yearmon   = b.yearmon 
                 and  a.comm_cd = t1.mda_type_code
                  {$sql_where}
            ) , 0) mda_amt
        from tb_code  a 
           join  ( select  yearmon  
                    , @RANK := @RANK + 1 yearmon_rank
                    from  vi_yearmon  , (SELECT  @RANK := 0) X0  
                    where  yearmon  between '{$_GET['fr_date']}' and   '{$_GET['to_date']}'   
                    order by yearmon 
               ) b 
           left outer join  tb_mdatype_stock c  on a.comm_cd =  c.mda_type_code and b.yearmon = c.yearmon   
       where comm_type_cd ='AAB' 
          and up_comm_seq is not null       
    ) a  
) x 
group by comm_cd , comm_cd_nm , ord  
order by ord    " ;

$result = sql_query_json($sql); //질의.
echo $result ;
?>
