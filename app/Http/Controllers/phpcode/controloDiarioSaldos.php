<?php

include_once 'data.php';
foreach ($campos as $key ) {
    if ($key[3]<=2500000) {
        print_r($key);
    }
}

?>