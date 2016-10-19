<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18/10/16
 * Time: 21:26
 */
$carac = array("(",")","'", ",");
$arqvs = scandir('arquivos_wav/',1);
for($i = 0 ; $i < sizeof($arqvs) ; $i++){
    $nome = str_replace("A","",(explode(".",$arqvs[$i]))[0]);
    exec(" python time-example.py 3 arquivos_wav/$arqvs[$i] > tempos_VADT/A".(int)$nome.".txt");
    $line = file("tempos_VADT/A".(int)$nome.".txt");
    for($j = 0 ; $j < sizeof($line) ; $j++){
        $newLine = str_replace($carac,"",$line[$j]);
        if($newLine != "\n"){
            file_put_contents("tempos_VAD/A".(int)$nome.".txt",$newLine, FILE_APPEND);
        }
    }
}