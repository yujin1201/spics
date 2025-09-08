<?
header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-Disposition: attachment; filename = 광고회사_위수탁.xls" );
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
    <!--[if !mso]>
    <style>
        v\:* {behavior:url(#default#VML);}
        o\:* {behavior:url(#default#VML);}
        x\:* {behavior:url(#default#VML);}
        .shape {behavior:url(#default#VML);}
    </style>
    <![endif]-->
    <style id="agn_BAJ04_0_17590_Styles">
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
        .style18
        {mso-number-format:0%;
            mso-style-name:백분율;
            mso-style-id:5;}
        .style16
        {mso-number-format:"_-* \#\,\#\#0_-\;\\-* \#\,\#\#0_-\;_-* \0022-\0022_-\;_-\@_-";
            mso-style-name:"쉼표 \[0\]";
            mso-style-id:6;}
        .style0
        { text-align:general;
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
        {mso-style-parent:style16;
            font-size:10.0pt;
            font-weight:700;
            mso-number-format:"_-* \#\,\#\#0_-\;\\-* \#\,\#\#0_-\;_-* \0022-\0022_-\;_-\@_-";
            text-align:center;
            border:.5pt solid windowtext;
            background:#FFE699;
            mso-pattern:black none;
            white-space:normal;}
        .xl71
        {mso-style-parent:style16;
            color:windowtext;
            font-size:10.0pt;
            mso-number-format:"General\0022개월\0022";
            text-align:center;
            border:.5pt solid windowtext;}
        .xl72
        {   font-size:10.0pt;
            text-align:center;
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:.5pt solid windowtext;
            white-space:normal;}
        .xl73
        {mso-style-parent:style0;
            color:red;
            font-size:10.0pt;
            font-weight:700;}
        .xl74
        {mso-style-parent:style0;
            mso-number-format:"\@";
            font-size:12.0pt;
            font-weight:700;}
        .xl75
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
        .xl76
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:left;
            padding-left:12px;
            mso-char-indent-count:1;}
        .xl77
        {mso-style-parent:style0;
            font-size:10.0pt;
            font-weight:700;
            text-align:left;
            padding-left:12px;
            mso-char-indent-count:1;}
        .xl78
        {mso-style-parent:style0;
            font-weight:700;}
        .xl79
        {mso-style-parent:style0;
            font-size:10.0pt;
            font-weight:700;
            border-top:.5pt solid windowtext;
            border-right:.5pt solid windowtext;
            border-bottom:none;
            border-left:.5pt solid windowtext;}
        .xl80
        {mso-style-parent:style0;
            font-size:10.0pt;
            font-weight:700;
            border-top:none;
            border-right:.5pt solid windowtext;
            border-bottom:none;
            border-left:.5pt solid windowtext;}
        .xl81
        {mso-style-parent:style0;
            font-size:10.0pt;
            font-weight:700;
            border-top:none;
            border-right:.5pt solid windowtext;
            border-bottom:.5pt solid windowtext;
            border-left:.5pt solid windowtext;}
        .xl82
        {mso-style-parent:style0;
            font-size:24.0pt;
            font-weight:700;}
        .xl83
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
        .xl84
        {mso-style-parent:style0;
            font-size:12.0pt;
            font-weight:700;
            text-align:center;
            border:.5pt solid windowtext;}
        .xl85
        {mso-style-parent:style0;
            font-size:9.0pt;}
        .xl86
        {mso-style-parent:style0;
            color:#FFF2CC;
            font-size:10.0pt;}
        .xl87
        {mso-style-parent:style0;
            color:#DDEBF7;
            font-size:10.0pt;}
        .xl88
        {mso-style-parent:style16;
            color:windowtext;
            font-size:10.0pt;
            mso-number-format:"General\0022개월\0022";
            text-align:center;
            border:.5pt solid windowtext;
            white-space:normal;}
        .xl89
        {mso-style-parent:style16;
            font-size:10.0pt;
            mso-number-format:"Long Date";
            text-align:center;
            border:.5pt solid windowtext;
            white-space:normal;}
        .xl90
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
        .xl91
        {mso-style-parent:style0;
            font-size:10.0pt;
            font-weight:700;
            text-align:left;
            border:.5pt solid windowtext;
            padding-left:12px;
            mso-char-indent-count:1;}
        .xl92
        {mso-style-parent:style0;
            font-size:10.0pt;
            font-weight:700;
            text-align:left;
            border:.5pt solid windowtext;
            background:white;
            mso-pattern:black none;
            padding-left:12px;
            mso-char-indent-count:1;}
        .xl93
        {mso-style-parent:style0;
            color:#C00000;
            font-size:10.0pt;
            text-align:left;
            padding-left:12px;
            mso-char-indent-count:1;}
        .xl94
        {mso-style-parent:style0;
            color:#C00000;
            font-size:10.0pt;
            text-align:left;}
        .xl95
        {mso-style-parent:style18;
            font-size:10.0pt;
            font-weight:700;
            mso-number-format:0%;
            text-align:center;
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:none;
            background:#FFD966;
            mso-pattern:black none;}
        .xl96
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
        .xl97
        {mso-style-parent:style18;
            font-size:10.0pt;
            font-weight:700;
            mso-number-format:0%;
            text-align:center;
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:.5pt solid windowtext;
            white-space:normal;}
        .xl98
        {mso-style-parent:style16;
            font-size:10.0pt;
            font-weight:700;
            mso-number-format:"_-* \#\,\#\#0_-\;\\-* \#\,\#\#0_-\;_-* \0022-\0022_-\;_-\@_-";
            text-align:center;
            border:.5pt solid windowtext;
            background:white;
            mso-pattern:black none;
            white-space:normal;}
        .xl99
        {mso-style-parent:style0;
            font-size:10.0pt;
            mso-number-format:"\@";
            background:white;
            mso-pattern:black none;}
        .xl100
        {mso-style-parent:style0;
            color:red;
            font-size:10.0pt;}
        .xl101
        {mso-style-parent:style0;
            color:red;
            font-size:10.0pt;
            text-align:left;}
        .xl102
        {mso-style-parent:style0;
            color:red;
            font-size:10.0pt;
            text-align:left;
            padding-left:12px;
            mso-char-indent-count:1;}
        .xl103
        {mso-style-parent:style0;
            color:windowtext;
            font-size:10.0pt;
            font-weight:700;
            text-align:left;
            border:.5pt solid windowtext;
            padding-left:12px;
            mso-char-indent-count:1;}
        .xl104
        {mso-style-parent:style0;
            color:#FFF2CC;}
        .xl105
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
        .xl106
        {mso-style-parent:style0;
            font-size:10.0pt;
            font-weight:700;
            text-align:right;}
        .xl107
        {mso-style-parent:style0;
            font-size:10.0pt;
            font-weight:700;
            text-align:left;}
        .xl108
        {mso-style-parent:style0;
            font-size:10.0pt;
            mso-number-format:"\@";}
        .xl109
        {mso-style-parent:style0;
            color:red;
            font-size:12.0pt;
            font-weight:700;}
        .xl110
        {mso-style-parent:style0;
            font-size:12.0pt;
            font-weight:700;
            text-align:left;}
        .xl111
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:left;
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:.5pt solid windowtext;
            padding-left:12px;
            mso-char-indent-count:1;}
        .xl112
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:left;
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:none;
            padding-left:12px;
            mso-char-indent-count:1;}
        .xl113
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:left;
            border-top:.5pt solid windowtext;
            border-right:.5pt solid windowtext;
            border-bottom:.5pt solid windowtext;
            border-left:none;
            padding-left:12px;
            mso-char-indent-count:1;}
        .xl114
        {mso-style-parent:style0;
            color:red;
            font-size:10.0pt;
            text-align:left;
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:.5pt solid windowtext;
            padding-left:12px;
            mso-char-indent-count:1;}
        .xl115
        {mso-style-parent:style0;
            color:red;
            font-size:10.0pt;
            text-align:left;
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:none;
            padding-left:12px;
            mso-char-indent-count:1;}
        .xl116
        {mso-style-parent:style0;
            color:windowtext;
            font-size:10.0pt;
            font-weight:700;
            text-align:left;
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:.5pt solid windowtext;
            padding-left:12px;
            mso-char-indent-count:1;}
        .xl117
        {mso-style-parent:style0;
            color:windowtext;
            font-size:10.0pt;
            font-weight:700;
            text-align:left;
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:none;
            padding-left:12px;
            mso-char-indent-count:1;}
        .xl118
        {mso-style-parent:style16;
            font-size:10.0pt;
            font-weight:700;
            mso-number-format:"\#\,\#\#\#\0022원\0022";
            text-align:left;
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:none;
            padding-left:12px;
            mso-char-indent-count:1;}
        .xl119
        {mso-style-parent:style16;
            font-size:10.0pt;
            font-weight:700;
            mso-number-format:"\#\,\#\#\#\0022원\0022";
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
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:.5pt solid windowtext;
            background:white;
            mso-pattern:black none;
            padding-left:12px;
            mso-char-indent-count:1;}
        .xl121
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:left;
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:none;
            background:white;
            mso-pattern:black none;
            padding-left:12px;
            mso-char-indent-count:1;}
        .xl122
        {mso-style-parent:style0;
            font-size:10.0pt;
            text-align:left;
            border-top:.5pt solid windowtext;
            border-right:.5pt solid windowtext;
            border-bottom:.5pt solid windowtext;
            border-left:none;
            background:white;
            mso-pattern:black none;
            padding-left:12px;
            mso-char-indent-count:1;}
        .xl123
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
        .xl124
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
        .xl125
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
        .xl126
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
        .xl127
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
        .xl128
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
        .xl129
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
        .xl130
        {mso-style-parent:style0;
            color:windowtext;
            font-size:12.0pt;
            font-weight:700;
            text-align:center;
            background:#F2F2F2;
            mso-pattern:black none;}
        .xl131
        {mso-style-parent:style0;
            color:white;
            font-size:10.0pt;
            font-weight:700;
            text-align:center;
            border:.5pt solid windowtext;
            background:#404040;
            mso-pattern:black none;
            white-space:normal;}
        .xl132
        {mso-style-parent:style0;
            font-size:10.0pt;
            font-weight:700;
            text-align:center;
            border:.5pt solid windowtext;
            background:#FFD966;
            mso-pattern:black none;}
        .xl133
        {mso-style-parent:style0;
            color:white;
            font-size:10.0pt;
            font-weight:700;
            text-align:center;
            border:.5pt solid windowtext;
            background:#404040;
            mso-pattern:black none;}
        .xl134
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
        .xl135
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
        .xl136
        {mso-style-parent:style0;
            color:white;
            font-size:10.0pt;
            font-weight:700;
            text-align:center;
            border:.5pt solid windowtext;
            background:#9933FF;
            mso-pattern:black none;
            white-space:normal;}
        .xl137
        {mso-style-parent:style0;
            color:white;
            font-size:10.0pt;
            font-weight:700;
            text-align:center;
            border-top:.5pt solid windowtext;
            border-right:none;
            border-bottom:none;
            border-left:.5pt solid windowtext;
            background:#404040;
            mso-pattern:black none;
            white-space:normal;}
        .xl138
        {mso-style-parent:style0;
            color:white;
            font-size:10.0pt;
            font-weight:700;
            text-align:center;
            border-top:none;
            border-right:none;
            border-bottom:.5pt solid windowtext;
            border-left:.5pt solid windowtext;
            background:#404040;
            mso-pattern:black none;
            white-space:normal;}
        .xl139
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
        .xl152
        {mso-style-parent:style0;
            color:black;
            font-size:10.0pt;
            mso-number-format:"\@";
            text-align:center;
            border-top:none;
            border-bottom:.5pt solid windowtext;
            border-left:none;
            white-space:normal;}
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

<div id="agn_BAJ04_0_17590" align=center x:publishsource="Excel">

    <table border=0 cellpadding=0 cellspacing=0 width=1636 style='border-collapse:
 collapse;table-layout:fixed;width:1229pt'>
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
        <col class=xl65 width=73 style='mso-width-source:userset;mso-width-alt:2346;
 width:55pt'>
        <col class=xl65 width=133 span=4 style='mso-width-source:userset;mso-width-alt:
 4266;width:100pt'>
        <col class=xl65 width=36 style='mso-width-source:userset;mso-width-alt:1152;
 width:27pt'>
        <col class=xl65 width=101 style='mso-width-source:userset;mso-width-alt:3242;
 width:76pt'>
        <col class=xl65 width=72 style='width:54pt'>
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
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='height:20.0pt'>
            <td height=27 class=xl65 width=36 style='height:20.0pt;width:27pt'><a name="Print_Area"></a></td>
            <td class=xl65 width=145 style='width:109pt'></td>
            <td class=xl65 width=128 style='width:96pt'></td>
            <td class=xl65 width=128 style='width:96pt'></td>
            <td class=xl65 width=128 style='width:96pt'></td>
            <td class=xl65 width=124 style='width:93pt'></td>
            <td class=xl65 width=133 style='width:100pt'></td>
            <td class=xl65 width=73 style='width:55pt'></td>
            <td class=xl65 width=133 style='width:100pt'></td>
            <td class=xl65 width=133 style='width:100pt'></td>
            <td class=xl65 width=133 style='width:100pt'></td>
            <td width=133 style='width:100pt' align=left valign=top> <span style='mso-ignore:vglayout;
  position:absolute;z-index:1;margin-left:79px;margin-top:30px;width:252px;
  height:142px'><img width=100 height=60
                     src="<?=$io_img_logo?>" v:shapes="그림_x0020_1"></span> <span
                        style='mso-ignore:vglayout2'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td height=27 class=xl65 width=133 style='height:20.0pt;width:100pt'></td>
   </tr>
  </table>
  </span></td>
            <td class=xl65 width=36 style='width:27pt'></td>
            <td class=xl65 width=101 style='width:76pt'></td>
            <td class=xl65 width=72 style='width:54pt'></td>
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
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl82 colspan=2 style='mso-ignore:colspan'>Insertion Order</td>
            <td class=xl74></td>
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
            <td class=xl87></td>
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
            <td class=xl66>　</td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl87></td>
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
            <td class=xl65></td>
            <td class=xl87></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl78>캠페인 정보</td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl101></td>
            <td class=xl94></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl87></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl91>광고주명</td>
            <td colspan=4 class=xl114 style='border-left:none'><?echo $cont['cli_nm']?>　</td>
            <td class=xl91>캠페인명</td>
            <td colspan=5 class=xl112 style='border-right:.5pt solid black'><?echo $cont['campgn_nm']?></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl87></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl91 style='border-top:none'>총 광고기간</td>
            <td colspan=4 class=xl116 style='border-left:none'><?echo $cont['cont_terms']?></td>
            <td class=xl103 style='border-top:none'>총 광고비</td>
            <td colspan=5 class=xl118 style='border-right:.5pt solid black'><?echo $cont['cont_amt']?></td>
            <td class=xl65></td>
            <td class=xl73></td>
            <td class=xl87></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl68></td>
            <td class=xl76></td>
            <td class=xl76></td>
            <td class=xl76></td>
            <td class=xl76></td>
            <td class=xl68></td>
            <td class=xl76></td>
            <td class=xl76></td>
            <td class=xl76></td>
            <td class=xl76></td>
            <td class=xl76></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl78>매체사 정보</td>
            <td class=xl77></td>
            <td class=xl77></td>
            <td class=xl76></td>
            <td class=xl76></td>
            <td class=xl68></td>
            <td class=xl76></td>
            <td class=xl76></td>
            <td class=xl76></td>
            <td class=xl76></td>
            <td class=xl76></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl91>매체사명</td>
            <td colspan=4 class=xl111 style='border-right:.5pt solid black;border-left:none'><?echo $comp_sa['comp_nm']?></td>
            <td class=xl75 style='border-left:none'>사업자등록번호</td>
            <td colspan=5 class=xl111 style='border-right:.5pt solid black'><?echo $comp_sa['busi_no']?></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td rowspan=2 class=xl91 style='border-top:none'>주소</td>
            <td colspan=4 class=xl111 style='border-right:.5pt solid black;border-left:none'><?echo $comp_sa['addr']?></td>
            <td class=xl75 style='border-top:none;border-left:none'>전화</td>
            <td colspan=5 class=xl111 style='border-right:.5pt solid black'><?echo $comp_sa['tel_no']?>　</td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td colspan=4 class=xl120 style='border-right:.5pt solid black;border-left:none'><?echo $comp_sa['addr3']?></td>
            <td class=xl75 style='border-top:none;border-left:none'>이메일</td>
            <td colspan=5 class=xl123 style='border-right:.5pt solid black'><?echo $cont['mb_email']?></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl91 style='border-top:none'>담당부서</td>
            <td colspan=4 class=xl111 style='border-right:.5pt solid black;border-left:none'> </td>
            <td class=xl75 style='border-top:none;border-left:none'>담당자명</td>
            <td colspan=5 class=xl111 style='border-right:.5pt solid black'><?echo $cont['mb_name']?></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl68></td>
            <td class=xl76></td>
            <td class=xl76></td>
            <td class=xl76></td>
            <td class=xl76></td>
            <td class=xl68></td>
            <td class=xl76></td>
            <td class=xl76></td>
            <td class=xl76></td>
            <td class=xl76></td>
            <td class=xl76></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl78>대행사 정보</td>
            <td class=xl77></td>
            <td class=xl77></td>
            <td class=xl76></td>
            <td class=xl76></td>
            <td class=xl68></td>
            <td class=xl101></td>
            <td class=xl93></td>
            <td class=xl76></td>
            <td class=xl76></td>
            <td class=xl76></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl92>대행사명</td>
            <td colspan=4 class=xl111 style='border-right:.5pt solid black;border-left:none'><?echo $comp_ag['comp_nm']?></td>
            <td class=xl75 style='border-left:none'>사업자등록번호</td>
            <td colspan=5 class=xl111 style='border-right:.5pt solid black'><?echo $comp_ag['busi_no']?></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td rowspan=2 class=xl92 style='border-top:none'>주소</td>
            <td colspan=4 class=xl111 style='border-right:.5pt solid black;border-left:none'><?echo $comp_ag['addr']?></td>
            <td class=xl75 style='border-top:none;border-left:none'>전화</td>
            <td colspan=5 class=xl111 style='border-right:.5pt solid black'><?echo $comp_ag['tel_no']?>　</td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td colspan=4 class=xl111 style='border-right:.5pt solid black;border-left:none'><?echo $comp_ag['addr3']?></td>
            <td class=xl75 style='border-top:none;border-left:none'>이메일</td>
            <td colspan=5 class=xl123 style='border-right:.5pt solid black'><a href="mailto:<?echo $comp_ag['psrn_email']?>"><?echo $comp_ag['psrn_email']?></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl92 style='border-top:none'>담당부서</td>
            <td colspan=4 class=xl111 style='border-right:.5pt solid black;border-left:none'> </td>
            <td class=xl75 style='border-top:none;border-left:none'>담당자명</td>
            <td colspan=5 class=xl111 style='border-right:.5pt solid black'><?echo $comp_mda['psrn_nm']?></td>
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
            <td class=xl100></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl78>계약 내용</td>
            <td class=xl68></td>
            <td class=xl68></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl102></td>
            <td class=xl65></td>
            <td class=xl106>VAT별도</td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td rowspan=2 class=xl133>미디어</td>
            <td rowspan=2 class=xl134 style='border-bottom:.5pt solid black'>상품</td>
            <td rowspan=2 class=xl134 style='border-bottom:.5pt solid black'>매체 수</td>
            <td rowspan=2 class=xl131 width=128 style='width:96pt'>집행기간</td>
            <td rowspan=2 class=xl131 width=124 style='width:93pt'>구좌 / 초수</td>
            <td rowspan=2 class=xl136 width=133 style='width:100pt'>광고비 (Gross)</td>
            <td rowspan=2 class=xl137 width=73 style='border-bottom:.5pt solid black;width:55pt'>수수료율</td>
            <td rowspan=2 class=xl131 width=133 style='width:100pt'>대행수수료</td>
            <td rowspan=2 class=xl139 width=133 style='width:100pt'>세금계산서 발행일</td>
            <td rowspan=2 class=xl139 width=133 style='width:100pt'>광고비 입금일</td>
            <td rowspan=2 class=xl131 width=133 style='width:100pt'>비고</td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl104></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl65></td>
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
        <tr height=51 style='page-break-before:always;mso-height-source:userset; height:38.25pt'>
            <td height=51 class=xl65 style='height:38.25pt'></td>
            <td class=xl72 width=145 style='border-top:none;width:109pt'><?echo $item['m2_nm']?></td>
            <td class=xl72 width=128 style='border-top:none;width:96pt'><?echo $item['mda_nm']?></td>
            <td class=xl72 width=128 style='border-top:none;width:96pt'><?echo $item['ins_cnt']?></td>
            <td class=xl88 width=128 style='border-top:none;width:96pt'><?echo $item['terms']?>　</td>
            <td class=xl152 style='border-top:none;border-left:none'> <?echo $item['account_cnt']?> / <?echo $item['mtrl_sec']?> </td>
            <td class=xl70 width=133 style='border-top:none;width:100pt'></td>
            <td class=xl97 width=73 style='border-top:none;border-left:none;width:55pt'></td>
            <td class=xl98 width=133 style='border-top:none;width:100pt'></td>
            <td class=xl105 width=133 style='border-top:none;width:100pt'></td>
            <td class=xl105 width=133 style='border-top:none;width:100pt'></td>
            <td class=xl89 width=133 style='border-top:none;border-left:none;width:100pt'>　</td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl86></td>
        </tr>
        <?
            $idx++ ;
        }
        ?>
        <tr height=51 style='mso-height-source:userset;height:38.25pt'>
            <td height=51 class=xl65 style='height:38.25pt'></td>
            <td class=xl72 width=145 style='border-top:none;width:109pt'></td>
            <td class=xl72 width=128 style='border-top:none;width:96pt'></td>
            <td class=xl72 width=128 style='border-top:none;width:96pt'></td>
            <td class=xl88 width=128 style='border-top:none;width:96pt'>　</td>
            <td class=xl71 style='border-top:none;border-left:none'></td>
            <td class=xl70 width=133 style='border-top:none;border-left:none;width:100pt'></td>
            <td class=xl97 width=73 style='border-top:none;border-left:none;width:55pt'></td>
            <td class=xl98 width=133 style='border-top:none;width:100pt'></td>
            <td class=xl105 width=133 style='border-top:none;width:100pt'></td>
            <td class=xl105 width=133 style='border-top:none;width:100pt'></td>
            <td class=xl89 width=133 style='border-top:none;border-left:none;width:100pt'>　</td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl86></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td colspan=5 class=xl132>합 계</td>
            <td class=xl96 style='border-top:none'></td>
            <td class=xl95 style='border-top:none'></td>
            <td class=xl69 style='border-top:none'> </td>
            <td class=xl90 style='border-top:none'>　</td>
            <td colspan=2 class=xl128 style='border-right:.5pt solid black'>　</td>
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
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl107>* 광고비 정산 *</td>
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
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl108>1. 세금계산서 발행</td>
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
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl108 colspan=4 style='mso-ignore:colspan'><span
                        style='mso-spacerun:yes'> </span>- 대행사는 정해진 날짜에 맞추어 스페이스애드에 위수탁계산서를 발행함</td>
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
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl108>2. 광고비 입금</td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl108 colspan=5 style='mso-ignore:colspan'><span style='mso-spacerun:yes'> </span>- 대행사는 정해진 날짜에 맞추어 스페이스애드에 광고비를 입금함 (대행수수료
                상계처리)</td>
            <td class=xl65></td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
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
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl67>　</td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl99>　</td>
            <td class=xl67>　</td>
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
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl99>　</td>
            <td class=xl67>　</td>
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
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl78>Remark</td>
            <td class=xl65></td>
            <td class=xl68></td>
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
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl65 colspan=3 style='mso-ignore:colspan'><span style='mso-spacerun:yes'> </span>- 세금계산서 발행일 및 광고비 금액 확인후 승인해주시기 바랍니다.</td>
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
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
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
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl100 colspan=2 style='mso-ignore:colspan'><span style='mso-spacerun:yes'> </span>- 광고집행 상세내역 후면 첨부 (옵션사항)</td>
            <td class=xl65></td>
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
            <td class=xl66>　</td>
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
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr class=xl74 height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl74 style='height:20.0pt'></td>
            <td class=xl109 colspan=3 style='mso-ignore:colspan'>본 Insertion Order는 광고계약서를 대신합니다.</td>
            <td class=xl109></td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl74 colspan=2 style='mso-ignore:colspan'>위와 같이 광고게재를 확정합니다.</td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl74></td>
        </tr>
        <tr class=xl74 height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl74 style='height:20.0pt'></td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl110>신청일 :</td>
            <td class="xl74"> </td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl74></td>
        </tr>
        <tr class=xl74 height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl74 style='height:20.0pt'></td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl110>신청인 :</td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl74></td>
        </tr>
        <tr class=xl74 height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl74 style='height:20.0pt'></td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl74></td>
        </tr>
        <tr class=xl74 height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl74 style='height:20.0pt'></td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl83>날인</td>
            <td class=xl84>spaceAdd 날인</td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl74></td>
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
            <td class=xl79 style='border-top:none'>　</td>
            <td align=left valign=top><!--[if gte vml 1]><v:shape id="그림_x0020_2" o:spid="_x0000_s3098"
                                                                  type="#_x0000_t75" style='position:absolute;margin-left:16pt;margin-top:8pt;
   width:66pt;height:65pt;z-index:2;visibility:visible' o:gfxdata="">
                    <v:imagedata src="<?=$io_img_stamp?>" o:title=""/>
                    <x:ClientData ObjectType="Pict">
                        <x:SizeWithCells/>
                    </x:ClientData>
                </v:shape><![endif]--><![if !vml]><span style='mso-ignore:vglayout;
  position:absolute;z-index:2;margin-left:21px;margin-top:11px;width:88px;
  height:87px'><img width=66 height=65
                    src="<?=$io_img_stamp?>" v:shapes="그림_x0020_2"></span><![endif]><span
                        style='mso-ignore:vglayout2'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td height=27 class=xl79 width=133 style='height:20.0pt;border-top:none;
    border-left:none;width:100pt'>　</td>
   </tr>
  </table>
  </span></td>
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
            <td class=xl80>　</td>
            <td class=xl80 style='border-left:none'>　</td>
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
            <td class=xl80>　</td>
            <td class=xl80 style='border-left:none'>　</td>
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
            <td class=xl81>　</td>
            <td class=xl81 style='border-left:none'>　</td>
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
            <td class=xl68></td>
            <td class=xl68></td>
        </tr>
        <tr class=xl74 height=35 style='mso-height-source:userset;height:26.5pt'>
            <td height=35 class=xl74 style='height:26.5pt'></td>
            <td colspan=11 class=xl130>스페이스애드 광고게재신청서</td>
            <td class=xl74></td>
            <td class=xl74></td>
            <td class=xl74></td>
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
            <td class=xl65></td>
            <td class=xl65></td>
        </tr>
        <tr height=27 style='mso-height-source:userset;height:20.0pt'>
            <td height=27 class=xl65 style='height:20.0pt'></td>
            <td class=xl65></td>
            <td class=xl85></td>
            <td class=xl85></td>
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
        <![if supportMisalignedColumns]>
        <tr height=0 style='display:none'>
            <td width=36 style='width:27pt'></td>
            <td width=145 style='width:109pt'></td>
            <td width=128 style='width:96pt'></td>
            <td width=128 style='width:96pt'></td>
            <td width=128 style='width:96pt'></td>
            <td width=124 style='width:93pt'></td>
            <td width=133 style='width:100pt'></td>
            <td width=73 style='width:55pt'></td>
            <td width=133 style='width:100pt'></td>
            <td width=133 style='width:100pt'></td>
            <td width=133 style='width:100pt'></td>
            <td width=133 style='width:100pt'></td>
            <td width=36 style='width:27pt'></td>
            <td width=101 style='width:76pt'></td>
            <td width=72 style='width:54pt'></td>
        </tr>
        <![endif]>
    </table>

</div>


<!----------------------------->
<!--Excel의 웹 페이지 마법사로 게시해서 나온 결과의 끝-->
<!----------------------------->
</body>

</html>
