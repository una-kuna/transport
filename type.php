<?php
header('Content-Type: text/html; charset=windows-1251');

$db = 'Z:\home\localhost\www\TestPHP\Transport.mdb';
$conn = new COM('ADODB.Connection');
$conn->Open("Provider=Microsoft.Jet.OLEDB.4.0; Data Source=".$db);

$Type = $_GET["Type"];

$sql = "SELECT Route_ID, Comment FROM Route  WHERE Type = '".$Type."' ";
$comments = $conn->Execute($sql);
for ($i=0; !$comments->EOF; $i++) { 
	echo '<option value='.$comments->Fields['Route_ID']->Value.'>'.$comments->Fields['Comment']->Value.'</option>';
	$comments->MoveNext();
	} ?>