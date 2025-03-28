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

    public function torles($tabla, $oszlop, $tablaHivatkozott, $hivatkozottOszlop, $mit){
        $sql = "DELETE FROM $tabla WHERE $oszlop IN (SELECT $oszlop FROM $tablaHivatkozott WHERE $hivatkozottOszlop = '$mit')";
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
}