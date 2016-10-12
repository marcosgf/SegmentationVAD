<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/10/16
 * Time: 15:21
 * */
$musica = array("[MÚSICA]", "[MÚSICA}", "[SOM]", "[SOM_DE_JOGO]", "[MÚSICA)", "[CANTANDO]", "[SOM}");
$silencio = array("[SEM_ÁUDIO]", "[SEM ÁUDIO]", "[SEM SOM]", "[ÁUDIO_EM_BRANCO]" ,"[SEM_AÚDIO]" ,"[SEM _ÁUDIO]","[SEM");
$ruido = array("[APLAUSOS]" ,"[BARULHO]" ,"[CONVERSA" ,"[RISOS]" ,"[BARULHO_DAS_TECLAS]" ,"[RISADA]",
"[RUÍDO]" ,"[DESCONHECIDO]" ,"[VENTO]" ,"[ESTRANGEIRO]" ,"[TECLANDO]" ,"[BIPE]" ,"[2 BIPES]" ,"[RISO]" ,"[INAUDIBLE]", "[INCOMPREENSÍVEL]",
    "[INAUDÍVEL]");
$linha = file('text');
for($i=0 ; $i< sizeof($linha) ; $i++){
    $palavra = explode(" ",$linha[$i]);
    $line = $linha[$i];
    for($j = 1 ; $j < sizeof($palavra); $j++) {
    if ($palavra[$j] == "[MÚSICA]" || $palavra[$j] == "[MÚSICA}" || $palavra[$j] == "[SOM]" || $palavra[$j] == "[SOM_DE_JOGO]"||
        $palavra[$j] =="[MÚSICA)"|| $palavra[$j] =="[CANTANDO]" || $palavra[$j] == "[SOM}") {
            $line = str_replace($musica, "[MUSICA]", $linha[$i]);
        } elseif ($palavra[$j] =="[SEM_ÁUDIO]"|| $palavra[$j] == "[SEM ÁUDIO]"|| $palavra[$j] == "[SEM SOM]"||
        $palavra[$j] =="[ÁUDIO_EM_BRANCO]" || $palavra[$j] =="[SEM_AÚDIO]" || $palavra[$j] =="[SEM _ÁUDIO]" || $palavra[$j] =="[SEM") {
            $line = str_replace($silencio, "[SILENCIO]", $linha[$i]);
        } elseif ($palavra[$j] =="[APLAUSOS]" || $palavra[$j] =="[BARULHO]" || $palavra[$j] =="[CONVERSA" || $palavra[$j] =="[RISOS]"||
        $palavra[$j] =="[BARULHO_DAS_TECLAS]" || $palavra[$j] =="[RISADA]"|| $palavra[$j] =="[RUÍDO]" || $palavra[$j] =="[DESCONHECIDO]"||
        $palavra[$j] =="[VENTO]"|| $palavra[$j] =="[ESTRANGEIRO]"|| $palavra[$j] =="[TECLANDO]"|| $palavra[$j] =="[BIPE]"|| $palavra[$j] =="[2 BIPES]"
        || $palavra[$j] =="[RISO]"|| $palavra[$j] =="[INAUDIBLE]"|| $palavra[$j] == "[INCOMPREENSÍVEL]"|| $palavra[$j] =="[INAUDÍVEL]") {
            $line = str_replace($ruido, "[RUIDO]", $linha[$i]);
        }
    }
    file_put_contents("text_marc",$line, FILE_APPEND);
}