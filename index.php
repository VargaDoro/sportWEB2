<?php 
    include_once "AB.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
        $adatbazis = new AB();
        if ($adatbazis->meret("kartya") == 0){
            $adatbazis->feltoltes("kartya", "szinAzon", "formaAzon", "szin", "forma");
        } 
        $adatbazis->kapcsolatBezar();
    ?>
</body>
</html>