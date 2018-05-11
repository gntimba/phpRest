<?php
require "Config.php";
$user_name=$_POST["user"];
$user_pass=$_POST["pass"];
//$user_name="veronica@ikworx.co.za";
//$user_pass="vero123";
$sql = "SELECT * FROM dbo.Sales_Rep WHERE S_Emails = '$user_name' and S_Password = '$user_pass'";
$response=array();
      
        
        $stmt1 = sqlsrv_query($conn, $sql);
//$stmt = sqlsrv_query( $conn, $sql );
   
         
            $row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC);
			
			array_push($response,array("email"=>$row['S_Emails'],"password"=>$row['S_Password']));
  
          echo json_encode(array("server_response"=>$response));
            //echo $_SESSION['Role'];
		
?>
