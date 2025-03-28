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

    public function meret($tabla){
        $sql = "SELECT * FROM $tabla";
        $matrix = $this->kapcsolat->query($sql);
        return $matrix->num_rows;
    }

    public function feltoltes($ujTabla, $mezo1, $mezo2, $tabla1, $tabla2){
        $mezo1Meret = $this->meret($tabla1);
        $mezo2Meret = $this->meret($tabla2);

        for ($i=1; $i <= $mezo1Meret; $i++) { 
            for ($j=1; $j <= $mezo2Meret; $j++) { 
                $sql = "INSERT INTO $ujTabla($mezo1, $mezo2) VALUES ('$i','$j')";
                $siker = $this->kapcsolat->query($sql);
                echo $siker?"siker":"sikertelen";
            }
        }
    }
}