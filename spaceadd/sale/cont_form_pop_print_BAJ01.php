<?
header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-Disposition: attachment; filename = 매체사_수수료율.xls" );
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
    <link rel=File-List href="mda_BAJ01.fld/filelist.xml">
    <!--[if !mso]>
    <style>
        v\:* {behavior:url(#default#VML);}
        o\:* {behavior:url(#default#VML);}
        x\:* {behavior:url(#default#VML);}
        .shape {behavior:url(#default#VML);}
    </style>
    <![endif]-->
    <style id="mda_BAJ01_1576_Styles">
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
        .font6
        {color:#0563C1;
            font-size:10.0pt;
            font-weight:400;
            font-style:normal;
            text-decoration:underline;
            text-underline-style:single;
            font-family:"맑은 고딕";
            mso-generic-font-family:auto;
            mso-font-charset:129;}
        .font7
        {color:windowtext;
            font-size:10.0pt;
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
        .style18
        {mso-number-format:0%;
            mso-style-name:백분율;
            mso-style-id:5;}
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
        {mso-style-parent:style17;
            font-size:10.0pt;
            mso-number-format:"\#\,\#\#\#\0022원\0022";
            text-align:center;
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:none;
            border-left:.5pt solid windowtext;}
        .xl79
        {mso-style-parent:style17;
            font-size:10.0pt;
            mso-number-format:"\#\,\#\#\#\0022원\0022";
            text-align:center;
            border-top:none;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:.5pt solid windowtext;}
        .xl80
        {mso-style-parent:style16;
            color:#0563C1;
            font-size:10.0pt;
            text-decoration:underline;
            text-underline-style:single;}
        .xl81
        {mso-style-parent:style17;
            font-size:10.0pt;
            mso-number-format:"\#\,\#\#\#\0022원\0022";
            text-align:center;
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:none;
            border-left:none;}
        .xl82
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
        .xl83
        {mso-style-parent:style0;
            color:white;
            font-size:10.0pt;
            font-weight:700;
            text-align:center;
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:none;
            border-left:.5pt solid windowtext;
            background:gray;
            mso-pattern:black none;}
        .xl84
        {mso-style-parent:style17;
            font-size:10.0pt;
            mso-number-format:"\#\,\#\#\#\0022원\0022";
            border:.5pt solid windowtext;
            white-space:normal;}
        .xl85
        {mso-style-parent:style17;
            font-size:10.0pt;
            mso-number-format:"\#\,\#\#\#\0022원\0022";
            text-align:center;
            border-top:2.0pt double windowtext;
            border-right:.5pt solid windowtext;
            border-bottom:.5pt solid windowtext;
            border-left:.5pt solid windowtext;}
        .xl86
        {mso-style-parent:style17;
            font-size:10.0pt;
            mso-number-format:"\#\,\#\#\#\0022원\0022";
            text-align:center;
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:2.0pt double windowtext;
            border-left:.5pt solid windowtext;}
        .xl87
        {mso-style-parent:style17;
            font-size:10.0pt;
            mso-number-format:"\#\,\#\#\#\0022원\0022";
            border-top:.5pt solid windowtext;
            border-right:.5pt solid windowtext;
            border-bottom:2.0pt double windowtext;
            border-left:.5pt solid windowtext;
            white-space:normal;}
        .xl88
        {mso-style-parent:style17;
            font-size:10.0pt;
            mso-number-format:"\#\,\#\#\#\0022원\0022";
            border-top:none;
            border-right:.5pt solid windowtext;
            border-bottom:2.0pt double windowtext;
            border-left:.5pt solid windowtext;
            white-space:normal;}
        .xl89
        {mso-style-parent:style17;
            font-size:10.0pt;
            mso-number-format:"\#\,\#\#\#\0022원\0022";
            border-top:none;
            border-right:.5pt solid windowtext;
            border-bottom:.5pt solid windowtext;
            border-left:.5pt solid windowtext;
            white-space:normal;}
        .xl90
        {mso-style-parent:style17;
            font-size:10.0pt;
            mso-number-format:"\#\,\#\#\#\0022원\0022";
            text-align:center;}
        .xl91
        {mso-style-parent:style18;
            font-size:10.0pt;
            mso-number-format:"\#\,\#\#\#\%";
            text-align:center;
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:none;
            border-left:.5pt solid windowtext;}
        .xl92
        {mso-style-parent:style0;
            font-size:10.0pt;
            font-weight:700;
            text-align:left;
            padding-left:12px;
            mso-char-indent-count:1;}
        .xl93
        {mso-style-parent:style0;
            font-size:12.0pt;
            font-weight:700;
            mso-pattern:black none;}
        .xl94
        {mso-style-parent:style0;
            font-size:10.0pt;
            mso-pattern:black none;}
        .xl95
        {mso-style-parent:style0;
            font-size:10.0pt;
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:.5pt solid windowtext;}
        .xl96
        {mso-style-parent:style0;
            font-size:10.0pt;
            border-top:.5pt solid windowtext;
            border-right:.5pt solid windowtext;
            border-bottom:.5pt solid windowtext;
            border-left:none;}
        .xl97
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:center;
            border:.5pt solid windowtext;
            white-space:normal;}
        .xl98
        {mso-style-parent:style0;
            mso-number-format:"Long Date";
            text-align:right;}
        .xl99
        {mso-style-parent:style0;
            color:windowtext;
            text-align:center;
            background:#F2F2F2;
            mso-pattern:black none;}
        .xl100
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:center;
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:.5pt solid windowtext;}
        .xl101
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:center;
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:none;}
        .xl102
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:center;
            border-top:.5pt solid windowtext;
            border-right:.5pt solid windowtext;
            border-bottom:.5pt solid windowtext;
            border-left:none;}
        .xl103
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:center;
            border-top:2.0pt double windowtext;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:.5pt solid windowtext;}
        .xl104
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:center;
            border-top:2.0pt double windowtext;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:none;}
        .xl105
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:center;
            border-top:2.0pt double windowtext;
            border-right:.5pt solid windowtext;
            border-bottom:.5pt solid windowtext;
            border-left:none;}
        .xl106
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:left;
            border:.5pt solid windowtext;}
        .xl107
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:left;
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:.5pt solid windowtext;
            mso-pattern:black none;}
        .xl108
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:left;
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:none;
            mso-pattern:black none;}
        .xl109
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:left;
            border-top:.5pt solid windowtext;
            border-right:.5pt solid windowtext;
            border-bottom:.5pt solid windowtext;
            border-left:none;
            mso-pattern:black none;}
        .xl110
        {mso-style-parent:style17;
            font-size:10.0pt;
            mso-number-format:"\#\,\#\#\#\0022원\0022";
            text-align:left;
            border:.5pt solid windowtext;}
        .xl111
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:left;
            border-top:.5pt solid windowtext;
            border-right:.5pt solid windowtext;
            border-bottom:none;
            border-left:.5pt solid windowtext;}
        .xl112
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:left;
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:.5pt solid windowtext;
            background:white;
            mso-pattern:black none;}
        .xl113
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:left;
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:none;
            background:white;
            mso-pattern:black none;}
        .xl114
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:left;
            border-top:.5pt solid windowtext;
            border-right:.5pt solid windowtext;
            border-bottom:.5pt solid windowtext;
            border-left:none;
            background:white;
            mso-pattern:black none;}
        .xl115
        {mso-style-parent:style16;
            color:#0563C1;
            text-decoration:underline;
            text-underline-style:single;
            text-align:left;
            border:.5pt solid windowtext;}
        .xl116
        {mso-style-parent:style16;
            color:#0563C1;
            font-size:10.0pt;
            text-decoration:underline;
            text-underline-style:single;
            text-align:left;
            border:.5pt solid windowtext;}
        .xl117
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:center;
            border:.5pt solid windowtext;}
        .xl118
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
        .xl119
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
        .xl120
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:left;
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:.5pt solid windowtext;}
        .xl121
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:left;
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:none;}
        .xl122
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:left;
            border-top:.5pt solid windowtext;
            border-right:.5pt solid windowtext;
            border-bottom:.5pt solid windowtext;
            border-left:none;}
        .xl123
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:left;
            border:.5pt solid windowtext;
            background:white;
            mso-pattern:black none;}
        .xl124
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:left;
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:none;
            border-left:.5pt solid windowtext;}
        .xl125
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:left;
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:none;
            border-left:none;}
        .xl126
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:left;
            border-top:.5pt solid windowtext;
            border-right:.5pt solid windowtext;
            border-bottom:none;
            border-left:none;}
        .xl127
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:left;
            border-top:none;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:.5pt solid windowtext;}
        .xl128
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:left;
            border-top:none;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:none;}
        .xl129
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:left;
            border-top:none;
            border-right:.5pt solid windowtext;
            border-bottom:.5pt solid windowtext;
            border-left:none;}
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
<!--[if !excel]>　　<![endif]-->
<!--다음 내용은 Microsoft Excel의 웹 페이지로 게시 마법사를 사용하여 작성되었습니다.-->
<!--같은 내용의 항목이 다시 게시되면 DIV 태그 사이에 있는 내용이 변경됩니다.-->
<!----------------------------->
<!--Excel의 웹 페이지 마법사로 게시해서 나온 결과의 시작 -->
<!----------------------------->

<div id="mda_BAJ01_1576" align=center x:publishsource="Excel">

    <table border=0 cellpadding=0 cellspacing=0 width=1149 style='border-collapse:
 collapse;table-layout:fixed;width:864pt'>
        <col width=36 style='mso-width-source:userset;mso-width-alt:1152;width:27pt'>
        <col width=165 style='mso-width-source:userset;mso-width-alt:5290;width:124pt'>
        <col width=85 style='mso-width-source:userset;mso-width-alt:2730;width:64pt'>
        <col width=117 span=3 style='mso-width-source:userset;mso-width-alt:3754;width:88pt'>
        <col width=121 span=2 style='mso-width-source:userset;mso-width-alt:3882;width:91pt'>
        <col width=117 span=2 style='mso-width-source:userset;mso-width-alt:3754;width:88pt'>
        <col width=36 style='mso-width-source:userset;mso-width-alt:1152;width:27pt'>
        <tr height=28 style='mso-height-source:userset;height:21.0pt'>
            <td height=28 width=36 style='height:21.0pt;width:27pt'></td>
            <td width=165 style='width:124pt'></td>
            <td width=85 style='width:64pt'></td>
            <td width=117 style='width:88pt'></td>
            <td width=117 style='width:88pt'></td>
            <td width=117 style='width:88pt'></td>
            <td width=121 style='width:91pt'></td>
            <td width=121 style='width:91pt'></td>
            <td width=117 style='width:88pt'></td>
            <td width=117 style='width:88pt' align=left valign=top><!--[if gte vml 1]><v:shapetype
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
                </v:shapetype><v:shape id="그림_x0020_1" o:spid="_x0000_s1025" type="#_x0000_t75"
                                       style='position:absolute;margin-left:27pt;margin-top:10pt;width:69pt;
   height:45pt;z-index:1;visibility:visible' o:gfxdata="">
                    <v:imagedata src="<?=$io_img_logo?>" o:title=""/>
                    <x:ClientData ObjectType="Pict">
                        <x:SizeWithCells/>
                    </x:ClientData>
                </v:shape><![endif]--><![if !vml]><span style='mso-ignore:vglayout;
  position:absolute;z-index:1;margin-left:36px;margin-top:13px;width:92px;
  height:60px'><img width=69 height=45
                    src="<?=$io_img_logo?>" v:shapes="그림_x0020_1"></span><![endif]><span
                        style='mso-ignore:vglayout2'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td height=28 width=117 style='height:21.0pt;width:88pt'></td>
   </tr>
  </table>
  </span></td>
            <td width=36 style='width:27pt'></td>
        </tr>
        <tr height=36 style='height:27.0pt'>
            <td height=36 style='height:27.0pt'></td>
            <td class=xl65 colspan=2 style='mso-ignore:colspan'>Insertion Order</td>
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
            <td class=xl66>　</td>
            <td></td>
        </tr>
        <tr height=23 style='height:17.0pt'>
            <td height=23 colspan=11 style='height:17.0pt;mso-ignore:colspan'></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 style='height:20.0pt'></td>
            <td class=xl67 colspan=2 style='mso-ignore:colspan'>Campaign Information</td>
            <td colspan=8 style='mso-ignore:colspan'></td>
        </tr>
        <tr height=24 style='mso-height-source:userset;height:18.0pt'>
            <td height=24 style='height:18.0pt'></td>
            <td class=xl68>광고주명</td>
            <td colspan=3 class=xl106 style='border-left:none'><?echo $cont['cli_nm']?>　</td>
            <td class=xl68 style='border-left:none'>캠페인명</td>
            <td colspan=4 class=xl107 style='border-right:.5pt solid black'><?echo $cont['campgn_nm']?></td>
            <td></td>
        </tr>
        <tr height=24 style='mso-height-source:userset;height:18.0pt'>
            <td height=24 style='height:18.0pt'></td>
            <td class=xl68 style='border-top:none'>광고기간</td>
            <td colspan=3 class=xl106 style='border-left:none'><?echo $cont['cont_terms']?>　</td>
            <td class=xl68 style='border-top:none;border-left:none'>광고금액</td>
            <td colspan=4 class=xl110 style='border-left:none'><?echo $cont['cont_amt']?>　</td>
            <td></td>
        </tr>
        <tr height=24 style='mso-height-source:userset;height:18.0pt'>
            <td height=24 colspan=11 style='height:18.0pt;mso-ignore:colspan'></td>
        </tr>
        <!--광고회사-->
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 style='height:20.0pt'></td>
            <td class=xl93>Media Agency Information</td>
            <td></td>
            <td class=xl92 colspan=4 style='mso-ignore:colspan'></td>
            <td colspan=4 style='mso-ignore:colspan'></td>
        </tr>
        <tr height=24 style='mso-height-source:userset;height:18.0pt'>
            <td height=24 style='height:18.0pt'></td>
            <td class=xl68>매체사명</td>
            <td colspan=3 class=xl106 style='border-left:none'><?echo $comp_sa['comp_nm']?></td>
            <td class=xl68 style='border-left:none'>사업자등록번호</td>
            <td colspan=4 class=xl106 style='border-left:none'><?echo $comp_sa['busi_no']?></td>
            <td></td>
        </tr>
        <tr height=24 style='mso-height-source:userset;height:18.0pt'>
            <td height=24 style='height:18.0pt'></td>
            <td rowspan=2 class=xl106 style='border-top:none'>주소</td>
            <td colspan=3 class=xl111><?echo $comp_sa['addr']?></td>
            <td class=xl68 style='border-top:none'>전화</td>
            <td colspan=4 class=xl106 style='border-left:none'><?echo $comp_sa['tel_no']?></td>
            <td></td>
        </tr>
        <tr height=24 style='mso-height-source:userset;height:18.0pt'>
            <td height=24 style='height:18.0pt'></td>
            <td colspan=3 class=xl112 style='border-right:.5pt solid black'><?echo $comp_sa['addr3']?></td>
            <td class=xl68 style='border-top:none'>이메일</td>
            <td colspan=4 class=xl115 style='border-left:none'></td>
            <td></td>
        </tr>
        <tr height=24 style='mso-height-source:userset;height:18.0pt'>
            <td height=24 style='height:18.0pt'></td>
            <td class=xl68 style='border-top:none'>담당부서</td>
            <td colspan=3 class=xl106 style='border-left:none'></td>
            <td class=xl68 style='border-top:none;border-left:none'>담당자명</td>
            <td colspan=4 class=xl106 style='border-left:none'></td>
            <td></td>
        </tr>
        <tr height=24 style='mso-height-source:userset;height:18.0pt'>
            <td height=24 colspan=11 style='height:18.0pt;mso-ignore:colspan'></td>
        </tr>
        <!--매체사 정보-->
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 style='height:20.0pt'></td>
            <td class=xl93>Media Information</td>
            <td></td>
            <td class=xl92 colspan=3 style='mso-ignore:colspan'></td>
            <td colspan=5 style='mso-ignore:colspan'></td>
        </tr>
        <tr height=24 style='mso-height-source:userset;height:18.0pt'>
            <td height=24 style='height:18.0pt'></td>
            <td class=xl68>브랜드명</td>
            <td colspan=3 class=xl120 style='border-right:.5pt solid black'><?echo $comp_mda['comp_nm']?>　</td>
            <td class=xl68>사업자등록번호</td>
            <td colspan=4 class=xl123 style='border-left:none'><?echo $comp_mda['busi_no']?>　</td>
            <td></td>
        </tr>
        <tr height=24 style='mso-height-source:userset;height:18.0pt'>
            <td height=24 style='height:18.0pt'></td>
            <td rowspan=2 class=xl106 style='border-top:none'>주소</td>
            <td colspan=3 class=xl124 style='border-right:.5pt solid black'><?echo $comp_mda['addr']?>　</td>
            <td class=xl68 style='border-top:none'>전화</td>
            <td colspan=4 class=xl106 style='border-left:none'><?echo $comp_mda['tel_no']?>　</td>
            <td></td>
        </tr>
        <tr height=24 style='mso-height-source:userset;height:18.0pt'>
            <td height=24 style='height:18.0pt'></td>
            <td colspan=3 class=xl127 style='border-right:.5pt solid black'>　</td>
            <td class=xl68 style='border-top:none'>이메일</td>
            <td colspan=4 class=xl115 style='border-left:none'> <a href="mailto:<?echo $comp_mda['psrn_email']?>"><?echo $comp_mda['psrn_email']?></a></td>
            <td></td>
        </tr>
        <tr height=24 style='mso-height-source:userset;height:18.0pt'>
            <td height=24 style='height:18.0pt'></td>
            <td class=xl68 style='border-top:none'>담당부서</td>
            <td colspan=3 class=xl106 style='border-left:none'>　</td>
            <td class=xl68 style='border-top:none;border-left:none'>담당자명</td>
            <td colspan=4 class=xl106 style='border-left:none'><?echo $comp_mda['psrn_nm']?>　</td>
            <td></td>
        </tr>
        <tr height=24 style='mso-height-source:userset;height:18.0pt'>
            <td height=24 colspan=5 style='height:18.0pt;mso-ignore:colspan'></td>
            <td class=xl81>　</td>
            <td class=xl81>　</td>
            <td class=xl90></td>
            <td colspan=3 style='mso-ignore:colspan'></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 style='height:20.0pt'></td>
            <td class=xl93>Media Mix Informati<span style='display:none'>on</span></td>
            <td colspan=9 style='mso-ignore:colspan'></td>
        </tr>
        <tr height=24 style='mso-height-source:userset;height:18.0pt'>
            <td height=24 style='height:18.0pt'></td>
            <td class=xl76>상품</td>
            <td class=xl76 style='border-left:none'>구좌</td>
            <td colspan=3 class=xl82 style='border-right:.5pt solid black'>기간</td>
            <td class=xl76>월 광고비</td>
            <td class=xl82>수수료율</td>
            <td class=xl82>광고 수수료</td>
            <td class=xl83>비고</td>
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
                <td class=xl97 style='border-top:none'><?echo $item['mda_nm']?>　</td>
                <td class=xl97 style='border-top:none;border-left:none'><?echo $item['account_cnt']?>　</td>
                <td colspan=3 class=xl100 style='border-right:.5pt solid black'>　<?echo $item['terms']?></td>
                <td class=xl78 style='border-left:none'>　</td>
                <td class=xl97>　</td>
                <td class=xl84 align=right width=117 style='width:88pt'>　</td>
                <td class=xl89 width=117 style='border-left:none;width:88pt'>　</td>
                <td></td>
            </tr>
            <?
            $idx++ ;
        }
        ?>
        <tr height=24 style='mso-height-source:userset;height:18.0pt'>
            <td height=24 style='height:18.0pt'></td>
            <td class=xl95>　</td>
            <td class=xl96>　</td>
            <td colspan=3 class=xl100 style='border-right:.5pt solid black;border-left:none'>　</td>
            <td class=xl86 style='border-left:none'>　</td>
            <td class=xl86>　</td>
            <td class=xl87 width=117 style='width:88pt'>　</td>
            <td class=xl88 width=117 style='width:88pt'>　</td>
            <td></td>
        </tr>
        <tr height=24 style='height:18.0pt'>
            <td height=24 style='height:18.0pt'></td>
            <td colspan=5 class=xl103 style='border-right:.5pt solid black'>합 계</td>
            <td class=xl84 style='border-left:none'></td>
            <td class=xl79>　</td>
            <td class=xl84 align=right width=117 style='width:88pt'></td>
            <td class=xl85 style='border-top:none'>　</td>
            <td></td>
        </tr>
        <tr height=23 style='height:17.0pt'>
            <td height=23 colspan=11 style='height:17.0pt;mso-ignore:colspan'></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 style='height:20.0pt'></td>
            <td class=xl67>Billing Information</td>
            <td class=xl94> </td>
            <td colspan=2 style='mso-ignore:colspan'></td>
            <td class=xl67>Remark</td>
            <td class=xl94> </td>
            <td colspan=4 style='mso-ignore:colspan'></td>
        </tr>
        <tr height=23 style='height:17.0pt'>
            <td height=23 style='height:17.0pt'></td>
            <td class=xl69 colspan=4 style='mso-ignore:colspan'><span style='mso-spacerun:yes'> </span>- 지불 금액 상기에 표시된 금액은 부가세 별도 금액입니다.</td>
            <td class=xl69 colspan=4 style='mso-ignore:colspan'><span style='mso-spacerun:yes'> </span>- 세금계산서 청구월 및 금액 확인 후 승인해주시기 바랍니다.</td>
            <td class=xl69></td>
            <td></td>
        </tr>
        <tr height=23 style='height:17.0pt'>
            <td height=23 style='height:17.0pt'></td>
            <td class=xl69 colspan=3 style='mso-ignore:colspan'><span style='mso-spacerun:yes'> </span>- 세금계산서 발행일 : 집행월 말일자로 발행</td>
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
            <td class=xl69><span style='mso-spacerun:yes'> </span>- 세금계산서 발송 :<span style='mso-spacerun:yes'>  </span>tax@spaceadd.com</td>
            <td class=xl80 colspan=2 style='mso-ignore:colspan'> </td>
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
            <td class=xl94><span style='mso-spacerun:yes'> </span>- 지불조건 : 세금계산서  발행일 기준으로 XX일 후 현금입금.</td>
            <td class=xl69></td>
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
            <td class=xl66>　</td>
            <td></td>
        </tr>
        <tr height=23 style='height:17.0pt'>
            <td height=23 colspan=11 style='height:17.0pt;mso-ignore:colspan'></td>
        </tr>
        <tr height=23 style='height:17.0pt'>
            <td height=23 style='height:17.0pt'></td>
            <td colspan=3 style='mso-ignore:colspan'>본 Insertion Order는 광고계약서를 대신합니다.</td>
            <td colspan=7 style='mso-ignore:colspan'></td>
        </tr>
        <tr height=23 style='height:17.0pt'>
            <td height=23 colspan=11 style='height:17.0pt;mso-ignore:colspan'></td>
        </tr>
        <tr height=23 style='height:17.0pt'>
            <td height=23 colspan=7 style='height:17.0pt;mso-ignore:colspan'></td>
            <td colspan=3 style='mso-ignore:colspan'><span
                        style='mso-spacerun:yes'>            </span>위와 같이 광고게재를 신청합니다.</td>
            <td></td>
        </tr>
        <tr height=23 style='height:17.0pt'>
            <td height=23 colspan=7 style='height:17.0pt;mso-ignore:colspan'></td>
            <td class=xl77>신청일 :</td>
            <td colspan=2 class=xl98> </td>
            <td></td>
        </tr>
        <tr height=23 style='height:17.0pt'>
            <td height=23 colspan=7 style='height:17.0pt;mso-ignore:colspan'></td>
            <td class=xl77>신청인 :</td>
            <td colspan=2 class=xl77> </td>
            <td></td>
        </tr>
        <tr height=11 style='mso-height-source:userset;height:8.5pt'>
            <td height=11 colspan=11 style='height:8.5pt;mso-ignore:colspan'></td>
        </tr>
        <tr height=23 style='height:17.0pt'>
            <td height=23 colspan=8 style='height:17.0pt;mso-ignore:colspan'></td>
            <td class=xl70><span style='mso-spacerun:yes'> </span>날인</td>
            <td class=xl71>spaceAdd 날인</td>
            <td></td>
        </tr>
        <tr height=23 style='height:17.0pt'>
            <td height=23 colspan=8 style='height:17.0pt;mso-ignore:colspan'></td>
            <td class=xl72>　</td>
            <td align=left valign=top><!--[if gte vml 1]><v:shape id="그림_x0020_2" o:spid="_x0000_s1026"
                                                                  type="#_x0000_t75" style='position:absolute;margin-left:18pt;margin-top:1pt;
   width:53pt;height:52pt;z-index:2;visibility:visible' o:gfxdata="">
                    <v:imagedata src="<?=$io_img_stamp?>" o:title=""/>
                    <x:ClientData ObjectType="Pict">
                        <x:SizeWithCells/>
                    </x:ClientData>
                </v:shape><![endif]--><![if !vml]><span style='mso-ignore:vglayout;
  position:absolute;z-index:2;margin-left:24px;margin-top:1px;width:71px;
  height:69px'><img width=53 height=52
                    src="<?=$io_img_stamp?>" v:shapes="그림_x0020_2"></span><![endif]><span
                        style='mso-ignore:vglayout2'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td height=23 class=xl73 width=117 style='height:17.0pt;width:88pt'>　</td>
   </tr>
  </table>
  </span></td>
            <td></td>
        </tr>
        <tr height=23 style='height:17.0pt'>
            <td height=23 colspan=8 style='height:17.0pt;mso-ignore:colspan'></td>
            <td class=xl72>　</td>
            <td class=xl73>　</td>
            <td></td>
        </tr>
        <tr height=23 style='height:17.0pt'>
            <td height=23 colspan=8 style='height:17.0pt;mso-ignore:colspan'></td>
            <td class=xl74>　</td>
            <td class=xl75>　</td>
            <td></td>
        </tr>
        <tr height=115 style='height:85.0pt;mso-xlrowspan:5'>
            <td height=115 colspan=11 style='height:85.0pt;mso-ignore:colspan'></td>
        </tr>
        <tr height=45 style='mso-height-source:userset;height:34.25pt'>
            <td height=45 style='height:34.25pt'></td>
            <td colspan=9 class=xl99>스페이스애드 광고게재신청서</td>
            <td></td>
        </tr>
        <![if supportMisalignedColumns]>
        <tr height=0 style='display:none'>
            <td width=36 style='width:27pt'></td>
            <td width=165 style='width:124pt'></td>
            <td width=85 style='width:64pt'></td>
            <td width=117 style='width:88pt'></td>
            <td width=117 style='width:88pt'></td>
            <td width=117 style='width:88pt'></td>
            <td width=121 style='width:91pt'></td>
            <td width=121 style='width:91pt'></td>
            <td width=117 style='width:88pt'></td>
            <td width=117 style='width:88pt'></td>
            <td width=36 style='width:27pt'></td>
        </tr>
        <![endif]>
    </table>
</div>

<!----------------------------->
<!--Excel의 웹 페이지 마법사로 게시해서 나온 결과의 끝-->
<!----------------------------->
</body>

</html>


<?php
include_once(G5_PATH . '/sale.tail.php');
?>
