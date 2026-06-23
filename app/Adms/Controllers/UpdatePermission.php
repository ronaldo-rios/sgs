<?php

namespace App\Adms\Controllers;

use App\Adms\Models\UpdatePermissionModel;
use App\Helpers\Flash;
use App\Helpers\Redirect;

class UpdatePermission
{
    public function index(int|string|null $id): void
    {
        $permissionId = (int) $id;
        $level = (int) filter_input(INPUT_GET, 'level', FILTER_SANITIZE_NUMBER_INT);
        $page = (int) filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT);

        if (!empty($permissionId) && !empty($level) && !empty($page)) {
            $this->updatePermission($permissionId);
            Redirect::to("permissions/index/{$page}?level={$level}");
        } 
        else {
            Flash::danger('Permissão não encontrada!');
            Redirect::to("permissions/index");
        }
    }

    private function updatePermission(int $permissionId): void
    {
        $updatePermission = new UpdatePermissionModel();
        $updatePermission->update($permissionId);
    }
}