<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 04/10/16
 * Time: 15:11
 */
$limit_sec = 1;
$arqs = scandir('tempos_VAD/',1);
for($i = 0 ; $i < 1 ; $i++){

    //vetores de tempos originais e legendas
    $file = file("tempos/$arqs[$i]");
    $k = 0;
    for($l = 0 ; $l < sizeof($file); $l = $l + 2){
        $times[$k] = $file[$l+1];
        $k++;
    }
   //var_dump($times);
    $k = 0 ;
    $file = file("legendas/$arqs[$i]");
    for($l = 0 ; $l < sizeof($file); $l = $l + 2){
        $legend[$k] = $file[$l+1];
        $k++;
    }
    //var_dump($legend);

    //testes
    /*
    $t_beg = (explode(" ", $times_vad[0]))[0];
    $t_end = (explode(" ", $times_vad[0]))[1];
    $end_ori = (explode(" ",$times[$id]))[1];
    echo "$arqs[$i] \n \n".$t_beg."\n $t_end\n$end_ori \n";*/

    $times_vad = file("tempos_VAD/$arqs[$i]");
    $id = 0;
    for($j = 0 ; $j < sizeof($times_vad) ; $j++){
        echo "1 ";
        $t_beg = (explode(" ", $times_vad[$j]))[0];
        $t_end = (explode(" ", $times_vad[$j]))[1];
        $end_ori = (explode(" ",$times[$id]))[1];
        echo "2 ";
        while($j < sizeof($times_vad)){
            if(($t_end <= $end_ori && $end_ori <= $t_end+$limit_sec) || ($t_end-$limit_sec <= $end_ori && $end_ori <= $t_end)){
                //anota legenda
                //salva t_end
                //proximo t_beg
                echo "3 ";
                break;
            }
            elseif($end_ori > $t_end+$limit_sec){
                //anota legenda
                echo "4 ";
                //proximo t_end
                //proximo end_orig
                $j++;
                $id++;
                $t_end = (explode(" ", $times_vad[$j]))[1];
                $end_ori = (explode(" ",$times[$id]))[1];
            }
        }
        file_put_contents("testes.txt",$t_beg." ".$t_end."\n", FILE_APPEND);
    }
    //break;
}