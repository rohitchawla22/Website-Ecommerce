<?php

if ( $conn = oci_connect('ggarg','AnkurGarg2008','oracle.cise.ufl.edu:1521/orcl'))
{
	
	$b= "select bb.*from transaction tt, product pp,(select aa.firstname , aa.lastname , aa.userid from account aa
        where extract(year from sysdate)- extract(year from date_of_birth) > 20) bb     
      where tt.prodid = pp.prodid
      and pp.type like 'Laptop%'
      and pp.genre like 'HeavyMetal%'
      and bb.userid = tt.userid";
   
    $stid = oci_parse($conn, $b) ;
	
		  oci_execute($stid);
		   while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) // getting your results in row 
		   {
					echo $row[0]." ".$row[1]." ".$row[2];
					echo "<br>";
			
		   }
        
		  
	   
     //   oci_fetch_all($stid);
       //echo $stid;
	
	
	    oci_free_statement($stid);
	    oci_close($conn);
	
	
}
   else
   {
       die("could not connect to foo");
   }
   
    



?>