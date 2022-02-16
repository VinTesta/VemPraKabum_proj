<?php
require_once("../layout/dao-loader.php");

session_start();
session_destroy();

redireciona("../", []);