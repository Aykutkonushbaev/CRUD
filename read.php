<?php
require 'database.php';
$id=$_GET['id'];
if(null==$id){
    header('location: index.php');
}
else{
    $pdo=Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $sql="SELECT * FROM users WHERE id=?";
    $q=$pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();
}
?>
<html>
<head>
    <title>Окуу</title>
    <meta charset="UTF-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="span10 offset1">
        <div class="row">
            <h3>Колдонуучу жонундо маалымат алуу</h3>
        </div>
        <div class="form-horizontal">
            <div class="control-group">
                <label class="control-label">Катардагы номери:</label>
                <div class="controls">
                    <label class="checkbox">
                        <?php echo $data['id'];?>
                    </label>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Электрондук почтасы:</label>
                <div class="controls">
                    <label class="checkbox">
                        <?php echo $data['email'];?>
                    </label>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Сыр созу:</label>
                <div class="controls">
                    <label class="checkbox">
                        <?php echo $data['password'];?>
                    </label>
                </div>
            </div>
            <div class="form-actions">
                <a class="btn" href="index.php">Артка кайт</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>