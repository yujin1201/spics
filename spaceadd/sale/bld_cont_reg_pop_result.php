<?php
include_once('./_common.php');
$jsonInput  = json_decode(stripslashes(file_get_contents('php://input')),  true );


$st_dt = str_replace('-', ''  ,$_POST['st_date'] ) ;
$ed_dt = str_replace('-', ''  ,$_POST['ed_date']  );
$mtrl_sec = $_POST['mtrl_sec']  ;
$bld_req_type = $_POST['bld_req_type']  ;
if( $bld_req_type  != ""){
    $bld_req_type ="bld_seq" ;
}


$bld_list =  $_POST['bld_list']   ;
$bld_str = ""   ;
if(count($bld_list)  > 0  ){
    $bld_str =" and  b.bld_seq  in ( '0' ";
    foreach ($bld_list as $key => $bld) {
        $bld_str .= ','.$bld  ;
    }
    $bld_str .=" ) " ;
}

$bld_nums =  $_POST['bld_nums']   ;
$bld_str1 = ""   ;
if(count($bld_nums)  > 0  ){
    $bld_str1 =" and b.bld_num  in ( '0'  ";
    foreach ($bld_nums as $key => $bld) {
        $bld_str1 .= ", '".$bld. "'" ;
    }
    $bld_str1 .=" ) " ;
}

$cont_str ="0";
$cont_list =  $_POST['cont_list']   ;
foreach ($cont_list as $key => $cont) {
    $cont_str .= ",".$cont  ;
}

$sql = "  select a.*, b.*
          , {$mtrl_sec}  mtrl_sec 
          , greatest('{$st_dt}', b.cont_st_dt )  st_date
          , least('{$ed_dt}', b.cont_ed_dt)  ed_date
          , ifnull((select x.comp_nm from tb_comp x where x.comp_seq = b.cli_seq  and x.comp_type='AAC01'   ) ,'') cli_nm   
          , ifnull((select x.comp_nm from tb_comp x where x.comp_seq = b.agncy_seq  and x.comp_type='AAC03'   ),'')  agncy_nm   
          , ifnull((select comm_cd_nm from tb_code where comm_cd = b.cont_stat and comm_type_cd ='BAC'), '')  cont_stat_nm  
          from (
                select bld_seq,bld_nm, bld_num, ins_cnt
                     , min((qty_sec - use_sec  - {$mtrl_sec})) qy
                     , min(qty_sec) ins_sec
               from (SELECT a.dt
                          , b.bld_seq
                          , b.bld_nm
                          , b.bld_num
                          , b.ins_cnt 
                          , ifnull((SELECT sum(mtrl_sec)
                                    from tb_cont_bld x
                                    where b.bld_seq = x.bld_seq
                                      and a.dt between x.st_dt and x.ed_dt
                                      and x.del_yn = 'N'  ), 0) use_sec
                          , ifnull((select min(ins_sec)
                                    from tb_bld_qty x
                                    where b.bld_seq = x.bld_seq
                                      and a.dt between x.st_dt and x.ed_dt
                                      and x.DEL_YN = 'N'), b.ins_sec) qty_sec
                     from tb_date a,
                          tb_bld b
                     where a.dt between '{$st_dt}' and '{$ed_dt}'   
                       and a.dt between b.use_st_dt and b.use_ed_dt
                       and b.DEL_YN = 'N'     
                       {$bld_str}
                       {$bld_str1}
                     ) a
               group by bld_seq, bld_nm,bld_num, ins_cnt
               ) a, tb_cont b
where a.qy >= 0
    and b.cont_seq in ({$cont_str} )
    and b.cont_ed_dt >= '{$st_dt}'   and b.cont_st_dt <= '{$ed_dt}'    
  order by bld_seq,  cont_seq 
    
    ";
$result = sql_query_json($sql); //질의.

echo $result ;
?>


