<?php
    session_start();

    if (isset($_SESSION['user']))
    {
        header("Content-Type: image/png");
        readfile($_GET['src'] . ".png");
    }
    else
        header("Location:../../authorization.php");