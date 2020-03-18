<?php

namespace Controllers;

use App\Services\MemberManager;
use App\Models\Member;

$m = new Member(0, "laure", "thomas", "thomaslaure3@gmail.com", "password");
MemberManager::insert($m);

include(__DIR__ . "/../Views/home.php");