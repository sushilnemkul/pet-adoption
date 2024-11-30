<?php
define("NUM", 8);
define("CHARACTERS", "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ");

function generateRandom() {
    $random = "";
    for($i = 0; $i < NUM; $i++) {
        $index = rand(0, strlen(CHARACTERS) - 1);
        $random .= CHARACTERS[$index];
    }
    return $random;
}
?>