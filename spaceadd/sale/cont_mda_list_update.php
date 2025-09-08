<?php
$sub_menu = "100400";
include_once('./_common.php');

$jsonInput  = json_decode(stripslashes(file_get_contents('php://input')),  true );

$arr = $jsonInput['codeList']  ;
    foreach ($arr as $key => $vals) {
        //저장
            $sql_common = " 
                ,cont_mda_seq = '{$vals['cont_mda_seq']}'  
                ,bigo = '{$vals['bigo2']}'  
                   ";

            //신규
            if (empty($vals['bigo_seq']) || $vals['bigo_seq'] == "") {
                $sql = " insert into tb_cont_mda_bigo 
                set  entr_dt=now()
                   , entr_prsn ='{$member['mb_no']}' 
                    {$sql_common} ";
                $result = sql_query($sql);
                if ($result) $last_seq_no = sql_insert_id();
            } else {
                $sql_update =
                    "   update tb_cont_mda_bigo  
                        set  updt_dt = now()
                           , updt_prsn ='{$member['mb_no']}'  
                          {$sql_common}
                        where bigo_seq ={$vals['bigo_seq']}    ";
                $result = sql_query($sql_update);
            }
    }
$value = array('comm_seq'=>"");
echo json_encode($value);
?>