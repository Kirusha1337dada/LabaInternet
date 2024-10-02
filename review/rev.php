<?php

use db\Database;
include '../db/Database.php';

$database = new Database();
$database->dbConnect();

	$get_id = null;
	$visitor = 1;
	$painting = 1;
	$rating = 1;
	$commentary = null;

	if(isset($_GET['Id']))
	{
		$get_id=$_GET['Id'];
	}
	if (isset($_POST['VisitorId']))
	{
		$visitor = htmlspecialchars($_POST['VisitorId']);
	}
	if (isset($_POST['PaintingId']))
	{
		$painting = htmlspecialchars($_POST['PaintingId']);
	}
	if (isset($_POST['Rating']))
	{
		$rating = htmlspecialchars($_POST['Rating']);
	}
	if (isset($_POST['Commentary']))
	{
		$commentary = htmlspecialchars($_POST['Commentary']);
	}

if (isset($_POST['add']))
{
	$errors = [];

	if (empty($_POST['VisitorId']))
	{
		$errors[] = "Айди где?.";
	}
	if (empty($_FILES['PaintingId']))
	{
		$errors[] = "Айди картины где?.";
	}
	if (empty($_POST['Rating']))
	{
		$errors[] = "Рейтинг подкрути.";
	}
	if (empty($_POST['Commentary']))
	{
		$errors[] = "Комментарий поставь.";
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

	if (empty($_POST['VisitorId']))
	{
		$errors[] = "Айди где?.";
	}
	if (empty($_FILES['PaintingId']))
	{
		$errors[] = "Айди картины где?.";
	}
	if (empty($_POST['Rating']))
	{
		$errors[] = "Рейтинг подкрути.";
	}
	if (empty($_POST['Commentary']))
	{
		$errors[] = "Комментарий поставь.";
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

	$columns = ['VisitorId','PaintingId','Rating','Commentary'];
	$values = [$visitor,$painting,$rating,$commentary];

	$database->add('reviewsgallery', $columns, $values);

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

	$sqlReq = "SELECT * FROM reviewsgallery";
	$query = $database->link->prepare($sqlReq);
	$query->execute();
	$result = $query->get_result();
	$rows = $result->fetch_all(MYSQLI_ASSOC);


	$database->edit('reviewsgallery', $columns, $values, $get_id);

	$database->delete($get_id,'reviewsgallery');

?>