<?php
if (!defined('_GNUBOARD_')) exit;

$g5_debug['php']['begin_time'] = $begin_time = get_microtime();

$files = glob(G5_SALE_PATH.'/css/admin_extend_*');
if (is_array($files)) {
    foreach ((array) $files as $k=>$css_file) {

        $fileinfo = pathinfo($css_file);
        $ext = $fileinfo['extension'];

        if( $ext !== 'css' ) continue;

        $css_file = str_replace(G5_SALE_PATH, G5_SALE_URL, $css_file);
        add_stylesheet('<link rel="stylesheet" href="'.$css_file.'">', $k);
    }
}

include_once(G5_PATH.'/head.sub.php');
function print_menu1($key, $no='')
{
    global $menu;

    $str = print_menu2($key, $no);

    return $str;
}

function print_menu2($key, $no='')
{
    global $menu, $auth_menu, $is_admin, $auth, $g5, $sub_menu;

    $str = "<ul>";
    for($i=1; $i<count($menu[$key]); $i++)
    {
        if( ! isset($menu[$key][$i]) ){
            continue;
        }



        $gnb_grp_div = $gnb_grp_style = '';

        if (isset($menu[$key][$i][4])){
            if (($menu[$key][$i][4] == 1 && $gnb_grp_style == false) || ($menu[$key][$i][4] != 1 && $gnb_grp_style == true)) $gnb_grp_div = 'gnb_grp_div';

            if ($menu[$key][$i][4] == 1) $gnb_grp_style = 'gnb_grp_style';
        }

        $current_class = '';

        if ($menu[$key][$i][0] == $sub_menu){
            $current_class = ' on';
        }

        $str .= '<li data-menu="'.$menu[$key][$i][0].'"><a href="'.$menu[$key][$i][2].'" class="gnb_2da '.$gnb_grp_style.' '.$gnb_grp_div.$current_class.'">'.$menu[$key][$i][1].'</a></li>';

        $auth_menu[$menu[$key][$i][0]] = $menu[$key][$i][1];
    }
    $str .= "</ul>";

    return $str;
}

$adm_menu_cookie = array(
    'container' => '',
    'gnb'       => '',
    'btn_gnb'   => '',
);

if( ! empty($_COOKIE['g5_admin_btn_gnb']) ){
    $adm_menu_cookie['container'] = 'container-small';
    $adm_menu_cookie['gnb'] = 'gnb_small';
    $adm_menu_cookie['btn_gnb'] = 'btn_gnb_open';
}

include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');
?>

<script type="text/javascript" src="/spaceadd/sale/js/jquery.alphanum.js"></script>
<script type="text/javascript" src="/spaceadd/sale/js/comm.js?v=20241212"></script>
<script type="text/javascript" src="/spaceadd/sale/js/jqxgrid_comm.js"></script>
<script>
    var tempX = 0;
    var tempY = 0;

    function imageview(id, w, h)
    {

        menu(id);

        var el_id = document.getElementById(id);

        //submenu = eval(name+".style");
        submenu = el_id.style;
        submenu.left = tempX - ( w + 11 );
        submenu.top  = tempY - ( h / 2 );

        selectBoxVisible();

        if (el_id.style.display != 'none')
            selectBoxHidden(id);
    }
</script>
<header id="hd">
    <h1><?php echo $config['cf_title'] ?></h1>
</header>
<script>
    jQuery(function($){

        var menu_cookie_key = 'g5_admin_btn_gnb';

        $(".tnb_mb_btn").click(function(){
            $(".tnb_mb_area").toggle();
        });

        $("#btn_gnb").click(function(){

            var $this = $(this);

            try {
                if( ! $this.hasClass("btn_gnb_open") ){
                    set_cookie(menu_cookie_key, 1, 60*60*24*365);
                } else {
                    delete_cookie(menu_cookie_key);
                }
            }
            catch(err) {
            }

            $("#container").toggleClass("container-small");
            $("#gnb").toggleClass("gnb_small");
            $this.toggleClass("btn_gnb_open");

        });

        $(".gnb_ul li .btn_op" ).click(function() {
            $(this).parent().addClass("on").siblings().removeClass("on");
        });
        jqxgridResizeForList();
        setInputNmber();
        setInputTelNo() ;
        setInputbizNo() ;
        setInputTime() ;

        $( "body" ).css( "background-color", "#FFFFFF" );
    });
</script>
<div id="wrapper_pop"  >
    <div id="container_pop" class="<?php echo $adm_menu_cookie['container']; ?>" style="height:100%;">
        <h1 id="container_pop_title"><?php echo $g5['title'] ?></h1>
        <div class="container_pop_wr" style="height:100%;">
