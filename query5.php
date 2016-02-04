<?php

if ( $conn = oci_connect('ggarg','AnkurGarg2008','oracle.cise.ufl.edu:1521/orcl'))
{
	
	$b= "select distinct bb.firstname, bb.lastname, aa.name as product_name
from transaction tt,  
(select distinct pp.* 
  from review rr, product pp
  where rr.productid = pp.prodid
   and rr.customerreviewaverage > '3'
   and rr.customerreviewaverage != 'None'
 ) aa, account bb
 where tt.prodid = aa.prodid
  and bb.userid = tt.userid";
   
    $stid = oci_parse($conn, $b) ;
	
		  oci_execute($stid);
		  
		   while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) // getting your results in row 
		   {       

					echo $row[0]." &nbsp".$row[1].$row[2];
					
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
