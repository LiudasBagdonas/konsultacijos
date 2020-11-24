<?php

require '../bootloader.php';

session_destroy();

header("Location: /login.php");
