<?
header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-Disposition: attachment; filename = 광고회사_직거래.xls" );
header( "Content-Description: PHP4 Generated Data" );

?>
<?php
include_once('./_common.php');
//출력 공통
$mda_comp_seq =  $_GET['mda_comp_seq']  ;
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
    <link rel=File-List href="agn_BAJ04_1.fld/filelist.xml">
    <!--[if !mso]>
    <style>
        v\:* {behavior:url(#default#VML);}
        o\:* {behavior:url(#default#VML);}
        x\:* {behavior:url(#default#VML);}
        .shape {behavior:url(#default#VML);}
    </style>
    <![endif]-->
    <style id="agn_BAJ04_1_23982_Styles">
        <!--table
        {mso-displayed-decimal-separator:"\.";
            mso-displayed-thousand-separator:"\,";}
        @page
        {margin:.75in .71in .75in .71in;
            mso-header-margin:.31in;
            mso-footer-margin:.31in;
            mso-horizontal-page-align:center;}
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
        .style16
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
        .style17
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
            font-size:10.0pt;}
        .xl66
        {mso-style-parent:style0;
            font-size:10.0pt;
            border-top:none;
            border-right:none;
            border-bottom:1.0pt solid windowtext;
            border-left:none;}
        .xl67
        {mso-style-parent:style0;
            font-size:10.0pt;
            background:white;
            mso-pattern:black none;}
        .xl68
        {mso-style-parent:style0;
            font-size:10.0pt;
            font-weight:700;}
        .xl69
        {mso-style-parent:style0;
            font-size:10.0pt;
            font-weight:700;
            mso-number-format:"_-* \#\,\#\#0_-\;\\-* \#\,\#\#0_-\;_-* \0022-\0022_-\;_-\@_-";
            border:.5pt solid windowtext;
            background:#FFD966;
            mso-pattern:black none;}
        .xl70
        {
            color:windowtext;
            mso-number-format:"\@";
            font-size:10.0pt;
            text-align:center;
            border:.5pt solid windowtext;}
        .xl71
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:center;
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:.5pt solid windowtext;
            white-space:normal;}
        .xl72
        {mso-style-parent:style0;
            color:red;
            font-size:10.0pt;
            font-weight:700;}
        .xl73
        {mso-style-parent:style0;
            font-size:12.0pt;
            font-weight:700;}
        .xl74
        {mso-style-parent:style0;
            font-size:10.0pt;
            font-weight:700;
            text-align:left;
            padding-left:12px;
            mso-char-indent-count:1;}
        .xl75
        {mso-style-parent:style0;
            font-weight:700;}
        .xl76
        {mso-style-parent:style0;
            font-size:10.0pt;
            font-weight:700;
            border-top:.5pt solid windowtext;
            border-right:.5pt solid windowtext;
            border-bottom:none;
            border-left:.5pt solid windowtext;}
        .xl77
        {mso-style-parent:style0;
            font-size:10.0pt;
            font-weight:700;
            border-top:none;
            border-right:.5pt solid windowtext;
            border-bottom:none;
            border-left:.5pt solid windowtext;}
        .xl78
        {mso-style-parent:style0;
            font-size:10.0pt;
            font-weight:700;
            border-top:none;
            border-right:.5pt solid windowtext;
            border-bottom:.5pt solid windowtext;
            border-left:.5pt solid windowtext;}
        .xl79
        {mso-style-parent:style0;
            font-size:12.0pt;
            font-weight:700;
            text-align:center;
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:.5pt solid windowtext;
            background:white;
            mso-pattern:black none;}
        .xl80
        {mso-style-parent:style0;
            font-size:12.0pt;
            font-weight:700;
            text-align:center;
            border:.5pt solid windowtext;}
        .xl81
        {mso-style-parent:style0;
            font-size:9.0pt;}
        .xl82
        {mso-style-parent:style16;
            color:windowtext;
            font-size:10.0pt;
            mso-number-format:"General\0022개월\0022";
            text-align:center;
            border:.5pt solid windowtext;
            white-space:normal;}
        .xl83
        {mso-style-parent:style16;
            font-size:10.0pt;
            mso-number-format:"Long Date";
            text-align:center;
            border:.5pt solid windowtext;
            white-space:normal;}
        .xl84
        {mso-style-parent:style16;
            font-size:10.0pt;
            font-weight:700;
            mso-number-format:"\#\,\#\#\#\0022원\0022";
            border-top:.5pt solid windowtext;
            border-right:.5pt solid windowtext;
            border-bottom:.5pt solid windowtext;
            border-left:none;
            background:#FFD966;
            mso-pattern:black none;}
        .xl85
        {mso-style-parent:style0;
            font-size:10.0pt;
            font-weight:700;
            mso-number-format:"_-* \#\,\#\#0_-\;\\-* \#\,\#\#0_-\;_-* \0022-\0022_-\;_-\@_-";
            border-top:.5pt solid windowtext;
            border-right:.5pt solid windowtext;
            border-bottom:.5pt solid windowtext;
            border-left:none;
            background:#FFD966;
            mso-pattern:black none;}
        .xl86
        {mso-style-parent:style16;
            font-size:10.0pt;
            font-weight:700;
            mso-number-format:"_-* \#\,\#\#0_-\;\\-* \#\,\#\#0_-\;_-* \0022-\0022_-\;_-\@_-";
            text-align:center;
            border:.5pt solid windowtext;
            background:white;
            mso-pattern:black none;
            white-space:normal;}
        .xl87
        {mso-style-parent:style0;
            font-size:10.0pt;
            mso-number-format:"\@";
            background:white;
            mso-pattern:black none;}
        .xl88
        {mso-style-parent:style0;
            color:red;
            font-size:10.0pt;}
        .xl89
        {mso-style-parent:style0;
            font-size:10.0pt;
            font-weight:700;
            text-align:left;
            border:.5pt solid windowtext;
            padding-left:12px;
            mso-char-indent-count:1;}
        .xl90
        {mso-style-parent:style0;
            color:windowtext;
            font-size:10.0pt;
            font-weight:700;
            text-align:left;
            border:.5pt solid windowtext;
            padding-left:12px;
            mso-char-indent-count:1;}
        .xl91
        {mso-style-parent:style0;
            font-size:10.0pt;
            font-weight:700;
            text-align:left;
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:.5pt solid windowtext;
            padding-left:12px;
            mso-char-indent-count:1;}
        .xl92
        {mso-style-parent:style16;
            color:windowtext;
            font-size:10.0pt;
            mso-number-format:"Long Date";
            text-align:center;
            border-top:.5pt solid windowtext;
            border-right:.5pt solid windowtext;
            border-bottom:.5pt solid windowtext;
            border-left:none;
            white-space:normal;}
        .xl93
        {mso-style-parent:style0;
            font-size:10.0pt;
            font-weight:700;
            text-align:right;}
        .xl94
        {mso-style-parent:style0;
            font-size:10.0pt;
            font-weight:700;
            text-align:left;}
        .xl95
        {mso-style-parent:style0;
            font-size:10.0pt;
            mso-number-format:"\@";}
        .xl96
        {mso-style-parent:style0;
            color:red;
            font-size:12.0pt;
            font-weight:700;}
        .xl97
        {mso-style-parent:style0;
            font-size:12.0pt;
            font-weight:700;
            text-align:left;}
        .xl98
        {mso-style-parent:style0;
            font-size:24.0pt;
            font-weight:700;}
        .xl99
        {mso-style-parent:style0;
            color:red;
            font-size:10.0pt;
            text-align:left;}
        .xl100
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:left;
            padding-left:12px;
            mso-char-indent-count:1;}
        .xl101
        {mso-style-parent:style0;
            color:red;
            font-size:10.0pt;
            text-align:left;
            padding-left:12px;
            mso-char-indent-count:1;}
        .xl102
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:left;
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:.5pt solid windowtext;
            padding-left:12px;
            mso-char-indent-count:1;}
        .xl103
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:left;
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:none;
            padding-left:12px;
            mso-char-indent-count:1;}
        .xl104
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:left;
            border-top:.5pt solid windowtext;
            border-right:.5pt solid windowtext;
            border-bottom:.5pt solid windowtext;
            border-left:none;
            padding-left:12px;
            mso-char-indent-count:1;}
        .xl105
        {mso-style-parent:style17;
            color:#0563C1;
            text-decoration:underline;
            text-underline-style:single;
            text-align:left;
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:.5pt solid windowtext;
            padding-left:12px;
            mso-char-indent-count:1;}
        .xl106
        {mso-style-parent:style17;
            color:#0563C1;
            text-decoration:underline;
            text-underline-style:single;
            text-align:left;
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:none;
            padding-left:12px;
            mso-char-indent-count:1;}
        .xl107
        {mso-style-parent:style17;
            color:#0563C1;
            text-decoration:underline;
            text-underline-style:single;
            text-align:left;
            border-top:.5pt solid windowtext;
            border-right:.5pt solid windowtext;
            border-bottom:.5pt solid windowtext;
            border-left:none;
            padding-left:12px;
            mso-char-indent-count:1;}
        .xl108
        {mso-style-parent:style16;
            font-size:10.0pt;
            mso-number-format:"\#\,\#\#\#\0022원\0022";
            text-align:center;
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:none;
            background:#FFD966;
            mso-pattern:black none;}
        .xl109
        {mso-style-parent:style16;
            font-size:10.0pt;
            mso-number-format:"\#\,\#\#\#\0022원\0022";
            text-align:center;
            border-top:.5pt solid windowtext;
            border-right:.5pt solid windowtext;
            border-bottom:.5pt solid windowtext;
            border-left:none;
            background:#FFD966;
            mso-pattern:black none;}
        .xl110
        {mso-style-parent:style0;
            color:windowtext;
            font-size:12.0pt;
            font-weight:700;
            text-align:center;
            background:#F2F2F2;
            mso-pattern:black none;}
        .xl111
        {mso-style-parent:style0;
            color:white;
            font-size:10.0pt;
            font-weight:700;
            text-align:center;
            border:.5pt solid windowtext;
            background:#404040;
            mso-pattern:black none;
            white-space:normal;}
        .xl112
        {mso-style-parent:style0;
            font-size:10.0pt;
            font-weight:700;
            text-align:center;
            border:.5pt solid windowtext;
            background:#FFD966;
            mso-pattern:black none;}
        .xl113
        {mso-style-parent:style0;
            color:white;
            font-size:10.0pt;
            font-weight:700;
            text-align:center;
            border:.5pt solid windowtext;
            background:#404040;
            mso-pattern:black none;}
        .xl114
        {mso-style-parent:style0;
            color:white;
            font-size:10.0pt;
            font-weight:700;
            text-align:center;
            border-top:.5pt solid windowtext;
            border-right:.5pt solid windowtext;
            border-bottom:none;
            border-left:.5pt solid windowtext;
            background:#404040;
            mso-pattern:black none;}
        .xl115
        {mso-style-parent:style0;
            color:white;
            font-size:10.0pt;
            font-weight:700;
            text-align:center;
            border-top:none;
            border-right:.5pt solid windowtext;
            border-bottom:.5pt solid windowtext;
            border-left:.5pt solid windowtext;
            background:#404040;
            mso-pattern:black none;}
        .xl116
        {mso-style-parent:style0;
            color:white;
            font-size:10.0pt;
            font-weight:700;
            text-align:center;
            border:.5pt solid windowtext;
            background:#9933FF;
            mso-pattern:black none;
            white-space:normal;}
        .xl117
        {mso-style-parent:style0;
            color:white;
            font-size:10.0pt;
            font-weight:700;
            text-align:center;
            border-top:.5pt solid windowtext;
            border-right:.5pt solid windowtext;
            border-bottom:.5pt solid windowtext;
            border-left:none;
            background:#9933FF;
            mso-pattern:black none;
            white-space:normal;}
        .xl118
        {mso-style-parent:style17;
            color:#0563C1;
            font-size:10.0pt;
            text-decoration:underline;
            text-underline-style:single;
            text-align:left;
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:none;
            padding-left:12px;
            mso-char-indent-count:1;}
        .xl119
        {mso-style-parent:style17;
            color:#0563C1;
            font-size:10.0pt;
            text-decoration:underline;
            text-underline-style:single;
            text-align:left;
            border-top:.5pt solid windowtext;
            border-right:.5pt solid windowtext;
            border-bottom:.5pt solid windowtext;
            border-left:none;
            padding-left:12px;
            mso-char-indent-count:1;}
        .xl120
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:left;
            border:.5pt solid windowtext;
            padding-left:12px;
            mso-char-indent-count:1;}
        .xl121
        {mso-style-parent:style16;
            font-size:10.0pt;
            font-weight:700;
            mso-number-format:"\#\,\#\#\#\0022원\0022";
            text-align:left;
            border:.5pt solid windowtext;
            padding-left:12px;
            mso-char-indent-count:1;}
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

<body link="#0563C1" vlink="#954F72" class=xl65>

<div id="agn_BAJ04_1_23982" align=center x:publishsource="Excel">
    <table border=0 cellpadding=0 cellspacing=0 width=1487 style='border-collapse:
 collapse;table-layout:fixed;width:1117pt'>
        <col class=xl65 width=36 style='mso-width-source:userset;mso-width-alt:1152;
 width:27pt'>
        <col class=xl65 width=145 style='mso-width-source:userset;mso-width-alt:4650;
 width:109pt'>
        <col class=xl65 width=128 span=2 style='mso-width-source:userset;mso-width-alt:
 4096;width:96pt'>
        <col class=xl65 width=128 style='mso-width-source:userset;mso-width-alt:4096;
 width:96pt'>
        <col class=xl65 width=124 style='mso-width-source:userset;mso-width-alt:3968;
 width:93pt'>
        <col class=xl65 width=133 style='mso-width-source:userset;mso-width-alt:4266;
 width:100pt'>
        <col class=xl65 width=129 style='mso-width-source:userset;mso-width-alt:4138;
 width:97pt'>
        <col class=xl65 width=133 span=3 style='mso-width-source:userset;mso-width-alt:
 4266;width:100pt'>
        <col class=xl65 width=36 style='mso-width-source:userset;mso-width-alt:1152;
 width:27pt'>
        <col class=xl65 width=101 style='mso-width-source:userset;mso-width-alt:3242;
 width:76pt'>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 width=36 style='height:20.0pt;width:27pt'><a name="Print_Area"></a></td>
            <td class=xl65 width=145 style='width:109pt'></td>
            <td class=xl65 width=128 style='width:96pt'></td>
            <td class=xl65 width=128 style='width:96pt'></td>
            <td class=xl65 width=128 style='width:96pt'></td>
            <td class=xl65 width=124 style='width:93pt'></td>
            <td class=xl65 width=133 style='width:100pt'></td>
            <td class=xl65 width=129 style='width:97pt'></td>
            <td class=xl65 width=133 style='width:100pt'></td>
            <td width=133 style='width:100pt' align=left valign=top><!--[if gte vml 1]><v:shapetype
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
                </v:shapetype><v:shape id="그림_x0020_1" o:spid="_x0000_s4120" type="#_x0000_t75" style='position:absolute;margin-left:59pt;margin-top:7pt;width:93pt;height:52pt;z-index:2;visibility:visible' o:gfxdata="">
                    <v:imagedata src="<?=$io_img_logo?>" o:title=""/>
                    <x:ClientData ObjectType="Pict">
                        <x:SizeWithCells/>
                    </x:ClientData>
                </v:shape><![endif]--><![if !vml]><span style='mso-ignore:vglayout;
  position:absolute;z-index:2;margin-left:79px;margin-top:9px;width:252px;
  height:143px'><img width=100 height=60
                     src="<?=$io_img_logo?>" v:shapes="그림_x0020_1"></span><![endif]><span
                        style='mso-ignore:vglayout2'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td height=27 class=xl65 width=133 style='height:20.0pt;width:100pt'></td>
   </tr>
  </table>
  </span></td>
            <td class=xl65 width=133 style='width:100pt'></td>
            <td class=xl65 width=36 style='width:27pt'></td>
            <td class=xl65 width=101 style='width:76pt'></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl98 colspan=2 style='mso-ignore:colspan'>Insertion Order</td>
            <td class=xl73></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl66>　</td>
            <td class=xl66>　</td>
            <td class=xl66>　</td>
            <td class=xl66>　</td>
            <td class=xl66>　</td>
            <td class=xl66>　</td>
            <td class=xl66>　</td>
            <td class=xl66>　</td>
            <td class=xl66>　</td>
            <td class=xl66>　</td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl75>캠페인 정보</td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl99></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl89>캠페인명</td>
            <td colspan=4 class=xl102 style='border-left:none'><?echo $cont['campgn_nm']?></td>
            <td class=xl89>광고주명</td>
            <td colspan=4 class=xl120 style='border-left:none'><?echo $cont['cli_nm']?>　</td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl89 style='border-top:none'>총 광고기간</td>
            <td colspan=4 class=xl90 style='border-left:none'><?echo $cont['cont_terms']?></td>
            <td class=xl90 style='border-top:none;border-left:none'>청구금액</td>
            <td colspan=4 class=xl121 style='border-left:none'><?echo $cont['cont_amt']?></td>
            <td class=xl65></td>
            <td class=xl72></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl68></td>
            <td class=xl100></td>
            <td class=xl100></td>
            <td class=xl100></td>
            <td class=xl100></td>
            <td class=xl68></td>
            <td class=xl100></td>
            <td class=xl100></td>
            <td class=xl100></td>
            <td class=xl100></td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl75>매체사 정보</td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl100></td>
            <td class=xl100></td>
            <td class=xl68></td>
            <td class=xl100></td>
            <td class=xl100></td>
            <td class=xl100></td>
            <td class=xl100></td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl89>매체사명</td>
            <td colspan=4 class=xl102 style='border-right:.5pt solid black;border-left:none'><?echo $comp_sa['comp_nm']?></td>
            <td class=xl91 style='border-left:none'>사업자등록번호</td>
            <td colspan=4 class=xl102 style='border-right:.5pt solid black'><?echo $comp_sa['busi_no']?></td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td rowspan=2 class=xl89 style='border-top:none'>주소</td>
            <td colspan=4 class=xl102 style='border-right:.5pt solid black;border-left:none'><?echo $comp_sa['addr']?></td>
            <td class=xl91 style='border-top:none;border-left:none'>전화</td>
            <td colspan=4 class=xl102 style='border-right:.5pt solid black'><?echo $comp_sa['tel_no']?></td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td colspan=4 class=xl102 style='border-right:.5pt solid black;border-left:none'><?echo $comp_sa['addr3']?></td>
            <td class=xl91 style='border-top:none;border-left:none'>이메일</td>
            <td colspan=4 class=xl105 style='border-right:.5pt solid black'><?echo $cont['mb_email']?></td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl89 style='border-top:none'>담당부서</td>
            <td colspan=4 class=xl102 style='border-right:.5pt solid black;border-left:none'> </td>
            <td class=xl91 style='border-top:none;border-left:none'>담당자명</td>
            <td colspan=4 class=xl102 style='border-right:.5pt solid black'><?echo $cont['mb_name']?>　</td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl68></td>
            <td class=xl100></td>
            <td class=xl100></td>
            <td class=xl100></td>
            <td class=xl100></td>
            <td class=xl68></td>
            <td class=xl100></td>
            <td class=xl100></td>
            <td class=xl100></td>
            <td class=xl100></td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl75>광고주 정보</td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl100></td>
            <td class=xl100></td>
            <td class=xl68></td>
            <td class=xl101></td>
            <td class=xl100></td>
            <td class=xl100></td>
            <td class=xl100></td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl89>광고주명</td>
            <td colspan=4 class=xl102 style='border-right:.5pt solid black;border-left:none'><?echo $cont['cli_nm']?>　</td>
            <td class=xl91 style='border-left:none'>사업자등록번호</td>
            <td colspan=4 class=xl102 style='border-right:.5pt solid black'><?echo $comp_cl['busi_no']?></td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td rowspan=2 class=xl89 style='border-top:none'>주소</td>
            <td colspan=4 class=xl102 style='border-right:.5pt solid black;border-left: none'><?echo $comp_cl['addr']?></td>
            <td class=xl91 style='border-top:none;border-left:none'>전화</td>
            <td colspan=4 class=xl102 style='border-right:.5pt solid black'><?echo $comp_cl['tel_no']?></td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td colspan=4 class=xl102 style='border-right:.5pt solid black;border-left:
  none'><?echo $comp_cl['addr3']?></td>
            <td class=xl91 style='border-top:none;border-left:none'>이메일</td>
            <td colspan=4 class=xl105 style='border-right:.5pt solid black'><a href="mailto:<?echo $comp_cl['psrn_email']?>"><?echo $comp_cl['psrn_email']?></a></td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl89 style='border-top:none'>담당부서</td>
            <td colspan=4 class=xl102 style='border-right:.5pt solid black;border-left:
  none'>　</td>
            <td class=xl91 style='border-top:none;border-left:none'>담당자명</td>
            <td colspan=4 class=xl102 style='border-right:.5pt solid black'><?echo $comp_cl['psrn_nm']?>　</td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl75>계약 내용</td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl101></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl93>VAT별도</td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td rowspan=2 class=xl113>미디어</td>
            <td rowspan=2 class=xl114 style='border-bottom:.5pt solid black'>상품</td>
            <td rowspan=2 class=xl114 style='border-bottom:.5pt solid black'>매체 수</td>
            <td rowspan=2 class=xl111 width=128 style='width:96pt'>집행기간</td>
            <td rowspan=2 class=xl111 width=124 style='width:93pt'>구좌 / 초수</td>
            <td rowspan=2 class=xl116 width=133 style='width:100pt'>광고비</td>
            <td rowspan=2 class=xl116 width=129 style='width:97pt'>청구금액</td>
            <td rowspan=2 class=xl117 width=133 style='width:100pt'>세금계산서 발행일</td>
            <td rowspan=2 class=xl117 width=133 style='width:100pt'>광고비 입금일</td>
            <td rowspan=2 class=xl111 width=133 style='width:100pt'>비고</td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl65></td>
            <td class=xl65></td>
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
            <tr height=51 style='page-break-before:always;mso-height-source:userset;
  height:38.25pt'>
                <td height=51 class=xl65 style='height:38.25pt'></td>
                <td class=xl71 width=145 style='border-top:none;width:109pt'><?echo $item['m2_nm']?></td>
                <td class=xl71 width=128 style='border-top:none;width:96pt'><?echo $item['mda_nm']?></td>
                <td class=xl71 width=128 style='border-top:none;width:96pt'><?echo $item['ins_cnt']?></td>
                <td class=xl82 width=128 style='border-top:none;width:96pt'><?echo $item['terms']?></td>
                <td class=xl70 style='border-top:none;border-left:none'><?echo $item['account_cnt']?>  /  <?echo $item['mtrl_sec']?></td>
                <td class=xl86 width=133 style='border-top:none;border-left:none;width:100pt'> </td>
                <td class=xl86 width=129 style='border-top:none;border-left:none;width:97pt'> </td>
                <td class=xl92 width=133 style='border-top:none;width:100pt'></td>
                <td class=xl92 width=133 style='border-top:none;width:100pt'> </td>
                <td class=xl83 width=133 style='border-top:none;border-left:none;width:100pt'>　</td>
                <td class=xl65></td>
                <td class=xl65></td>
            </tr>
            <?
            $idx++ ;
        }
        ?>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td colspan=5 class=xl112>합 계</td>
            <td class=xl85 style='border-top:none'> </td>
            <td class=xl69 style='border-top:none;border-left:none'> </td>
            <td class=xl84 style='border-top:none'>　</td>
            <td colspan=2 class=xl108 style='border-right:.5pt solid black'>　</td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl94>* 광고비 정산 *</td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl95>1. 세금계산서 발행</td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl95 colspan=5 style='mso-ignore:colspan'><span style='mso-spacerun:yes'> </span>- 스페이스애드는 정해진 날짜에 맞추어 광고주에게 '청구금액'에 맞는 계산서를 발행함</td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl95>2. 광고비 입금</td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl95 colspan=4 style='mso-ignore:colspan'><span style='mso-spacerun:yes'> </span>- 광고주는 정해진 날짜에 맞추어 스페이스애드에 '청구금액'에 맞는 광고비를 입금함</td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl87>　</td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl87>　</td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl75>Remark</td>
            <td class=xl65></td>
            <td class=xl68></td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl65 colspan=3 style='mso-ignore:colspan'><span style='mso-spacerun:yes'> </span>- 세금계산서 발행일 및 광고비 청구금액 확인후 승인해주시기 바랍니다.</td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl88 colspan=2 style='mso-ignore:colspan'><span style='mso-spacerun:yes'> </span>- 광고집행 상세내역 후면 첨부 (옵션사항)</td>
            <td class=xl65></td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl66>　</td>
            <td class=xl66>　</td>
            <td class=xl66>　</td>
            <td class=xl66>　</td>
            <td class=xl66>　</td>
            <td class=xl66>　</td>
            <td class=xl66>　</td>
            <td class=xl66>　</td>
            <td class=xl66>　</td>
            <td class=xl66>　</td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr class=xl73 height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl73 style='height:20.0pt'></td>
            <td class=xl96 colspan=3 style='mso-ignore:colspan'>본 Insertion Order는 광고계약서를 대신합니다.</td>
            <td class=xl96></td>
            <td class=xl73></td>
            <td class=xl73></td>
            <td class=xl73></td>
            <td class=xl73></td>
            <td class=xl73 colspan=2 style='mso-ignore:colspan'>위와 같이 광고게재를 확정합니다.</td>
            <td class=xl73></td>
            <td class=xl73></td>
        </tr>
        <tr class=xl73 height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl73 style='height:20.0pt'></td>
            <td class=xl73></td>
            <td class=xl73></td>
            <td class=xl73></td>
            <td class=xl73></td>
            <td class=xl73></td>
            <td class=xl73></td>
            <td class=xl73></td>
            <td class=xl73></td>
            <td class=xl97>신청일 :</td>
            <td class=xl73></td>
            <td class=xl73></td>
            <td class=xl73></td>
        </tr>
        <tr class=xl73 height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl73 style='height:20.0pt'></td>
            <td class=xl73></td>
            <td class=xl73></td>
            <td class=xl73></td>
            <td class=xl73></td>
            <td class=xl73></td>
            <td class=xl73></td>
            <td class=xl73></td>
            <td class=xl73></td>
            <td class=xl97>신청인 :</td>
            <td class=xl73></td>
            <td class=xl73></td>
            <td class=xl73></td>
        </tr>
        <tr class=xl73 height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl73 style='height:20.0pt'></td>
            <td class=xl73></td>
            <td class=xl73></td>
            <td class=xl73></td>
            <td class=xl73></td>
            <td class=xl73></td>
            <td class=xl73></td>
            <td class=xl73></td>
            <td class=xl73></td>
            <td class=xl73></td>
            <td class=xl73></td>
            <td class=xl73></td>
            <td class=xl73></td>
        </tr>
        <tr class=xl73 height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl73 style='height:20.0pt'></td>
            <td class=xl73></td>
            <td class=xl73></td>
            <td class=xl73></td>
            <td class=xl73></td>
            <td class=xl73></td>
            <td class=xl73></td>
            <td class=xl73></td>
            <td class=xl73></td>
            <td class=xl79>날인</td>
            <td class=xl80>spaceAdd 날인</td>
            <td class=xl73></td>
            <td class=xl73></td>
        </tr>
        <tr class=xl68 height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl68 style='height:20.0pt'></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl76 style='border-top:none'>　</td>
            <td align=left style='border-top:none;border-bottom:none' valign=top><!--[if gte vml 1]><v:shape id="그림_x0020_3" o:spid="_x0000_s4121"
                                                                  type="#_x0000_t75" style='position:absolute;margin-left:18pt;margin-top:7pt;
   width:66pt;height:64pt;z-index:3;visibility:visible' o:gfxdata="">
                    <v:imagedata src="<?=$io_img_stamp?>" o:title=""/>
                    <x:ClientData ObjectType="Pict">
                        <x:SizeWithCells/>
                    </x:ClientData>
                </v:shape><![endif]--><![if !vml]><span style='mso-ignore:vglayout;
  position:absolute;z-index:3;margin-left:24px;margin-top:9px;width:88px;
  height:85px'><img width=66 height=64
                    src="<?=$io_img_stamp?>" v:shapes="그림_x0020_3"></span><![endif]><span
                        style='mso-ignore:vglayout2'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td height=27 class=xl78 width=133 style='height:20.0pt;border-top:none;border-bottom:none; border-left:none;width:100pt'>　</td>
   </tr>
  </table>
  </span></td>
            <td class=xl68></td>
            <td class=xl68></td>
        </tr>
        <tr class=xl68 height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl68 style='height:20.0pt'></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl77>　</td>
            <td class=xl77 style='border-left:none;border-top:none'>　</td>
            <td class=xl68></td>
            <td class=xl68></td>
        </tr>
        <tr class=xl68 height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl68 style='height:20.0pt'></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl77>　</td>
            <td class=xl77 style='border-left:none'>　</td>
            <td class=xl68></td>
            <td class=xl68></td>
        </tr>
        <tr class=xl68 height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl68 style='height:20.0pt'></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl78>　</td>
            <td class=xl78 style='border-left:none'>　</td>
            <td class=xl68></td>
            <td class=xl68></td>
        </tr>
        <tr class=xl68 height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl68 style='height:20.0pt'></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl68></td>
        </tr>
        <tr class=xl68 height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl68 style='height:20.0pt'></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl68></td>
        </tr>
        <tr class=xl73 height=35 style='mso-height-source:userset;height:26.5pt'>
            <td height=35 class=xl73 style='height:26.5pt'></td>
            <td colspan=10 class=xl110>스페이스애드 광고게재신청서</td>
            <td class=xl73></td>
            <td class=xl73></td>
        </tr>
        <tr height=27 style='height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl65></td>
            <td class=xl81></td>
            <td class=xl81></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <![if supportMisalignedColumns]>
        <tr height=0 style='display:none'>
            <td width=36 style='width:27pt'></td>
            <td width=145 style='width:109pt'></td>
            <td width=128 style='width:96pt'></td>
            <td width=128 style='width:96pt'></td>
            <td width=128 style='width:96pt'></td>
            <td width=124 style='width:93pt'></td>
            <td width=133 style='width:100pt'></td>
            <td width=129 style='width:97pt'></td>
            <td width=133 style='width:100pt'></td>
            <td width=133 style='width:100pt'></td>
            <td width=133 style='width:100pt'></td>
            <td width=36 style='width:27pt'></td>
            <td width=101 style='width:76pt'></td>
        </tr>
        <![endif]>
    </table>
</div>
</body>

</html>
