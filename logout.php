<?php
ob_start();
session_start();
session_reset();
session_unset();
header('refresh:0;url=index.php');
ob_end_flush();