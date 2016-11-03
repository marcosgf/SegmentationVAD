<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 03/11/16
 * Time: 10:30
 */
$dicO = file('dict');
$phrase = file('text');
$dic = array(0 => "BOM");
$k = 1;
$l = 0;

function busca($palavra, $words){
    for($i=0; $i<sizeof($words); $i++){
        if($palavra == $words[$i]){
            return TRUE;
        }
    }
    return FALSE;
}

for($i=0; $i<sizeof($phrase); $i++){
    $words = explode(" ",$phrase[$i]);
    for($j=1; $j<sizeof($words); $j++){
        if(!busca($words[$j],$dic)){
            $dic[$k] = $words[$j];
            $k++;
        }
        else{
            //echo "já está no dicionário a palavra :".$words[$j]."\n";
        }
    }
}


for($i=0;$i<sizeof($dic);$i++){
    if(!busca($dic[$i],$dicO)){
        $WError[$l] = $dic[$i];
        $l++;
    }
}

print_r($WError);



/*
//CORRETOR
//dicionario
$dic[0] = "JARDIM PAULISTA";
$dic[1] = "JARDIM EUROPA";
$dic[2] = "ITAQUERA";
$dic[3] = "VILA MARIANA";
$dic[4] = "VILA MADALENA";
$dic[5] = "MORUMBI";
$dic[6] = "CENTRO";
$dic[7] = "PRACA DA ARVORE";

//TESTE: qual o nome mais similar à "JDIM PAULIZTA" no dicionário?
$bairro1 = "JDIM PAULIZTA";

$min_dist = 1000;
$sugestao = "";

foreach ( $dic as $item_dic)
{
    $cur_dist = levenshtein($bairro1, $item_dic);
    echo "distancia edicao: $bairro1 -> $item_dic = $cur_dist<br/>";

    if ($cur_dist < $min_dist) {
        $min_dist = $cur_dist;
        $sugestao = $item_dic;
    }
}

echo " <br/><br/>bairro: $bairro1<br/>";
echo "você não quis dizer $sugestao ?";