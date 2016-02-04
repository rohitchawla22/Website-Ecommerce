<?php

if ( $conn = oci_connect('ggarg','AnkurGarg2008','oracle.cise.ufl.edu:1521/orcl'))
{
	
	$b= "select cc.*,  (case when cc.shippingcost > 3  
             then  cc.totalPrice + cc.shippingcost 
               else cc.totalPrice End) as cartPrice
 from 
(select aa.userid, aa.email_id,  pp.prodid, pp.saleprice, pp.qtysold, pp.shippingcost ,  
        (case when pp.saleprice >= 10 and pp.saleprice < 20 then pp.saleprice * 0.95
             when pp.saleprice >= 20 and pp.saleprice < 30 then pp.saleprice * 0.9
             when pp.saleprice >= 30                     then pp.saleprice * 0.85   
             else pp.saleprice
        END) * pp.qtysold as totalPrice
from account aa, transaction tt, product pp
where aa.userid = tt.userid
and pp.prodid = tt.prodid
and pp.saleprice > 0
and pp.qtysold is not null) cc";
   
    $stid = oci_parse($conn, $b) ;
	
		  oci_execute($stid);
		  
		   while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) // getting your results in row 
		   {       

					echo $row[0]."&nbsp &nbsp".$row[1]." &nbsp ".$row[2]."&nbsp ".$row[3]."&nbsp  "
					.$row[4]."&nbsp ".$row[5]."&nbsp ".$row[6]."&nbsp ".$row[7] ;
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
