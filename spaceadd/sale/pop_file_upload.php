<?php

include_once('./_common.php');

$g5['title'] = '파일 업로드';
include_once('./sale.head.popup.php');


//신규 입력
$w = "I";
$upload_max_filesize = ini_get('upload_max_filesize');

?>
    <style type="text/css">
        html {overflow:hidden;}
    </style>
    <form name="f_file" id="f_file" action="./pop_file_upload_update.php" onsubmit="return f_file_submit(this);" method="post" enctype="multipart/form-data">
        <input type="hidden" name="w" value="<?php echo $w ?>">
        <input type="hidden" name="comp_seq" value="<?php echo $_GET['comp_seq'] ?>">
        <input type="hidden" name="token" value=<?php echo get_write_token('online') ?>>


        <div class="tbl_frm01 tbl_wrap">
            <table>
                <tbody>
                <tr>
                    <th scope="row" style="width:120px"><label for="file_content">설명<strong class="sound_only">필수</strong></label></th>
                    <td>
                        <input type="text" name="file_content" id="file_content" maxlength="50" size="50">
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="width:120px"><label for="comp_file">파일선택<strong class="sound_only">필수</strong></label></th>
                    <td>
                        <input type="file" name="comp_file" id="comp_file" title="파일첨부 : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file ">
                    </td>
                </tr>

                </tbody>
            </table>
        </div>

        <!--
    <div class="btn_fixed_top">
        <a href="./comp_list.php?<?php /*echo $qstr */?>" class="btn btn_02">목록</a>
        <input type="submit" value="확인" class="btn_submit btn" accesskey='s'>
    </div>
-->
        <div class="" align="center">

            <button  class="btn btn_save btn_lg" onclick="f_file_submit(this);">저장</button>

            <button  type="button" class="btn btn_close btn_lg" onclick="self.close();">닫기</button>
        </div>



    </form>
    <script>
        function f_file_submit(f)
        {

            return true;
        }
    </script>

    </body>
    </html>
<?php echo html_end(); // HTML 마지막 처리 함수 : 반드시 넣어주시기 바랍니다.