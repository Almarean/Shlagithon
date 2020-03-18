<?php

namespace App\Controllers;

session_start();
session_unset();
session_destroy();

header("Location: login");