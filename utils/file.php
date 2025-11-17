<?php

function readJsonUser() {
    $filename = "/home/abdel/semestre3/TP_HTML/boostrap/utils/users.json";
    
    $ft = fopen($filename, "r");
    if ($ft === false) {
        echo "ressource false";
        var_dump([]);
        return []; 
    }
    $taille = filesize($filename);
    
    if ($taille === 0) {
        fclose($ft); 
        echo "Le fichier $filename est vide.";
        var_dump([]);
        return [];
    }
    $content = fread($ft, $taille);
    fclose($ft); 
    $content_in_array = json_decode($content, true); 
    return $content_in_array;
}


// readJson();


function writeJsonUser($tableau) {
    $filename = "/home/abdel/semestre3/TP_HTML/boostrap/utils/users.json";
    $ft = fopen($filename, "w");

    if ($ft === false) {
        error_log("Erreur : Impossible d'écrire dans le fichier $filename. ");
        return; 
    }
    $content_in_array = json_encode($tableau, JSON_PRETTY_PRINT);
    fwrite($ft, $content_in_array);
    fclose($ft);
    
    //echo "Données écrites avec succès dans $filename.\n";
}




?>