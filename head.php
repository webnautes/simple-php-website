<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>로그인 예제</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="https://webnautes.tistory.com/">webnautes.tistory.com</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">메인</a>
                    </li>
                    <?php if (isset($_SESSION['user_id'])) { ?>
                        <li class="nav-item"><a class="nav-link" href="">Signed in as <?php echo $_SESSION['user_id']; ?></a></li>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Log Out</a></li>
                    <?php } else { ?>
                        <li class="nav-item"><a class="nav-link" href="index.php">Login</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- jQuery, Popper.js, and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>