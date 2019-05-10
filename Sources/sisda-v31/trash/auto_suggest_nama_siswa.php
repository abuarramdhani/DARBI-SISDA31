<?php
include_once("../sisda-config.php");
$db = new mysqli($host,$username,$password,$db);

if(!$db) {

	echo 'tidak bisa akses database.';
} else {

	if(isset($_POST['queryString1'])) {
		$queryString = $db->real_escape_string($_POST['queryString1']);

		if(strlen($queryString) >0) {

			$query = $db->query("SELECT nama_siswa FROM siswa WHERE nama_siswa LIKE '$queryString%' LIMIT 10");
			if($query) {
			echo '<ul>';
				while ($result = $query ->fetch_object()) {
					echo '<li onClick="fill(\''.addslashes($result->nama_siswa).'\');">'.$result->nama_siswa.'</li>';
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