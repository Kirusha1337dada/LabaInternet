<?php

namespace db;

use MongoDB\BSON\PackedArray;
use mysqli_sql_exception;
include_once 'config.php';

class Database
{
	public $host = HOST;
	public $user = USER;
	public $password = PASSWORD;
	public $database = DATABASE;

	public $link;
	public $error;

	public function __construct()
	{
		try
		{
			$this->dbConnect();
		}
		catch (mysqli_sql_exception $ex)
		{
			die("Связь с базой не установлена: " . $ex->getMessage());
		}
	}

	public function dbConnect()
	{
		$this->link = mysqli_connect($this->host, $this->user, $this->password, $this->database);
		if (!$this->link)
		{
			$this->error = "Не удалось установить связь!";
			return false;
		}
	}

	public function add($tableName, $columns, $values)
	{
		$columnsString = implode(',', $columns);
		$valuesString = implode(',', array_fill(0, count($values), '?'));

		try
		{
			if(isset ($_POST ['add']))
			{
				$sqlReq = ("INSERT INTO $tableName ($columnsString) VALUES ($valuesString)");
				$query = $this->link->prepare($sqlReq);
				$query->execute($values);
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
	}

	public function edit($tableName, $columns, $values, $get_id)
	{
		/*if(isset($_GET['Id']))
		{
			$id = $_GET['Id'];
		}*/

		$columnsString = implode(' =?, ', $columns) . ' =?';
		$valuesString = implode(',', array_fill(0, count($values), '?'));

		try
		{
			if (isset($_POST['edit']))
			{
				$sqlReq = ("UPDATE $tableName SET $columnsString WHERE Id=?");
				$query = $this->link->prepare($sqlReq);
				$query->execute(array_merge($values, [$get_id = $_GET['Id']]));
				if ($query)
				{
					header("Location: " . $_SERVER['HTTP_REFERER']);
				}
			}
		}
		catch(mysqli_sql_exception $ex)
		{
			die("Произошла ошибка!" . $ex->getMessage());
		}
	}

	public function read($tableName)
	{
		$sqlReq = "SELECT * FROM $tableName";
		$query = $this->link->prepare($sqlReq);
		$query->execute();
		$result = $query->get_result();
		$rows = $result->fetch_all(MYSQLI_ASSOC);
	}

	public function delete($get_id, $tableName)
	{
		try
		{
			if (isset($_POST['delete']))
			{
				$sqlReq = ("DELETE FROM $tableName WHERE Id=?");
				$query = $this->link->prepare($sqlReq);
				$query->execute([$get_id]);
				if ($query)
				{
					header("Location: " . $_SERVER['HTTP_REFERER']);
				}
			}
		}
		catch(mysqli_sql_exception $ex)
		{
			die("Произошла ошибка!" . $ex->getMessage());
		}
	}

}

?>