<?php
require "Config.php";

$name = $_POST["S_Name"];
$surname = $_POST["S_Surname"];
$role = $_POST["S_Surname"];
$email = $_POST["S_Emails"];
$password = $_POST["S_Password"];
$address = $_POST["Address"];
$city = $_POST["city"];
$postalcode = $_POST["Postal_code"];
$country = $_POST["Country"];

$sql1= "select SalesID from dbo.Sales_Rep";
$stmt1 = sqlsrv_query( $conn, $sql1 );

	while( $row = sqlsrv_fetch_array( $stmt1, SQLSRV_FETCH_ASSOC) ) 
		{
			$temp= explode("S",$row['SalesID']);
			
		}
		$temp[1]+=1;
		$num = 123;
$str_length = 3;

// hardcoded left padding if number < $str_length
$SalesID= substr("0000{$temp[1]}", -$str_length);

// output: 0123
		
		//$custID="C".$temp[1];
		 $SalesID="S".$SalesID;

$sql="INSERT INTO [dbo].[Sales_Rep]
           ([SalesID]
           ,[S_Name]
           ,[S_Surname]
		   ,[S_Role]
           ,[S_Emails]
           ,[S_Password]
		   ,[Address]
           ,[City]
           ,[Postal_code]
		   ,[Country]
           ,[Employee_Status])
     VALUES
           ('$SalesID'
           ,'$name'
           ,'$surname'
		   ,'$role'
           ,'$email'
           ,'$password'
           ,'$address'
           ,'$city'
           ,'$postalcode'
		   ,'$country'
		   ,1)";
		   
//$params = array();
////$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
//$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$stmt = sqlsrv_query( $conn, $sql );
if( $stmt === false ) {
    if( ($errors = sqlsrv_errors() ) != null) {
        foreach( $errors as $error ) {
            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
            echo "code: ".$error[ 'code']."<br />";
            echo "message: ".$error[ 'message']."<br />";
            echo $sql;
        }
    }
}
		
?>

