<?PHP
//you have to put the <select name="month"> and </select> before and after the include tag, in the page that call this page.
//why it should be like this, because you have to define var name="xxxxx" uniquely, in every field that use this cur_month_opt.php

//There are so many notes should be written for this page, but i'm to lazy and dont have much time to write it here.
//So please read the related note on cur_date_opt.php. 
//You'll be understand why is this page supposed to be like this

$not_cur = (!isset($src_not_cur) ? false : true);

if($not_cur == true) {
	echo "<option value=''>bulan</option>";
}

$opt_cur_month = (!isset($defined_month)) ? date("m") : $defined_month;

for($opt_month = 1; $opt_month < 13; $opt_month++) {
	if($not_cur == true) {
		if(!isset($defined_month)) {
			echo "<option value='$opt_month'>$opt_month</option>";
		} else {
			if($opt_month == $opt_cur_month) {
				echo "<option value='$opt_month' selected>$opt_month</option>";
			} else {
				echo "<option value='$opt_month'>$opt_month</option>";
			}
		}
	} else {
		if($opt_month == $opt_cur_month) {
			echo "<option value='$opt_month' selected>$opt_month</option>";
		} else {
			echo "<option value='$opt_month'>$opt_month</option>";
		}
	}
}

if(isset($src_not_cur)) {
	$src_not_cur = false;
	
	if(isset($defined_month)) {
		$defined_month = false;
	}
}
?>