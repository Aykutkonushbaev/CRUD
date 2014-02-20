<?php
require 'database.php';
if( !empty($_POST)){
    $emailError=null;
    $passwordError=null;

    $email=$_POST['email'];
    $password=$_POST['password'];

    $valid = true;

    if(empty($email)){
        $emailError='Бул талоо бош калбоосу керек';
        $valid=false;
    }
    else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $emailError='Туура E-mail-низди жазыныз';
        $valid=false;
    }
    if(empty($password)){
        $passwordError='Бул талоо бош калбоосу керек';
        $valid=false;
    }

    if($valid){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO users(email,password) VALUES(?,?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($email,$password));
        Database::disconnect();
        header("location: index.php");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Кошуу</title>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="span10 offset1">
        <div class="row">
            <h3>Жаны колдонуучу кошуу</h3>
        </div>
        <form class="form-horizontal" action="create.php" method="POST">
            <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
                <label class="control-label">Электрондук почта</label>
                <div class="controls">
                    <input name="email" type="email" placeholder="электрондук адресиниз" value="<?php echo !empty($email)?$email:'';?>">
                    <?php if(!empty($emailError)):?>
                        <span class="help-inline"><?php echo $emailError;?></span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="control-group <?php echo !empty($passwordError)?'error':'';?>">
                <label class="control-label">Сыр соз</label>
                <div class="controls">
                    <input name="password" type="password" placeholder="сыр созунуз" value="<?php echo !empty($password)?$password:'';?>">
                    <?php if(!empty($passwordError)):?>
                        <span class="help-inline"><?php echo $passwordError;?></span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-success">Кош</button>
                <a class="btn" href="index.php">Артка кайт</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>