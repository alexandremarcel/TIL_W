<?php

include '../bdd/connexion.php';
include 'classement.php';
include 'notation.php';
include 'getAverageNote.php';

//echo note();
//echo getAverageNote();
echo getClassement($bdd);
?>