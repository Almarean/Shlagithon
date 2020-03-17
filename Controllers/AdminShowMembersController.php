<?php

namespace App\Controllers;

use App\Models\Member;
use App\Services;
$members = Services\MemberManager::findAllByDateCreation();
if(isset($_GET['deleteLogin'])){
    Services\MemberManager::deleteOneById($_GET['deleteLogin']);
    header('location:members-editor');
}

include __DIR__ . "/../Views/admin_show_members.php";
