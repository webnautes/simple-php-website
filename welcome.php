<?php
include('dbcon.php');
include('check.php');

if (is_login()) {;
} else
  header("Location: index.php");

include('head.php');
?>

<div align="center">
  <?php
  $user_id = $_SESSION['user_id'];

  try {
    $stmt = $con->prepare('select * from users where username=:username');
    $stmt->bindParam(':username', $user_id);
    $stmt->execute();
  } catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
  }

  $row = $stmt->fetch();

  echo ($row['regtime']);
  ?>

  에 생성된

  <?php echo $user_id; ?>로 로그인했습니다.
</div>

</body>

</html>