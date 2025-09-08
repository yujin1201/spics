<?php
$sub_menu = "100400";
include_once('./_common.php');
include_once('./cont_form_common.php');

$jsonInput  = json_decode(stripslashes(file_get_contents('php://input')),  true );


$bld_list = $jsonInput['bld_list']  ;
$cont_list = $jsonInput['cont_list']  ;

$st_dt = str_replace('-', ''  ,$jsonInput['st_date'] ) ;
$ed_dt = str_replace('-', ''  ,$jsonInput['ed_date']  );
$mtrl_sec = $jsonInput['mtrl_sec']  ;
$bigo = str_replace( '\'', '"' , $jsonInput['bigo']) ;

$cnt = 0 ;
foreach ($bld_list as $key => $bld) {
    foreach ($cont_list as $key1 => $cont) {

        $sql_ck = "   select  min(ifnull(qty_sec, ins_sec) - use_sec ) sec
                      from (  
                              SELECT a.dt,  b.ins_sec   
                                  , ifnull(( SELECT sum(mtrl_sec)  from tb_cont_bld x    where b.bld_seq = x.bld_seq and a.dt between x.st_dt and  x.ed_dt  ),0)  use_sec   
                                  , (select  min(ins_sec) from tb_bld_qty x where  b.bld_seq = x.bld_seq and a.dt between x.st_dt and  x.ed_dt and x.DEL_YN='N') qty_sec                      
                               from tb_date a, tb_bld b 
                               where a.dt between {$st_dt} and {$ed_dt} 
                                    and a.dt between b.use_st_dt and b.use_ed_dt
                                    and b.bld_seq  = {$bld} 
                                    and b.DEL_YN='N'  
                            ) a   " ;
        $result_ck = sql_fetch($sql_ck ) ;
        $sec =  $result_ck['sec'];

        if( $mtrl_sec > 0 && $sec >= $mtrl_sec ){
            $sql = " insert into tb_cont_bld 
                        set     
                            cont_seq = {$cont['cont_seq'] },
                            bld_seq = {$bld} ,
                            mtrl_sec = {$mtrl_sec},
                            st_dt = '{$st_dt}',
                            ed_dt = '{$ed_dt}'  , 
                            bigo = '{$jsonInput['bigo']}' , 
                            entr_dt = now(),
                            entr_prsn ='{$member['mb_no']}' " ;
            $result = sql_query($sql);
            $cnt++;
        }
    }
}

echo $cnt;
?>