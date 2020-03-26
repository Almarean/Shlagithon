<?php

namespace App\Controllers;

session_unset();
session_destroy();

header("Location: login");