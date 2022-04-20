<?php
session_start();
require('../include/include/cnx.php');
session_destroy();
header('location:../index.php');