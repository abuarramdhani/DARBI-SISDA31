<?PHP
$cur_year	= date("Y");
?>
<select name="periode">
<option value="<?PHP echo ($cur_year-5)." - ".($cur_year-4); ?>"><?PHP echo ($cur_year-5)." - ".($cur_year-4); ?></option>
<option value="<?PHP echo ($cur_year-4)." - ".($cur_year-3); ?>"><?PHP echo ($cur_year-4)." - ".($cur_year-3); ?></option>
<option value="<?PHP echo ($cur_year-3)." - ".($cur_year-2); ?>"><?PHP echo ($cur_year-3)." - ".($cur_year-2); ?></option>
<option value="<?PHP echo ($cur_year-2)." - ".($cur_year-1); ?>"><?PHP echo ($cur_year-2)." - ".($cur_year-1); ?></option>
<option value="<?PHP echo ($cur_year-1)." - ".$cur_year; ?>"><?PHP echo ($cur_year-1)." - ".$cur_year; ?></option>
<option value="<?PHP echo $cur_year." - ".($cur_year+1); ?>" selected="selected"><?PHP echo $cur_year." - ".($cur_year+1); ?></option>
<option value="<?PHP echo ($cur_year+1)." - ".($cur_year+2); ?>"><?PHP echo ($cur_year+1)." - ".($cur_year+2); ?></option>
</select>

