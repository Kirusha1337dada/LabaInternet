<?php

use db\Database;
include '../db/Database.php';
include_once '../test/test.php';

$database = new Database();
$database->dbConnect();

$get_id = null;
$name = null;

if(isset($_GET["Id"]))
{
	$get_id = $_GET["Id"];
}
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$name = $_POST["Name"];
}

$columns=['Name'];
$values=[$name];

$database->add('galleries',$columns,$values);

$query="SHOW TABLES";
$result = $database->link->query($query);

$tables=[];
if ($result)
{
	while ($row = $result->fetch_array())
	{
		$tables[] = $row[0];
	}
} else
{
	echo "Ошибка: " . $database->error;
}

$sqlReq = "SELECT * FROM galleries";
$query = $database->link->prepare($sqlReq);
$query->execute();
$result = $query->get_result();
$rows = $result->fetch_all(MYSQLI_ASSOC);

$database->edit('galleries',$columns,$values,$get_id);

$database->delete($get_id,'galleries');

