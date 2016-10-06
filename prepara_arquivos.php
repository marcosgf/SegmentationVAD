<?php
error_reporting(E_ERROR | E_PARSE);
function removeCaracteres($x) {
    $remover = array("WEBVTT", ",","!", '"', "-", ":", ".", ">","?","_","(",")","III",";","{","}","'","ª","º","□","”","’","‘");

    $trocaMIN = array(
        'à', 'á', 'ã', 'â',
        'ê', 'é',
        'í',
        'ó', 'õ', 'ô',
        'ú', 'ü',
        'ç',
        'é', 'ê');

    $trocaMAI = array(
        'À', 'Á', 'Ã', 'Â',
        'Ê', 'É',
        'Í',
        'Ó', 'Õ', 'Ô',
        'Ú', 'Ü',
        'Ç',
        'É', 'Ê');

    return $x=(strtoupper(str_replace($trocaMIN,$trocaMAI,(str_replace($remover,"",$x)))));
}
for($id=1;$id<=621;$id++) {
    //Mudar o caminho de acordo com o arquivo srt ou vtt que for usar.
    $arquivo = "legenda/A" . $id . ".vtt";
    $item = file($arquivo);
    for ($i = 0; $i < sizeof($item); $i++) {
        for ($j = 0; $j < strlen($item[$i]); $j++) {
            if (ctype_alpha($item[$i]{$j}) || $item[$i]{0} == "\n") {
                $item[$i] = removeCaracteres($item[$i]);
                if ($item[$i] != "\n")
                    $item[$i] = str_replace("\n", " ", $item[$i]);
                //echo $item[$i];
                file_put_contents('legenda/aux.txt', $item[$i], FILE_APPEND);
                break;
            }
        }
    }

    $item = file('legenda/aux.txt');
    $item1 = file('tempo/'.$id.'.txt');
    $j = 0;

    for($i=0;$i<sizeof($item);$i++){
        if($item[$i]=="\n"){
            //echo $id."-->".$i."\n";
        }
        else{
            file_put_contents('legendas/A'.$id.'.txt', $j."\n".$item[$i], FILE_APPEND);
            $j++;
        }
    }

    for($i=0;$i<sizeof($item1);$i++){

        $tempo= explode("|||||",$item1[$i]);
        $decI = explode(".",$tempo[0]);
        $segI = explode(":",$decI[0]);
        $decF = explode(".",$tempo[1]);
        $segF = explode(":",$decF[0]);

        $inicio = (((int)$segI[0] * 3600) + ((int)$segI[1] * 60) + ((int)$segI[2])).".$decI[1]";
        $fim = (((int)$segF[0] * 3600) + ((int)$segF[1] * 60) + ((int)$segF[2])).".$decF[1]";
        if((int)$inicio>(int)$fim){
            echo $i."\n";
        }
        file_put_contents('tempos/A'.$id.'.txt', $i."\n".$inicio." ".$fim, FILE_APPEND);
    }
    unlink('legenda/aux.txt');

    //função para verificar se estão do mesmo tamanho
    $legendas = file('legendas/A'.$id.'.txt');
    $tempos = file('tempos/A'.$id.'.txt');
    if(sizeof($legendas)!=sizeof($tempos)){
        echo "ERRO: tamanho de arquivos diferentes em A$id \n";
    }

}