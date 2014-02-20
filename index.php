<?php
/**
 * Created by PhpStorm.
 * User: Aykut
 * Date: 2/17/14
 * Time: 5:36 PM
 */
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Башкаруу</title>
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
<div class="container">
    <div class="row">
        <h3>КошууОкууЖанылооОчуруу</h3>
        <h3>CreateReadUpdateDelete</h3>
    </div>
    <div class="row">
        <p>
            <a href="create.php" class="btn btn-success">Кошуу</a>
        </p>

        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Номер</th>
                <th>Электрондук почта</th>
                <th>Сыр созу</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            include 'database.php';
            $pdo = Database::connect();
            $sql = 'SELECT * FROM users ORDER BY id DESC';
            foreach ($pdo->query($sql) as $row) {
                echo '<tr>';
                echo '<td>'. $row['id'] . '</td>';
                echo '<td>'. $row['email'] . '</td>';
                echo '<td>'. $row['password'] . '</td>';

                echo '<td width=250>';
                echo '<a class="btn btn-info" href="read.php?id='.$row['id'].'">Окуу</a>';
                echo ' ';
                echo '<a class="btn btn-warning" href="update.php?id='.$row['id'].'">Жанылоо</a>';
                echo ' ';
                echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Очуруу</a>';
                echo '</td>';
                echo '</tr>';
            }
            Database::disconnect();
            ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>