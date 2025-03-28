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
        //$adatbazis->beszur('Alcsut',2003,'alcsut.png');
        $adatbazis->modosit();
        $adatbazis->torles("csapat","nev","tag","csapatAzon","Kutya");
        $matrix = $adatbazis->oszlopLeker("nev","kep","csapat");
        $adatbazis->megjelenites($matrix);
        $adatbazis->kapcsolatBezar();
    ?>
</body>
</html>