<?php
header('Content-Type: text/html; charset=windows-1251');

$db = 'Z:\home\localhost\www\TestPHP\Transport.mdb';
$conn = new COM('ADODB.Connection');
$conn->Open("Provider=Microsoft.Jet.OLEDB.4.0; Data Source=".$db);
$Route_ID = $_GET["Route_ID"];

$sql3 = 'SELECT StopInRoute.Stop_ID, StopInRoute.StopNumb, Route.Number, Route.Type, Route.Comment, Route.Route_ID FROM Stop INNER JOIN (Route INNER JOIN StopInRoute ON Route.Route_ID = StopInRoute.Route_ID) ON Stop.Stop_ID = StopInRoute.Stop_ID WHERE (([StopInRoute].[Stop_ID]='.$Route_ID.'))';
$rs3 = $conn->Execute($sql3);
echo '<th hidden>Stop_ID</th> <th hidden>Route_ID</th> <th>Тип</th> <th>Номер</th> <th>Название</th>';
for ($i=0; !$rs3->EOF; $i++) {
 echo '<tr onclick=TRClick2('.$i.')>';
 echo '<td hidden>'.$rs3->Fields['Stop_ID']->Value.'</td>';
 echo '<td hidden>'.$rs3->Fields['Route_ID']->Value.'</td>';
 echo '<td>'.$rs3->Fields['Type']->Value.'</td>';
 echo '<td>'.$rs3->Fields['StopNumb']->Value.'</td>';
 echo '<td>'.$rs3->Fields['Comment']->Value.'</td></tr>';
 
 $rs3->MoveNext(); } ?>