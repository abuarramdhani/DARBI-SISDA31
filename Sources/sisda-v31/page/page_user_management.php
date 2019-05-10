<?PHP
//The system need to know whether user already login or not.
//And yes you do, if you are the admin, you may access this page. Otherwise, let the page blank
if(isset($_SESSION["id"]) && $_SESSION["privilege"] == "1") {
?>
<!-- i dont think that i should give many comments here, hope you understand the script step by step -->
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
    	<td colspan="3" height="10"></td>
    </tr>
	<tr height="25">
    	<td width="30"></td>
        <td id="text_title_page1" align="center">User Management</td>
        <td width="30"></td>
    </tr>
    <tr>
    	<td></td>
    	<td height="10"><hr noshade="noshade" color="#666666" size="1" /></td>
        <td></td>
    </tr>
    <tr>
    	<td></td>
    	<td>
        	<!---====================uhuh uh7h 8uh87 8h8n8hj un7================================-->
        	<form method="post" name="add_user" action="engine.php?case=add_user">
        	<table width="100%" border="0" cellpadding="0" cellspacing="0">
            	<tr height="45">
                    <td width="200" id="text_normal_black" colspan="4"><b>Daftarkan user baru</b><br /> Seluruh field harus dilengkapi</td>
                </tr>
            	<tr height="20">
                	<td width="10" bgcolor="#cccccc"></td>
                    <td width="200" bgcolor="#cccccc" id="text_normal_black">Nama</td>
                    <td width="5"></td>
                    <td align="left"><input type="text" name="name" size="35" /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#cccccc"></td>
                    <td width="200" bgcolor="#cccccc" id="text_normal_black">Username</td>
                    <td width="5"></td>
                    <td align="left"><input type="text" name="username" size="35" /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#cccccc"></td>
                    <td width="200" bgcolor="#cccccc" id="text_normal_black">Password</td>
                    <td width="5"></td>
                    <td align="left"><input type="password" name="password1" size="35" /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#cccccc"></td>
                    <td width="200" bgcolor="#cccccc" id="text_normal_black">Password (conf)</td>
                    <td width="5"></td>
                    <td align="left"><input type="password" name="password2" size="35" /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#cccccc"></td>
                    <td width="200" bgcolor="#cccccc" id="text_normal_black">Hak akses</td>
                    <td width="5"></td>
                    <td align="left">
                    	<select name="privilege">
                        <option value="">Pilih</option>
                        <option value="2">Admin</option>
                        <option value="3">Admin Finance</option>
                        <option value="4">Finance</option>
                        <option value="5">Admin Kepegawaian</option>
                        <option value="6">Kepegawaian</option>
                        <option value="7">TK</option>
                        <option value="8">SD</option>
                        <option value="9">SMP</option>
                        <option value="10">ICT</option>
                        <option value="11">Yayasan</option>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#cccccc"></td>
                    <td width="200" bgcolor="#cccccc" id="text_normal_black">Status aktif</td>
                    <td width="5"></td>
                    <td align="left">
                    	<select name="status">
                        <option value="0">Aktif</option>
                        <option value="1">Non Aktif</option>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10"></td>  
                    <td width="200"></td>
                    <td width="5"></td>                  
                    <td colspan="3" align="left"><!-- the verification function returned here, in submit button, check the whole script below --><input type="submit" value="Daftarkan user" onClick="return verification()"/><input type="reset" value="Kosongkan" /></td>
                </tr>
            </table>            
            </form>
            <!--================================ end here =================================-->
            <?PHP
			//Load all user data////////////
			////////////////////////////////
			////////////////////////////////
			
			//check whether the expected page empty or not, if it is, give it values as 0
			//variable p defines from which page, the query has to begin			
			//why 0? because we have to start the page from beginning.
			//why minus one --> because we have to count it from previous page + 1 record
			//So, when we put -1, we will get previous page, 
			//and 'the 1' record will be added on $the_limit
			//confuse???? so am i. hahahahahahaha :))			
			$src_limit = (!isset($_GET["p"])) ? "0" : htmlspecialchars($_GET["p"] - 1);
			
			//hey jude, how many record that you wanna show us in this page, buddy?
			$show_per_page = 10;
			
			//So, the record starts from n1 like 1 or 11 or 21 or 31 or or or, depends on $show_per_page 
			//But you have to know, that the "limit" in mysql query is start with 0 not 1, based on MySQL 5.5 Reference manual.. 
			//Hahahahahahahahahahaha kamal doent know about it. He argues me strongly, that it starts from 1...hahahahaha. For this case, dont believe him, just believe me and the manual
			//And so so so, when $the_limit value is 0, the query will return row beginned from first record (number 1)
			//when $the_limit value is 10, the query will return row beginned from eleventh record (number 11)
			//when $the_limit value is 20, the query will return row beginned from eleventh record (number 21)
			$the_limit 	= ($src_limit * $show_per_page);
			
			//weleh-weleh, take a look at this query.....
			//$the_limit       = defines where should the query begin from
			//$show_per_page   = defines how many record should be shown
			$src_load_user		= "select * from user order by id asc limit $the_limit,$show_per_page";
			
			//but also, we need to select all record. it will be used to define the paging list.
			$src_load_user_all	= "select * from user";
			
			$query_load_user		=  mysqli_query($mysql_connect, $src_load_user) or die("There is an error with mysql: ".mysql_error());
			$query_load_user_all	=  mysqli_query($mysql_connect, $src_load_user_all) or die("There is an error with mysql: ".mysql_error());
			
			//Hey, how many record do we have..?????
			$num_load_user_all		= mysql_num_rows($query_load_user_all);
			?>
            <!--========================== user registration form =========================-->
            <?PHP
			$p = (!isset($_GET["p"])) ? "1" : htmlspecialchars($_GET["p"]);
			
			$all_page = ceil($num_load_user_all/$show_per_page);
			?>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">            	
            	<tr height="40">
                	<td colspan="3"><hr noshade="noshade" size="1" color="#999999" /></td>
                </tr>
            	<tr>
                	<td></td>
                    <td>
                    <?PHP 
					for($i = 1; $i <= $all_page; $i++) {
						if($i == $p) {
							echo "<span id='paging'>".$i." </span>";
						} else {
							echo "<span id='paging'><a href=\"?pl=user_management&p=$i\" >$i</a></span> ";
						}
					}
					?>
                    </td>
                    <td></td>
                </tr>
            </table>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
            	<tr id="text_normal_white_bold" bgcolor="#666666" height="30">
                	<td width="10"></td>
                	<td>No</td>
                    <td width="10"></td>
                    <td>Nama</td>
                    <td width="10"></td>
                    <td>Username</td>
                    <td width="10"></td>
                    <td>Password</td>
                    <td width="10"></td>
                    <td>Tanggal pendaftaran</td>
                    <td width="10"></td>
                    <td>Status</td>
                    <td width="10"></td>
                    <td>Modifikasi</td>
                    <td width="10"></td>
                </tr>
            <?PHP
			//$bg used to generate zebra background.
			$bg			="#beb8a9";	
					
			//this is for row  number, you know...it starts from 0
			$row_number	= $the_limit + 1;
			
			while($row_load_user = mysql_fetch_array($query_load_user)) {			
			?>
            	<tr height="30" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black">
                	<td></td>
                	<td><?PHP echo $row_number++; ?></td>
                    <td></td>
                    <td><?PHP echo $row_load_user["name"]; ?></td>
                    <td></td>
                    <td><?PHP echo $row_load_user["username"]; ?></td>
                    <td></td>
                    <td><!--It's idiot to show the user's password, ask mustofa kamal, he must be agree with this statement-->tidak ditampilkan</td>
                    <td></td>
                    <td><?PHP /*we have to substr the date value, because of it format, check db*/ echo substr($row_load_user["date"],8,2)."-".substr($row_load_user["date"],5,2)."-".substr($row_load_user["date"],0,4); ?></td>
                    <td></td>
                    <td><?PHP if($row_load_user["status"] == "0") { echo "Aktif"; } else if ($row_load_user["status"] == "1") { echo "Tidak aktif"; } ?></td>
                    <td></td>
                    <td><a href="mainpage.php?pl=edit_user&id=<?PHP echo $row_load_user["id"]; ?>"><img src="images/icon_edit.png" border="0" title="Edit user <?PHP echo ucwords($row_load_user["name"]) ?>" /></a>&nbsp;&nbsp;<a href="mainpage.php?pl=edit_user&id=<?PHP echo $row_load_user["id"]; ?>"><img src="images/icon_delete.png" border="0" title="Delete user <?PHP echo ucwords($row_load_user["name"]) ?>"/></a></td>
                    <td></td>
                </tr>	
            <?PHP
				//this is the other part of zebra background generator
				//if background of the first row is xxxxxx, so you have to change it to #yyyyyy in the next row 
				if($bg	== "#beb8a9") {
					$bg	= "#ffffff";
				}
				else {
					$bg	= "#beb8a9";
				}
            }	
			?>
            </table>            
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
            	<tr height="35">
                    <td width="200" id="text_normal_black" colspan="4"></td>
                </tr>
            </table>
        </td>
        <td></td>
    </tr>
</table>
<!-- sandy said: form verifiation start form here buddy...:)-->
<SCRIPT type="text/javascript" >
function verification() 
{ 
	if(document.add_user.name.value == "")
	{
		alert('Field nama tidak boleh kosong');
		return false;
	}
	if(document.add_user.username.value == "")
	{
		alert('Field username tidak boleh kosong');
		return false;
	}
	if(document.add_user.password1.value == "")
	{
		alert('Password tidak boleh kosong');
		return false;
	}
	if(document.add_user.password2.value == "")
	{
		alert('Password konfirmasi tidak boleh kosong');
		return false;
	}
	if(document.add_user.password1.value != document.add_user.password2.value)
	{
		alert('Password baru tidak sama dengan password yang anda konfirmasikan');
		return false;
	}
	if(document.add_user.privilege.value == "")
	{
		alert('Silahkan lengkapi hak akses user');
		return false;
	}

return true;	
}
</SCRIPT>
<?PHP
}
?>