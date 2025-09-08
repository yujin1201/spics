<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_URL.'/jPushMenu/style.css">', 0);
add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_URL.'/jPushMenu/jPushMenu.css">', 0);
add_javascript('<script src="'.G5_THEME_URL.'/jPushMenu/jPushMenu.js"></script>', 0);

?>

<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left">
	<h3>Menu</h3>
	<a href="#">Sample Menu2</a>
	<a href="#">Sample Menu</a>
	<a href="#">Sample Menu3</a>
	<a href="#">Sample Menu</a>
	<a href="#">Sample Menu</a>
	<a href="#">Sample Menu</a>
</nav>
<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right">
	<h3>Menu</h3>
	<a href="#">Sample Menu2</a>
	<a href="#">Sample Men2u</a>
	<a href="#">Sample Menu</a>
	<a href="#">Sample Menu</a>
	<a href="#">Sample Menu</a>
	<a href="#">Sample Menu</a>
</nav>
<nav class="cbp-spmenu cbp-spmenu-horizontal cbp-spmenu-top">
	<h3>Menu</h3>
	<a href="#">Sample Menu</a>
	<a href="#">Sample Menu3</a>
	<a href="#">Sample Menu</a>
	<a href="#">Sample Menu3</a>
	<a href="#">Sample Menu</a>
	<a href="#">Sample Menu</a>
	<a href="#">Sample Menu</a>
	<a href="#">Sample Menu</a>
	<a href="#">Sample Menu</a>
	<a href="#">Sample Menu</a>
	<a href="#">Sample Menu</a>
	<a href="#">Sample Menu</a>
</nav>
<nav class="cbp-spmenu cbp-spmenu-horizontal cbp-spmenu-bottom">
	<h3>Menu</h3>
	<a href="#">Sample Menu</a>
	<a href="#">Sample Menu</a>
	<a href="#">Sample Menu</a>
	<a href="#">Sample Menu</a>
	<a href="#">Sample Menu</a>
	<a href="#">Sample Menu</a>
	<a href="#">Sample Menu</a>
	<a href="#">Sample Menu</a>
	<a href="#">Sample Menu</a>
	<a href="#">Sample Menu</a>
	<a href="#">Sample Menu</a>
	<a href="#">Sample Menu</a>
</nav>

<!--call jPushMenu, required-->
<script>
	jQuery(document).ready(function($) {
		$('.toggle-menu').jPushMenu();
	});
</script>