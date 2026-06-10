<?php

namespace App\Adms\Controllers;

use App\Adms\Models\UpdateConfigEmailModel;
use App\Helpers\Flash;
use App\Helpers\Redirect;
use Core\ConfigView;

class UpdateConfigEmail
{
    private ?array $data;

    public function index(int|string $id)
    {
        $formData = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

        if(! empty($id) && empty($formData['send_edit_email_config'])) {
            $id = (int) $id;
            $emailServer = new UpdateConfigEmailModel();
            $details = $emailServer->viewInfoEmailServer($id);
            
            if ($details) {
                $this->data['edit'] = $details;
                $this->viewEditEmailServer();
            } else {
                Flash::danger("Email de configuração não encontrado!");
                Redirect::to("config-emails/index");
            }
        }
        else {
            $this->editEmailServer($formData);
        }

    }

    private function viewEditEmailServer(): void
    {
        $view = new ConfigView("Adms/Views/emailconfig/updateConfigEmail", $this->data);
        $view->loadView();
    }

    private function editEmailServer(?array $formData): void
    {
        if (! empty($formData['send_edit_email_config'])) {
            $emailServer = new UpdateConfigEmailModel();
            $updated = $emailServer->edit($formData);
            if ($updated) {
                Redirect::to("config-emails/index");
            }
            else {
                $this->data['edit'] = $formData;
                $this->viewEditEmailServer();
            }
        }
        else {
            Flash::danger("Email de configuração não encontrado!");
            Redirect::to("config-emails/index");
        }
    }
}