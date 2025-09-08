<?php
//if (!defined('_INDEX_')) define('_INDEX_', true);
//if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_THEME_PATH.'/head.php');
echo "tettste";
?>


<div class="main">
    <div id="grid" style="width: 100%; background:#000000 ;align-content: center;margin: auto;" >
    </div>	
	<div id="eventslog" style="margin-top: 30px;">
		<div style="width: 200px; float: left; margin-right: 10px;">
			<input value="Remove Filter" id="clearfilteringbutton" type="button" />
			<div style="margin-top: 10px;" id='filterbackground'>Filter Background</div>
			<div style="margin-top: 10px;" id='filtericons'>Show All Filter Icons</div>
		</div>
		<div style="float: left;">
			Event Log:
			<div style="border: none;" id="events">
			</div>
		</div>
	</div>
</div>


<?php
include_once(G5_THEME_PATH.'/tail.php');