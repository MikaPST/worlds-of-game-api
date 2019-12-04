<?php
require ("bddData.php");

function getPdo():PDO
{

    return new PDO(
        DSN,
        USER,
        MDP,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    );

}
