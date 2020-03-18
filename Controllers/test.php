<?php

namespace Controllers;

use Models\Member;

$m = new Member("test", "test", "test", "test", "test");

include(__DIR__ . "/../Views/home.php");