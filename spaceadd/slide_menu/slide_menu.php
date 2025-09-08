<div class="bgs sh-side-demos-container-close"></div>
<script type="text/javascript" src="<?php echo G5_URL ?>/slide_menu/jquery.slide.min.js"></script>
<link rel="stylesheet" href="<?php echo G5_URL ?>/slide_menu/slide.css" />


<div class="sh-side-options sh-side-options-pages mobiles">
    <div class="sh-side-demos-container">

        <!-- 닫기버튼 -->
        <div class="sh-side-demos-container-close close_r">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M17.25 6.75L6.75 17.25" stroke="#141414" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M6.75 6.75L17.25 17.25" stroke="#141414" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <!-- //닫기버튼 -->

        <div class="sh-side-demos-loop">
            <div class="sh-side-demos-loop-container" style="padding:0px 30px 0px 20px">

                <!-- 메뉴 시작 -->

                <div class="r_prof_div">

                    <ul id="DB_navi42">

                        <?php
                        $menu_datas = get_menu_db(0, true);
                        $i = 0;
                        foreach( $menu_datas as $row ){
                            if( empty($row) ) continue;
                        ?>

                        <li class="DB_1D">
                            
                            <!-- 1차 메뉴 { -->
                            <a href="<?php echo $row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>" class="font-b">
                                <?php echo $row['me_name'] ?>
                            </a>
                            <!-- } -->
                            
                            <?php
                                $k = 0;
                                foreach( (array) $row['sub'] as $row2 ){
                                    if( empty($row2) ) continue; 
                                    if($k == 0)
                                    echo '<ul class="DB_2D_wrap">'.PHP_EOL;
                            ?>
                            
                            <!-- 2차 메뉴 { -->
                            <li class="DB_2D"><a href="<?php echo $row2['me_link']; ?>" class="font-b" target="_<?php echo $row2['me_target']; ?>">
                                <?php echo $row2['me_name'] ?></a>
                            </li>
                            <!-- } -->
                        
                            <?php
                                $k++;
                                }   //end foreach $row2
                                if($k > 0)
                                    echo '</ul>'.PHP_EOL;
                            ?>

                        </li>

                        <?php
                            $i++;
                            }   //end foreach $row

                            if ($i == 0) { ?>
                            <span class="font-11 font-r color-999">
                            등록된 메뉴가 없습니다.<br>
                            <a href="<?php echo G5_URL ?>/adm/menu_list.php" target="_blank"><b>환경설정 > 메뉴설정</b></a> 에서 설정해주세요.
                            </span>
                        <?php } ?>


                    </ul>

                    <!-- 메뉴 활성화 { -->
                    <?php
                    $subNum = "null";
                
                    // 아래 예제를 보시고 상황에 맞게 if문으로 ID값을 넣어주고 활성화될 메뉴의 번호를 넣으시면 됩니다.
                    // 메뉴의 번호는 위에서부터 1,2,3 순 입니다. $pageNum = 2; 인경우 두번째 메뉴가 활성화 됩니다.
                    // 내용관리 에서 생성한 페이지는 $co_id, 게시판은 $bo_table 입니다.
                    // 첫번째 메뉴를 활성화 해야되는 페이지가 여러개라면 || 로 구분해주시면 됩니다.
                        
                        // 예제시작 {
                        if($co_id == "test1" || $co_id == "test2") { // 현재 페이지의 Url이 ?co_id=test1 또는 ?co_id=test2 일때
                            $pageNum = 1; // 첫번째 메뉴를 활성화
                        } else if($co_id == "slide_menu1") { // 현재 페이지의 Url이 ?co_id=slide_menu1 일때
                            $pageNum = 2; // 두번째 메뉴를 활성화
                        } else if($bo_table == "test4") { // 현재 페이지의 Url이 ?bo_table=test4 일때
                            $pageNum = 3; // 세번째 메뉴를 활성화
                        } else { // 이도저도 아닐때
                            $pageNum = "null"; // 활성화 하지 않음
                        }
                        // } 예제 끝

                    ?>
                    <!-- } -->

                    <script type="text/javascript">
                        $('#DB_navi42').jquery_slide({
                            key: "n16686",
                            depth1: <?php echo $pageNum ?>,
                            depth2: <?php echo $subNum ?>,
                            depth3: null,
                            motionSpeed: 300 // 메뉴가 아래로 열리는 스피드
                        });
                    </script>

                </div>


                <br>

                <!-- 기타 추가 컨텐츠 { -->
                <div class="cs_div">

                    <div class="cs">
                        <ul class="cs_tit2 font-14 font-m letter-05 color-999">유선상담 안내</ul>
                        <div class="cb"></div>
                    </div>


                    <div class="cs_tel">
                        <ul class="cs_tel_ul1_m" onclick="location.href='tel:02-1234-5678';">
                            <li class="font-b font-18 letter-1 fl">02.1234.5678</li>
                            <li class="fr">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.89286 4.75H6.06818C5.34017 4.75 4.75 5.34017 4.75 6.06818C4.75 13.3483 10.6517 19.25 17.9318 19.25C18.6598 19.25 19.25 18.6598 19.25 17.9318V15.1071L16.1429 13.0357L14.5317 14.6468C14.2519 14.9267 13.8337 15.0137 13.4821 14.8321C12.8858 14.524 11.9181 13.9452 10.9643 13.0357C9.98768 12.1045 9.41548 11.1011 9.12829 10.494C8.96734 10.1537 9.06052 9.76091 9.32669 9.49474L10.9643 7.85714L8.89286 4.75Z" stroke="#141414" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M14 5.02936C16.4312 5.72562 18.3396 7.65944 19 10.1056" stroke="#141414" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </li>
                            <div class="cb"></div>
                        </ul>
                        <div class="cb"></div>
                    </div>

                    <div class="cs_txt2">
                        <ul class="font-12 font-r color-999">평일 오전 10시 ~ 오후 6시<br>점심시간 : 오후 12시 ~ 오후 1시 30분</ul>
                    </div>

                </div>
                <!-- } -->


            </div>
        </div>

    </div>


</div>


<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('.sh-side-options-item-trigger').on('click', function() {
            $('.sh-side-options').css('transition', 'all 600ms cubic-bezier(0.86, 0, 0.07, 1)');

            if ($('.sh-side-options').hasClass('open')) {
                $('.sh-side-options').removeClass('open');
                $('.bgs').show();
            } else {
                $('.sh-side-options .sh-side-demos-image').each(function() {
                    $(this).attr('src', $(this).attr('data-src'));
                });
                $('.sh-side-options').addClass('open');
                $('.bgs').show();
            }

        });

        $('.sh-side-demos-container-close').on('click', function() {
            $('.sh-side-options').css('transition', 'all 600ms cubic-bezier(0.86, 0, 0.07, 1)');
            $('.sh-side-options').removeClass('open');
            $('.bgs').hide();
        });
    });
</script>
<!-- } -->