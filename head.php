<html>
<head>
  <meta http-equiv="Content-Type" content="text/html;
    charset=UTF-8" />
<title>로그인 예제</title>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<script src="bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
<nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="http://www.sourcecodester.com">Sourcecodester</a>
<ul class="nav navbar-nav">
            <li class="active"><a href="index.php">메인</a></li>
            <?php if (isset($_SESSION['user_id'])) { ?>
                <li><a href="">Signed in as <?php echo $_SESSION['user_id']; ?></a></li>
                <li><a href="logout.php">Log Out</a></li>
            <?php } else { ?>
                <li><a href="index.php">Login</a></li>
            <?php } ?>
</ul>
        </div>
    </div>
</nav>