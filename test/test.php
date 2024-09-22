<?php global $result; global $tables;
include 'test1.php' ?>
<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">

	<title>Galleries</title>
</head>
<body>

<div class="container mt-3">
    <select id="tableSelect" class="form-select" onchange="location = this.value;">
        <option selected>Выберите таблицу</option>
		<?php
		foreach ($tables as $table)
        {
			$url = '';
			switch ($table) {
				case 'galleries':
					$url = 'http://localhost/LabaBeta/test/test.php';
					break;
				case 'artists':
					$url = 'http://localhost/LabaBeta/painter/painter.php';
					break;
				case 'reviewsgallery':
					$url = 'http://localhost/LabaBeta/review/review.php';
					break;
				case 'gallerypersonal':
					$url = 'http://localhost/LabaBeta/staff/staff.php';
					break;
				case 'paintings':
					$url = 'http://localhost/LabaBeta/index.php?Id=1';
					break;
				default:
					$url = 'http://localhost/LabaBeta/test/test.php';
				break;
			}
			?>
            <option value="<?php echo $url; ?>"><?php echo $table; ?></option>
		<?php } ?>
    </select>
</div>

<h1>Список галерей</h1>
<div class="container">
	<div class="row">
		<div class="col-12">
			<button class="btn btn-success mt-2" data-bs-toggle="modal" data-bs-target="#create">+</button>
			<button class="btn btn-primary" style="width: 200px; position:absolute; right: 120px" onclick="location.href='http://localhost/LabaBeta/index.php'">Вернуться на главную</button>
			<table class="table table-striped table-hover mt-2">
				<thead class="thead-dark">
				<th>Id</th>
				<th>Название галереи</th>
				</thead>
				<tbody>
				<?php foreach($result as $res) {?>
				<tr>
					<td><?php echo $res['Id'];?></td>
                    <td><a href="<?php echo 'http://localhost/LabaBeta/index.php'; ?>?Id=<?php echo $res['Id']; ?>"><?php echo $res['Name'];?></a></td>
					<td><a href="?Id=<?php echo $res['Id'];?>" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit<?php echo $res['Id'];?>" style="position:absolute; right: 120px">Изменить </a>
						<a href="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?php echo $res['Id'];?>" style=" position: absolute ;right: 240px; ">Удалить</a></td>
				</tr>
				<!-- Modal edit-->
				<div class="modal fade" id="edit<?php echo $res['Id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h1 class="modal-title fs-5" id="exampleModalLabel">Изменить</h1>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
							</div>
							<div class="modal-body">
								<form action="?Id=<?php echo $res['Id'];?>" method="post" enctype="multipart/form-data">
									<div class="form-group">
										<small>Название галереи</small>
										<input type="text" class="form-control" name="Name" value="<?php echo $res['Name'];?>">
									</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
								<button type="submit" class="btn btn-primary" name="edit">Добавить</button></form>
							</div>
						</div>
					</div>
				</div>
				<!-- Modal edit-->
				<!-- Modal delete-->
				<div class="modal fade" id="delete<?php echo $res['Id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h1 class="modal-title fs-5" id="exampleModalLabel">Удалить номер <?php echo $res['Id'];?></h1>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
								<div class="modal-footer">
									<form action="?Id=<?php echo $res['Id'];?>" method="post" enctype="multipart/form-data">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
										<button type="submit" class="btn btn-danger" name="delete">Удалить</button></form>
								</div>
							</div>
						</div>
					</div>
					<!-- Modal delete-->
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>


<!-- Modal create-->
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="exampleModalLabel">Добавить</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
			</div>
			<div class="modal-body">
				<form action="" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<small>Название галереи</small>
						<input type="text" class="form-control" name="Name">
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
				<button type="submit" class="btn btn-primary" name="add">Добавить</button></form>
			</div>
		</div>
	</div>
</div>
<!-- Modal create-->
<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
-->
</body>
</html>

