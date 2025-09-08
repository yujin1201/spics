<?php
define('G5_IS_ADMIN', true);
include_once ('/spaceadd2/www/spaceadd/common.php');
include_once(G5_SALE_PATH.'/sale.lib.php');
if( isset($token) ){
    $token = @htmlspecialchars(strip_tags($token), ENT_QUOTES);
}

//run_event('admin_common');