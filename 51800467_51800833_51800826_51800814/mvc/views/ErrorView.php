<?php
$root = "";

if (isset($_GET["url"])) {
    $url = explode("/", filter_var(trim($_GET["url"], "/")));
    $level = count($url);

    while ($level > 1) {
        $root = $root . "../";
        $level--;
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= $root . "public/style.css" ?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <title>Thông báo lỗi</title>
</head>
<body>
	<div class="container w-50 mt-5">
		<div class="alert alert-danger" role="alert">
            <div class="d-flex justify-content-center">
                <img class="w-100" src="<?= $root . "public/imgs/not_found.png" ?>">
            </div>

			<hr>
			<div class="d-flex pr-0">
			  <span class="mb-0">Không tìm thấy trang hoặc đã xảy ra lỗi! Bấm vào đây để trở về trang chủ</span>
			  <button onclick="window.location='<?= $root . "Home/Listclass" ?>';" type="button" class="btn btn-outline-danger ml-auto mr-0"> Trang chủ </button>
			</div>
		</div>
    </div>
</body>
</html>

