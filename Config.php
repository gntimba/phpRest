<?php
ob_start();
//session_start();
        $serverName ="192.168.176.33\SQLEXPRESS";
        $UID = "ikworx";
        $PWD = "Xibelani@54";
        $Database = "IKWORX.CO.ZA";
        
       //$connectionInfo = array( "Database"=>$Database,"CharacterSet" => "UTF-8","UID"=>$UID,"PWD"=>$PWD);
		  $connectionInfo = array( "Database"=>$Database,"CharacterSet" => "UTF-8","UID"=>$UID,"PWD"=>$PWD);
        $conn = sqlsrv_connect( $serverName, $connectionInfo);
		
			/*	if( $super ) {
     echo "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
	 
}*/
?>