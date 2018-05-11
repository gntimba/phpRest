<?php
require "Config.php";
$sql="select  * from Customer c,AssignTask a, Status where c.CustID=a.custid and Status.CustID=c.CustID and a.SalesID='S001' and Status.Status_Name='Not Attempted'";
$response=array();
      
        
        $stmt1 = sqlsrv_query($conn, $sql);
//$stmt = sqlsrv_query( $conn, $sql );
   
         
            while($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC))
			
			array_push($response,array("fullname"=>$row['Name'].' '.$row['Surname'],"company"=>$row['Company'],"position"=>$row['Designation'],"ID"=>$row['CustID']));
  
          echo json_encode(array("server_response"=>$response));
            //echo $_SESSION['Role'];
		
?>
