<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 04/10/16
 * Time: 15:11
 */
$limit_sec = 1;
$arqs = scandir('tempos_VAD/',1);
for($i = 600 ; $i < sizeof($arqs) ; $i++){
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
        //echo " t_beg = $t_beg ,  t_end = $t_end ,  end_ori = $end_ori \n";
        while($j < sizeof($times_vad) && $id < sizeof($times)){
            if(((float)$t_end <= (float)$end_ori && (float)$end_ori <= (float)$t_end+$limit_sec) ||
                ((float)$t_end-$limit_sec <= (float)$end_ori && (float)$end_ori <= (float)$t_end)){
                $leg_aux = $legenda;
                //echo "2 ";
                $legenda = str_replace("\n","",$leg_aux);
                $legenda = $legenda.$legend[$id];
                $id++;
                break;
            }
            elseif((float)$end_ori > (float)$t_end+$limit_sec || ((float)$t_end + $limit_sec) > (float)$end_ori){
                $j++;
                if($j >= sizeof($times_vad)){
                    $j--;
                    //echo "3 ";
                    $t_end = (explode(" ", $times_vad[$j]))[1];
                    break;
                }
                $t_end = (explode(" ", $times_vad[$j]))[1];
                if((float)$end_ori >= (float)$t_end || (((float)$t_end <= (float)$end_ori && (float)$end_ori <= (float)$t_end+$limit_sec) ||
                        ((float)$t_end-$limit_sec <= (float)$end_ori && (float)$end_ori <= (float)$t_end))){
                    //não anda com end_orig
                    //echo "4 ";
                }else{
                    $id++;
                    //echo "5 ";
                    $leg_aux = $legenda;
                    $legenda = str_replace("\n","",$leg_aux);
                    $legenda = $legenda.$legend[$id];
                    $end_ori = (explode(" ",$times[$id]))[1];
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