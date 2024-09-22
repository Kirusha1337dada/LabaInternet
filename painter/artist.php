<?php

use db\Database;
include '../db/Database.php';

$database = new Database();
$database->dbConnect();

$get_id = null;
$name = null;
$idArtist = null;
$data = null;


if(isset($_GET['Id']))
{
	$get_id = $_GET['Id'];
}

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$name = $_POST['Name'];
	$idArtist = $_POST['IdArtist'];
	$data = $_POST['Data'];
}

$columns = ['Name','IdArtist','Data'];
$values = [$name,$idArtist,$data];

$database->add('artists', $columns, $values);

$query="SHOW TABLES";
$result = $database->link->query($query);

$tables=[];
if ($result)
{
	while ($row = $result->fetch_array())
	{
		$tables[] = $row[0];
	}
}
else
{
	echo "Ошибка: " . $database->error;
}

$sqlReq = "SELECT * FROM artists";
$query = $database->link->prepare($sqlReq);
$query->execute();
$result = $query->get_result();
$rows = $result->fetch_all(MYSQLI_ASSOC);


$database->edit('artists', $columns, $values, $get_id);

$database->delete($get_id,'artists');

?>