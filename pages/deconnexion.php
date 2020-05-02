<?php
include('../includes/debut_page.php');
unset($_SESSION['pseudo']);
unset($_SESSION['niveau']);
header('Location: http://nolarkprof/index.php');