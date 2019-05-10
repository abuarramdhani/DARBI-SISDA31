<?PHP
session_start();

if(isset($_SESSION["id"]) && $_SESSION["privilege"] == "2") {
	
	//here they are the variable
	//========
	//========
	/////////////////////////////////////////
	$exist_no_sisda = empty($_POST["no_sisda"]) ? "" : $_POST["no_sisda"];
	//These are the student's data
	$nama_siswa			= htmlspecialchars($_POST["nama_siswa"]);
	$nama_ayah			= htmlspecialchars($_POST["nama_ayah"]);
	$nama_bunda			= htmlspecialchars($_POST["nama_bunda"]);
	$kat_status_anak	= htmlspecialchars($_POST["kat_status_anak"]);
	$telp_ayah			= htmlspecialchars($_POST["telp_ayah"]);
	$telp_bunda			= htmlspecialchars($_POST["telp_bunda"]);
	$nama_sekolah_asal	= htmlspecialchars($_POST["nama_sekolah_asal"]);
	$stat_sekolah_asal	= htmlspecialchars($_POST["stat_sekolah_asal"]);
	
	//**For date format field, we have to set it with this pattern: year-month-date which is 0000-00-00
	$src_tanggal_daftar	= htmlspecialchars($_POST["src_tanggal_daftar"]);
	$tanggal_daftar_exp	= explode("-",$src_tanggal_daftar);
	$tanggal_daftar		= $tanggal_daftar_exp[2]."-".$tanggal_daftar_exp[1]."-".$tanggal_daftar_exp[0];
	
	$jenjang			= htmlspecialchars($_POST["jenjang"]);
	$tingkat			= htmlspecialchars($_POST["tingkat"]);
	$bulan_terdaftar	= htmlspecialchars($_POST["bulan_terdaftar"]);
	$periode			= htmlspecialchars($_POST["periode"]);
	$shift_test			= htmlspecialchars($_POST["shift_test"]);
	//Look at ** above
	$src_fase_1_date	= htmlspecialchars($_POST["src_fase_1_date"]);
	$fase_1_date		= substr($src_fase_1_date,6,4)."-".substr($src_fase_1_date,3,2)."-".substr($src_fase_1_date,0,2);
	//Look at ** above
	$src_fase_2_date	= htmlspecialchars($_POST["src_fase_2_date"]);
	$fase_2_date		= substr($src_fase_2_date,6,4)."-".substr($src_fase_2_date,3,2)."-".substr($src_fase_2_date,0,2);		
	
	////////////////////////////////////////		
	//these are the discount category's data
	$disc_cat_adm	= (empty($_POST["disc_cat_adm"])) 	? '' : htmlspecialchars($_POST["disc_cat_adm"]);
	$pengembangan	= (empty($_POST["pengembangan"])) 	? '' : htmlspecialchars($_POST["pengembangan"]);
	$kegiatan		= (empty($_POST["kegiatan"])) 		? '' : htmlspecialchars($_POST["kegiatan"]);
	$peralatan		= (empty($_POST["peralatan"])) 		? '' : htmlspecialchars($_POST["peralatan"]);
	$seragam		= (empty($_POST["seragam"])) 		? '' : htmlspecialchars($_POST["seragam"]);
	$paket			= (empty($_POST["paket"])) 			? '' : htmlspecialchars($_POST["paket"]);
	$sub_total_bima	= (empty($_POST["sub_total_bima"])) ? '' : htmlspecialchars($_POST["sub_total_bima"]);
	
	
	////////////////////////////////////////
	//These ara the SPP's data
	$spp			= (empty($_POST["spp"])) 			? '' : htmlspecialchars($_POST["spp"]);
	$ict			= (empty($_POST["ict"])) 			? '' : htmlspecialchars($_POST["ict"]);
	$ler			= (empty($_POST["ler"])) 			? '' : htmlspecialchars($_POST["ler"]);
	$ks				= (empty($_POST["ks"])) 			? '' : htmlspecialchars($_POST["ks"]);
	$sub_total_spp	= (empty($_POST["sub_total_spp"])) 	? '' : htmlspecialchars($_POST["sub_total_spp"]);
	
	////////////////////////////////////////
	//These are the rumah berbagi's data
	$zakat_mal		= htmlspecialchars($_POST["zakat_mal"]);
	$zakat_profesi	= htmlspecialchars($_POST["zakat_profesi"]);
	$infaq_shodaqoh	= htmlspecialchars($_POST["infaq_shodaqoh"]);
	$wakaf			= htmlspecialchars($_POST["wakaf"]);
	$lain_lain		= htmlspecialchars($_POST["lain_lain"]);
	
	
	//escape them..........
	$enc_nama_siswa			= mysql_real_escape_string($nama_siswa);
	$enc_nama_ayah			= mysql_real_escape_string($nama_ayah);
	$enc_nama_bunda			= mysql_real_escape_string($nama_bunda);
	$enc_kat_status_anak	= mysql_real_escape_string($kat_status_anak);
	$enc_telp_ayah			= mysql_real_escape_string($telp_ayah);
	$enc_telp_bunda			= mysql_real_escape_string($telp_bunda);
	$enc_nama_sekolah_asal	= mysql_real_escape_string($nama_sekolah_asal);
	$enc_stat_sekolah_asal	= mysql_real_escape_string($stat_sekolah_asal);
	$enc_tanggal_daftar		= mysql_real_escape_string($tanggal_daftar);
	$enc_jenjang			= mysql_real_escape_string($jenjang);
	$enc_tingkat			= mysql_real_escape_string($tingkat);
	$enc_periode			= mysql_real_escape_string($periode);
	$enc_shift_test			= mysql_real_escape_string($shift_test);
	$enc_fase_1_date		= mysql_real_escape_string($fase_1_date);
	$enc_fase_2_date		= mysql_real_escape_string($fase_2_date);
	
	//You may find some variables are not sent here
	//These cases are depend on what "jengjang" they are
	//So define them as empty this page cannot find them
	$enc_disc_cat_adm	= mysql_real_escape_string($disc_cat_adm); 
	$enc_pengembangan	= mysql_real_escape_string($pengembangan); 
	$enc_kegiatan		= mysql_real_escape_string($kegiatan); 
	$enc_peralatan		= mysql_real_escape_string($peralatan); 
	$enc_seragam		= mysql_real_escape_string($seragam); 
	$enc_paket			= mysql_real_escape_string($paket); 
	
	//This value will be used for value in table tunggakan
	$enc_sub_total_bima	= mysql_real_escape_string($sub_total_bima); 
	
	$enc_spp			= mysql_real_escape_string($spp);
	$enc_ict			= mysql_real_escape_string($ict);
	$enc_ler			= mysql_real_escape_string($ler);			
	$enc_ks				= mysql_real_escape_string($ks);
	
	//This value will be used for value in table tunggakan
	$enc_sub_total_spp	= mysql_real_escape_string($sub_total_spp);
	
	$enc_zakat_mal		= mysql_real_escape_string($zakat_mal);
	$enc_zakat_profesi	= mysql_real_escape_string($zakat_profesi);
	$enc_infaq_shodaqoh	= mysql_real_escape_string($infaq_shodaqoh);
	$enc_wakaf			= mysql_real_escape_string($wakaf);
	$enc_lain_lain		= mysql_real_escape_string($lain_lain);
	
	//Firstly,...
	//All of this data is depend on NO SISDA, which can be taken from table siswa. Note that the every student will have a unique NO SISDA which is generated automatically 
	//every registration data has been added into database. 
	//we will have two conditions with this registration process, thet are:
	//1. Registration for new student, it means that we have to generate new unique NO SISDA for them. how to do that? get the last NO SISDA from DB, add it with 1, 
	//   that is the new SISDA for new student.
	//2. Reregistration for old student that will get into the next level, we can use the existing NO SISDA, that taken from their data in DB.
	
	/*get current NO SISDA*/
	//look at the + 0 in below query. it's used to convert string data to integer, because the original data type of NO SISDA is string , 
	//but we only can select the max value of NO SISDA serial number(last 5 digits) in integer type. dont porgetgetget about it baby(but when i check in db, is already integer hehehe)....
	//So we dont need to use it ------->>>>>>>    $src_get_no_sisda	= "select no_sisda, MAX(SUBSTRING(no_sisda,6) + 0) from siswa";
	$src_get_no_sisda	= "select MAX(SUBSTRING(no_sisda from 5 for 6)) as cur_no_sisda from siswa"; 
	$query_get_no_sisda	= mysqli_query($mysql_connect, $src_get_no_sisda);
	$no_sisda_row		= mysql_fetch_array($query_get_no_sisda);
	
	//add 1 to the last no_sisda.
	//it's become current no_sisda.
	$last_no_sisda	= $no_sisda_row["cur_no_sisda"]+1;
	
	//we have problem with the 4 zeroes from the serial number, ex: 000001,000012,000356,006478
	//Check how many 'zero' that we have to add next to the last value
	$lenght_no_sisda 	= 6-(strlen($last_no_sisda)); 
	if($lenght_no_sisda == 5) { $add_digit = "00000"; }
	else if($lenght_no_sisda == 4) { $add_digit = "0000"; }
	else if($lenght_no_sisda == 3) { $add_digit = "000"; }
	else if($lenght_no_sisda == 2) { $add_digit = "00"; }
	else if($lenght_no_sisda == 1) { $add_digit = "0"; }
	
	//We need current year
	$cur_year	= date("Y");
	
	//And here is the last no_sisda for the last student
	$cur_no_sisda	= $cur_year.$add_digit.$last_no_sisda;
	
	//We have to seperate, between basic student data and finance data
	//why is that? because the table of them is different.
	//The steps are: insert the basic data first, then the finance data
	///////////////////////////////////////////////////////////////////		
	
	//here we go again baby,....
	//lets insert the student data first
	
	/////////////////////////////////////////////////////////////////
	/////														/////
	/////			Insertion of main student data				/////
	/////														/////
	/////////////////////////////////////////////////////////////////
	
	if($exist_no_sisda == "") {
	
		$src_insert_user	= "insert into siswa (
								
								no_sisda,
								aktif,
								periode,
								nama_siswa,
								nama_ayah,
								nama_bunda,
								kat_status_anak,
								telp_ayah,
								telp_bunda,
								asal_sekolah,	
								stat_sekolah_asal,							
								tanggal_daftar,
								jenjang,
								tingkat,
								gelombang_test,
								tahap1,
								tahap2
								
								) values (
								
								'$cur_no_sisda',
								'1',
								'$enc_periode',
								'$enc_nama_siswa',
								'$enc_nama_ayah',
								'$enc_nama_bunda',
								'$enc_kat_status_anak',
								'$enc_telp_ayah',
								'$enc_telp_bunda',
								'$enc_nama_sekolah_asal',
								'$enc_stat_sekolah_asal',
								'$enc_tanggal_daftar',
								'$enc_jenjang',
								'$enc_tingkat',
								'$enc_shift_test',
								'$enc_fase_1_date',
								'$enc_fase_2_date'								
								
								)";
		$query_insert_user	= mysqli_query($mysql_connect, $src_insert_user) or die ("There is an error with mysql: ".mysql_error());
		
	} else {
		
		$src_update_user	= "update siswa set
		
								tanggal_daftar = '$enc_tanggal_daftar',
								jenjang = '$enc_jenjang',
								tingkat = '$enc_tingkat',
								gelombang_test = '$enc_shift_test',
								tahap1 = '$enc_fase_1_date',
								tahap2 = '$enc_fase_2_date'
								
								where 
								
								no_sisda = '$exist_no_sisda'
		
								";
		$query_update_user = mysqli_query($mysql_connect, $src_update_user) or die(mysql_error());
		
	}
	
	//By defining that the query_insert_user working successfuly, it's meaning that we already had no_sisda for this student.
	//Which is this no_sisda is needed to identify every finance data related to this student
	//Ok here is the insertion process
	
	/////////////////////////////////////////////////////////////////
	/////														/////
	/////			Insertion of student finance data			/////
	/////														/////
	/////////////////////////////////////////////////////////////////
	
	if($exist_no_sisda == "") { $no_sisda_finance = $cur_no_sisda; } else { $no_sisda_finance = $exist_no_sisda; }
	
	$src_insert_data_finance	= "insert into siswa_finance (
									
									no_sisda,
									aktif,
									nama_siswa,
									periode,
									jenjang,
									tingkat,
									discount_payment,
									pengembangan,
									kegiatan,
									peralatan,
									seragam,
									paket,
									spp,
									ict,
									elearning,
									ks,
									zakat_mal,
									zakat_profesi,
									infaq_shodaqoh,
									wakaf,
									lainlain
									
									) values (
									
									'$no_sisda_finance',
									'1',
									'$enc_nama_siswa',
									'$enc_periode',
									'$enc_jenjang',
									'$enc_tingkat',
									'$enc_disc_cat_adm',
									'$enc_pengembangan',
									'$enc_kegiatan',
									'$enc_peralatan',
									'$enc_seragam',
									'$enc_paket',
									'$enc_spp',
									'$enc_ict',
									'$enc_ler',
									'$enc_ks',
									'$enc_zakat_mal',
									'$enc_zakat_profesi',
									'$enc_infaq_shodaqoh',
									'$enc_wakaf',
									'$enc_lain_lain'
									
									)";
	
	$query_insert_data_finance = mysqli_query($mysql_connect, $src_insert_data_finance) or die ("There is an error with mysql: ".mysql_error());
	
	
	
	if($query_insert_data_finance) {
	
		/////////////////////////////////////////////////////////////////
		/////														/////
		/////			Insertion of data 'biaya masuk'				/////
		/////														/////
		/////////////////////////////////////////////////////////////////
	
		//Related files to the cases below (tunggakan, ect) ++++++++++++++++++++++++++
		//////////////////////////////////////////////////////////////////////////////
	    ////////Please check -> define_month_spp.php executed in proc_login.php///////
		////////Please check -> check_spp_arrear.php executed in proc_login.php///////
		//////////////////////////////////////////////////////////////////////////////
			
			
		//Pleaseeeeeeeeeeeeeeeee read this comment carefully
		//we need to split the payment as 12 months for each student ---> (SPP)
		//So we have to define it in following table
		//This is really important since we have to know parents that they havent paid their billing.
		//And then there is a problem when a parent hasnt finished their payment, for two months in different year
		//For example, because education year starts on juli, payment for June 1st and July 1 st, is different.
		//June and July is in the same year, but in education year, Juli is a new year.
		//And of course the nominal that has to be paid is different.
		//So we have to define it. We have to be careful with this. (bi kerpullll mennnnn)
		//Once we make a mistake with this condition,.... all payment for each student would be failed, bahaya mennnnnnn.....
		//But,... this system will explode gedebooooooooooom (suicide/harakiri/kill it self or something like that)... Whennnnnnnnnnnnnnnnnnnnnn
		//when the government (education minister) decides that education year not starts on July anymore....
		//Wakkkkkkkkkkkkkkkkkssssssssssssssssssssssssssssssss
		
		//Wait a moment,
		//Waiting for om tony gunawan with my indomie rebussssssssss
		
		//Listen-listen-listen, we have two other conditions that we have to mentain
		//this is about "biaya masuk":
		// 1. PG, TKA, TKB      ----> with pengembangan, kegiatan, peralatan, seragam, paket
		// 2. SD, SMP  			----> with pengembangan, seragam
		// 3. Toddler  			----> with pengembangan
		
		//But in our system, we know two general types of payment only. Those are:
		//1. pengembangan
		//2. SPP
		
		//Have i told you, why we need this table (tunggakan)??? Because it's (not easy manually) hard to find a student's arrears, 
		//if we only depend on table transaction. We dont know directly how munch money a student has to pay. 
		//Without table tunggakan, we must count each payment manually and compare that result with the data in table siswa_finance.
		//It will take longer time, and the engine(server) will work harder
		//With table tunggakan, we only need to make a simple query for the rest of payment that a student must pay.
		//So Pak Gamal & Bu Fitri easily could see in a list, students which have arrears of payment.
		/////.............................................................................
		//Sampai jumpa kawanku, semoga kita slalu jadi kisah klasik untuk masa depan. yeaaaa.... wooo.wooo hey-hey-hey.......
		//lapar euy (20131007)........
		
		$src_insert_pengembangan	= "insert into tunggakan (
										no_sisda, 
										status,
										periode, 
										jenis_tunggakan, 
										nominal_tunggakan,										
										nom_pengembangan,
										nom_kegiatan,
										nom_peralatan,
										nom_seragam,
										nom_paket
										
										) values (
										
										'$no_sisda_finance',
										'1',
										'$enc_periode',
										'biaya_masuk',
										'$enc_sub_total_bima',
										'$enc_pengembangan',
										'$enc_kegiatan',
										'$enc_peralatan',
										'$enc_seragam',
										'$enc_paket'
										)";
		$query_insert_pengembangan	= mysqli_query($mysql_connect, $src_insert_pengembangan) or die("Terjadi kesalahan: ".mysql_error());
		
		if($query_insert_pengembangan) {
		
			/////////////////////////////////////////////////////////////////
			/////														/////
			/////				Insertion of data 'SPP'					/////
			/////														/////
			/////////////////////////////////////////////////////////////////
			
			//okay,,, this is about SPP, 
			//Every student has to pay their SPP payment every month.
			//look,..everybody knows that there are 12 months in a year....
			//So what..????
			//Why we define jumlah_bulan with 12
			//it just because we want to tell, how many month that a student has paid their payment. (until current month)
			//So we can call the rest as arrear from that student
			//Each time a student pay their payment, (for example 2 months). So the jumlah_bulan will change to 10.
			//You will find that this method really helpful when there is a student that has arrear in two or more education years
			//for example 8 month of errear from january 2012-2013 until august 2013-2014
			
			//Look, this really important
			//the registration (including payment) has to be done in december (this is about PMB in Darbi - time of registration decided by foundation)
			//the meaning is, payment for the first month (july next education year) is being paid before its education year coming.
			
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			//AMpun deh Om tony, ke SD nganter modul lama banget... ini dah jam 9.40, lapar euy... mo beli indomie......ane sarapan cuma separo barusan bro (20140115).//
			//Ganjal pakai CoffeeMIx dingin....                                                                                                                        //
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			
			//because if student has finished their SPP payment for july (next year) in december (current year), table kontrol_bulan_SPP hasn't been set for the next education year.
			//kontrol_bulan_SPP will start on july.
			//For example, a student candidate has finished her/his payment of registration, for next year of education, that is 2013-2014. so she/he has to finished her/his payment on december 2012-2013.
			//But it's okay, set field 'july' in table tunggakan to 2, it mean student has finished their SPP payment for july.
			//Got it????? brow????broww???? aja meneng bae lah browwww........!!!
			
			//And then for a moving student from another school that joint to darbi not from the beginning of the year of education.
			//For example student level 5, want to joint to darbi in october. it means she/he is late 3 months.
			//If we input her/his data (data siswa & data siswa finance) in october, our system will still guess that this student joint darbi since july.
			//So we have to tell our system, that this student doesnt need to pay (SPP), for the first 3 months before she/he comes
			//How is it? we must manipulate the first 3 months before she/he comes (field july, august, september) with 2 in table tunggakan.
			//Our system will guess that this student has finished those payments.
			
			//Now, how does our system know, how many month that it is has to be changed to 2?
			//The answer is, we have to count how many month has been inserted in table kontrol_bulan_SPP for this education year.			
				
			//Lets get the amount of month
			$src_get_month		= "select * from kontrol_bulan_spp where periode = '$enc_periode'";
			$query_get_month	= mysqli_query($mysql_connect, $src_get_month) or die("Terjadi kesalahan: ".mysql_error());
			
			//We have to know how many months are available (the month already came) in this educatioan year.
			$num_month			= mysql_num_rows($query_get_month);	
			
			//Set as a default value for each month with 0, the meaning is payment time (month) for each month is not coming yet
			$val_july		= "0-".$enc_sub_total_spp;
			$val_august		= "0-".$enc_sub_total_spp;
			$val_september	= "0-".$enc_sub_total_spp;
			$val_october	= "0-".$enc_sub_total_spp;
			$val_november	= "0-".$enc_sub_total_spp;
			$val_december	= "0-".$enc_sub_total_spp;
			$val_january	= "0-".$enc_sub_total_spp;
			$val_february	= "0-".$enc_sub_total_spp;
			$val_march		= "0-".$enc_sub_total_spp;
			$val_april		= "0-".$enc_sub_total_spp;
			$val_may		= "0-".$enc_sub_total_spp;
			$val_june		= "0-".$enc_sub_total_spp;
			
			//Once more,..... this importanttantantantantnantantnant......... mal kamal
			//if $num_month = 0, it means year education hanst coming yet, so keep the val_month above as 0
						
			if($num_month != 0) {
			
				//When is the month where student does registration? ==> $tanggal_daftar_exp[1] = month when student registration
				//we need to know it, because we want to set current month in table tunggakan to 1 
				//-----------IMPORTANT: Education Year Starts on JULY------------------
				/*
				if($tanggal_daftar_exp[1] == 1 ) { $current_month = 7; } 	// 1=January, 	so January is the 7th month from july
				if($tanggal_daftar_exp[1] == 2 ) { $current_month = 8; } 	// 2=February, 	so February is the 8th month from july
				if($tanggal_daftar_exp[1] == 3 ) { $current_month = 9; } 	// 3=March, 	so March is the 9th month from july
				if($tanggal_daftar_exp[1] == 4 ) { $current_month = 10; }	// 4=April, 	so April is the 10th month from july
				if($tanggal_daftar_exp[1] == 5 ) { $current_month = 11; }	// 5=May, 		so May is the 11th month from july
				if($tanggal_daftar_exp[1] == 6 ) { $current_month = 12; }	// 6=June, 		so June is the 12th month from july
				if($tanggal_daftar_exp[1] == 7 ) { $current_month = 1; }	// 7=July, 		so July is the 1st month in this education year
				if($tanggal_daftar_exp[1] == 8 ) { $current_month = 2; }	// 8=August, 	so August is the 2nd month from july
				if($tanggal_daftar_exp[1] == 9 ) { $current_month = 3; }	// 9=Sebtember,	so Sebtember is the 3rd month from july
				if($tanggal_daftar_exp[1] == 10 ) { $current_month = 4; }	// 10=October, 	so October is the 4th month from july
				if($tanggal_daftar_exp[1] == 11 ) { $current_month = 5; }	// 11=November, so November is the 5th month from july
				if($tanggal_daftar_exp[1] == 12 ) { $current_month = 6; }	// 12=December, so December is the 6th month from july
				*/
				
				$current_month = $bulan_terdaftar;
				
				//echo $num_month;
				
				/*
				---Anda Opah Kamal harap perhatikan baik-baik, sebab ini bagian paling krusial di sisda v3, jangan ngurusin domba garut terus... hehehe---
				
				Before, i'll explain you about the logic of this function..... 
				You have to understand that, it's all about student registration. why this function must be created?
				As we know, sometimes in Darbi, there is 1 or more student that joint to darbi, not in the beginning of year of education (in july)
				Let say, in august, December or another else. It usually happen to moving student from another school... (siswa pindahan boss....)
				If a stundent (moving student) does his registration in December, of course he/she doesnt need to pay SPP from july, August, September, October and November
				He just need to pay the SPP for December. Agree..????
				So, we have to ensure this system knows, when a student joint to Darbi (Does his/her registration)
				So, we have to tell our system that this student doesnt need to pay SPP for july, August, September, October and November.
				
				==It Doesn't matter for regular student that do their registration in july on the education year, or before it. This system understand it.==
				
				In Database, field month in table kontrol_bulan_spp will be updated automatically when the month is already came. 
				It's being done by page proc_login.php.
				So it is imposible that a student does his/her registration more than the last month that has been recorded in kontrol_bulan_spp, it's imposiblebelbelbelllll.......
	
				Firstly, We will loop this funtion as many months as we've got from table kontrol_bulan_spp
				As the example above, Let say, the education year has run until December. So it means, this month is december.
				And the student does his/her registration in December.
				What should this system do???
				This system has to set months in table tunggakan for this education year (period) as:
				July 			with 2 (has been paid)
				August 			with 2 (has been paid)
				September 		with 2 (has been paid)
				October 		with 2 (has been paid)
				November 		with 2 (has been paid)
				December 		with 1 (has to be paid)
				January			with 0 (hans't to be paid yet)
				February		with 0 (hans't to be paid yet)
				March			with 0 (hans't to be paid yet)
				April			with 0 (hans't to be paid yet)
				May				with 0 (hans't to be paid yet)
				June			with 0 (hans't to be paid yet)
				
							
				And then what?? 
				Here we go......
				$num_month has to be equal with 6, because it's December... you know it. check it above
				And also $current_month has to be equal with 6, becase it's december.. hehehehehhahahahaihihi 
				
				>>>>$num_month = 6; $current_month = 6;<<<<
				
				in our looping...
				
				If $i=1, we have to check whether current month of payment equal with $i (1/one) or not?
				1!=6,... so we set july with 2
				
				If $i=2, we have to check whether current month of payment equal with $i (2/two) or not?
				2!=6,... so we set August with 2
				
				If $i=3, we have to check whether current month of payment equal with $i (3/three) or not?
				3!=6,... so we set September with 2
				
				If $i=4, we have to check whether current month of payment equal with $i (4/four) or not?
				4!=6,... so we set october with 2
				
				If $i=5, we have to check whether current month of payment equal with $i (5/five) or not?
				5!=6,... so we set November with 2
				
				If $i=6, we have to check whether current month of payment equal with $i (6/six) or not?
				6=6,... Yoa ma mannnnnn,.......so we set December with 1
				
				And the rest (January, February, March, April, May and June) still 0, as defined is $val_month above.......
				
				[[[[[Wah, dari tadi gunain so udah berapa kali tuh di atas..... biar deh yang penting nggak nyasab kemana-mana...]]]]]
				*/
				
				for($i=0; $i<=$current_month; $i++) {			
					if($i == 1) { 
						//echo "current_month:".$current_month." num_month:".	$i."<br>";	
						if($current_month > $i) { $val_july = "4-0"; } else if($current_month == $i) { $val_july = "1-".$enc_sub_total_spp; }
					}
					if($i == 2) { 	
						//echo "current_month:".$current_month." num_month:".	$i."<br>";			
						if($current_month > $i) { $val_august = "4-0"; } else if($current_month == $i) { $val_august = "1-".$enc_sub_total_spp; } 
					}
					if($i == 3) { 	
						//echo "current_month:".$current_month." num_month:".	$i."<br>";			
						if($current_month > $i) { $val_september = "4-0"; } else if($current_month == $i){ $val_september = "1-".$enc_sub_total_spp; }
					}
					if($i == 4) { 	
						//echo "current_month:".$current_month." num_month:".	$i."<br>";			
						if($current_month > $i) { $val_october = "4-0"; } else if($current_month == $i) { $val_october = "1-".$enc_sub_total_spp; }
					}
					if($i == 5) { 
						//echo "current_month:".$current_month." num_month:".	$i."<br>";				
						if($current_month > $i) { $val_november = "4-0"; } else if($current_month == $i) { $val_november = "1-".$enc_sub_total_spp; }  
					}	
					if($i == 6) { 	
						//echo "current_month:".$current_month." num_month:".	$i."<br>";			
						if($current_month > $i) { $val_december = "4-0"; }{ $val_december = "1-".$enc_sub_total_spp; }
					}
					if($i == 7) { 	
						//echo "current_month:".$current_month." num_month:".	$i."<br>";			
						if($current_month > $i) { $val_january = "4-0"; } else if($current_month == $i) { $val_january = "1-".$enc_sub_total_spp; } 
					}
					if($i == 8) { 	
						//echo "current_month:".$current_month." num_month:".	$i."<br>";			
						if($current_month > $i) { $val_february = "4-0"; } else if($current_month == $i) { $val_february = "1-".$enc_sub_total_spp; }
					}
					if($i == 9) { 	
						//echo "current_month:".$current_month." num_month:".	$i."<br>";			
						if($current_month > $i) { $val_march = "4-0"; } else if($current_month == $i) { $val_march = "1-".$enc_sub_total_spp; }
					}	
					if($i == 10) { 	
						//echo "current_month:".$current_month." num_month:".	$i."<br>";			
						if($current_month > $i) { $val_april = "4-0"; } else if($current_month == $i) { $val_april = "1-".$enc_sub_total_spp; }
					}	
					if($i == 11) {
						//echo "current_month:".$current_month." num_month:".	$i."<br>"; 				
						if($current_month > $i) { $val_may = "4-0"; } else if($current_month == $i) { $val_may = "1-".$enc_sub_total_spp; }
					}	
					if($i == 12) { 	
						//echo "current_month:".$current_month." num_month:".	$i."<br>";			
						if($current_month == $i) { $val_june = "1-".$enc_sub_total_spp; }
					}		
				}
			}
			
			/*echo $val_july.
			$val_august.
			$val_september.
			$val_october.
			$val_november.
			$val_december.
			$val_january.
			$val_february.
			$val_march.
			$val_april.
			$val_may.
			$val_june;*/
			
			//If the data siswa insertion process done before july (the education year hasnt coming yet, and it should be started in july), we have to set the field "data baru" as '1'
			//Why do so? because it will be needed when the month has changed to august.
			//it will be needed in file include/check_spp_arrear.php
			//If it is not set as 1, data in field july in table tunggakan will be error, when the month has changed to august
			//the same thing goes to cataj (catering and antar jemput)
						
			$cur_month_data_baru	= strtolower(date("F"));
			$cur_year_data_baru		= date("Y");
						
			//Let's get current edu year....
			if($cur_month_data_baru == "january" || $cur_month_data_baru == "february" || $cur_month_data_baru == "march" || $cur_month_data_baru == "april" || $cur_month_data_baru == "may" || $cur_month_data_baru == "june") {	
				
				$edu_year_data_baru		= ($cur_year_data_baru-1)." - ".$cur_year_data_baru;
				$per_begin_data_baru	= $cur_year_data_baru-1;
				
			} else if ($cur_month_data_baru == "july" || $cur_month_data_baru == "august" || $cur_month_data_baru == "september" || $cur_month_data_baru == "october" || $cur_month_data_baru == "november" || $cur_month_data_baru == "december") {	
				
				$edu_year_data_baru		= $cur_year_data_baru." - ".($cur_year_data_baru+1);
				$per_begin_data_baru	= $cur_year_data_baru;
				
			}

			//Periode when the student submited
			//But we only need the begin of the year for comparation
			$periode_from_form = substr($periode,0,4);


			if($periode_from_form > $per_begin_data_baru) {
				
				$data_baru 			= "data_baru,";
				$data_baru_value 	= "'1',";
				
			} else {
			
				$data_baru			= "";
				$data_baru_value 	= "";
				
			}
			
			$src_insert_spp		= 
									"insert into tunggakan (
										no_sisda,
										status,
										$data_baru
										periode,
										jenis_tunggakan,
										nominal_tunggakan,
										jumlah_bulan,
										july,
										august,
										september,
										october,
										november,
										december,
										january,
										february,
										march,
										april,
										may,
										june
									) values (
										'$no_sisda_finance',
										'2',
										$data_baru_value
										'$enc_periode',
										'spp',
										'',
										'12',
										'$val_july',
										'$val_august',
										'$val_september',
										'$val_october',
										'$val_november',
										'$val_december',
										'$val_january',
										'$val_february',
										'$val_march',
										'$val_april',
										'$val_may',
										'$val_june'
									)";
			$query_insert_spp	= mysqli_query($mysql_connect, $src_insert_spp) or die("Terjadi kesalahan: ".mysql_error());			
		
			if($query_insert_spp) {
			
				//---------------------------------------
				//here are variables that used in prog_log.php
				include_once("include/url.php");
				$activity	= "Add registrasi administasi siswa & info tunggakan";
				$url		= curPageURL();
				$id			= $_SESSION["id"];
				$need_log	= true;
				include_once("include/log.php");
				//---------------------------------------
				
				$redirect_path	= "";
				$redirect_icon	= "images/icon_true.png";
				$redirect_url	= "mainpage.php?pl=reg_adm_siswa_ask";
				$redirect_text	= "Registrasi Administrasi Siswa berhasil";
				
				$need_redirect	= true;
				include_once ("include/redirect.php");
				
			} else { echo "Proses input data informasi acuan TUNGGAKAN SPP siswa tidak dapat dilakukan, silakan hubungi admin"; } //if($query_insert_spp)
		} else { echo "Proses input data informasi acuan TUNGGAKAN PENGEMBANGAN siswa tidak dapat dilakukan, silakan hubungi admin"; } //if($query_insert_pengembangan)
	} else { echo "Proses input data siswa baru tidak dapat dilakukan, silakan hubungi admin."; } //if($query_insert_data_finance)
} else { header("location:../index.php"); } //if(isset($_SESSION["id"]) && $_SESSION["privilege"] == "2")
?>