<?php
   $link = new mysqli('localhost', 'root' ,'', 'pharmacy');
	if(!$link) {
	
		echo 'Could not connect to the database.';
	} else {
	
		if(isset($_POST['queryString'])) {
			$queryString = $link->real_escape_string($_POST['queryString']);
			
			if(strlen($queryString) >0) {

				$query = $link->query("SELECT customer_name FROM customer WHERE customer_name LIKE '$queryString%' LIMIT 10");
				if($query) {
				echo '<ul>';
					while ($result = $query ->fetch_object()) {
	         			echo '<li onClick="fill(\''.addslashes($result->customer_name).'\');">'.$result->customer_name.'</li>';
	         		}
				echo '</ul>';
					
				} else {
					echo 'OOPS we had a problem :(';
				}
			} else {
				// do nothing
			}
		} else {
			echo 'There should be no direct access to this script!';
		}
	}
?>