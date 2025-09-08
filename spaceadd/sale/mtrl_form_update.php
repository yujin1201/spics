<?php


include_once('./_common.php');

$w = $_POST['w'];
if(!isset($_POST['w']) ){
    $w = $_GET['w'];
}
$sql_common = "  comp_seq = '{$_POST['comp_seq']}',                 
                 mtrl_nm = '{$_POST['mtrl_nm']}',      
                 mtrl_sec = '{$_POST['mtrl_sec']}',
                 use_yn = '{$_POST['use_yn']}',
                 prod_type = '{$_POST['prod_type']}',
                 mtrl_url_1 = '{$_POST['mtrl_url_1']}',
                 mtrl_url_2 = '{$_POST['mtrl_url_2']}',
                 mtrl_url_3 = '{$_POST['mtrl_url_3']}',
                 mtrl_url_4 = '{$_POST['mtrl_url_4']}',     
                 bigo = '{$_POST['bigo']}'                                 
                  ";
if ($w == 'I'){
    $result = sql_query(" insert into tb_mtrl set entr_dt=now(),entr_prsn ='{$member['mb_no']}', {$sql_common} ");

    //echo " insert into tb_mtrl set entr_dt=now(),entr_prsn ='{$member['mb_no']}', {$sql_common} ";
    if($result)  $last_seq_no = sql_insert_id();

    if($last_seq_no >0 ){
        ?>
<script>
    opener.parent.mtrl_reload();
    //self.close();
</script>
<?php
        alert("등록 완료", './mtrl_form_pop.php?w=U&mtrl_seq='.$last_seq_no.'&comp_seq='.$_POST['comp_seq']);
    }



}else if($w == 'U'){
    $result = sql_query(" update tb_mtrl set updt_dt=now(),updt_prsn ='{$member['mb_no']}', {$sql_common}  where comp_seq = {$_POST['comp_seq']} and mtrl_seq = '{$_POST['mtrl_seq']}'" );
?>
    <script>
        opener.parent.mtrl_reload();
        //self.close();
    </script>
<?php
    alert("저장 완료", './mtrl_form_pop.php?w=U&mtrl_seq='.$_POST['mtrl_seq'].'&comp_seq='.$_POST['comp_seq']);
}else if($w == 'D'){
    if(!isset($_POST['mtrl_seq']) ){
        $mtrl_seq = $_GET['mtrl_seq'];
    }else{
        $mtrl_seq = $_POST['mtrl_seq'];
    }

    //echo " update tb_mtrl set updt_dt=now(),updt_prsn ='{$member['mb_no']}', del_yn='Y'  where mtrl_seq = {$mtrl_seq}";

    $result = sql_query(" update tb_mtrl set updt_dt=now(),updt_prsn ='{$member['mb_no']}', del_yn='Y'  where mtrl_seq = {$mtrl_seq}" );
    ?>
    <script>
        opener.parent.mtrl_reload();
        alert("삭제 되었습니다.");
        self.close();
    </script>
    <?php
}
?>