<?php
 
    include('dbcon.php');
    include('check.php');
 
    if (is_login()){


        if ($_SESSION['user_id'] == 'admin' && $_SESSION['is_admin']==1)
            ;
        else
            header("Location: welcome.php");
    }else
        header("Location: index.php");


if(isset($_GET['edit_id']) && !empty($_GET['edit_id']))
{
$edit_id = $_GET['edit_id'];
$stmt_edit = $con->prepare('SELECT * FROM users WHERE username = :user_id');
$stmt_edit->execute(array(':user_id'=>$edit_id));
$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
extract($edit_row);
}
else
{
header("Location: index.php");
}


if( ($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['btn_save_updates']))
{
        foreach ($_POST as $key => $val)
        {
            if(preg_match('#^__autocomplete_fix_#', $key) === 1){
                $n = substr($key, 19);
                if(isset($_POST[$n])) {
                    $_POST[$val] = $_POST[$n];
            }
        }
        }



$user_id = $_POST['editusername'];
$user_password = $_POST['editpassword'];
$userprofile = $_POST['edituserprofile'];
if ( isset($_POST['activate'])) $activate=1;
else $activate=0;

try {
$stmt = $con->prepare('select * from users where username=:username');
$stmt->bindParam(':username', $user_id);
$stmt->execute();

  } catch(PDOException $e) {
die("Database error: " . $e->getMessage());
  }

  $row = $stmt->fetch();
  $password = $row['password'];
  $salt = $row['salt'];


if(!isset($errMSG))
{
$stmt = $con->prepare('UPDATE users SET password=:user_password, userprofile=:userprofile, activate=:activate WHERE username=:user_id');
$stmt->bindParam(':user_id',$user_id);
$stmt->bindParam(':userprofile',$userprofile);
$stmt->bindParam(':activate',$activate);
                        $encrypted_password = base64_encode(encrypt($user_password, $salt));
                        $stmt->bindParam(':user_password', $encrypted_password);
$stmt->bindParam(':userprofile',$userprofile);

if($stmt->execute()){
?>
                                <script>
alert('업데이트 성공');
window.location.href='admin.php';
</script>
                <?php
}
else{
$errMSG = "업데이트 실패";
}
}
}
    include('head.php');
?>

<div class="container">
<div>
    <h1 class="h2" align="center">&nbsp; 사용자 정보 수정<a class="btn btn-success" href="admin.php" style="margin-left: 850px"><span class="glyphicon glyphicon-home"></span>&nbsp; Back</a></h1><hr>
    </div>
<form id="myform" method="post" enctype="multipart/form-data" class="form-horizontal" style="margin: 0 300px 0 300px;border: solid 1px;border-radius:4px">
    <?php
if(isset($errMSG)){
?>
        <div class="alert alert-danger">
          <span class="glyphicon glyphicon-info-sign"></span> &nbsp; <?php echo $errMSG; ?>
        </div>
        <?php
}
?>
<table class="table table-responsive">
    <tr>
        <? $r1 = rmd5(rand().mocrotime(TRUE)); ?>
    <td><label class="control-label">아이디</label></td>
        <td>
        <input id="id" class="form-control" type="text" name="<? echo $r1; ?>" value="<?php echo $username; ?>" placeholder="아이디를 입력하세요." autocomplete="off" readonly   />
        <input type="hidden" name="__autocomplete_fix_<? echo $r1; ?>" value="editusername" />
        </td>
    </tr>
    <tr>
        <? $r2 = rmd5(rand().mocrotime(TRUE)); ?>
    <td><label class="control-label">패스워드</label></td>
        <td>
        <?php
        $decrypted_password = decrypt(base64_decode($password), $salt);
        ?>
        <input id="pw" class="form-control" type="password" name="<? echo $r2; ?>" value="<?php echo $decrypted_password; ?>" placeholder="패스워드를 입력하세요."
              autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" required />
        <input type="hidden" name="__autocomplete_fix_<? echo $r2; ?>" value="editpassword" />
        </td>
    </tr>
    <tr>
        <? $r3 = rmd5(rand().mocrotime(TRUE)); ?>
    <td><label class="control-label">프로필</label></td>
        <td>
        <input class="form-control" type="text" name="<? echo $r3; ?>" value="<?php echo $userprofile; ?>" placeholder="프로필을 입력하세요."
              autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" required />
        <input type="hidden" name="__autocomplete_fix_<? echo $r3; ?>" value="edituserprofile" />
        </td>
    </tr>


<tr>
<td><label class="control-label">계정 활성화</label></td>
<td>
<?php if($activate)
{
?>
<input type="checkbox" name="activate" checked >    
<?php } else{
?>

<input type="checkbox" name="activate" >    
<?php
}
?>

</td>
</tr>

    <tr>


        <td colspan="2" align="center">
<button type="submit" name="btn_save_updates" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp; 업데이트</button>
        <a class="btn btn-warning" href="admin.php"> <span class="glyphicon glyphicon-remove"></span>&nbsp; 취소</a>
        </td>
    </tr>
    </table>
</form>
</div>
</body>
</html>