<?php
$sub_menu = "100400";
define('G5_IS_ADMIN', true);
include_once ('../../../common.php');
include_once(G5_ADMIN_PATH.'/admin.lib.php');

if( isset($token) ){
    $token = @htmlspecialchars(strip_tags($token), ENT_QUOTES);
}

run_event('admin_common');

?>

<div class="local_desc01 local_desc">
    <p>
        회원자료 삭제 시 다른 회원이 기존 회원아이디를 사용하지 못하도록 회원아이디, 이름, 닉네임은 삭제하지 않고 영구 보관합니다.
    </p>
</div>


<form name="fmemberlist" id="fmemberlist" action="./member_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">

<div class="tbl_head01 tbl_wrap">
   
</div>

<div class="btn_fixed_top">
    <input type="submit" name="act_button" value="선택수정" onclick="document.pressed=this.value" class="btn btn_02">
    <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value" class="btn btn_02">
    <?php if ($is_admin == 'super') { ?>
    <a href="./member_form.php" id="member_add" class="btn btn_01">회원추가</a>
    <?php } ?>

</div>


</form>

<?php
include_once ('./admin.tail.php');