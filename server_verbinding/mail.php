<?php
function genereerRandomString() {
    $karakters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $karakterlengte = strlen($karakters);
    $String = '';
    for ($i = 0; $i < 15; $i++) {
        $String .= $karakters[rand(0, $karakterlengte - 1)];
    }
    return $String;
}
?>
