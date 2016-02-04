<?php

if ( $conn = oci_connect('ggarg','AnkurGarg2008','oracle.cise.ufl.edu:1521/orcl'))
{
	
	$b= "select bb.*, aa.* 
 from account aa, 
   (select pp.prodid, pp.name , tt.userid, rr.customerreviewaverage
   from product pp, transaction tt, review rr
   where pp.prodid = tt.prodid
     and tt.recommendation = 'TRUE'
     and rr.customerreviewaverage != 'None'
     and rr.productid = pp.prodid
     and rr. recommendation  = 'true') bb
     where aa.userid = bb.userid";
   
    $stid = oci_parse($conn, $b) ;
	
		  oci_execute($stid);
		  
		   while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) // getting your results in row 
		   {       

					echo $row[0]."&nbsp &nbsp".$row[1]."&nbsp &nbsp".$row[3]."&nbsp &nbsp".$row[13]."&nbsp &nbsp".$row[14] ;
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
