<html>
<head><title>��������� ������ ���������</title></head>
 <body><?php
 // ����������� � ���� ������ 
$db = 'Z:\home\localhost\www\TestPHP\Transport.mdb';
$conn = new COM('ADODB.Connection');
$conn->Open("Provider=Microsoft.Jet.OLEDB.4.0; Data Source=".$db); 
$sql = 'SELECT * FROM Stop';
$sql2 = 'SELECT Route_ID, Comment FROM Route';
$stop = $conn->Execute($sql); 
$comments = $conn->Execute($sql2);?>

<table border="0" id="table1"><tr><td>
<table border="1" id="table2">
<tr><th hidden>ID</th><th>���������</th>
</tr>
<?php for ($i=0; !$stop->EOF; $i++) { ?>
<tr <?php echo 'onclick=TRClick('.$i.')'?>>
<td hidden><?php echo $stop->Fields['Stop_ID']->Value ?></td>
<td><?php echo $stop->Fields['Name']->Value ?></td></tr>
<?php $stop->MoveNext() ?> <?php } ?>
</table> </td>
<td><input type="button" value="��������" onclick="InsertClick_Stop()">
<br><br>
<input type="button" value="��������" onclick="UpdateClick_Stop()"><br><br>
<input type="submit" value="�������  " onclick="DeleteClick_Stop()"></td>

<td>
<form id="form2" method="POST" action="changesStop.php" hidden>
�������� ���������<br>
<input type="text" name="NCommentStop" id="ICommentStop"><br><br>
<input type="submit" value="   OK   " ID="IOKStop">
<input type="button" value= "������ " onclick="CancelClick_Stop()"><br>
<input hidden type="text" name="NIDStop" id="IIDStop">
<input hidden type="text" name="NOperStop" id="IOperStop">
</form>
</td>

<tr>
<td>
<table border="1" id="table3"> </table>
</td>

<td><input type="button" value="��������" onclick="InsertClick_StopInRoute()">
<br><br>
<input type="button" value="��������" onclick="UpdateClick_StopInRoute()"><br><br>
<input type="submit" value="�������  " onclick="DeleteClick_StopInRoute()"></td>

<td>
<form id="form1" method="POST" action="changesStopInRoute.php" hidden>
���<br>
<select name="NType" id="IType" onchange="ChangeComments()">
<option>�������</option>
<option>����������</option>
<option>�������</option>
</select><br><br>

�������<br>
<select name="NComment" id="IComment">

<?php 
for ($i=0; !$comments->EOF; $i++) { 
	echo '<option value='.$comments->Fields['Route_ID'].'>'.$comments->Fields['Comment']->Value.'</option>';
	$comments->MoveNext();
	}
?>
</select><br><br>

�����<br>
<input type="text" name="NNumber"  id="INumber"><br><br>

<input type="submit" value="   OK   " ID="IOK">
<input type="button" value= "������ " onclick="CancelClick_StopInRoute()"><br><br>

<input hidden type="text" name="NID" id="IID">
<input hidden type="text" name="StopNumb_NID" id="StopNumb_IID">
<input hidden type="text" name="NID_Route" id="IID_Route">
<input hidden type="text" name="NOper" id="IOper">
</form>
</td></tr></tr></body>

<script>
 var CurRow = 0;
 var CurRow2 = 0;
 var Stop_id = 0;
 var T2 = document.getElementById("table2");
 var T3 = document.getElementById("table3");
 var CurTR = T2.rows[1];
 CurTR.style.backgroundColor="#ff00ff";
 SelectStopInRoute(CurTR.cells[0].innerHTML)
 
 SelectType("�������");
 document.getElementById("IType").selectedIndex = 0;
 
 // ������� ��������� ��������� ���
 // ��������� ���� ����������
 function ChangeComments() {
	var Type = document.getElementById("IType").value;
	SelectType(Type)
 }
 
 // ���� �� ������� � ������� � �����������
 function TRClick(i) {
	CurTR = T2.rows[CurRow+1];
    CurTR.style.backgroundColor="#ffffff";
    CurRow = i;	
    CurTR = T2.rows[CurRow+1];
    CurTR.style.backgroundColor="#ff00ff";
	
	var td0 = CurTR.cells[0];
    var ID = td0.innerHTML;
	var Type = document.getElementById("IType").value;
	Stop_id = ID
	SelectStopInRoute(ID)
 } // end of TRClick
 
 // ���� �� ������� � ������� � ����������� �� ��������
 function TRClick2(i) {
		CurTR = T3.rows[CurRow2+1];
	
		CurTR.style.backgroundColor="#ffffff";
		CurRow2 = i;	
		CurTR = T3.rows[CurRow2+1];
		CurTR.style.backgroundColor="#04c77f";
	
		var td1 = CurTR.cells[1];
		var ID_Route = td1.innerHTML;
		document.getElementById("IID_Route").value = ID_Route;
	
 } // end of TRClick
 
 // ������ ����� ��������� �� ��������
 function InsertClick_StopInRoute()  {
    var F1 = document.getElementById("form1");
    F1.hidden = false;
	document.getElementById("IID").value = Stop_id;	
	document.getElementById("IOper").value = 1;
	
	var td1 = CurTR.cells[1];
    var ID_Route = td1.innerHTML;
	document.getElementById("IID_Route").value = ID_Route;
    } // InsertClick
	
 function InsertClick_Stop()  {
    var F2 = document.getElementById("form2");
    F2.hidden = false;
    document.getElementById("IOperStop").value = 1;
    } // InsertClick
 

 // ��������� ��������
 function UpdateClick_StopInRoute() {
    var F1 = document.getElementById("form1");
    F1.hidden = false;
    T3 = document.getElementById("table3");
    CurTR = T3.rows[CurRow2+1];
    var td0 = CurTR.cells[0];
    var ID_Stop = td0.innerHTML;
	var td1 = CurTR.cells[1];
    var ID_Route = td1.innerHTML;
    var td2 = CurTR.cells[2];
    var Type = td2.innerHTML;
    var td3 = CurTR.cells[3];
    var Number = td3.innerHTML;
    var td4 = CurTR.cells[4];
    var Comment = td4.innerHTML;
    var IType = document.getElementById("IType");
    
	if (Type == "�������") IType.selectedIndex = 0;
    if (Type == "����������") IType.selectedIndex = 1;
    if (Type == "�������") IType.selectedIndex = 2;
    
	document.getElementById("INumber").value = Number; 			
	document.getElementById("IComment").value = ID_Route;
	
	// ������ ��������	
    document.getElementById("IID_Route").value = ID_Route;
	document.getElementById("StopNumb_IID").value = Number;	
	document.getElementById("IID").value = ID_Stop;	
    
	document.getElementById("IOK").value = "   ��   ";
    document.getElementById("IOper").value = 2;
 } // UpdateClick
 
 // �������� ���������
 function UpdateClick_Stop() {
    var F2 = document.getElementById("form2");
    F2.hidden = false;
    T2 = document.getElementById("table2");
    CurTR = T2.rows[CurRow+1];
	var td0 = CurTR.cells[0];
    var ID = td0.innerHTML;
    var td3 = CurTR.cells[1];
    var Comment = td3.innerHTML;
    		
	document.getElementById("ICommentStop").value = Comment; 		
    document.getElementById("IIDStop").value = ID;		
    var IOK = document.getElementById("IOKStop");
    IOK.value = "   ��   ";
    document.getElementById("IOperStop").value = 2;
 } // UpdateClick
 
 // ������� ��������� �� ��������
 function DeleteClick_StopInRoute() {
    UpdateClick_StopInRoute();
    var IOK = document.getElementById("IOK");
    IOK.value = "����������� ��������";
    var Oper = document.getElementById("IOper");
    Oper.value = 3;
    }

 // ������� ���������	
 function DeleteClick_Stop() {
	UpdateClick_Stop_Stop();
	document.getElementById("IOKStop").value = "����������� ��������";
    document.getElementById("IOperStop").value = 3;
    }

 // ������ ����������, ��������� � �������� ��������� �� ��������
 function CancelClick_Stop() {
    var F2 = document.getElementById("form2");
    F2.hidden = true;
    document.getElementById("IOK").value = "   ��   ";
 } // End of CancelClick
 
 // ������ ����������, ��������� � �������� ���������
 function CancelClick_StopInRoute() {
    var F1 = document.getElementById("form1");
    F1.hidden = true;
    document.getElementById("IOK").value = "   ��   ";
 } // End of CancelClick
 
	
function SelectStopInRoute(Route_ID) {
	xmlHttp=CreateAJAX();
	xmlHttp.onreadystatechange = ReceiveRequest;
	p = "selectStopInRoute.php?Route_ID="+Route_ID;
    //alert(p);
	xmlHttp.open("GET", p, true);
	xmlHttp.send(null);
} // End of SelectStopInRoute

 // ����� ���� ���������� 
 function SelectType(Type_text) {
	xmlHttp=CreateAJAX();
	xmlHttp.onreadystatechange = ReceiveRequest_Comments;
	p = "type.php?Type=" + Type_text;
	xmlHttp.open("GET", p, true);
	xmlHttp.send(null);
} // End of SelectType

 function ReceiveRequest() {
	var TextDoc=null;
	if (xmlHttp.readyState == 4) {
		if (xmlHttp.status == 200) {
			TextDoc=xmlHttp.responseText;
			document.getElementById("table3").innerHTML = TextDoc;
 
			TRClick2(0); 
 } else {
 } // else
 } //if
} // ReceiveRequest

//������ �� ��������� ��������� � �������������� ����� 
 function ReceiveRequest_Comments() {
	var TextDoc=null;
	if (xmlHttp.readyState == 4) {
		if (xmlHttp.status == 200) {
			TextDoc=xmlHttp.responseText;
			document.getElementById("IComment").innerHTML = TextDoc;
 //CurTR2 = 0;
	//TRClick2(0); 
 } else {
 } // else
 } //if
} // Comments

 // �������� AJAX
 function CreateAJAX() {
	var xmlHttp;
	try {
		xmlHttp=new XMLHttpRequest();
	} catch(e) {
		try {
			xmlHttp=new ActiveXObject("MSXML2.XMLHTTP");
		} catch(e) {
			try {
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			} catch(e) {
				} // catch
				} // catch
				} // catch
 if (!xmlHttp) alert("�� ������� ������� ������ XMLHttpRequest");
 return xmlHttp;
} // CreateAJAX
</script> </html>
