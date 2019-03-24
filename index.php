<?php 

header('content:type application/json');
$request=$_SERVER['REQUEST_METHOD'];
switch ($request) {
	case 'GET':
             getmethod();
		break;

		case 'PUT':
		 $data=json_decode(file_get_contents('php://input'),true);
		 putmethod($data);
		break;

		case 'POST':
		 $data=json_decode(file_get_contents('php://input'), true);
		 postmethod($data);
		break;

		case 'DELETE':
		$data=json_decode(file_get_contents('php://input'), true);
		 deletemethod($data);
		break;
	
	default:
		
		break;
}

function getmethod()
{
include 'db.php';
	$sql="SELECT * from api_tbl";
	$result=mysqli_query($conn,$sql);
	if (mysqli_num_rows($result) > 0) {
		$rows=array();
		while ($r=mysqli_fetch_assoc($result)) {
		    $rows['result'][]=$r;

		}

		echo json_encode($rows);
		
	}
	else {
		echo '{"json data not found"}';
	}
}
function postmethod($data)
{
include 'db.php';
 $name=$data["name"];
 $skill=$data["skill"];
 $sql="INSERT INTO api_tbl(name,skill,created_at) values('$name','$skill',now())";
 if (mysqli_query($conn,$sql)) {
 	echo '{"result":"data inserted"}';
 }

 else
 {
 	echo '{"result":"data is not inserted"}';
 }
}

function putmethod($data)
{
include 'db.php';
 $id=$data["id"];
 $name=$data["name"];
 $skill=$data["skill"];
 $sql="UPDATE api_tbl set name='$name', skill='$skill', created_at=now() where id='$id' ";
 if (mysqli_query($conn,$sql)) {
 	echo '{"result":"data update successfull"}';
 }

 else
 {
 	echo '{"result":"data is not update"}';
 }
}

function deletemethod($data)
{
include 'db.php';
 $id=$data["id"];
 
 $sql="DELETE FROM api_tbl where id='$id' ";
 if (mysqli_query($conn,$sql)) {
 	echo '{"result":"data delete successfull"}';
 }

 else
 {
 	echo '{"result":"data is not delete"}';
 }
}
