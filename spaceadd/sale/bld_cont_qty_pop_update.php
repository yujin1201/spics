<?php
$sub_menu = "100400";
include_once('./_common.php');
include_once('./cont_form_common.php');

$jsonInput  = json_decode(stripslashes(file_get_contents('php://input')),  true );

$cnt = 0 ;
$arr = $jsonInput['list']  ;

if ( $jsonInput['submissionId'] == "subForm") {
    foreach ($arr as $key => $vals) {

        $sql_ck = "   select  min(ifnull(qty_sec, ins_sec) - use_sec ) sec
                      from (  
                              SELECT a.dt,  b.ins_sec   
                                  , ifnull(( SELECT sum(mtrl_sec)  from tb_cont_bld x    
                                                                   where b.bld_seq = x.bld_seq and a.dt between x.st_dt and  x.ed_dt and x.DEL_YN='N' and x.cont_bld_seq != {$vals['cont_bld_seq'] } ),0)  use_sec   
                                  , (select  min(ins_sec) from tb_bld_qty x where  b.bld_seq = x.bld_seq and a.dt between x.st_dt and  x.ed_dt and x.DEL_YN='N') qty_sec                      
                               from tb_date a, tb_bld b 
                               where a.dt between '{$vals['st_dt'] }' and '{$vals['ed_dt'] }'
                                    and a.dt between b.use_st_dt and b.use_ed_dt
                                    and b.bld_seq  = {$vals['bld_seq'] }
                                    and b.DEL_YN='N'  
                            ) a   " ;
        $result_ck = sql_fetch($sql_ck ) ;
        $sec =  $result_ck['sec'];
        $mtrl_sec = $vals['mtrl_sec']  ;

        if( $mtrl_sec > 0 && $sec >= $mtrl_sec ) {

            $sql = " update tb_cont_bld 
                set      
                    mtrl_sec = {$vals['mtrl_sec'] },
                    st_dt = '{$vals['st_dt'] }',
                    ed_dt = '{$vals['ed_dt'] }', 
                    updt_dt = now(),
                    updt_prsn ='{$member['mb_no']}' 
                where  cont_bld_seq  = {$vals['cont_bld_seq'] } ";

            $result = sql_query($sql);
            $cnt++;
        }
    }
}else{
    foreach ($arr as $key => $vals) {
        $sql = "delete 
                from  tb_cont_bld  
                where  cont_bld_seq  = {$vals['cont_bld_seq'] } ";

        $result = sql_query($sql);
        $cnt++;
    }
}



echo $cnt;
?>