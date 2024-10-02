<?php

use db\Database;
include '../db/Database.php';

$database = new Database();
$database->dbConnect();

$get_id = null;
$name = null;
$role = null;
$staffId = 1;

if(isset($_GET['Id']))
{
	$get_id = $_GET['Id'];
}
if(isset($_POST['Name']))
{
	$name = htmlspecialchars($_POST['Name']);
}
if(isset($_POST['Role']))
{
	$role = htmlspecialchars($_POST['Role']);
}
if(isset($_POST['StaffId']))
{
	$staffId = htmlspecialchars($_POST['StaffId']);
}

if (isset($_POST['add']))
{
	$errors = [];

	if (empty($_POST['Name']))
	{
		$errors[] = "Имя обязательно.";
	}
	if (empty($_POST['Role']))
	{
		$errors[] = "Роль обязательно.";
	}
	if (empty($_POST['StaffId']))
	{
		$errors[] = "Айдишник обязателен.";
	}

	if (!empty($errors))
	{
		foreach ($errors as $error)
		{
			echo "<div class='alert alert-danger'>$error</div>";
		}
	}
	else
	{

	}
}

if (isset($_POST['edit']))
{
	$errors = [];

	if (empty($_POST['Name']))
	{
		$errors[] = "Имя обязательно.";
	}
	if (empty($_POST['Role']))
	{
		$errors[] = "Роль обязательно.";
	}
	if (empty($_POST['StaffId']))
	{
		$errors[] = "Айдишник обязателен.";
	}

	if (!empty($errors))
	{
		foreach ($errors as $error)
		{
			echo "<div class='alert alert-danger'>$error</div>";
		}
	}
	else
	{

	}
}

$columns = ['Name', 'Role', 'StaffId'];
$values = [$name, $role, $staffId];

$database->add('gallerypersonal', $columns, $values);

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

$sqlReq = "SELECT * FROM gallerypersonal";
$query = $database->link->prepare($sqlReq);
$query->execute();
$result = $query->get_result();
$rows = $result->fetch_all(MYSQLI_ASSOC);

$database->edit('gallerypersonal', $columns, $values, $get_id);

$database->delete($get_id,'gallerypersonal');

?>