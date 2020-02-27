<?php
$_dir=__DIR__;
define('env', $_dir);
include(env.'/env.php');


// helpers
include 'vendor/autoload.php';
include 'helpers/helper.php';
include 'helpers/form.php';
include 'helpers/db.php';
include 'helpers/upload.php';
include 'helpers/session.php';
