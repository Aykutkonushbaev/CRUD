<?php
require 'database.php';
$id=$_GET['id'];
if(empty($_GET['id'])){
    $id=$_REQUEST['id'];
}

if(!empty($_POST)){
    $emailError=null;
    $passwordError=null;

    $email=$_POST['email'];
    $password=$_POST['password'];

    $valid=true;

    if (empty($email)) {
        $emailError = 'Бул талааны тортурунуз';
        $valid = false;
    } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
        $emailError = 'Туура жазылбай калды';
        $valid = false;
    }

    if(empty($password)){
        $passwordError='Бул талаа бош калбаш керек';
        $valid=false;
    }
    if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE users  set email = ?, password =? WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($email,$password,$id));
            Database::disconnect();
            header("Location: index.php");
        }
    else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM users where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $id = $data['id'];
        $email = $data['email'];
        $password = $data['password'];
        Database::disconnect();
    }
}
?>

<html>
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <link   href="css/style.css">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
<div class="container">

    <div class="span10 offset1">
        <div class="row">
            <h3>Колдонуучу маалыматтарын жанылоо</h3>
        </div>

        <form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">
            <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
                <label class="control-label">Электрондук дарек</label>
                <div class="controls">
                    <input name="email" type="text" placeholder="Жаны электрондук дарек" value="<?php echo !empty($email)?$email:'';?>">
                    <?php if (!empty($emailError)): ?>
                        <span class="help-inline"><?php echo $emailError;?></span>
                    <?php endif;?>
                </div>
            </div>
            <div class="control-group <?php echo !empty($passwordError)?'error':'';?>">
                <label class="control-label">Сыр соз</label>
                <div class="controls">
                    <input name="password" type="text"  placeholder="Жаны сыр соз" value="<?php echo !empty($password)?$password:'';?>">
                    <?php if (!empty($passwordError)): ?>
                        <span class="help-inline"><?php echo $passwordError;?></span>
                    <?php endif;?>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-success">Жаныла</button>
                <a class="btn" href="index.php">Артка кайт</a>
            </div>
        </form>
    </div>

</div>
</body>
</html>
