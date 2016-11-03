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

/*
 <?php

error_reporting(E_ERROR | E_PARSE);
$limit_sec = 1;
$arqs = scandir('tempos_VAD/',1);
for($i = 0 ; $i < 1; $i++){
    echo " Arquivo atual: $arqs[$i] \n";

    //vetores de tempos originais e legendas
    $file = file("tempos/$arqs[$i]");
    $k = 0;
    for($l = 0 ; $l < sizeof($file); $l = $l + 2){
        $times[$k] = $file[$l+1];
        $k++;
    }
    $k = 0 ;
    $file = file("legendas/$arqs[$i]");
    for($l = 0 ; $l < sizeof($file); $l = $l + 2){
        $legend[$k] = $file[$l+1];
        $k++;
    }

    $times_vad = file("tempos_VAD/$arqs[$i]");
    $id = 0;
    $l = 0;
    for($j = 0 ; $j < sizeof($times_vad) ; $j++){
        $legenda = "";
        //echo "1 ";
        $t_beg = (explode(" ", $times_vad[$j]))[0];
        $t_end = (explode(" ", $times_vad[$j]))[1];
        $end_ori = (explode(" ",$times[$id]))[1];

        while($j < sizeof($times_vad) && $id < sizeof($times)){
            if(((float)$t_end <= (float)$end_ori && (float)$end_ori <= (float)$t_end+ (float)$limit_sec) ||
                ((float)$t_end- (float)$limit_sec <= (float)$end_ori && (float)$end_ori <= (float)$t_end)){
                $leg_aux = $legenda;
                echo "1 t_beg = $t_beg ,  t_end = $t_end ,  end_ori = $end_ori \n";
                //echo "2 ";
                $legenda = str_replace("\n","",$leg_aux);
                $legenda = $legenda.$legend[$id];
                $id++;
                break;
            }
            else{
                /*elseif((float)$end_ori > (float)$t_end+$limit_sec || ((float)$t_end + $limit_sec) > (float)$end_ori){
                    $j++;
                    if($j >= sizeof($times_vad)){
                        $j--;
                        //echo "3 ";
                        $t_end = (explode(" ", $times_vad[$j]))[1];
                        break;
                    }
                    $aux_end_ori = (explode(" ",$times[$id + 1]))[1];
                    //echo " t_beg = $t_beg ,  t_end = $t_end ,  end_ori = $end_ori \n";
                    if((float)$t_end > (float)$end_ori && (float)$aux_end_ori < (float)$t_end){
                        $j--;
                        //echo "6 ";
                    }
                echo "2 t_beg = $t_beg ,  t_end = $t_end ,  end_ori = $end_ori \n";
                $id++;
                //echo "5 ";

                $end_ori = (explode(" ",$times[$id]))[1];
                if((float)$end_ori > ((float)$t_end + (float)$limit_sec)){
                    $id--;
                    $end_ori = (explode(" ",$times[$id]))[1];
                }
                else{
                    $leg_aux = $legenda;
                    $legenda = str_replace("\n","",$leg_aux);
                    $legenda = $legenda.$legend[$id];
                }
                if((((float)$t_end <= (float)$end_ori && (float)$end_ori <= (float)$t_end+ (float)$limit_sec) ||
                    ((float)$t_end- (float)$limit_sec <= (float)$end_ori && (float)$end_ori <= (float)$t_end))){
                    //não anda com end_orig
                    //echo "4 ";
                    echo "3 t_beg = $t_beg ,  t_end = $t_end ,  end_ori = $end_ori \n";
                }
                elseif((float)$end_ori >= (float)$t_end || ((float)$t_end - (float)$limit_sec) > (float)$end_ori){
                    echo "4 t_beg = $t_beg ,  t_end = $t_end ,  end_ori = $end_ori \n";
                    $j++;
                    $t_end = (explode(" ", $times_vad[$j]))[1];
                    if($j==sizeof($times_vad)){
                        $j--;
                        $t_end = (explode(" ", $times_vad[$j]))[1];
                        $j++;
                    }
                }

            }
        }
        //echo "6 ";
        $name = str_pad(str_replace("A","",(explode(".",$arqs[$i]))[0]),3,0,STR_PAD_LEFT);
        $id1 =  str_pad($l, 6, "0", STR_PAD_LEFT);
        $begin = str_replace("\n","",str_pad((explode(".",$t_beg))[0].substr((explode(".",$t_beg))[1],0,-1), 6, "0",STR_PAD_LEFT));
        $end = str_replace("\n","",str_pad((explode(".",$t_end))[0].substr((explode(".",$t_end))[1],0,-2), 6, "0",STR_PAD_LEFT));
        file_put_contents("text","A$name-$id1-$begin-$end ".substr($t_beg,0,-1)." ".substr($t_end,0,-2)."\n", FILE_APPEND);
        file_put_contents("segments","A$name-$id1-$begin-$end $legenda", FILE_APPEND);
        $l++;
    }
}
 */

//TUDO MAIÚSCULO
/*
function UpperCaracteres($x) {
    $trocaMIN = array(
        'à', 'á', 'ã', 'â',
        'è','ê', 'é',
        'ì','í',
        'ò','ó', 'õ', 'ô',
        'ù','ú', 'ü',
        'ç',
        'é', 'ê');

    $trocaMAI = array(
        'À', 'Á', 'Ã', 'Â',
        'È','Ê', 'É',
        'Ì','Í',
        'Ò','Ó', 'Õ', 'Ô',
        'Ù','Ú', 'Ü',
        'Ç',
        'É', 'Ê');

    return $x=(strtoupper(str_replace($trocaMIN,$trocaMAI,$x)));
}

$words = file('dict');
for($i=0;$i<sizeof($words);$i++){
    file_put_contents("dict1",UpperCaracteres($words[$i]), FILE_APPEND);
}
*/