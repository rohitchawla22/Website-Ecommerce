<?php require_once('Connections/connect.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Search Engine - Search</title>


</head>
<body class="holder">
	<center>
	
	<form action='results.php' method='get'>
		<input type='text' name='input' size='50' value='<?php echo $_GET['input']; ?>' class="search-field" /> 
		<input type='submit' value='Search ' class="search-button">
	</form>
    </center>
    <br/>
    
	<?php
	$i=0;
		$input = $_GET['input'];
		$terms = explode(" ", $input);
		$query = "SELECT * FROM product WHERE Name = '$input'  ";
		
		foreach ($terms as $each){
			$i++;
			if ($i == 1)
				$query .= "keywords LIKE '%$each%' ";
			else
				$query .= "OR keywords LIKE '%$each%' ";
		}
		
		// connecting to our mysql database
		//mysql_connect("localhost", "root", "");
		//mysql_select_db("emall");
		include "Connections/connect.php";
		$query = oci_query($connect,$query);
		$numrows = oci_num_rows($query);
		if ($numrows > 0){
			while ($row = mysql_fetch_assoc($query)){
				$id = $row['Prodid'];//yaha database me jo attributes h wo ainge 
				$title = $row['Name'];
				$description = $row['Description'];
				$keywords = $row['Description'];
				$link = $row['Type'];
				echo "<h2><a href='$link'>$title</a></h2>
				$description<br /><br />";

			}
			
				
			
			
		}
		else
			echo "No results found for \"<b>$input</b>\"";
		
		// disconnect
		mysql_close();
	?>
    
</body>
</html>