<?
header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-Disposition: attachment; filename = 매체사_매체비.xls" );
header( "Content-Description: PHP4 Generated Data" );

?>
<?php
include_once('./_common.php');
//출력 공통
$mda_comp_seq =  $_GET['mda_comp_seq']  ;
$angcy_comp_seq = 100  ;   /*스페이스애드*/
include_once('cont_form_pop_print_comm.php');

?>
<html xmlns:v="urn:schemas-microsoft-com:vml"
      xmlns:o="urn:schemas-microsoft-com:office:office"
      xmlns:x="urn:schemas-microsoft-com:office:excel"
      xmlns="http://www.w3.org/TR/REC-html40">

<head>
    <meta http-equiv=Content-Type content="text/html; charset=utf-8">
    <meta name=ProgId content=Excel.Sheet>
    <meta name=Generator content="Microsoft Excel 15">
    <!--[if !mso]>
    <style>
        v\:* {behavior:url(#default#VML);}
        o\:* {behavior:url(#default#VML);}
        x\:* {behavior:url(#default#VML);}
        .shape {behavior:url(#default#VML);}
    </style>
    <![endif]-->
    <style id="mda_BAJ02_16175_Styles">
        <!--table
        {mso-displayed-decimal-separator:"\.";
            mso-displayed-thousand-separator:"\,";}
        @page
        {margin:.75in .7in .75in .7in;
            mso-header-margin:.3in;
            mso-footer-margin:.3in;}
        .font5
        {color:windowtext;
            font-size:8.0pt;
            font-weight:400;
            font-style:normal;
            text-decoration:none;
            font-family:"맑은 고딕";
            mso-generic-font-family:auto;
            mso-font-charset:129;}
        tr
        {mso-height-source:auto;
            mso-ruby-visibility:none;}
        col
        {mso-width-source:auto;
            mso-ruby-visibility:none;}
        br
        {mso-data-placement:same-cell;}
        .style17
        {mso-number-format:"_-* \#\,\#\#0_-\;\\-* \#\,\#\#0_-\;_-* \0022-\0022_-\;_-\@_-";
            mso-style-name:"쉼표 \[0\]";
            mso-style-id:6;}
        .style0
        {mso-number-format:General;
            text-align:general;
            vertical-align:middle;
            white-space:nowrap;
            mso-rotate:0;
            mso-background-source:auto;
            mso-pattern:auto;
            color:black;
            font-size:11.0pt;
            font-weight:400;
            font-style:normal;
            text-decoration:none;
            font-family:"맑은 고딕";
            mso-generic-font-family:auto;
            mso-font-charset:129;
            border:none;
            mso-protection:locked visible;
            mso-style-name:표준;
            mso-style-id:0;}
        .style16
        {color:#0563C1;
            font-size:11.0pt;
            font-weight:400;
            font-style:normal;
            text-decoration:underline;
            text-underline-style:single;
            font-family:"맑은 고딕";
            mso-generic-font-family:auto;
            mso-font-charset:129;
            mso-style-name:하이퍼링크;
            mso-style-id:8;}
        a:link
        {color:#0563C1;
            font-size:11.0pt;
            font-weight:400;
            font-style:normal;
            text-decoration:underline;
            text-underline-style:single;
            font-family:"맑은 고딕";
            mso-generic-font-family:auto;
            mso-font-charset:129;}
        a:visited
        {color:#954F72;
            font-size:11.0pt;
            font-weight:400;
            font-style:normal;
            text-decoration:underline;
            text-underline-style:single;
            font-family:"맑은 고딕";
            mso-generic-font-family:auto;
            mso-font-charset:129;}
        td
        {mso-style-parent:style0;
            padding:0px;
            mso-ignore:padding;
            color:black;
            font-size:11.0pt;
            font-weight:400;
            font-style:normal;
            text-decoration:none;
            font-family:"맑은 고딕";
            mso-generic-font-family:auto;
            mso-font-charset:129;
            mso-number-format:General;
            text-align:general;
            vertical-align:middle;
            border:none;
            mso-background-source:auto;
            mso-pattern:auto;
            mso-protection:locked visible;
            white-space:nowrap;
            mso-rotate:0;}
        .xl65
        {mso-style-parent:style0;
            font-size:18.0pt;
            font-weight:700;}
        .xl66
        {mso-style-parent:style0;
            border-top:none;
            border-right:none;
            border-bottom:1.0pt solid windowtext;
            border-left:none;}
        .xl67
        {mso-style-parent:style0;
            font-size:12.0pt;
            font-weight:700;}
        .xl68
        {mso-style-parent:style0;
            font-size:10.0pt;
            border:.5pt solid windowtext;}
        .xl69
        {mso-style-parent:style0;
            font-size:10.0pt;}
        .xl70
        {mso-style-parent:style0;
            font-size:9.0pt;
            text-align:center;
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:.5pt solid windowtext;}
        .xl71
        {mso-style-parent:style0;
            font-size:9.0pt;
            text-align:center;
            border:.5pt solid windowtext;}
        .xl72
        {mso-style-parent:style0;
            border-top:none;
            border-right:none;
            border-bottom:none;
            border-left:.5pt solid windowtext;}
        .xl73
        {mso-style-parent:style0;
            border-top:none;
            border-right:.5pt solid windowtext;
            border-bottom:none;
            border-left:.5pt solid windowtext;}
        .xl74
        {mso-style-parent:style0;
            border-top:none;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:.5pt solid windowtext;}
        .xl75
        {mso-style-parent:style0;
            border-top:none;
            border-right:.5pt solid windowtext;
            border-bottom:.5pt solid windowtext;
            border-left:.5pt solid windowtext;}
        .xl76
        {mso-style-parent:style0;
            color:white;
            font-size:10.0pt;
            font-weight:700;
            text-align:center;
            border:.5pt solid windowtext;
            background:gray;
            mso-pattern:black none;}
        .xl77
        {mso-style-parent:style0;
            text-align:right;}
        .xl78
        {mso-style-parent:style0;
            color:white;
            font-size:10.0pt;
            font-weight:700;
            text-align:center;
            border-top:.5pt solid windowtext;
            border-right:.5pt solid windowtext;
            border-bottom:.5pt solid windowtext;
            border-left:none;
            background:gray;
            mso-pattern:black none;}
        .xl79
        {mso-style-parent:style17;
            font-size:10.0pt;
            font-weight:700;
            mso-number-format:"\#\,\#\#\#\0022원\0022";
            text-align:center;
            border-top:none;
            border-right:.5pt solid windowtext;
            border-bottom:.5pt solid windowtext;
            border-left:none;}
        .xl80
        {mso-style-parent:style17;
            font-size:10.0pt;
            font-weight:700;
            mso-number-format:"\#\,\#\#\#\0022원\0022";
            text-align:center;
            border-top:none;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:none;}
        .xl81
        {mso-style-parent:style17;
            font-size:10.0pt;
            font-weight:700;
            mso-number-format:"\#\,\#\#\#\0022원\0022";
            border-top:none;
            border-right:.5pt solid windowtext;
            border-bottom:.5pt solid windowtext;
            border-left:.5pt solid windowtext;}
        .xl82
        {mso-style-parent:style17;
            font-size:10.0pt;
            mso-number-format:"Long Date";
            border-top:none;
            border-right:.5pt solid windowtext;
            border-bottom:2.0pt double windowtext;
            border-left:.5pt solid windowtext;
            white-space:normal;}
        .xl83
        {mso-style-parent:style17;
            font-size:10.0pt;
            mso-number-format:"\#\,\#\#\#\0022원\0022";
            border-top:none;
            border-right:.5pt solid windowtext;
            border-bottom:2.0pt double windowtext;
            border-left:.5pt solid windowtext;}
        .xl84
        {mso-style-parent:style17;
            font-size:10.0pt;
            mso-number-format:"\#\,\#\#\#\0022원\0022";
            text-align:right;
            border-top:.5pt solid windowtext;
            border-right:.5pt solid windowtext;
            border-bottom:2.0pt double windowtext;
            border-left:.5pt solid windowtext;}
        .xl85
        {mso-style-parent:style17;
            font-size:10.0pt;
            mso-number-format:"Long Date";
            border-top:none;
            border-right:.5pt solid windowtext;
            border-bottom:.5pt solid windowtext;
            border-left:.5pt solid windowtext;
            white-space:normal;}
        .xl86
        {mso-style-parent:style17;
            font-size:10.0pt;
            mso-number-format:"\#\,\#\#\#\0022원\0022";
            text-align:center;
            border:.5pt solid windowtext;}
        .xl87
        {mso-style-parent:style17;
            font-size:10.0pt;
            mso-number-format:"\#\,\#\#\#\0022원\0022";
            text-align:right;
            border:.5pt solid windowtext;}
        .xl88
        {mso-style-parent:style17;
            font-size:10.0pt;
            mso-number-format:"Long Date";
            border:.5pt solid windowtext;
            white-space:normal;}
        .xl89
        {mso-style-parent:style0;
            font-size:12.0pt;
            font-weight:700;
            
            mso-pattern:black none;}
        .xl90
        {mso-style-parent:style0;
            font-size:10.0pt;
            
            mso-pattern:black none;}
        .xl91
        {mso-style-parent:style0;
            font-size:10.0pt;
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:.5pt solid windowtext;}
        .xl92
        {mso-style-parent:style0;
            font-size:10.0pt;
            border-top:.5pt solid windowtext;
            border-right:.5pt solid windowtext;
            border-bottom:.5pt solid windowtext;
            border-left:none;}
        .xl93
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:center;
            border:.5pt solid windowtext;}
        .xl94
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:center;
            border:.5pt solid windowtext;
            white-space:normal;}
        .xl95
        {mso-style-parent:style0;
            font-size:10.0pt;
            font-weight:700;
            text-align:left;
            
            mso-pattern:black none;
            padding-left:12px;
            mso-char-indent-count:1;}
        .xl96
        {mso-style-parent:style0;
            mso-number-format:"Long Date";
            text-align:right;}
        .xl97
        {mso-style-parent:style0;
            color:windowtext;
            text-align:center;
            background:#F2F2F2;
            mso-pattern:black none;}
        .xl98
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:center;
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:.5pt solid windowtext;}
        .xl99
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:center;
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:none;}
        .xl100
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:center;
            border-top:.5pt solid windowtext;
            border-right:.5pt solid windowtext;
            border-bottom:.5pt solid windowtext;
            border-left:none;}
        .xl101
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:left;
            border:.5pt solid windowtext;}
        .xl102
        {mso-style-parent:style17;
            font-size:10.0pt;
            mso-number-format:"\#\,\#\#\#\0022원\0022";
            text-align:left;
            border:.5pt solid windowtext;}
        .xl103
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:left;
            border-top:.5pt solid windowtext;
            border-right:.5pt solid windowtext;
            border-bottom:none;
            border-left:.5pt solid windowtext;}
        .xl104
        {mso-style-parent:style16;
            color:#0563C1;
            text-decoration:underline;
            text-underline-style:single;
            text-align:left;
            border:.5pt solid windowtext;}
        .xl105
        {mso-style-parent:style16;
            color:#0563C1;
            font-size:10.0pt;
            text-decoration:underline;
            text-underline-style:single;
            text-align:left;
            border:.5pt solid windowtext;}
        .xl106
        {mso-style-parent:style0;
            color:white;
            font-size:10.0pt;
            font-weight:700;
            text-align:center;
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:.5pt solid windowtext;
            background:gray;
            mso-pattern:black none;}
        .xl107
        {mso-style-parent:style0;
            color:white;
            font-size:10.0pt;
            font-weight:700;
            text-align:center;
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:none;
            background:gray;
            mso-pattern:black none;}
        .xl108
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:left;
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:.5pt solid windowtext;}
        .xl109
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:left;
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:none;}
        .xl110
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:left;
            border-top:.5pt solid windowtext;
            border-right:.5pt solid windowtext;
            border-bottom:.5pt solid windowtext;
            border-left:none;}
        .xl111
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:left;
            border:.5pt solid windowtext;
            background:white;
            mso-pattern:black none;}
        .xl112
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:left;
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:none;
            border-left:.5pt solid windowtext;}
        .xl113
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:left;
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:none;
            border-left:none;}
        .xl114
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:left;
            border-top:.5pt solid windowtext;
            border-right:.5pt solid windowtext;
            border-bottom:none;
            border-left:none;}
        .xl115
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:left;
            border-top:none;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:.5pt solid windowtext;}
        .xl116
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:left;
            border-top:none;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:none;}
        .xl117
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:left;
            border-top:none;
            border-right:.5pt solid windowtext;
            border-bottom:.5pt solid windowtext;
            border-left:none;}
        .xl118
        {mso-style-parent:style0;
            font-size:10.0pt;
            font-weight:700;
            text-align:center;
            border-top:2.0pt double windowtext;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:.5pt solid windowtext;}
        .xl119
        {mso-style-parent:style0;
            font-size:10.0pt;
            font-weight:700;
            text-align:center;
            border-top:2.0pt double windowtext;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:none;}
        .xl120
        {mso-style-parent:style0;
            font-size:10.0pt;
            font-weight:700;
            text-align:center;
            border-top:2.0pt double windowtext;
            border-right:.5pt solid windowtext;
            border-bottom:.5pt solid windowtext;
            border-left:none;}
        .xl121
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:left;
            border-top:none;
            border-right:.5pt solid windowtext;
            border-bottom:.5pt solid windowtext;
            border-left:.5pt solid windowtext;}
        .xl122
        {mso-style-parent:style0;
            font-size:10.0pt;
            border:.5pt solid windowtext;
            mso-pattern:black none;}
        ruby
        {ruby-align:left;}
        rt
        {color:windowtext;
            font-size:8.0pt;
            font-weight:400;
            font-style:normal;
            text-decoration:none;
            font-family:"맑은 고딕";
            mso-generic-font-family:auto;
            mso-font-charset:129;
            mso-char-type:none;
            display:none;}
        -->
    </style>
</head>

<body link="#0563C1" vlink="#954F72">
<div id="mda_BAJ02_16175" align=center x:publishsource="Excel">
    <table border=0 cellpadding=0 cellspacing=0 width=1173 style='border-collapse: collapse;table-layout:fixed;width:881pt'>
        <col width=24 style='mso-width-source:userset;mso-width-alt:768;width:18pt'>
        <col width=223 style='mso-width-source:userset;mso-width-alt:7125;width:167pt'>
        <col width=117 span=4 style='mso-width-source:userset;mso-width-alt:3754;width:88pt'>
        <col width=124 style='mso-width-source:userset;mso-width-alt:3968;width:93pt'>
        <col width=137 style='mso-width-source:userset;mso-width-alt:4394;width:103pt'>
        <col width=173 style='mso-width-source:userset;mso-width-alt:5546;width:130pt'>
        <col width=24 style='mso-width-source:userset;mso-width-alt:768;width:18pt'>
        <tr height=28 style='mso-height-source:userset;height:21.0pt'>
            <td height=28 width=24 style='height:21.0pt;width:18pt'><a name="Print_Area"></a></td>
            <td width=223 style='width:167pt'></td>
            <td width=117 style='width:88pt'></td>
            <td width=117 style='width:88pt'></td>
            <td width=117 style='width:88pt'></td>
            <td width=117 style='width:88pt'></td>
            <td width=124 style='width:93pt'></td>
            <td width=137 style='width:103pt'></td>
            <td width=173 style='width:130pt' align=left valign=top><!--[if gte vml 1]><v:shapetype
                        id="_x0000_t75" coordsize="21600,21600" o:spt="75" o:preferrelative="t"
                        path="m@4@5l@4@11@9@11@9@5xe" filled="f" stroked="f">
                    <v:stroke joinstyle="miter"/>
                    <v:formulas>
                        <v:f eqn="if lineDrawn pixelLineWidth 0"/>
                        <v:f eqn="sum @0 1 0"/>
                        <v:f eqn="sum 0 0 @1"/>
                        <v:f eqn="prod @2 1 2"/>
                        <v:f eqn="prod @3 21600 pixelWidth"/>
                        <v:f eqn="prod @3 21600 pixelHeight"/>
                        <v:f eqn="sum @0 0 1"/>
                        <v:f eqn="prod @6 1 2"/>
                        <v:f eqn="prod @7 21600 pixelWidth"/>
                        <v:f eqn="sum @8 21600 0"/>
                        <v:f eqn="prod @7 21600 pixelHeight"/>
                        <v:f eqn="sum @10 21600 0"/>
                    </v:formulas>
                    <v:path o:extrusionok="f" gradientshapeok="t" o:connecttype="rect"/>
                    <o:lock v:ext="edit" aspectratio="t"/>
                </v:shapetype><v:shape id="그림_x0020_1" o:spid="_x0000_s2049" type="#_x0000_t75"
                                       style='position:absolute;margin-left:64pt;margin-top:14pt;width:67pt;
   height:51pt;z-index:1;visibility:visible' o:gfxdata="">
                    <v:imagedata src="<?=$io_img_logo?>" o:title=""/>
                    <x:ClientData ObjectType="Pict">
                        <x:SizeWithCells/>
                    </x:ClientData>
                </v:shape><![endif]--><![if !vml]><span style='mso-ignore:vglayout;
  position:absolute;z-index:1;margin-left:85px;margin-top:19px;width:89px;
  height:68px'><img width=67 height=51
                    src="<?=$io_img_logo?>" v:shapes="그림_x0020_1"></span><![endif]><span
                        style='mso-ignore:vglayout2'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td height=28 width=173 style='height:21.0pt;width:130pt'></td>
   </tr>
  </table>
  </span></td>
            <td width=24 style='width:18pt'></td>
        </tr>
        <tr height=36 style='height:27.0pt'>
            <td height=36 style='height:27.0pt'></td>
            <td class=xl65>Insertion Order</td>
            <td colspan=8 style='mso-ignore:colspan'></td>
        </tr>
        <tr height=24 style='height:18.0pt'>
            <td height=24 style='height:18.0pt'></td>
            <td class=xl66>　</td>
            <td class=xl66>　</td>
            <td class=xl66>　</td>
            <td class=xl66>　</td>
            <td class=xl66>　</td>
            <td class=xl66>　</td>
            <td class=xl66>　</td>
            <td class=xl66>　</td>
            <td></td>
        </tr>
        <tr height=23 style='height:17.0pt'>
            <td height=23 colspan=10 style='height:17.0pt;mso-ignore:colspan'></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 style='height:20.0pt'></td>
            <td class=xl67>Campaign Information</td>
            <td colspan=8 style='mso-ignore:colspan'></td>
        </tr>
        <tr height=24 style='mso-height-source:userset;height:18.0pt'>
            <td height=24 style='height:18.0pt'></td>
            <td class=xl68>광고주명</td>
            <td colspan=3 class=xl101 style='border-left:none'><?echo $cont['cli_nm']?>　</td>
            <td class=xl68 style='border-left:none'>캠페인명</td>
            <td colspan=3 class=xl122 style='border-left:none'><?echo $cont['campgn_nm']?></td>
            <td class=xl69></td>
        </tr>
        <tr height=24 style='mso-height-source:userset;height:18.0pt'>
            <td height=24 style='height:18.0pt'></td>
            <td class=xl68 style='border-top:none'>광고기간</td>
            <td colspan=3 class=xl101 style='border-left:none'><?echo $cont['cont_terms']?>　</td>
            <td class=xl68 style='border-top:none;border-left:none'>입금가</td>
            <td colspan=3 class=xl102 style='border-left:none'><?echo $cont['cont_amt']?>　　</td>
            <td></td>
        </tr>
        <tr height=24 style='mso-height-source:userset;height:18.0pt'>
            <td height=24 colspan=10 style='height:18.0pt;mso-ignore:colspan'></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 style='height:20.0pt'></td>
            <td class=xl67>Agency Information</td>
            <td></td>
            <td class=xl95><span style='mso-spacerun:yes'></td>
            <td colspan=6 style='mso-ignore:colspan'></td>
        </tr>
        <tr height=24 style='mso-height-source:userset;height:18.0pt'>
            <td height=24 style='height:18.0pt'></td>
            <td class=xl68>매체사명</td>
            <td colspan=3 class=xl101 style='border-left:none'><?echo $comp_sa['comp_nm']?></td>
            <td class=xl68 style='border-left:none'>사업자등록번호</td>
            <td colspan=3 class=xl101 style='border-left:none'><?echo $comp_sa['busi_no']?></td>
            <td></td>
        </tr>
        <tr height=24 style='mso-height-source:userset;height:18.0pt'>
            <td height=24 style='height:18.0pt'></td>
            <td rowspan=2 class=xl101 style='border-top:none'>주소</td>
            <td colspan=3 class=xl103><?echo $comp_sa['addr']?></td>
            <td class=xl68 style='border-top:none'>전화</td>
            <td colspan=3 class=xl101 style='border-left:none'><?echo $comp_sa['tel_no']?></td>
            <td></td>
        </tr>
        <tr height=24 style='mso-height-source:userset;height:18.0pt'>
            <td height=24 style='height:18.0pt'></td>
            <td colspan=3 class=xl121 style='border-left:none'><?echo $comp_sa['addr3']?></td>
            <td class=xl68 style='border-top:none;border-left:none'>이메일</td>
            <td colspan=3 class=xl104 style='border-left:none'></td>
            <td></td>
        </tr>
        <tr height=24 style='mso-height-source:userset;height:18.0pt'>
            <td height=24 style='height:18.0pt'></td>
            <td class=xl68 style='border-top:none'>담당부서</td>
            <td colspan=3 class=xl101 style='border-left:none'></td>
            <td class=xl68 style='border-top:none;border-left:none'>담당자명</td>
            <td colspan=3 class=xl101 style='border-left:none'></td>
            <td></td>
        </tr>
        <tr height=24 style='mso-height-source:userset;height:18.0pt'>
            <td height=24 colspan=10 style='height:18.0pt;mso-ignore:colspan'></td>
        </tr>
        <!--매체사 정보-->
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 style='height:20.0pt'></td>
            <td class=xl67>Media Information</td>
            <td></td>
            <td class=xl95><span style='mso-spacerun:yes'></td>
            <td colspan=6 style='mso-ignore:colspan'></td>
        </tr>
        <tr height=24 style='mso-height-source:userset;height:18.0pt'>
            <td height=24 style='height:18.0pt'></td>
            <td class=xl68>브랜드명</td>
            <td colspan=3 class=xl108 style='border-right:.5pt solid black'><?echo $comp_mda['comp_nm']?>　</td>
            <td class=xl68>사업자등록번호</td>
            <td colspan=3 class=xl111 style='border-left:none'><?echo $comp_mda['busi_no']?>　</td>
            <td></td>
        </tr>
        <tr height=24 style='mso-height-source:userset;height:18.0pt'>
            <td height=24 style='height:18.0pt'></td>
            <td rowspan=2 class=xl101 style='border-top:none'>주소</td>
            <td colspan=3 class=xl112 style='border-right:.5pt solid black'><?echo $comp_mda['addr']?>　</td>
            <td class=xl68 style='border-top:none'>전화</td>
            <td colspan=3 class=xl101 style='border-left:none'><?echo $comp_mda['tel_no']?>　</td>
            <td></td>
        </tr>
        <tr height=24 style='mso-height-source:userset;height:18.0pt'>
            <td height=24 style='height:18.0pt'></td>
            <td colspan=3 class=xl115 style='border-right:.5pt solid black'><?echo $comp_mda['addr3']?>　　</td>
            <td class=xl68 style='border-top:none'>이메일</td>
            <td colspan=3 class=xl104 style='border-left:none'><a href="mailto:<?echo $comp_mda['psrn_email']?>"><?echo $comp_mda['psrn_email']?></a></td>
            <td></td>
        </tr>
        <tr height=24 style='mso-height-source:userset;height:18.0pt'>
            <td height=24 style='height:18.0pt'></td>
            <td class=xl68 style='border-top:none'>담당부서</td>
            <td colspan=3 class=xl101 style='border-left:none'>　</td>
            <td class=xl68 style='border-top:none;border-left:none'>담당자명</td>
            <td colspan=3 class=xl101 style='border-left:none'><?echo $comp_mda['psrn_nm']?>　</td>
            <td></td>
        </tr>
        <tr height=24 style='mso-height-source:userset;height:18.0pt'>
            <td height=24 colspan=10 style='height:18.0pt;mso-ignore:colspan'></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 style='height:20.0pt'></td>
            <td class=xl89>Media Mix Information</td>
            <td colspan=8 style='mso-ignore:colspan'></td>
        </tr>
        <tr height=24 style='mso-height-source:userset;height:18.0pt'>
            <td height=24 style='height:18.0pt'></td>
            <td class=xl76>상품</td>
            <td class=xl76 style='border-left:none'>구좌</td>
            <td colspan=3 class=xl106 style='border-right:.5pt solid black'>기간</td>
            <td class=xl76>입금가</td>
            <td class=xl76 style='border-left:none'>항목</td>
            <td class=xl78>비고</td>
            <td></td>
        </tr>
        <?
        $idx = 0 ;
        $total = 0 ;
        $total1 = 0 ;
        foreach ($cont_f as $item) {
        $item['terms'] = date('Y.m.d',strtotime($item['st_dt']))." ~ ".date('Y.m.d',strtotime($item['st_dt']));
        $total =$total + $item['sell_amt'] ;
        $total1 =  $item['cont_amt'] ;
        ?>
        <tr height=24 style='mso-height-source:userset;height:18.0pt'>
            <td height=24 style='height:18.0pt'></td>
            <td class=xl94 style='border-top:none'><?echo $item['mda_nm']?></td>
            <td class=xl94 style='border-top:none;border-left:none'><?echo $item['account_cnt']?>　</td>
            <td colspan=3 class=xl98 style='border-right:.5pt solid black'>　<?echo $item['terms']?></td>
            <td class=xl87 style='border-top:none'></td>
            <td class=xl86 style='border-top:none;border-left:none'></td>
            <td class=xl85 width=173 style='border-left:none;width:130pt'>　</td>
            <td></td>
        </tr>
            <?
            $idx++ ;
        }
        ?>
        <tr height=24 style='mso-height-source:userset;height:18.0pt'>
            <td height=24 style='height:18.0pt'></td>
            <td class=xl91>　</td>
            <td class=xl92>　</td>
            <td colspan=3 class=xl98 style='border-right:.5pt solid black;border-left: none'>　</td>
            <td class=xl84 style='border-left:none'>　</td>
            <td class=xl83>　</td>
            <td class=xl82 width=173 style='width:130pt'>　</td>
            <td></td>
        </tr>
        <tr height=24 style='height:18.0pt'>
            <td height=24 style='height:18.0pt'></td>
            <td colspan=5 class=xl118 style='border-right:.5pt solid black'>TOTAL</td>
            <td class=xl81 align=right></td>
            <td class=xl80>　</td>
            <td class=xl79>　</td>
            <td></td>
        </tr>
        <tr height=23 style='height:17.0pt'>
            <td height=23 colspan=10 style='height:17.0pt;mso-ignore:colspan'></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 style='height:20.0pt'></td>
            <td class=xl67>Billing Information</td>
            <td class=xl90></td>
            <td colspan=2 style='mso-ignore:colspan'></td>
            <td class=xl67>Remark</td>
            <td class=xl90></td>
            <td colspan=3 style='mso-ignore:colspan'></td>
        </tr>
        <tr height=23 style='height:17.0pt'>
            <td height=23 style='height:17.0pt'></td>
            <td class=xl69 colspan=3 style='mso-ignore:colspan'><span style='mso-spacerun:yes'> </span>- 지불 금액 상기에 표시된 금액은 부가세 별도 금액입니다.</td>
            <td class=xl69></td>
            <td class=xl69 colspan=3 style='mso-ignore:colspan'><span style='mso-spacerun:yes'> </span>- 세금계산서 청구월 및 금액 확인후 승인해주시기 바랍니다.</td>
            <td class=xl69></td>
            <td></td>
        </tr>
        <tr height=23 style='height:17.0pt'>
            <td height=23 style='height:17.0pt'></td>
            <td class=xl69 colspan=2 style='mso-ignore:colspan'><span  style='mso-spacerun:yes'> </span>- 세금계산서 발행일 : 집행월 말일자로 발행</td>
            <td class=xl69></td>
            <td class=xl69></td>
            <td class=xl69></td>
            <td class=xl69></td>
            <td class=xl69></td>
            <td class=xl69></td>
            <td></td>
        </tr>
        <tr height=23 style='height:17.0pt'>
            <td height=23 style='height:17.0pt'></td>
            <td class=xl69 colspan=2 style='mso-ignore:colspan'><span style='mso-spacerun:yes'> </span>- 세금계산서 발송 :<span style='mso-spacerun:yes'> 
  </span>tax@spaceadd.com</td>
            <td class=xl69></td>
            <td class=xl69></td>
            <td class=xl69></td>
            <td class=xl69></td>
            <td class=xl69></td>
            <td class=xl69></td>
            <td></td>
        </tr>
        <tr height=23 style='height:17.0pt'>
            <td height=23 style='height:17.0pt'></td>
            <td class=xl90><span style='mso-spacerun:yes'> </span>- 지불조건 : 세금계산서 발행일 기준으로 XX일 후 현금입금.</td>
            <td class=xl69></td>
            <td class=xl69></td>
            <td class=xl69></td>
            <td class=xl69></td>
            <td class=xl69></td>
            <td class=xl69></td>
            <td class=xl69></td>
            <td></td>
        </tr>
        <tr height=24 style='height:18.0pt'>
            <td height=24 style='height:18.0pt'></td>
            <td class=xl66>　</td>
            <td class=xl66>　</td>
            <td class=xl66>　</td>
            <td class=xl66>　</td>
            <td class=xl66>　</td>
            <td class=xl66>　</td>
            <td class=xl66>　</td>
            <td class=xl66>　</td>
            <td></td>
        </tr>
        <tr height=23 style='height:17.0pt'>
            <td height=23 colspan=10 style='height:17.0pt;mso-ignore:colspan'></td>
        </tr>
        <tr height=23 style='height:17.0pt'>
            <td height=23 style='height:17.0pt'></td>
            <td colspan=2 style='mso-ignore:colspan'>본 Insertion Order는 광고계약서를 대신합니다.</td>
            <td colspan=7 style='mso-ignore:colspan'></td>
        </tr>
        <tr height=23 style='height:17.0pt'>
            <td height=23 colspan=10 style='height:17.0pt;mso-ignore:colspan'></td>
        </tr>
        <tr height=23 style='height:17.0pt'>
            <td height=23 colspan=6 style='height:17.0pt;mso-ignore:colspan'></td>
            <td colspan=3 style='mso-ignore:colspan'><span  style='mso-spacerun:yes'>            </span>위와 같이 광고게재를 신청합니다.</td>
            <td></td>
        </tr>
        <tr height=23 style='height:17.0pt'>
            <td height=23 colspan=6 style='height:17.0pt;mso-ignore:colspan'></td>
            <td class=xl77>신청일 :</td>
            <td colspan=2 class=xl96> </td>
            <td></td>
        </tr>
        <tr height=23 style='height:17.0pt'>
            <td height=23 colspan=6 style='height:17.0pt;mso-ignore:colspan'></td>
            <td class=xl77>신청인 :</td>
            <td colspan=2 class=xl77> </td>
            <td></td>
        </tr>
        <tr height=11 style='mso-height-source:userset;height:8.5pt'>
            <td height=11 colspan=10 style='height:8.5pt;mso-ignore:colspan'></td>
        </tr>
        <tr height=23 style='height:17.0pt'>
            <td height=23 colspan=7 style='height:17.0pt;mso-ignore:colspan'></td>
            <td class=xl70><span style='mso-spacerun:yes'> </span>날인</td>
            <td align=left valign=top><!--[if gte vml 1]><v:shape id="그림_x0020_2" o:spid="_x0000_s2050"
                                                                  type="#_x0000_t75" style='position:absolute;margin-left:42pt;margin-top:16pt;
   width:56pt;height:55pt;z-index:2;visibility:visible' o:gfxdata="">
                    <v:imagedata src="<?=$io_img_stamp?>" o:title=""/>
                    <x:ClientData ObjectType="Pict">
                        <x:SizeWithCells/>
                    </x:ClientData>
                </v:shape><![endif]--><![if !vml]><span style='mso-ignore:vglayout;
  position:absolute;z-index:2;margin-left:56px;margin-top:21px;width:74px;
  height:74px'><img width=56 height=56
                    src="<?=$io_img_stamp?>" v:shapes="그림_x0020_2"></span><![endif]><span
                        style='mso-ignore:vglayout2'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td height=23 class=xl71 width=173 style='height:17.0pt;width:130pt'>spaceAdd
    날인</td>
   </tr>
  </table>
  </span></td>
            <td></td>
        </tr>
        <tr height=23 style='height:17.0pt'>
            <td height=23 colspan=7 style='height:17.0pt;mso-ignore:colspan'></td>
            <td class=xl72>　</td>
            <td class=xl73>　</td>
            <td></td>
        </tr>
        <tr height=23 style='height:17.0pt'>
            <td height=23 colspan=7 style='height:17.0pt;mso-ignore:colspan'></td>
            <td class=xl72>　</td>
            <td class=xl73>　</td>
            <td></td>
        </tr>
        <tr height=23 style='height:17.0pt'>
            <td height=23 colspan=7 style='height:17.0pt;mso-ignore:colspan'></td>
            <td class=xl74>　</td>
            <td class=xl75>　</td>
            <td></td>
        </tr>
        <tr height=46 style='height:34.0pt;mso-xlrowspan:2'>
            <td height=46 colspan=10 style='height:34.0pt;mso-ignore:colspan'></td>
        </tr>
        <tr height=0 style='display:none'>
            <td height=0 colspan=10 style='mso-ignore:colspan'></td>
        </tr>
        <tr height=0 style='display:none'>
            <td height=0 colspan=10 style='mso-ignore:colspan'></td>
        </tr>
        <tr height=23 style='height:17.0pt'>
            <td height=23 colspan=10 style='height:17.0pt;mso-ignore:colspan'></td>
        </tr>
        <tr height=45 style='mso-height-source:userset;height:34.25pt'>
            <td height=45 style='height:34.25pt'></td>
            <td colspan=8 class=xl97>스페이스애드 광고게재신청서</td>
            <td></td>
        </tr>
        <![if supportMisalignedColumns]>
        <tr height=0 style='display:none'>
            <td width=24 style='width:18pt'></td>
            <td width=223 style='width:167pt'></td>
            <td width=117 style='width:88pt'></td>
            <td width=117 style='width:88pt'></td>
            <td width=117 style='width:88pt'></td>
            <td width=117 style='width:88pt'></td>
            <td width=124 style='width:93pt'></td>
            <td width=137 style='width:103pt'></td>
            <td width=173 style='width:130pt'></td>
            <td width=24 style='width:18pt'></td>
        </tr>
        <![endif]>
    </table>
</div>
</body>

</html>
