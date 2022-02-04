<html>
<head><title></title></head>
<body><?
 $Oper = $_POST['NOper'];

 $StopNumb_old = $_POST['StopNumb_NID'];
 $StopNumb_new = $_POST['NNumber'];
 $Route_ID_old = $_POST['NID_Route'];
 $Route_ID_new = $_POST['NComment'];
 $Stop_ID = $_POST['NID'];
 echo " ".$Route_ID_new;
 $db = 'Z:\home\localhost\www\TestPHP\Transport.mdb';
 $conn = new COM('ADODB.Connection');
 $conn->Open("Provider=Microsoft.Jet.OLEDB.4.0; Data Source=".$db); 

 if ($Oper == '1') {
	$sql = "INSERT INTO StopInRoute (Route_ID, Stop_ID, StopNumb) VALUES (".$Route_ID_new.",".$Stop_ID.",".$StopNumb_new.")"; } // if
 if ($Oper == '2') {
	$sql = "UPDATE StopInRoute  SET Route_ID=".$Route_ID_new.", [StopNumb]= ".$StopNumb_new." WHERE Route_ID=".$Route_ID_old." AND [StopNumb] = ".$StopNumb_old; } // if
 if ($Oper == '3') {
	$sql = "DELETE FROM StopInRoute WHERE Route_ID=".$Route_ID_old." AND Stop_ID=".$Stop_ID." AND StopNumb=".$StopNumb_old; } // if
 $rs = $conn->Execute($sql);
 if ($Oper == '1') {
	echo "<h1>Добавлена остановка на маршруте</h1>";
	echo "<table border=0>";
	echo "<tr><td>Номер остановки</td><td>".$Stop_ID."</td></tr>";
	echo "<tr><td>Номер остановки на маршруте</td><td>".$StopNumb_new."</td></tr>";
	echo "<tr><td>Номер маршрута</td><td>".$Route_ID_new."</td></tr>";
	echo "</table>";} // if
 if ($Oper == '2') {
	echo "<h1>Изменена остановка на маршруте</h1>"; 
	echo "<table border=0>";
	echo "<tr><td>Номер остановки</td><td>".$Stop_ID."</td></tr>";
	echo "<tr><td>Номер остановки на маршруте</td><td>".$StopNumb_new."</td></tr>";
	echo "<tr><td>Номер маршрута</td><td>".$Route_ID_new."</td></tr>";
	echo "</table>";} // if
 if ($Oper == '3') {
	echo "<h1>Удалена остановка на маршруте</h1>"; 
	echo "<table border=0>";
	echo "<tr><td>Номер остановки</td><td>".$Stop_ID."</td></tr>";
	echo "<tr><td>Номер остановки на маршруте</td><td>".$StopNumb_old."</td></tr>";
	echo "<tr><td>Номер маршрута</td><td>".$Route_ID_old."</td></tr>";
	echo "</table>";} // if ?>
<a href="http://localhost/TestPHP/mainWindow.php">Возврат</2>
</body></html>
