<?php
   $db = new mysqli('localhost', 'root' ,'', 'sisda3');
 
    if(!$db) {
 
        echo 'Could not connect to the database.';
    } else {
 
        if(isset($_POST['queryString'])) {
            $queryString = $db->real_escape_string($_POST['queryString']);
 
            if(strlen($queryString) >0) {
 
                $query = $db->query("SELECT no_sisda FROM siswa WHERE no_sisda LIKE '$queryString%' LIMIT 10");
                if($query) {
                echo '<ul>';
                    while ($result = $query ->fetch_object()) {
                        echo '<li onClick="fill(\''.addslashes($result->no_sisda).'\');">'.$result->no_sisda.'</li>';
                    }
                echo '</ul>';
 
                } else {
                    echo 'OOPS we had a problem <img src="http://www.wavesdream.com/wp-includes/images/smilies/icon_sad.gif" alt=":(" class="wp-smiley"> ';
                }
            } else {
                // do nothing
            }
        } else {
            echo 'There should be no direct access to this script!';
        }
    }
?>