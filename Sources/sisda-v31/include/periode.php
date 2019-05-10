<?PHP
$select_periode	= empty($src_select_periode) ? "" : $src_select_periode;
?>
<select name="periode">
<option value="">Pilih</option>
<?PHP
for($periode = 1; $periode < 20; $periode++) {	
    
	$periode_bott 	= 2005+$periode;
	$periode_up		= 2006+$periode;
	
	$used_periode	= $periode_bott." - ".$periode_up;
	
	if($select_periode == $used_periode) {
		
		echo "<option value='$used_periode' selected>$used_periode</option>";
		
	} else {
		
		echo "<option value='$used_periode'>$used_periode</option>";	
	}
}
?>
</select>