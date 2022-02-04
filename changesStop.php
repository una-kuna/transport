<html>
<head><title></title></head>
<body><?
 $Oper = $_POST['NOperStop'];
 if ($Oper == '1' || $Oper == '2') {
	$Comment = $_POST['NCommentStop'];
 } // if
 if ($Oper == '2' || $Oper == '3') {
	$ID = $_POST['NIDStop'];
 } // if
 
 $db = 'Z:\home\localhost\www\TestPHP\Transport.mdb';
 $conn = new COM('ADODB.Connection');
 $conn->Open("Provider=Microsoft.Jet.OLEDB.4.0; Data Source=".$db); 
 
 if ($Oper == '1') {
	$sql = "INSERT INTO Stop (Name) Values ('".$Comment."')"; } // if
 if ($Oper == '2') {
	$sql = "UPDATE Stop SET Name='".$Comment."' WHERE Stop_ID=".$ID; } // if
 if ($Oper == '3') {
	$sql = "DELETE FROM Stop WHERE Stop_ID=".$ID; } // if
 $stop = $conn->Execute($sql);
 if ($Oper == '1') {
	echo "<h1>Добавлена остановка</h1>";
	echo "<table border=0>";
	echo "<tr><td>Остановка</td><td>".$Comment."</td></tr>";
	echo "</table>"; } // if
 if ($Oper == '2') {
	echo "<h1>Изменена остановка</h1>";
	echo "<table border=0>";
	echo "<tr><td>Остановка</td><td>".$Comment."</td></tr>";
	echo "</table>"; } // if
 if ($Oper == '3') {
	echo "<h1>Удалена остановка</h1>";
	echo "<table border=0>";
	echo "<tr><td>ID</td><td>".$ID."</td></tr>";
	echo "</table>"; } // if ?>
<a href="http://localhost/TestPHP/mainWindow.php">Возврат</2>
</body></html>
