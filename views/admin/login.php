<?php

use App\Models\Users;
use App\PDOConnection;

$pdo = PDOConnection::getPDO();
$user = new Users;
