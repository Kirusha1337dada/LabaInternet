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
			$title = $_POST['Title'];
			$filename = $_FILES['FileName']['name'];
			$id_artist = $_POST['IdArtist'];
			$data = $_POST['Data'];
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
				$sqlReq=("DELETE FROM paintings WHERE Id=?");
				$query = $database->link->prepare($sqlReq);
				$query->execute([$get_id]);
				if($query)
				{
					header("Location: " . $_SERVER['HTTP_REFERER']);
				}
			}
		}
		catch (mysqli_sql_exception $ex)
		{
			die("Произошла ошибка!" . $ex->getMessage());
		}

?>
