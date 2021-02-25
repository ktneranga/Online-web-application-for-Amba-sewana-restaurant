<?php 



function comments($pid){
			
		$query = "SELECT * FROM reviews WHERE pid = 3";

		$result = mysqli_query($connection, $query);


		if ($result) {
			echo mysqli_num_rows($result);

		}
}

mysqli_close($connection);

 ?>