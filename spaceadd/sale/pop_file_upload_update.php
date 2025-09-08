<?php


include_once('./_common.php');

$w = $_POST['w'];

if(!isset($_POST['w']) ){
    $w = $_GET['w'];
}

if($w == 'I'){
    $file_upload_msg = '';

    $upload_max_filesize = ini_get('upload_max_filesize');


    $tmp_file  = $_FILES['comp_file']['tmp_name'];
    $filesize  = $_FILES['comp_file']['size'];
    $filename  = $_FILES['comp_file']['name'];
    $filename  = get_safe_filename($filename);

    if ($filename) {
        if ($_FILES['comp_file']['error'] == 1) {
            $file_upload_msg .= '\"'.$filename.'\" 파일의 용량이 서버에 설정('.$upload_max_filesize.')된 값보다 크므로 업로드 할 수 없습니다.\\n';

        }
        else if ($_FILES['comp_file']['error'] != 0) {
            $file_upload_msg .= '\"'.$filename.'\" 파일이 정상적으로 업로드 되지 않았습니다.\\n';

        }
    }

    if (is_uploaded_file($tmp_file)) {
// 관리자가 아니면서 설정한 업로드 사이즈보다 크다면 건너뜀
        if ( $filesize > $upload_max_filesize) {
            $file_upload_msg .= '\"' . $filename . '\" 파일의 용량(' . number_format($filesize) . ' )이 설정(' . number_format($upload_max_filesize) . ' 바이트)된 값보다 크므로 업로드 하지 않습니다.\\n';

        }
    }


// 프로그램 원래 파일명
    $upload['source'] = $filename;
    $upload['filesize'] = $filesize;
    shuffle($chars_array);
    $shuffle = implode('', $chars_array);
    $upload['file'] = abs(ip2long($_SERVER['REMOTE_ADDR'])).'_'.substr($shuffle,0,8).'_'.replace_filename($filename);

// 아래의 문자열이 들어간 파일은 -x 를 붙여서 웹경로를 알더라도 실행을 하지 못하도록 함
    $filename = preg_replace("/\.(php|pht|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $filename);
    $dest_file = G5_DATA_PATH.'/file/sale/comp/'.$upload['file'];

//echo $dest_file."\n";

    $error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES['comp_file']['error']);

// 올라간 파일의 퍼미션을 변경합니다.
    chmod($dest_file, G5_FILE_PERMISSION);

    $bf_width = isset($upload['image'][0]) ? (int) $upload['image'][0] : 0;
    $bf_height = isset($upload['image'][1]) ? (int) $upload['image'][1] : 0;
    $bf_type = explode(".", $filename);

    $file_type = $bf_type[count($bf_type)-1];

    $sql_common = "  comp_seq = '{$_POST['comp_seq']}',                 
                 file_source = '{$upload['source']}',
                 file_save = '{$upload['file']}',
                 file_download = '{$_POST['file_download']}',
                 file_content = '{$_POST['file_content']}',                                  
                 file_storage = '{$dest_file}',
                 file_size = '{$upload['filesize']}',
                 file_width = '{$bf_width}',
                 file_height = '{$bf_height}',
                 file_type = '{$file_type}'                 
                 ";

    $result = sql_query(" insert into tb_comp_file set entr_dt=now(),entr_prsn ='{$member['mb_no']}', {$sql_common} ");

//echo " insert into tb_comp_file set entr_dt=now(),entr_prsn ='{$member['mb_no']}', {$sql_common} ";

    /* 파일 삭제 나중에 필요하면 개발
    $delete_file = run_replace('delete_file_path', G5_DATA_PATH.'/file/'.$bo_table.'/'.str_replace('../', '', $row['bf_file']), $row);
    if( file_exists($delete_file) ){
        @unlink($delete_file);
    }

    */

?>
<script>
    opener.parent.file_grid_load();
    alert("파일 등록 완료!");
    self.close();
</script>

<?php
}else if($w == 'D'){

    sql_query("update tb_comp_file set del_yn='Y', updt_dt = now(), updt_prsn = '{$member['mb_no']}' where file_seq={$_GET['file_seq']}");
    //echo "update tb_comp_file set del_yn='Y', updt_dt = now(), updt_prsn = '{$member['mb_no']}' where file_seq={$_GET['file_seq']}";
?>
    <script>
        opener.parent.file_grid_load();
        alert("파일 삭제 완료!");
        self.close();
    </script>
<?php
}
?>