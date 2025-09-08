<?php


include_once('./_common.php');

$w = $_POST['w'];

if(!isset($_POST['w']) ){
    $w = $_GET['w'];
}

$sql_common = "  comp_seq = '{$_POST['comp_seq']}',                 
                 item_code = '{$_POST['item_code']}',      
                 use_yn = '{$_POST['use_yn']}',                
                 bigo = '{$_POST['bigo']}'                                 
                  ";
if ($w == 'I'){
    $result = sql_query(" insert into tb_comp_excpt set entr_dt=now(),entr_prsn ='{$member['mb_no']}', {$sql_common} ");

    //echo " insert into tb_comp_mda set entr_dt=now(),entr_prsn ='{$member['mb_no']}', {$sql_common} ";

?>
        <script>
            opener.parent.excpt_grid_load();
            //alert("저장 되었습니다.");
            //self.close();
        </script>
<?php
    alert("등록 완료", './mda_excpt_form_pop.php?w=u&comp_seq='.$_POST['comp_seq'].'&item_code='.$_POST['item_code']);

}else if($w == 'U'){

    //구좌수 바뀌는거 체크 해야함 tb_cont_mda_assign에 이미 등록 되어 있으면 구좌수 수정 안됨
    //tb_cont_mda_assign에 없으면 tb_mda_assign에 그냥 싹 지우고 새로 입력 하자
    $result = sql_query(" update tb_comp_excpt set updt_dt=now(),updt_prsn ='{$member['mb_no']}', {$sql_common}  where comp_seq = {$_POST['comp_seq']} and item_code = {$_POST['item_code']}" );



?>
<script>
    opener.parent.excpt_grid_load();
    //alert("저장 되었습니다.");
    //self.close();
    //goto_url("./mda_pro_form_pop.php?w=u&comp_seq={$_POST['comp_seq']}&prod_seq={$_POST['prod_seq']}");
</script>
<?php
    alert("저장 완료", './mda_excpt_form_pop.php?w=u&comp_seq='.$_POST['comp_seq'].'&item_code='.$_POST['item_code']);
}else if($w == 'D'){

    $result = sql_query(" update tb_comp_excpt set updt_dt=now(),updt_prsn ='{$member['mb_no']}', del_yn='Y'  where comp_seq = {$_GET['comp_seq']} and item_code = '{$_GET['item_code']}'" );

?>
    <script>
        opener.parent.excpt_grid_load();
        alert("삭제 완료.");
        self.close();
        //goto_url("./mda_pro_form_pop.php?w=u&comp_seq={$_POST['comp_seq']}&prod_seq={$_POST['prod_seq']}");
    </script>
<?php
}

?>
