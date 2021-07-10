<?php

$cmdpost=0;
$sqlreq=$_POST['sqlreq'];
if(!empty($_POST['cmdpost'])) {
	$cmdpost = $_POST['cmdpost'];
	print "cmdpost: ".$cmdpost."<br>";
	print "sqlreq: ".$sqlreq."<br>";
}

if(!empty($_GET['cmd'])) {
	$cmdpost = $_GET['cmd'];
	print "cmdreq: ".$_GET['cmd']."<br>";
}

//openshift
//$host = "172.30.201.140";
//$username = "sa";
//$password = "admin";
//$DBName = "sampledb";

//$host = "bmppikx9mn79axgjlhh4-mysql.services.clever-cloud.com";
//$username = "uphyltwqsqsipjri";
//$password = "5V7FaMjFWryhGXYcagw2";
//$DBName = "bmppikx9mn79axgjlhh4";

// db4free very slow
//$host = "www.db4free.net";
//$username = "eddysa";
//$password = "eddyadmin";
//$DBName = "eddydb_sample";

//$host = "remotemysql.com";
//$username = "qrhs901Ddt";
//$password = "YKA5Fa4hhb";
//$DBName = "qrhs901Ddt";

$host = "fdb34.awardspace.net";
$username = "3892307_db";
$password = "admin100";
$DBName = "3892307_db";

$conn = mysqli_connect($host,$username,$password) or die(mysql_error());
$db = mysqli_select_db($conn,$DBName) or die(mysql_error());
$query=$sqlreq; //"SELECT * FROM dummy1";

if ($cmdpost == "1") {
	$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
	if ($result=="") {
		print "SELECT failed: ".$query."<p>\n";
	}
	else {
	  // SELECT succeeded
	  $numrows = mysqli_num_rows($result);
	  $numcols=mysqli_num_fields($result);
	  //print "Number of rows: ".$numrows."<br>";
	  //print "Number of columns: ".$numcols."<p>\n";

	  $respond = "";
	  while ($row=mysqli_fetch_array($result)){
	   print "<tr>";
	   for ($i=0;$i<$numcols;$i++) {
		   $respond .= $row[$i]."~";
	   }
	   
	  } //while
		print "~~ ".$respond." ~~";
	} //else

}
if ($cmdpost == "2") {
    $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
    if ($result)    {
    print "~~ ".mysqli_affected_rows($conn)." ~~";
    }    
}

if ($cmdpost == "3") {
	$sqllist = explode("~", $query);
	$i = 0; 
	foreach ($sqllist as $v) {
		//print $v."<br>";
    	$result = mysqli_query($conn,$v) or die(mysqli_error($conn));
		if ($result == false) die(mysql_error());
		$i++;
	}
    print "~~ ".$i." ~~";  
}
?>
