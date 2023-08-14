<?php
use phpseclib3\Net\SFTP;

$sftp = new SFTP('10.100.57.116');
$sftp->login('ewp_archiver', 'Mkesh2021!');
?>