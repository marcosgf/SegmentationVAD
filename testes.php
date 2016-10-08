<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 04/10/16
 * Time: 16:26
 */

/*$item1 = file('tempo/1.txt');
for($i=0;$i<2;$i++) {
    //echo $item1[$i];
    $tempo = explode("|||||", $item1[$i]);
    //echo "$tempo[0]|||||$tempo[1]\n";
    $nom1 = explode(".", $tempo[0]);
    $text1 = explode(":", $nom1[0]);
    $nom2 = explode(".", $tempo[1]);
    $text2 = explode(":", $nom2[0]);

    $inicio = (((int)$text1[0] * 3600) + ((int)$text1[1] * 60) + ((int)$text1[2])).".$nom1[1]";
    $fim = (((int)$text2[0] * 3600) + ((int)$text2[1] * 60) + ((int)$text2[2])).".$nom2[1]";

    echo $inicio;
    echo " ".$fim;
    /*
    $inicio = str_pad($inicio, 4, "0", STR_PAD_LEFT) . str_pad(substr(round((int)$nom1[1], 3), 0, -1), 2, 0, STR_PAD_LEFT);
    $fim = str_pad($fim, 4, "0", STR_PAD_LEFT) . str_pad(substr(round((int)$nom2[1], 3), 0, -1), 2, 0, STR_PAD_LEFT);
    $inicio = str_pad($inicio, 7, "0", STR_PAD_LEFT);
    $fim = str_pad($fim, 7, "0", STR_PAD_LEFT);
    echo $inicio."--".$fim."\n";
    /*$id1 = str_pad(1, 3, "0", STR_PAD_LEFT);
    if (strlen($inicio) == 7) {
        $inicio = substr($inicio, 0, -1);
    }
    if (strlen($fim) == 7) {
        $fim = substr($fim, 0, -1);
    }
    $id2 = str_pad($i, 6, "0", STR_PAD_LEFT);
    echo $inicio."\n".$fim."\n".$id1."\n".$id2."\n";
    */

/*
    $carac = array("(",")","'", ",");
    $arquivos = scandir('tempos_VADT/',1);
    for($i = 0 ; $i < sizeof($arquivos); $i++){
        $line = file("tempos_VADT/$arquivos[$i]");
        for($j = 0 ; $j < sizeof($line) ; $j++){
            $newLine = str_replace($carac,"",$line[$j]);
            if($newLine != "\n"){
                file_put_contents("tempos_VAD/$arquivos[$i]",$newLine, FILE_APPEND);
            }
        }
    }

$arquivos = scandir('tempos_VADT/',1);
for($i = 0 ; $i < sizeof($arquivos); $i++){
    $line = file("tempos_VADT/$arquivos[$i]");
    for($j = 0 ; $j < sizeof($line) ; $j++){
        $nome1 = str_replace("A","",$arquivos[$i]);
        $nome = explode(".",$nome1);
        file_put_contents("tempos_VAD/A".(int)$nome[0].".txt",$line[$j], FILE_APPEND);
    }
}*/
$times = "0.000 5.527";
$end_ori = (explode(" ",$times))[1];
echo $end_ori;