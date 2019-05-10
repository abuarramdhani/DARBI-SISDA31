<?php
/*
### This file is used in global_js/auto_suggest_form_id_sisda.js ###

all results from this file will be sent to global_js/auto_suggest_form_id_sisda.js

*/
include_once("../sisda-config.php");
$db = new mysqli($host,$username,$password,$db);

if(!$db) {

	echo 'tidak bisa akses database.';
} else {

	if(isset($_POST['queryString'])) {
	
		//Look at the page in mainpage.php?pl=transaction_src_idsisda
		//There, you'll fine a form with one field. And you know what? $_POST['queryString'] is taken from there.
		$queryString = $db->real_escape_string($_POST['queryString']);

		if(strlen($queryString) >0) {

			$query = $db->query("SELECT no_sisda,nama_siswa,kelas FROM siswa_finance WHERE nama_siswa LIKE '$queryString%' and aktif = '1' LIMIT 10");
			if($query) {
			echo '<ul>';
				while ($result = $query ->fetch_object()) {
					//This is the dropdown option/value in the field above.
					echo '<li onClick="fill(\''.addslashes($result->no_sisda).'\');">'.$result->nama_siswa."<br>[".$result->no_sisda."] kelas: ".$result->kelas.'</li>';
				}
			echo '</ul>';

			} else {
				echo 'Query gagal dilakukan';
			}
		} else {
			// do nothing
		}
	} else {
		echo 'Tidak dapat diakses langsung';
	}
}
?>