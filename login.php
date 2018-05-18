<?php

require "Config.php";
error_reporting(0);
$user_name=$_GET["user"];
$user_pass=$_GET["pass"];
//$user_name="veronica@ikworx.co.za";
//$user_pass="vero123";
$sql = "SELECT * FROM dbo.Sales_Rep WHERE S_Emails = '$user_name'";
$response=array();
      
       
        $stmt1 = sqlsrv_query($conn, $sql);
//$stmt = sqlsrv_query( $conn, $sql );
   
         
            $row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC);

			if($row['S_Emails']==$user_name)
			{
				$message='emailOK';
				if($row['S_Password']==$user_pass)
					$message='loginOK';
				
			}
			else
				$message="wrong";
	
			
			array_push($response,array("message"=>$message));
  
          echo json_encode(array("server_response"=>$response));

            //echo $_SESSION['Role'];
		
?>
