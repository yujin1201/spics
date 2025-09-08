<?php
include_once('./_common.php');


$sql = " select  a.*
        ,  ifnull( qty_sec , ins_sec) real_sec
        ,  ( ifnull( qty_sec , ins_sec) -  mtrl_sec ) able_sec
        , left(a.dt, 4) yyyy
        , substr(a.dt, 5, 2) mm
        , substr(a.dt, 7, 2) dd
     from ( 
          SELECT a.dt
               , b.bld_seq
               , b.bld_num
               , b.bld_nm
               , b.ins_sec  
               , b.ins_cnt
               , c.cont_bld_seq
               , c.cont_seq 
               , ifnull(c.mtrl_sec,0) mtrl_sec 
               , c.st_dt
               , c.ed_dt         
              ,  (select  min(ins_sec) from tb_bld_qty x where  b.bld_seq = x.bld_seq and a.dt between x.st_dt and  x.ed_dt and x.DEL_YN='N')  qty_sec
              , ifnull(substr(d.cont_nm,1,20)    ,'') cont_nm
              , d.cli_seq 
              , d.agncy_seq 
              , ifnull((select x.comp_nm from tb_comp x where x.comp_seq = d.cli_seq  and x.comp_type='AAC01'   ) ,'') cli_nm   
              , ifnull((select x.comp_nm from tb_comp x where x.comp_seq = d.agncy_seq  and x.comp_type='AAC03'   ),'')  agncy_nm    
           from tb_date a
              left outer join tb_bld b  on  a.dt between b.use_st_dt and b.use_ed_dt  and b.DEL_YN='N'
              left outer join tb_cont_bld c on a.dt between c.st_dt and c.ed_dt   and b.bld_seq =c.bld_seq and c.del_yn = 'N' 
              left outer join tb_cont d on c.cont_seq = d.cont_seq     
      where a.dt between '{$_GET['st_dt']}' and  '{$_GET['ed_dt']}'  
    " ;

if (isset($_GET['stx']) && $_GET['stx'] != ""  ) {
    if($_GET['sfl'] == 'sch_all'){
        $sql .= "and ( b.bld_nm like '%{$_GET['stx']}%' or b.addr1 like '%{$_GET['stx']}%' ) ";
    }else{
        $sql .= "and {$_GET['sfl']}  like '%{$_GET['stx']}%'";
    }
}
if (isset($_GET['bld_pkg'])  && $_GET['bld_pkg'] != ""   ) {
    $sql .= "and b.bld_pkg = '{$_GET['bld_pkg']}'";
}

$sql .= " ) a   order by a.dt, a.bld_seq ";

$result = sql_query_json($sql); //질의.
echo $result ;
?>


