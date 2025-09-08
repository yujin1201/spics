<?php


include_once('./_common.php');

$w = $_POST['w'];

if(!isset($_POST['w']) ){
    $w = $_GET['w'];
}

if($_POST['ad_adj_type_code'] == "ABB01"){ //비율
    $ad_amt = 0;
    $ad_rt = $_POST['ad_rt'];
    $ad_adj_type_code = 'ABB01';
    $ad_adj_yn = 'Y';
}else if($_POST['ad_adj_type_code'] == "ABB02"){ //금액
    $ad_amt = str_replace(",", "", $_POST['ad_amt']);
    $ad_rt = 0;
    $ad_adj_type_code = 'ABB02';
    $ad_adj_yn = 'Y';
}else if($_POST['ad_adj_type_code'] == "N"){ //해당없음
    $ad_amt = 0;
    $ad_rt = 0;
    $ad_adj_type_code = '';
    $ad_adj_yn = 'N';
}

if($_POST['rent_adj_type_code'] == "N"){ //비율
    $rent_adj_yn = 'N';
    $rent_adj_type_code = '';
}else {
    $rent_adj_yn = 'Y';
    $rent_adj_type_code = $_POST['rent_adj_type_code'];
}

$mda_amt = str_replace(",", "", $_POST['mda_amt']);
$rent_amt = str_replace(",", "", $_POST['rent_amt']);
$sql_common = "  comp_seq = '{$_POST['comp_seq']}',                 
                 mda_seq = '{$_POST['mda_seq']}',
                 mda_position = '{$_POST['mda_position']}',
                 asg_use_yn = '{$_POST['asg_use_yn']}',            
                 mda_nm = '{$_POST['mda_nm']}',
                 mda_cnt = '{$_POST['mda_cnt']}',
                 use_yn = '{$_POST['use_yn']}',                 
                 use_st_dt = replace('{$_POST['use_st_dt']}', '-',''),
                 use_ed_dt = replace('{$_POST['use_ed_dt']}', '-',''),
                 use_st_time =replace('{$_POST['use_st_time']}', ':',''),
                 use_ed_time = replace('{$_POST['use_ed_time']}', ':',''),
                 rent_adj_type_code = '{$rent_adj_type_code}',
                 rent_adj_day = '{$_POST['rent_adj_day']}',
                 rent_amt = '{$rent_amt}',
                 rent_adj_yn = '{$rent_adj_yn}',
                 ad_adj_type_code = '{$ad_adj_type_code}',
                 ad_adj_yn = '{$ad_adj_yn}',                 
                 ad_adj_day = '{$_POST['ad_adj_day']}',
                 ad_amt = {$ad_amt},
                 ad_rt = '{$ad_rt}',
                 ins_cnt = '{$_POST['ins_cnt']}',
                 ad_date_type_code = '{$_POST['ad_date_type_code']}', 
                 mda_type_code = '{$_POST['mda_type_code']}',
                 mda_amt = '{$mda_amt}', 
                 bigo = '{$_POST['bigo']}'                                 
                  ";
if ($w == 'I'){
    $result = sql_query(" insert into tb_comp_mda set entr_dt=now(),entr_prsn ='{$member['mb_no']}', {$sql_common} ");

    if($result)  $last_seq_no = sql_insert_id();

    for($i=1; $i<=$_POST['mda_cnt'];$i++){

        $sql_common_assign = "  prod_seq = '{$last_seq_no}',                 
                             asg_num = '".$i."번',      
                             ord = {$i},                            
                             use_yn = 'Y',                             
                             bigo = '{$_POST['mda_comnt']}'                                 
                              ";

        sql_query(" insert into tb_mda_assign set entr_dt=now(),entr_prsn ='{$member['mb_no']}', {$sql_common_assign} ");

    }

    if($last_seq_no >0 ){
        ?>
        <script>
            opener.parent.mtrl_reload();
        </script>
    <?php
        alert("등록 완료", './mda_pro_form_pop.php?w=u&comp_seq='.$_POST['comp_seq'].'&prod_seq='.$last_seq_no);
    }
}else if($w == 'U'){

    //구좌수 바뀌는거 체크 해야함 tb_cont_mda_assign에 이미 등록 되어 있으면 구좌수 수정 안됨
    //tb_cont_mda_assign에 없으면 tb_mda_assign에 그냥 싹 지우고 새로 입력 하자

    $sql = "SELECT a.asg_use_yn, a.mda_cnt 
      FROM tb_comp_mda a  where a.prod_seq='{$_POST['prod_seq']}'";
    $prod = sql_fetch($sql);

    $sql = "SELECT count(*) as cont_cnt
      FROM tb_cont_mda a  where a.prod_seq='{$_POST['prod_seq']}'";
    $cont = sql_fetch($sql);


    //기존 구좌사용 여부 나 구좌수가 변경 되었는지 확인
    if($prod['asg_use_yn'] != $_POST['asg_use_yn']){
        if($cont['cont_cnt'] > 0 ){
            alert("계약이 존재 합니다. 재원 사용여부를 수정 할수 없습니다.", './mda_pro_form_pop.php?w=u&comp_seq='.$_POST['comp_seq'].'&prod_seq='.$_POST['prod_seq']);
        }
    }

    //기존보다 구좌수가 많다면 추가
    if($prod['mda_cnt'] < $_POST['mda_cnt']){
        $addCnt = $_POST['mda_cnt'] - $prod['mda_cnt'];

        $i = $prod['mda_cnt'] +1;
        for($i; $i<=$_POST['mda_cnt'];$i++){

            //갯수 늘릴때 확인으로 수정 2022-12-25 박민상

            $sql = "SELECT ord FROM tb_mda_assign where prod_seq = {$_POST['prod_seq']} and ord = {$i}";
            $result = sql_query($sql);
            $tot = sql_num_rows($result);

            if($tot > 0 ){
                $result = sql_query(" update tb_mda_assign set updt_dt=now(),updt_prsn ='{$member['mb_no']}', use_yn='Y'   where ord ={$i} and prod_seq = {$_POST['prod_seq']}" );

            }else{
                $sql_common_assign = "  prod_seq = '{$_POST['prod_seq']}',                 
                             asg_num = '".$i."번',      
                             ord = {$i},                            
                             use_yn = 'Y',                                                                                  
                             bigo = '{$_POST['mda_comnt']}'                                 
                              ";

                sql_query(" insert into tb_mda_assign set entr_dt=now(),entr_prsn ='{$member['mb_no']}', {$sql_common_assign} ");
            }
        }
        $result = sql_query(" update tb_comp_mda set updt_dt=now(),updt_prsn ='{$member['mb_no']}', {$sql_common}  where prod_seq = {$_POST['prod_seq']}" );

        //exit;
    }else if($prod['mda_cnt'] > $_POST['mda_cnt']){

        /*
        if($cont['cont_cnt'] > 0 ){
            alert("계약이 존재 합니다. 구좌 갯수를 수정 할 수 없습니다.", './mda_pro_form_pop.php?w=u&comp_seq='.$_POST['comp_seq'].'&prod_seq='.$_POST['prod_seq']);
        }else{
            alert("구좌 갯수를 수정 할 수 없습니다.", './mda_pro_form_pop.php?w=u&comp_seq='.$_POST['comp_seq'].'&prod_seq='.$_POST['prod_seq']);
        }
        */

        $result = sql_query(" update tb_mda_assign set updt_dt=now(),updt_prsn ='{$member['mb_no']}', use_yn='N'   where ord > {$_POST['mda_cnt']} and prod_seq = {$_POST['prod_seq']}" );
        $result = sql_query(" update tb_comp_mda set updt_dt=now(),updt_prsn ='{$member['mb_no']}', {$sql_common}  where prod_seq = {$_POST['prod_seq']}" );
    }else{
        $result = sql_query(" update tb_comp_mda set updt_dt=now(),updt_prsn ='{$member['mb_no']}', {$sql_common}  where prod_seq = {$_POST['prod_seq']}" );
    }

?>
<script>
    opener.parent.mtrl_reload();
</script>
<?php
    alert("저장 완료", './mda_pro_form_pop.php?w=u&comp_seq='.$_POST['comp_seq'].'&prod_seq='.$_POST['prod_seq']);
}else if($w == 'D'){

    if(!isset($_POST['prod_seq']) ){
        $prod_seq = $_GET['prod_seq'];
    }else{
        $prod_seq = $_POST['prod_seq'];
    }

    $sql = "SELECT count(*) as cont_cnt
      FROM tb_cont_mda a  where a.prod_seq='{$prod_seq}'";
    $cont = sql_fetch($sql);
    if($cont['cont_cnt'] > 0 ){
        alert("계약이 존재 합니다. 삭제할 수 없습니다.", './mda_pro_form_pop.php?w=u&comp_seq='.$_POST['comp_seq'].'&prod_seq='.$_POST['prod_seq']);
    }

    $result = sql_query(" update tb_comp_mda set updt_dt=now(),updt_prsn ='{$member['mb_no']}', del_yn='Y'  where prod_seq = {$_GET['prod_seq']}" );
?>
<script>
    opener.parent.mtrl_reload();
    alert("삭제 되었습니다.");
    self.close();
</script>
<?php
}
?>
