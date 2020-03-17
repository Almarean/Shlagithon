<?php

namespace App\Controllers;

use App\Models\Member;
use App\Services\MemberManager;

$members = MemberManager::findAllByDateCreation();
if (isset($_GET['deleteLogin'])) {
    MemberManager::deleteOneById($_GET['deleteLogin']);
    header('Location: members-editor');
}

include __DIR__ . "/../Views/admin_show_members.php";