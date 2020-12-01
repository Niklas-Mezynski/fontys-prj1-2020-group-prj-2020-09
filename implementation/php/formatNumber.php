<?php
function formatNumber($number) {
    for ($i = 3; $i < strlen($number); $i+=4) {
        $position = strlen($number) - $i;
        $number = substr_replace($number, ".", $position, 0);
    }
    return $number;
}
?>