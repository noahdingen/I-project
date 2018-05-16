<?php

foreach ($klantgegevens as $value){
    if(isset($value)){
        echo $value;
    }
}

header("location: ../profielpagina.php?bewerken=false");
?>