<?PHP
//We need to know current month and year
$cur_month	= strtolower(date("F"));
$cur_year	= date("Y");

//we have to change the year into education year
//where the education year starts per july
//So from January until June, set the year as (current year minus 1) - current year
//From July until December, set the year as current year - (current year plus 1)
if($cur_month == "january" || $cur_month == "february" || $cur_month == "march" || $cur_month == "april" || $cur_month == "may" || $cur_month == "june") {	
	$edu_year1	= ($cur_year-1)." - ".($cur_year);		
	$edu_year2	= ($cur_year)." - ".($cur_year+1);
	
} else if ($cur_month == "july" || $cur_month == "august" || $cur_month == "september" || $cur_month == "october" || $cur_month == "november" || $cur_month == "december") {	
	$edu_year1	= ($cur_year)." - ".($cur_year+1);		
	$edu_year2	= ($cur_year+1)." - ".($cur_year+2);
		
}
?>
<option value="<?PHP echo $edu_year1; ?>"><?PHP echo $edu_year1; ?></option>
<option value="<?PHP echo $edu_year2; ?>"><?PHP echo $edu_year2; ?></option>