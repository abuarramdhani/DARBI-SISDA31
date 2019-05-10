<?PHP
//you have to put the <select name="year"> and </select> before and after the include tag, in the page that call this page.
//why it should be like this, because you have to define var name="xxxxx" uniquely, in every field that use this cur_date-opt.php

//There are so many notes should be written for this page, but i'm to lazy and dont have much time to write it here.
//So please read the related note on cur_date_opt.php. 
//You'll be understand why is this page supposed to be like this

//Tester
/*
if(isset($src_not_cur)) {
	echo "<option>gak dipilih</option>";
} else {
	if(isset($defined_year)) {
		echo "<option>Ditentukan</option>";
	} else {
		echo "<option>sekarang</option>";
	}
}
*/

$not_cur = (!isset($src_not_cur) ? false : true);

if($not_cur == true) {
	echo "<option value=''>tahun</option>";
}

$opt_cur_year = (!isset($defined_year)) ? date("Y") : $defined_year;

for($opt_year = 1990; $opt_year < 2021; $opt_year++) {
	if($not_cur == true) {
		if(!isset($defined_year)) {
			echo "<option value='$opt_year'>$opt_year</option>";
		} else {
			if($opt_year == $opt_cur_year) {
				echo "<option value='$opt_year' selected>$opt_year</option>";
			} else {
				echo "<option value='$opt_year'>$opt_year</option>";
			}
		}
	} else {
		if($opt_year == $opt_cur_year) {
			echo "<option value='$opt_year' selected>$opt_year</option>";
		} else {
			echo "<option value='$opt_year'>$opt_year</option>";
		}
	}
}

if(isset($src_not_cur)) {
	$src_not_cur = false;
	
	if(isset($defined_year)) {
		$defined_year = false;
	}
}
?>