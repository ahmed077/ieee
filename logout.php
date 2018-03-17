<?php
session_start();
session_reset();
session_unset();
header("Location: index.php");
exit();