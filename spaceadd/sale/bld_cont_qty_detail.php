<?php
$sub_menu = "100604";
include_once('./_common.php');

$g5['title'] = '빌딩 계약 상세';
include_once(G5_SALE_PATH.'/sale.head.popup.php');

$bld_seq = isset($_GET['bld_seq']) ? $_GET['bld_seq']  : "";
$st_dt = isset($_GET['st_dt']) ? $_GET['st_dt'] : date( 'Y-m-01' ) ;
$ed_dt = isset($_GET['ed_dt']) ? $_GET['ed_dt'] : date( 'Y-m-t' ) ;

if( $bld_seq  != ""){
    $sql = "select  
          bld_seq
        , bld_num
        , bld_nm
        , zipcode
        , addr1
        , addr2
        , addr3
        , bld_type
        , bld_level
        , bld_floor
        , bld_ev1
        , bld_ev2
        , area1
        , area2
        , bld_pkg
        , ds_type
        , ds_ev1
        , ds_ev2
        , ds_ev3
        , ds_ev4
        , disable_cnt
        , ins_cnt
        , ins_sec
        , use_st_dt
        , use_ed_dt
        , excpt_item
        , bigo
        , use_yn
        , del_yn
        , entr_prsn
        , entr_dt
        , updt_prsn
        , updt_dt
        , ifnull((select comm_cd_nm from tb_code where comm_cd = a.bld_type and comm_type_cd ='BBA'), '')  bld_type_nm
        , ifnull((select comm_cd_nm from tb_code where comm_cd = a.bld_level and comm_type_cd ='BBB'), '')  bld_level_nm
        , ifnull((select comm_cd_nm from tb_code where comm_cd = a.area1 and comm_type_cd ='BBC'), '') area1_nm
        , ifnull((select comm_cd_nm from tb_code where comm_cd = a.area2 and comm_type_cd ='BBD'), '') area2_nm
     
    ,FN_MB_NM(entr_prsn) as entr_prsn
    ,FN_MB_NM(updt_prsn) as updt_prsn 
    from tb_bld  a 
    where bld_seq='{$bld_seq }'";
    $comp = sql_fetch($sql);
}
?>
<style>

    .tbl_frm01 th {
        padding :3px 5px  ;
	}
</style>



    <div class="tbl_frm01 tbl_wrap">
        <table>
            <caption><?php echo $g5['title']; ?></caption>
            <colgroup>
                <col class="grid_2">
                <col class="grid_4">
                <col class="grid_2">
                <col class="grid_4">
            </colgroup>
            <tbody>
            <tr>
                <th scope="row"><label for="bld_nm">빌딩명</label></th>
                <td colspan="3"><?php echo $comp['bld_nm'] ?>
                </td>
              </tr>
            <tr>
                <th scope="row"><label for="bld_num">빌딩코드</label></th>
                <td><?php echo $comp['bld_num'] ?></td>
                <th scope="row"><label for="bld_floor">층수</label></th>
                <td ><?php echo $comp['bld_floor'] ?></td>
            </tr>
            <tr>
                <th scope="row"><label for="bld_type">건물유형</label></th>
                <td  colspan="3"><?php echo $comp['bld_type_nm'] ?></td>
<!--                <th scope="row"><label for="bld_level">건물 등급</label></th>
                <td ><?php /*echo $comp['bld_level_nm'] */?></td>-->
            </tr>
            <tr>
                <th scope="row"><label for="area1">빌딩 권역</label></th>
                <td ><?php echo $comp['area1_nm'].'-'.$comp['area2_nm'] ?></td>
                <th scope="row"><label for="bld_level">엘리베이터</label></th>
                <td>
                    내부 : <?php echo $comp['bld_ev1'] ?>
                    외부 : <?php echo $comp['bld_ev2'] ?>
                </td>
            </tr>
            <tr>
                <th scope="row">주 소</th>
                <td colspan="3" class="td_addr_line">
                    [<?php echo $comp['zipcode']; ?>]<?php echo $comp['addr1'].' '.$comp['addr2'].' '.$comp['addr3'] ?>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="ins_sec">가용초수</label></th>
                <td><?php echo $comp['ins_sec'] ?></td>
                <th scope="row"><label for="ins_cnt">기기수</label></th>
                <td><?php echo $comp['ins_cnt'] ?></td>
                <!--<th scope="row"><label for="use_st_dt"> 운영기간</label></th>
                <td ><?php /*=$comp['use_st_dt'].'~'.$comp['use_ed_dt']*/?></td>-->
            </tr>
            <tr>

                <th scope="row"><label for="disable_cnt">송출불가 기기수</label></th>
                <td><?php echo $comp['disable_cnt'] ?>&nbsp;</td>
                <th scope="row"><label for="excpt_item">금지업종</label></th>
                <td><?=$comp['excpt_item']?>&nbsp;</td>

                <!--<th scope="row"><label for="use_yn">사용여부</label></th>
                <td><?php /*echo $comp['use_yn'] */?></td>-->

            </tr>
            </tbody>
        </table>
    </div>
    <?php if( isset($_GET['bld_seq'])  ) {  ?>
    <div class="subTlt" style="position: relative"  >
        빌딩 계약 내역
    </div>
    <div class="tbl_frm01 tbl_wrap">

        <div id="main_grid" class="tbl_head01 tbl_wrap" style="width: 100%; height:495px;">
            <div id="grid"  style="width: 100%; height: 100%;">
            </div>
            <?php
            include_once('./common/comm_grid_btns.php');
            ?>
        </div>
    </div>
    <div class="" align="center">
        <button  class="btn btn_close btn_lg" onclick="return self.close();">닫기</button>
    </div>
    <?php
    }
    ?>
</form>


<script>
   <?php if( isset($_GET['bld_seq'])  ) {  ?>
   ins_grid_load();

   <!--빌딩 계약내역-->

    function ins_grid_load() {
        $("#grid").jqxGrid('clear');
        var source =
            {
                datatype: "json",
                datafields: [
                    { name: 'cont_bld_seq',type: 'number'},
                    { name: 'cont_seq'},
                    { name: 'bld_seq'},
                    { name: 'mtrl_sec'},
                    { name: 'st_dt'},
                    { name: 'ed_dt'},
                    { name: 'act_st_time'},
                    { name: 'act_ed_time'},
                    { name: 'bigo'},
                    { name: 'bld_nm'},
                    { name: 'ins_sec'},
                    { name: 'cont_nm'},
                    { name: 'cli_seq'},
                    { name: 'agncy_seq'},
                    { name: 'cli_nm'},
                    { name: 'agncy_nm'},
                    { name: 'entr_prsn'},
                    { name: 'entr_dt'},
                    { name: 'updt_prsn'} ,
                    { name: 'bld_div'} ,
                    { name: 'cont_div'} ,
                ],
                url: g_sale_url+'/bld_cont_list_result.php',
                cache: false,
                data: {
                    bld_seq: '<?=$bld_seq?>',
                    st_dt: '<?=$st_dt?>',
                    ed_dt: '<?=$ed_dt?>',
                }
            };
        var adapter = new $.jqx.dataAdapter(source);

        $("#grid").jqxGrid(
            {
                width: '100%',
                height: '100%',
                source: adapter,
                filterable: true,
                filterbarmode: 'simple',
                sortable: true,
                ready: function () {
                    addfilter();
                },
                showfilterbar: true,
                showstatusbar: false,
                statusbarheight: 27,
                showaggregates: true,
                autoshowfiltericon: true,
                columnsresize: true,
                columnsreorder: true,
                showgroupsheader: false ,
                columns: [
                    {
                        text: '#', columntype: 'number', width:50,cellsalign: 'center', align: 'center',filtertype: 'checkedlist',
                        cellsrenderer: cellRowNum ,
                        aggregates: ['count'] ,
                        aggregatesrenderer: aggCount ,
                    },
                    { text: '시작일', datafield: 'st_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:100 ,cellsrenderer : cellYmd },
                    { text: '시작일', datafield: 'ed_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:100 ,cellsrenderer : cellYmd },
                    { text: '적용초수', datafield: 'mtrl_sec', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:100  },
                    { text: '계약명', datafield: 'cont_nm',    filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:250},
                    { text: '광고주', datafield: 'cli_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150},
                    { text: '광고회사', datafield: 'agncy_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150},

                    { text: '등록자', datafield: 'entr_prsn', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:130},
                    { text: '등록일', datafield: 'entr_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:130},
                    { text: '수정자', datafield: 'updt_prsn', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:130},
                    { text: '수정일', datafield: 'updt_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:130} ,
                    {datafield: 'bld_seq', hidden: true,  },
                    {datafield: 'bld_div', hidden: true, text: '빌딩명',  } ,
                    {datafield: 'cont_div', hidden: true, text: '계약명',  }

                ]
            });
    }
    <?php
    }
    ?>
</script>

<?php
include_once(G5_PATH.'/tail.sub.php');
?>