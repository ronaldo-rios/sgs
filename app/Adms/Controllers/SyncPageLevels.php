<?php

namespace App\Adms\Controllers;

use App\Adms\Models\SyncPageLevelsModel;
use App\Helpers\Redirect;

class SyncPageLevels
{
    public function index(): void
    {
        $syncPageLevels = new SyncPageLevelsModel();
        $syncPageLevels->sync();
        Redirect::to("access-levels/index");
    }
}
