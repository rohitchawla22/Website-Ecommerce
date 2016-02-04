





<?php

if ( $conn = oci_connect('ggarg','AnkurGarg2008','oracle.cise.ufl.edu:1521/orcl'))
{
	
}
   else
   {
       die("could not connect to foo");
   }
   
    $stid = oci_parse($conn, "Select(select count(*) from review)+(select count(*) from billing)+(select count(*) from transaction)+
                      (select count(*) from product)+(select count(*) from Account)+(select count(*) from movie)	as NUM_ROWS from dual");
	 oci_define_by_name($stid, 'NUM_ROWS', $num_rows);
        oci_execute($stid);
	
        oci_fetch_array($stid);
       echo $num_rows;
	
	
	
	oci_close($conn);
	
	



?>