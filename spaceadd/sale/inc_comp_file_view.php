<?php
include_once('./_common.php');

$g5['title'] = '이미지 크게보기';

$sql = " select * from tb_comp_file where file_seq = '{$_GET['file_seq']}' ";
$file = sql_fetch($sql);

$filename = isset($file['file_save']) ? preg_replace('/[^A-Za-z0-9 _ .\-\/]/', '', $file['file_save']) : '';

if(function_exists('clean_relative_paths')){
    $filename = clean_relative_paths($filename);
}
$extension = pathinfo($filename, PATHINFO_EXTENSION);

if ( ! preg_match('/(jpg|jpeg|png|gif|bmp)$/i', $extension) ){
    alert_close('이미지 확장자가 아닙니다.');
}

$editor_file = '';
$filepath = $file['file_storage'];



$file_exists = (is_file($filepath) && file_exists($filepath)) ? 1 : 0;

if($file_exists = run_replace('exists_view_image', $file_exists, $filepath, $editor_file)) {
    $size = $file_exists ? run_replace('get_view_imagesize', @getimagesize($filepath), $filepath, $editor_file) : array();
    if(empty($size))
        alert_close('이미지 파일이 아닙니다.');

    $width = (isset($size[0]) && $size[0]) ? (int) $size[0] : 0;
    $height = (isset($size[1]) && $size[1]) ? (int) $size[1] : 0;

    //$fileurl = run_replace('get_file_board_url', $filepath, 'tb_comp_file');
    $fileurl = "/spaceadd/data/file/sale/comp/".$file['file_save'];

    $img_attr = ($width && $height) ? 'width="'.$width.'" height="'.$height.'"' : '';

    $img = '<img src="'.$fileurl.'" alt="" '.$img_attr.' class="draggable" style="position:relative;top:0;left:0;">';
} else {
    alert_close('파일이 존재하지 않습니다.');
}

?>

<div class="bbs-view-image"><?php echo $img ?></div>

<script>


</script>

