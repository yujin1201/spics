<?php
include_once('./_common.php');

$sql = "select mda_seq, mda_nm, dep  from vi_media where up_mda_seq={$_GET['up_mda_seq']} order by ord ";
$result = sql_query($sql);
$array_select = array();
$diff = 0;
$dep = 0;

while($row = sql_fetch_array($result)) {

    $array_select[$row[mda_seq]] = trim($row[mda_nm]);
    if($diff !=0){
        $mda_nm .= ",";
        $mda_seq .= ",";
    }
    $mda_nm .= "new Array('".$diff."','".$row[mda_nm]."')";
    $mda_seq .= "new Array('".$diff."','".$row[mda_seq]."')";

    $diff++;
    $dep = $row[dep];
}

if(!sizeof($array_select)) return;

echo "<select name='mda_seq_select_{$dep}' id='mda_seq_select_{$dep}' onchange='update_select({$dep},0)'>";
echo "<option value=''>선택하세요</option>";
foreach( $array_select as $key => $val )
{
    echo "<option value='".$key."'";
    if($ob!="")
    {
        is_select($ob, $key);
    }
    echo "> ".$val." </option>";
}
echo "</select>";
?>


