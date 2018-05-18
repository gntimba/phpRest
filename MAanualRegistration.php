<?php

require "Config.php";
$message='';
//$custID
if(isset($_POST['submit'])){
$name=$_POST["name"];
$surname=$_POST["surname"];
$email=$_POST["email"];
$company=$_POST["company"];
$designation=$_POST["designation"];
$phone=$_POST["phone"];
$addr1=$_POST["addr1"];
$city=$_POST["city"];
$province=$_POST["province"];
$zip=$_POST["zip"];
$country=$_POST["country"];
$sales=$_SESSION['name'];
$status=$_POST["dropdown"];
$comment = $_POST["comment"];


$sql1= "select CustID from dbo.customer";
$stmt1 = sqlsrv_query( $conn, $sql1 );

	while( $row = sqlsrv_fetch_array( $stmt1, SQLSRV_FETCH_ASSOC) ) 
		{
			$temp= explode("C",$row['CustID']);
			
		}
		$temp[1]+=1;
		$num = 123;
$str_length = 3;

// hardcoded left padding if number < $str_length
$custID= substr("0000{$temp[1]}", -$str_length);

// output: 0123
		
		//$custID="C".$temp[1];
		 $custID="C".$custID;

$sql="INSERT INTO [dbo].[Customer]
           ([CustID]
           ,[Name]
           ,[Surname]
           ,[Email]
           ,[Phone]
           ,[Company]
           ,[Address]
           ,[City]
           ,[Zip_code]
           ,[Province]
           ,[Country]
           ,[Date_Added]
           ,[SalesID]
		   ,[Designation]
		   ,[Comment])
     VALUES
           ('$custID'
           ,'$name'
           ,'$surname'
           ,'$email'
		   ,'$phone'
           ,'$company'
           ,'$addr1'
           ,'$city'
           ,'$zip'
           ,'$province'
		   ,'$country'
		   ,GetDate()
		   ,'$sales'
		   ,'$designation'
		   ,'$comment')
	 ";
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
}else{

$message= '<div id="success" class="alert alert-success">Customer added Successfully</div>';
if($status=='New opportunity'){
	$_SESSION['custID']=$custID;
	//header('Location:leadProd.php');	
}

}


$sql2= "select StatusID from dbo.status";
$stmt2 = sqlsrv_query( $conn, $sql2 );

	while( $row = sqlsrv_fetch_array( $stmt2, SQLSRV_FETCH_ASSOC) ) 
		{
			$temp= explode("ST",$row['StatusID']);
			
		}
	$num=	(int)$temp[1];
$num+=1;
		
$str_length = 3;

// hardcoded left padding if number < $str_length
$StatusID= substr("0000{$num}", -$str_length);

// output: 0123
		
		//$custID="C".$temp[1];
		  $StatusID="ST".$StatusID;
		 
$sql3="INSERT INTO [dbo].[Status]
           ([StatusID]
           ,[CustID]
           ,[Status_Name]
           ,[Status_Date])
     VALUES
           ('$StatusID'
           ,'$custID'
           ,'Not Attempted'
           ,getdate())";
		   $stmt3 = sqlsrv_query( $conn, $sql3 );
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


$sql6= "select * from dbo.[AssignTask]";
    $params = array();
    $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
    $stmt6 = sqlsrv_query($conn, $sql6, $params, $options);
	if (sqlsrv_num_rows($stmt6) >= 1)
{
	while( $row = sqlsrv_fetch_array( $stmt6, SQLSRV_FETCH_ASSOC) ) 
		{
			
			$temp= explode("A",$row['tsID']);
			
			
			
		}
		$temp[1]+=1;
		$num = 123;
$str_length = 3;

// hardcoded left padding if number < $str_length
$leadID= substr("0000{$temp[1]}", -$str_length);

// output: 0123
		
		//$custID="L".$temp[1];
		 $taskID="A".$leadID;
		 }
		 else
		 $taskID="A001";
		 
		 
		 $sql8= "INSERT INTO dbo.AssignTask
        (tsID,SalesID, stMonth, custid)
        VALUES ('$taskID','$sales', getdate(), '$custID');";
    $stqr = sqlsrv_query( $conn, $sql8 );  
    if( $stqr === false ) {
    if( ($errors = sqlsrv_errors() ) != null) {
        foreach( $errors as $error ) {
            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
            echo "code: ".$error[ 'code']."<br />";
            echo "message: ".$error[ 'message']."<br />";
            echo $sql8;
        }
    }
}
}
?>