<?php
function extenso($valor, $maiusculas) {
    // verifica se tem virgula decimal
    if (strpos($valor, ",") > 0) {
        // retira o ponto de milhar, se tiver
        $valor = str_replace(".", "", $valor);

        // troca a virgula decimal por ponto decimal
        $valor = str_replace(",", ".", $valor);
    }
    $singular = array("", "", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
    $plural = array("", "", "mil", "milhões", "bilhões", "trilhões",
        "quatrilhões");

    $c = array("", "cem", "duzentos", "trezentos", "quatrocentos",
        "quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos");
    $d = array("", "dez", "vinte", "trinta", "quarenta", "cinquenta",
        "sessenta", "setenta", "oitenta", "noventa");
    $d10 = array("dez", "onze", "doze", "treze", "quatorze", "quinze",
        "dezesseis", "dezesete", "dezoito", "dezenove");
    $u = array("", "um", "dois", "três", "quatro", "cinco", "seis",
        "sete", "oito", "nove");

    $z = 0;

    $valor = number_format($valor, 2, ".", ".");
    $inteiro = explode(".", $valor);
    $cont = count($inteiro);
    for ($i = 0; $i < $cont; $i++)
        for ($ii = strlen($inteiro[$i]); $ii < 3; $ii++)
            $inteiro[$i] = "0" . $inteiro[$i];

    $fim = $cont - ($inteiro[$cont - 1] > 0 ? 1 : 2);
    $rt = '';
    for ($i = 0; $i < $cont; $i++) {
        $valor = $inteiro[$i];
        $rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
        $rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
        $ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";

        $r = $rc . (($rc && ($rd || $ru)) ? " e " : "") . $rd . (($rd &&
                $ru) ? " e " : "") . $ru;
        $t = $cont - 1 - $i;
        $r .= $r ? " " . ($valor > 1 ? $plural[$t] : $singular[$t]) : "";
        if ($valor == "000"

        )$z++; elseif ($z > 0)
            $z--;
        if (($t == 1) && ($z > 0) && ($inteiro[0] > 0))
            $r .= ( ($z > 1) ? " de " : "") . $plural[$t];
        if ($r)
            $rt = $rt . ((($i > 0) && ($i <= $fim) &&
                    ($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $r;
    }

    if (!$maiusculas) {
        return($rt ? $rt : "zero");
    } elseif ($maiusculas == "2") {
        return (strtoupper($rt) ? strtoupper($rt) : "Zero");
    } else {
        return (ucwords($rt) ? ucwords($rt) : "Zero");
    }
}

function soNumero($str) {
    return preg_replace("/[^0-9]/", " ", $str);
}



//linha text 52105

$arquivo = file('text');
for($j = 0 ; $j < sizeof($arquivo) ; $j++){
    echo $j."\n";
    $text = "";
    $text = explode(" ",$arquivo[$j]);
    $textos = "";
    for($l = 1 ; $l < sizeof($text); $l++) $textos = $textos." ".$text[$l];
    $string1 = soNumero($textos);
    $texto = explode(" ",$string1);
    $nova = $textos;
    for($i = 0 ; $i < sizeof($texto); $i++){
        if(is_numeric($texto[$i])){
            //echo strtoupper(str_replace($texto[$i],extenso((int)$texto[$i],true),$nova));
            //$line = fgets(STDIN);
            //if($line == 1){
            $nova = strtoupper(str_replace($texto[$i],extenso((int)$texto[$i],true),$nova));
            //}
        }
    }
    //echo $text[0].$nova;
    file_put_contents('text_normalize', $text[0].$nova, FILE_APPEND);
}

$arquivo = file('text_normalize');
for($i = 0 ; $i < sizeof($arquivo) ; $i++){
    //echo $i."\n";
    $text = "";
    $text = explode(" ",$arquivo[$i]);
    $textos = "";
    for($l = 1 ; $l < sizeof($text); $l++) $textos = $textos." ".$text[$l];
    for($j = 0 ; $j < strlen($textos) ; $j++){
        if(is_numeric($textos{$j})){
            echo $text[0]."\n";
        }
    }
}
