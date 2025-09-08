<?php
include_once('../_common.php');

$jsonInput  = json_decode(stripslashes(file_get_contents('php://input')),  true );

$bld_pkg_options =""  ;
for($i=0; $i< $jsonInput['bld_pkg_size'] ; $i++){
    if (isset($jsonInput['bld_pkg_'.$i]) && $jsonInput['bld_pkg_'.$i] != ""  ) {
        $bld_pkg_options = $bld_pkg_options . " , '{$jsonInput['bld_pkg_'.$i]}' ";
    }
}
if($bld_pkg_options != "") $bld_pkg_options = "and b.bld_pkg  in ( '' {$bld_pkg_options} ) " ;


if (isset($jsonInput['excpt_str'])  && $jsonInput['excpt_str'] != ""   ) {
    if (isset($jsonInput['excpt_opt'])  && $jsonInput['excpt_opt'] != ""   ) {
        if (  $jsonInput['excpt_opt'] =="Y"  ) {
            $bld_pkg_options .= "and b.excpt_item  not like '%{$jsonInput['excpt_str']}%'";
        }else{
            $bld_pkg_options .= "and b.excpt_item  like '%{$jsonInput['excpt_str']}%'";
        }
    }else{
        $bld_pkg_options .= "and b.excpt_item  not like '%{$jsonInput['excpt_str']}%'";
    }
}

if (isset($jsonInput['bld_mda_type'])  && $jsonInput['bld_mda_type'] != ""   ) {
    $bld_pkg_options .= "and b.bld_mda_type = '{$jsonInput['bld_mda_type']}'";
}

$qty_div = "1" ;
if (isset($jsonInput['qty_type'])  && $jsonInput['qty_type'] != ""   ) {
    $qty_div =  ($jsonInput['qty_type'] == "cnt")?"15" :"1" ;
}

/*

$sql = "  select  a.*
  ,  ( ifnull( qty_sec , ins_sec)  -  mtrl_sec  ) able_sec
  , left(a.dt, 4) yyyy
  , substr(a.dt, 5, 2) mm
  , substr(a.dt, 7, 2) dd
from (
      select dt , bld_seq, bld_num, bld_nm
           , ins_cnt, bld_pkg, bld_mda_type
           , count(cont_seq) cont_cnt
           , ceil(ins_sec / {$qty_div} ) ins_sec
           , ceil(sum(mtrl_sec) / {$qty_div} )  mtrl_sec 
           , ceil( ifnull((select  min(ins_sec) from tb_bld_qty x where  a.bld_seq = x.bld_seq and a.dt between x.st_dt and  x.ed_dt and x.DEL_YN='N'), ins_sec)  / {$qty_div} )   qty_sec
      from (
               SELECT a.dt
                    , b.bld_seq
                    , b.bld_num
                    , b.bld_nm
                    , b.ins_sec
                    , b.ins_cnt
                    , b.bld_pkg 
                    , b.bld_mda_type
                    , c.cont_bld_seq
                    , c.cont_seq
                    , ifnull(c.mtrl_sec,0) mtrl_sec
               from tb_date a
                    inner join tb_bld b  on  a.dt between b.use_st_dt and b.use_ed_dt  and b.DEL_YN='N'  ";
                                if (isset($jsonInput['stx']) && $jsonInput['stx'] != ""  ) {
                                    if($jsonInput['sfl'] == 'sch_all'){
                                        $sql .= "and ( b.bld_nm like '%{$jsonInput['stx']}%' or b.addr1 like '%{$jsonInput['stx']}%' ) ";
                                    }else{
                                        $sql .= "and {$jsonInput['sfl']}  like '%{$jsonInput['stx']}%'";
                                    }
                                }
                                $sql .= $bld_pkg_options ;
$sql .= "          left outer join tb_cont_bld c on a.dt between c.st_dt and c.ed_dt   and b.bld_seq =c.bld_seq and c.del_yn = 'N'  
                                                   and exists ( select '1' from tb_cont x where x.cont_seq = c.cont_seq " ;
                                            if(isset($jsonInput['cont_stat']) &&  $jsonInput['cont_stat'] != ''){
                                                $sql .= "  and x.cont_stat in ('".str_replace("\'", "'", $jsonInput['cont_stat'])."')  ";
                                            }
$sql .= " 
                    )
               where a.dt between  '{$jsonInput['st_dt']}' and  '{$jsonInput['ed_dt']}'  
           ) a
      group by  dt , bld_seq, bld_num, bld_nm, ins_sec, ins_cnt , bld_pkg ,  bld_mda_type 
 ) a   
  order by   bld_seq, bld_num, bld_nm, dt ,ins_sec, ins_cnt " ;
*/

  $sql ="
     select a.*
      , ( ifnull( qty_sec , ins_sec)  -  mtrl_sec  ) able_sec
      , left(a.dt, 4) yyyy
      , substr(a.dt, 5, 2) mm
      , substr(a.dt, 7, 2) dd
      ,ifnull((select comm_cd_nm from tb_code where comm_cd = bld_mda_type and comm_type_cd ='BBK'),'') bld_mda_type_nm
     from ( 
      SELECT 
          a.dt , b.bld_seq, b.bld_num, b.bld_nm, b.ins_cnt, b.bld_pkg, b.bld_mda_type   
          , count(c.cont_seq) cont_cnt
          , ceil(b.ins_sec /{$qty_div} ) ins_sec
          , ifnull(ceil(sum(mtrl_sec) / {$qty_div}), 0)   mtrl_sec                                                      
          , ceil( ifnull((select  min(b.ins_sec) from tb_bld_qty x where  b.bld_seq = x.bld_seq and a.dt between x.st_dt and  x.ed_dt and x.DEL_YN='N'), ins_sec)  / {$qty_div} )   qty_sec "  ;

      if(isset($jsonInput['cont_sale_type']) &&  $jsonInput['cont_sale_type'] != ''){
            $sql .= ",  0 local_sec   ";
       }else{
          $sql .= ", case when exists ( select '1' from  tb_cont x where c.cont_seq = x.cont_seq  and  x.cont_sale_type ='BAK03' ) then  ifnull(ceil(sum(mtrl_sec) / {$qty_div}), 0)  else 0  end local_sec    ";
      }

     $sql .= " from tb_date a
              inner join tb_bld b  on  a.dt between b.use_st_dt and b.use_ed_dt  and b.DEL_YN='N'  " ;
                    if (isset($jsonInput['stx']) && $jsonInput['stx'] != ""  ) {
                        if($jsonInput['sfl'] == 'sch_all'){
                            $sql .= "and ( b.bld_nm like '%{$jsonInput['stx']}%' or b.addr1 like '%{$jsonInput['stx']}%' ) ";
                        }else{
                            $sql .= "and {$jsonInput['sfl']}  like '%{$jsonInput['stx']}%'";
                        }
                    }
                    $sql .= $bld_pkg_options ;
    $sql .= "  left outer join   tb_cont_bld c   on a.dt between c.st_dt and c.ed_dt   and b.bld_seq =c.bld_seq    and    c.del_yn = 'N'     
                                                 and exists ( select '1' from   tb_cont d   where   c.cont_seq = d.cont_seq   " ;
                                                   if(isset($jsonInput['cont_stat']) &&  $jsonInput['cont_stat'] != ''){
                                                        $sql .= "  and d.cont_stat in ('".str_replace("\'", "'", $jsonInput['cont_stat'])."')  ";
                                                   }
                                                    if(isset($jsonInput['cont_sale_type']) &&  $jsonInput['cont_sale_type'] != ''){
                                                        $sql .= "  and d.cont_sale_type = '".$jsonInput['cont_sale_type']."'  ";
                                                   }
    $sql .= "                                        ) 
     where a.dt between  '{$jsonInput['st_dt']}' and  '{$jsonInput['ed_dt']}'   
     group by  a.dt , b.bld_seq, b.bld_num, b.bld_nm, b.ins_cnt, b.bld_pkg, b.bld_mda_type    
    ) a 
   order by  a.bld_seq, a.dt "   ;
  $result = sql_query_json($sql); //질의.
echo $result ;
?>


