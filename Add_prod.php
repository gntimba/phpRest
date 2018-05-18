<?php

require"Config.php";
	
	$prod_name = $_POST['Prod_Name'];
	$prod_desc = $_POST['Prod_Duration'];
	$prod_price = $_POST['Prod_Price'];
	
	$sql1= "select prod_id from dbo.Product";  

$stmt1 = sqlsrv_query( $conn, $sql1);
	while( $row = sqlsrv_fetch_array( $stmt1, SQLSRV_FETCH_ASSOC) ) 
		{
			$temp= explode("P",$row['prod_id']);
			
		}
		$temp[1]+=1;
		$str_length = 3;

// hardcoded left padding if number < $str_length
$prod_id= substr("0000{$temp[1]}", -$str_length);

		//$Prod_ID="P".$temp[1];
		 $prod_id="P".$prod_id;
	
	//adding products in the database
	$sql = "Insert into product(Prod_ID, Prod_Name, Prod_Duration, Prod_Price)
		values('$prod_id', '$prod_name', '$prod_desc', '$prod_price')";
	
	$stmt3 = sqlsrv_query( $conn, $sql);
	if( $stmt3 === false ) {
if( ($errors = sqlsrv_errors() ) != null) {
 foreach( $errors as $error ) {
     echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
     echo "code: ".$error[ 'code']."<br />";
     echo "message: ".$error[ 'message']."<br />";
     echo $sql;
     die;
 }
 }
}

?>