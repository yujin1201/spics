<?php
$sub_menu = "100400";
include_once('./_common.php');

$jsonInput  = json_decode(stripslashes(file_get_contents('php://input')),  true );

$arr = $jsonInput['mdaList']  ;
    foreach ($arr as $key => $vals) {
        //저장
        if($jsonInput['submissionId'] == "subSave") {
            $sql_common = "
                 ,mda_nm = '{$vals['mda_nm']}'
                 ,mda_div = '{$vals['mda_div']}'
                 ,mda_type = '{$vals['mda_type']}'
                 ,mda_prod = '{$vals['mda_prod']}'
                 ,mda_poi = '{$vals['mda_poi']}'
                 ,ord = '{$vals['ord']}'
                 ,use_yn = UPPER(ifnull('{$vals['use_yn']}', 'Y'))
                 ,show_yn = UPPER(ifnull('{$vals['show_yn']}', 'Y')) 
                 ,bigo = '{$vals['bigo']}'
                 ,up_mda_seq = '{$vals['up_mda_seq']}'         
                 ,last_yn = UPPER('{$vals['last_yn']}')
                 ,depth = '{$vals['depth']}'  
                 ,mda_own_yn = '{$vals['mda_own_yn']}'  
             ";

            //신규
            if (empty($vals['org_mda_seq']) || $vals['org_mda_seq'] == "") {
                $sql = " insert into tb_media 
                set  entr_dt=now()
                   , entr_prsn ='{$member['mb_no']}'
                   {$sql_common} ";
                $result = sql_query($sql);
                if ($result) $last_seq_no = sql_insert_id();

                //depth  update
                $sql_update =
                    "   update tb_media  
                        set  depth = concat({$vals['depth']}, " / ", {$last_seq_no}) 
                        where mda_seq ={$last_seq_no}    ";
                $result = sql_query($sql_update);

                //부모 업데이트
                $sql_update =
                    "   update tb_media  
                        set updt_dt = now()
                           , updt_prsn ='{$member['mb_no']}'  
                           ,last_yn ='N'
                        where mda_seq = {$vals['up_mda_seq']}    ";
                $result = sql_query($sql_update);
            } else {
                $sql_update =
                    "   update tb_media  
                        set  updt_dt = now()
                           , updt_prsn ='{$member['mb_no']}'  
                          {$sql_common}
                        where mda_seq ={$vals['org_mda_seq']}    ";
                $result = sql_query($sql_update);
            }
        }else {
            $sql_update =
                "   update tb_media  
                    set  updt_dt = now()
                       , updt_prsn ='{$member['mb_no']}'   
                    where mda_seq ={$vals['org_mda_seq']}    "  ;
            $result = sql_query($sql_update );

            $sql_update =
                "   delete from  tb_media   
                where mda_seq ={$vals['org_mda_seq']}    "  ;
            $result = sql_query($sql_update );

            // 업데이트
            $sql_update =
                "   update tb_media  
                        set updt_dt = now()
                           , updt_prsn ='{$member['mb_no']}'  
                           ,last_yn ='Y'
                        where mda_seq = {$vals['up_mda_seq']}
                             and not exists ( select '1' from vi_media a where a.up_mda_seq = {$vals['up_mda_seq']} )";
            $result = sql_query($sql_update);
        }
    }
$value = array('mda_seq'=>"");
echo json_encode($value);
?>