<?php
class AB{
    private $host = "localhost";
    private $felhasznaloNev = "root";
    private $jelszo = "";
    private $adatbazisNev = "sport";
    private $kapcsolat;

    public function __construct(){
        $this->kapcsolat = new mysqli($this->host, $this->felhasznaloNev, $this->jelszo, $this->adatbazisNev);
        $this->kapcsolat->query("SET NAMES UTF8");
    }

    public function kapcsolatBezar(){
        $this->kapcsolat->close();
    }

    public function torles($tabla, $oszlop, $ertek){
        $sql = "DELETE FROM $tabla WHERE $tabla WHERE $oszlop = '$ertek')";
        $this->kapcsolat->query($sql);
    }

    public function beszur($ujTabla, $mezok, $ertekek){
        if (count($mezok) !== count($ertekek)) {
            die("Hiba: A mezők és az értékek száma nem egyezik!");
        }

        // Mezők és értékek megfelelő formázása
        $mezoLista = implode(", ", $mezok);
        $ertekLista = implode("', '", array_map([$this->kapcsolat, 'real_escape_string'], $ertekek));

        $sql = "INSERT INTO $ujTabla ($mezoLista) VALUES ('$ertekLista')";
        $siker = $this->kapcsolat->query($sql);

        return $siker ? "Adatok sikeresen beszúrva!" : "Hiba: " . $this->kapcsolat->error;
    }

    public function modosit(){
        $this->kapcsolat->query("UPDATE `csapat` SET `nev`='Császárok' WHERE `nev`='Királyok'");
    }

    public function oszlopLeker($oszlop, $oszlop2, $tabla){
        $sql = "SELECT $oszlop, $oszlop2 FROM $tabla";
        $matrix = $this->kapcsolat->query($sql);
        return $matrix;
    }

    public function megjelenites($matrix){
        echo"<h1>Csapatok</h1>";
        while ($sor = $matrix->fetch_row()) {
            echo "<div class='csapat'>";
            echo "<img src='kepek/{$sor[1]}' alt='{$sor[0]}'>";
            echo "<p>{$sor[0]}</p>";
            echo "</div>";
        }
    }
}