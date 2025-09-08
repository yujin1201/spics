<?php
include_once('./_common.php');

$st_dt = str_replace('-', ''  ,$_GET['st_dt'] ) ;
$ed_dt = str_replace('-', ''  ,$_GET['ed_dt']  );


$sql = "  
          SELECT     
                c.cont_bld_seq
                , c.cont_seq
                , c.bld_seq
                , ifnull(c.mtrl_sec,0) mtrl_sec 
                , c.st_dt
                , c.ed_dt
                , c.act_st_time
                , c.act_ed_time
                , c.bigo 
                ,FN_MB_NM(c.entr_prsn) as entr_prsn
                , c.entr_dt
                ,FN_MB_NM(c.updt_prsn) as updt_prsn 
                , c.updt_dt
                , b.bld_nm
                , b.bld_num
                , b.ins_sec  
                , ifnull(d.cont_nm ,'') cont_nm
                , d.cli_seq 
                , d.agncy_seq 
                , ifnull((select x.comp_nm from tb_comp x where x.comp_seq = d.cli_seq  and x.comp_type='AAC01'   ) ,'') cli_nm   
                , ifnull((select x.comp_nm from tb_comp x where x.comp_seq = d.agncy_seq  and x.comp_type='AAC03'   ),'')  agncy_nm    
                ,  concat(c.bld_seq, '-', b.bld_nm)  bld_div
                ,  concat(c.cont_seq, '-', ifnull(d.cont_nm ,''))  cont_div
                , d.cont_sale_type
                , ifnull((select comm_cd_nm from tb_code where comm_cd = d.cont_sale_type and comm_type_cd ='BAK'), '')  cont_sale_type_nm 
           from  tb_cont_bld c 
               inner join tb_bld b   on   b.bld_seq =c.bld_seq   and b.DEL_YN='N'   
               inner  join tb_cont d on c.cont_seq = d.cont_seq   
          where exists ( select '1' from tb_date a where   a.dt between '{$st_dt }' and  '{$ed_dt }'   and a.dt between c.st_dt and c.ed_dt  )
            and c.del_yn = 'N'  " ;

if (isset($_GET['bld_seq']) && $_GET['bld_seq'] > 0) {
    $sql .= "and c.bld_seq = '{$_GET['bld_seq']}'";
}

if (isset($_GET['search_str']) && $_GET['search_str'] != ""  ) {
    if($_GET['sfl'] == 'sch_all'){
        $sql .= "and ( bld_nm like '%{$_GET['search_str']}%' or cont_nm like '%{$_GET['search_str']}%' ) ";
    }else{
        $sql .= "and {$_GET['sfl']}  like '%{$_GET['search_str']}%'";
    }
}
$sql .= "order by c.st_dt desc , c.ed_dt  desc  ";
 

$result = sql_query_json($sql); //질의.
echo $result ;
?>


