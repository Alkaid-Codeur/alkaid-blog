<?php

session_start();
session_destroy();

header('Location:'. $router->url('admin_login'));
exit();