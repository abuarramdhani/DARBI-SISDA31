<?PHP
$select_periode	= empty($src_select_periode) ? "" : $src_select_periode;

$cur_year	= date("Y")
?>
<select name="periode">
<option value="<?PHP echo $cur_year." - ".($cur_year+1); ?>"><?PHP echo $cur_year." - ".($cur_year+1); ?></option>
<option value="<?PHP echo ($cur_year+1)." - ".($cur_year+2); ?>"><?PHP echo ($cur_year+1)." - ".($cur_year+2); ?></option>
</select>