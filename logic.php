<?php

use db\Database;
include_once 'db/Database.php';

$database = new Database();
$database->dbConnect();

	$get_id = null;
	$title = null;
	$filename = null;
	$id_artist = null;
	$data = null;
	$gallery_id = isset($_GET['Id']) ? $_GET['Id'] : null;

		if(isset($_GET['Id']))
		{
			$get_id=$_GET['Id'];
		}
		if($_SERVER["REQUEST_METHOD"] == "POST")
		{
			$title = htmlspecialchars($_POST['Title'],ENT_QUOTES,'UTF-8');
			$filename = $_FILES['FileName']['name'];
			$id_artist = htmlspecialchars($_POST['IdArtist'],ENT_QUOTES,'UTF-8');
			$data = htmlspecialchars($_POST['Data']);
		}

		if (isset($_POST['add']))
		{
			$errors = [];

			if (empty($_POST['Title']))
			{
				$errors[] = "Название продукта обязательно.";
			}
			if (empty($_FILES['FileName']['name']))
			{
				$errors[] = "Файл продукта обязателен.";
			}
			if (empty($_POST['Name']))
			{
				$errors[] = "Описание обязательно.";
			}
			if (empty($_POST['Price']))
			{
				$errors[] = "Цена обязательна.";
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

			if (empty($_POST['Title']))
			{
				$errors[] = "Название продукта обязательно.";
			}
			if (empty($_FILES['FileName']['name']))
			{
				$errors[] = "Файл продукта обязателен.";
			}
			if (empty($_POST['Name']))
			{
				$errors[] = "Описание обязательно.";
			}
			if (empty($_POST['Price']))
			{
				$errors[] = "Цена обязательна.";
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

		try
		{
			if(isset ($_POST ['add']))
			{
				$sqlReq = ("INSERT INTO paintings(Title,FileName,IdArtist,Data,GalleryId) VALUES (?,?,?,?,?)");
				$query = $database->link->prepare($sqlReq);
				$query->execute([$title,$filename,$id_artist,$data,$gallery_id]);
				if($query)
				{
					header("Location: " . $_SERVER['HTTP_REFERER']);
				}
			}
		}
		catch(mysqli_sql_exception $ex)
		{
			die("Произошла ошибка!" . $ex->getMessage());
		}

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

		$sqlReq = "SELECT * FROM paintings WHERE GalleryId=?";
		$query = $database->link->prepare($sqlReq);
		$query->bind_param("i", $gallery_id);
		$query->execute();
		$result = $query->get_result();
		$rows = $result->fetch_all(MYSQLI_ASSOC);


		$sqlGalleries = "SELECT * FROM galleries";
		$galleriesQuery = $database->link->prepare($sqlGalleries);
		$galleriesQuery->execute();
		$galleriesResult = $galleriesQuery->get_result();
		$galleries = $galleriesResult->fetch_all(MYSQLI_ASSOC);

		try
		{
			if (isset($_POST['edit']))
			{
				$sqlReq = ("UPDATE paintings SET Title=?,FileName=?,IdArtist=?,Data=? WHERE Id=?");
				$query = $database->link->prepare($sqlReq);
				$query->execute([$title, $filename, $id_artist, $data, $get_id]);
				if ($query)
				{
					header("Location: " . $_SERVER['HTTP_REFERER']);
				}
			}
		}
		catch (mysqli_sql_exception $ex)
		{
			die("Произошла ошибка!" . $ex->getMessage());
		}

		try
		{
			if(isset($_POST['delete']))
			{
				$sqlReq = "SELECT FileName FROM paintings WHERE Id=?";
				$query = $database->link->prepare($sqlReq);
				$query->execute([$get_id]);
				$result = $query->get_result();
				$painting = $result->fetch_assoc();

				if ($painting)
				{
					$filePath = '../LabaBeta/фото/' . $painting['FileName'];
					if (file_exists($filePath))
					{
						unlink($filePath);
					}

					$sqlReq = ("DELETE FROM paintings WHERE Id=?");
					$query = $database->link->prepare($sqlReq);
					$query->execute([$get_id]);
					if ($query) {
						header("Location: " . $_SERVER['HTTP_REFERER']);
					}
				}
			}
		}
		catch (mysqli_sql_exception $ex)
		{
			die("Произошла ошибка!" . $ex->getMessage());
		}

?>
