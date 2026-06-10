<?php

namespace App\Adms\Controllers;

use App\Adms\Models\UpdateAccessLevelModel;
use App\Helpers\Flash;
use Core\ConfigView;
use App\Helpers\Redirect;

class UpdateAccessLevel
{
    private ?array $data = [];

    public function index(string|int $id)
    {
        $formData = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

        if(! empty($id) && empty($formData['send_update_access_level'])) {
            $id = (int) $id;
            $accessLevel = new UpdateAccessLevelModel();
            $details = $accessLevel->viewInfoAccessLevel($id);

            if ($details !== []) {
                $this->data['accesslevel'] = $details;
                $this->viewEditAccessLevel();
            } else {
                Flash::danger("Nível de acesso não encontrado!");
                Redirect::to("access-levels/index");
            }
        }
        else {
            $this->editAccessLevel($formData);
        }
    }

    private function viewEditAccessLevel(): void
    {
        $view = new ConfigView("Adms/Views/accesslevel/updateAccessLevel", $this->data);
        $view->loadView();
    }

    private function editAccessLevel(?array $formData): void
    {
        if (! empty($formData['send_update_access_level'])) {
            $accessLevel = new UpdateAccessLevelModel();
            $updated = $accessLevel->update($formData);
            if ($updated) {
                Redirect::to("access-levels/index");
            }
            else {
                $this->data['accesslevel'] = $formData;
                $this->viewEditAccessLevel();
            }
        }
        else {
            Flash::danger("Nível de acesso não encontrado!");
            Redirect::to("access-levels/index");
        }
    }
}
