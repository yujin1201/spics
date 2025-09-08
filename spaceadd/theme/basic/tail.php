<?php
?>

    </div>

    </div>

    </div>
    <!-- } 콘텐츠 끝 -->

    <hr>

    <!-- 하단 시작 { -->
    <footer id="ft">
        <p>
            Copyright &copy; spaceAdd. All rights reserved. <?php echo $print_version; ?><br>
            <button type="button" class="scroll_top"><span class="top_img"></span><span class="top_txt">TOP</span></button>
        </p>
    </footer>

<?php

?>

    <!-- } 하단 끝 -->

    <script>
        $(function() {
            // 폰트 리사이즈 쿠키있으면 실행
            font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
        });
    </script>

<?php
include_once(G5_THEME_PATH."/tail.sub.php");