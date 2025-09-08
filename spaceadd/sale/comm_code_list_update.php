<?php
$sub_menu = "100400";
include_once('./_common.php');

$jsonInput  = json_decode(stripslashes(file_get_contents('php://input')),  true );

$arr = $jsonInput['codeList']  ;
    foreach ($arr as $key => $vals) {
        //저장
        if($jsonInput['submissionId'] == "subSave") {
            $sql_common = " 
                 ,comm_cd_nm = '{$vals['comm_cd_nm']}'             
                 ,ord = '{$vals['ord']}'
                 ,use_yn = UPPER('{$vals['use_yn']}')
                 ,bigo1 = '{$vals['bigo1']}'
                 ,bigo2 = '{$vals['bigo2']}'
                 ,bigo3 = '{$vals['bigo3']}'
            ";

            //신규
            if (empty($vals['org_comm_seq']) || $vals['org_comm_seq'] == "") {
                $sql = " insert into tb_code 
                set  entr_dt=now()
                   , entr_prsn ='{$member['mb_no']}'
                   , comm_cd = UPPER('{$vals['comm_cd']}')
                   , comm_type_cd = UPPER(if('{$vals['comm_type_cd']}', '','{$vals['comm_cd']}'))
                   , up_comm_seq = '{$vals['up_comm_seq']}'
                    {$sql_common} ";
                $result = sql_query($sql);
                if ($result) $last_seq_no = sql_insert_id();
            } else {
                $sql_update =
                    "   update tb_code  
                        set  updt_dt = now()
                           , updt_prsn ='{$member['mb_no']}'  
                          {$sql_common}
                        where comm_seq ={$vals['org_comm_seq']}    ";
                $result = sql_query($sql_update);
            }
        }else {
            $sql_update =
                "   update tb_code  
                    set  updt_dt = now()
                       , updt_prsn ='{$member['mb_no']}'
                       ,use_yn = 'N'
                    where comm_seq ={$vals['org_comm_seq']}    "  ;
            $result = sql_query($sql_update );
        }
    }
$value = array('comm_seq'=>"");
echo json_encode($value);
?>