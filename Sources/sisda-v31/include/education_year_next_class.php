<?PHP
//We need to know current month and year
$cur_month	= strtolower(date("F"));
$cur_year	= date("Y");

//we have to change the year into education year
//where the education year starts per july
//So from January until June, set the year as (current year minus 1) - current year
//From July until December, set the year as current year - (current year plus 1)
if($cur_month == "january" || $cur_month == "february" || $cur_month == "march" || $cur_month == "april" || $cur_month == "may" || $cur_month == "june") {	
	
	$edu_year0	= ($cur_year-2)." - ".($cur_year-1);	
	$edu_year1	= ($cur_year-1)." - ".($cur_year);		
	$edu_year2	= ($cur_year)." - ".($cur_year+1);
		
	$show0	= ($cur_year-2)." - ".($cur_year-1)." ke ".($cur_year-1)." - ".($cur_year);	
	$show1	= ($cur_year-1)." - ".($cur_year)." ke ".($cur_year)." - ".($cur_year+1);
	$show2	= ($cur_year)." - ".($cur_year+1)." ke ".($cur_year+1)." - ".($cur_year+2);
	
	$check0	= ($cur_year-1)." - ".($cur_year);
	$check1	= ($cur_year)." - ".($cur_year+1);
	$check2	= ($cur_year+1)." - ".($cur_year+2);
	
} else if ($cur_month == "july" || $cur_month == "august" || $cur_month == "september" || $cur_month == "october" || $cur_month == "november" || $cur_month == "december") {	
	$edu_year0	= ($cur_year-1)." - ".($cur_year);		
	$edu_year1	= ($cur_year)." - ".($cur_year+1);		
	$edu_year2	= ($cur_year+1)." - ".($cur_year+2);	
	
	$show0	= ($cur_year-1)." - ".($cur_year)." ke ".($cur_year)." - ".($cur_year+1);
	$show1	= ($cur_year)." - ".($cur_year+1)." ke ".($cur_year+1)." - ".($cur_year+2);
	$show2	= ($cur_year+2)." - ".($cur_year+2)." ke ".($cur_year+1)." - ".($cur_year+3);
	
	$check0	= ($cur_year)." - ".($cur_year+1);
	$check1	= ($cur_year+1)." - ".($cur_year+2);
	$check2	= ($cur_year+1)." - ".($cur_year+3);
		
}

$checked	= explode("-",$check_tahun_jenjang);
$checked_jenjang	= $checked[0];

$src_check_year_spp_0	= "select distinct periode from set_spp where periode = '$check0' and jenjang = '$checked_jenjang'";
$query_check_year_spp_0	= mysqli_query($mysql_connect, $src_check_year_spp_0) or die(mysql_error());

$src_check_year_spp_1	= "select distinct periode from set_spp where periode = '$check1' and jenjang = '$checked_jenjang'";
$query_check_year_spp_1	= mysqli_query($mysql_connect, $src_check_year_spp_1) or die(mysql_error());

$src_check_year_spp_2	= "select distinct periode from set_spp where periode = '$check2' and jenjang = '$checked_jenjang'";
$query_check_year_spp_2	= mysqli_query($mysql_connect, $src_check_year_spp_2) or die(mysql_error());

//Look!
//The value of combo box below is current education year.
//So, for students that move to the next class has to use current year + 1
//i know that this is all really hard to understand, but here it is, what should i say. please learn harder.

//we only display the option, if spp payment has been set in table set_spp for the year spesified
?>
<select name="periode">
<?PHP if(mysql_num_rows($query_check_year_spp_0) != 0) { ?><option value="<?PHP echo $edu_year0; ?>"><?PHP echo $show0; ?></option><?PHP } ?>
<?PHP if(mysql_num_rows($query_check_year_spp_1) != 0) { ?><option value="<?PHP echo $edu_year1; ?>" selected><?PHP echo $show1; ?></option><?PHP } ?>
<?PHP if(mysql_num_rows($query_check_year_spp_2) != 0) { ?><option value="<?PHP echo $edu_year2; ?>"><?PHP echo $show2; ?></option><?PHP } ?>
</select>