<?php

    $example = 'nicer/2020MayFri1105582020Apr271104121fungi.jpg';

    var_dump(strpos($example, '/'));

    $occur = strpos($example, '/');

    if($occur)
    {
        echo substr($example, 0, $occur);
    }

    print "\n";

?>