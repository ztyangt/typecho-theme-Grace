<?php

$this->need('./action/Ajax.php');

if (isset($_POST['smtp'])) {
	exit($this->need('./action/Smtp.php'));
} 
