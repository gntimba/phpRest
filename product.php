<?php
require "Config.php";
$sql="select * from product";
$response=array();
      
        
        $stmt1 = sqlsrv_query($conn, $sql);
//$stmt = sqlsrv_query( $conn, $sql );
   
         
            while($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC))
			
			array_push($response,array("ID"=>$row['Prod_ID'],"name"=>$row['Prod_Name'],"price"=>$row['Prod_Price'],"duration"=>$row['Prod_Duration']));
  
          echo json_encode(array("server_response"=>$response));
            //echo $_SESSION['Role'];
		
?>