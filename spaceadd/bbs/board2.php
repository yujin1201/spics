<?php
include_once('./_common.php');

include_once(G5_PATH.'/head.sub.php');


include_once(G5_PATH.'/_head.php');


?>



<?

// 전체목록보이기 사용이 "예" 또는 wr_id 값이 없다면 목록을 보임
//if ($board['bo_use_list_view'] || empty($wr_id))


include_once(G5_BBS_PATH.'/board_tail.php');

include_once(G5_PATH.'/tail.sub.php');