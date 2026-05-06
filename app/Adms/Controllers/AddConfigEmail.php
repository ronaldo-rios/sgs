<?php

namespace App\Adms\Controllers;

use App\Adms\Models\AddConfiEmailModel;
use App\Helpers\Redirect;
use Core\ConfigView;

class AddConfigEmail
{
    private ?array $data = [];

    public function index(): void
    {
        $formData = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

        ! empty($formData['send_add_config_emails']) 
            ? $this->addEmailServer($formData) 
            : $this->viewEmailServer();
    }

    private function addEmailServer(array $formData): void
    {
        $addConfEmail = new AddConfiEmailModel();
        $added = $addConfEmail->add($formData);

        $added ? Redirect::to("config-emails/index") : $this->viewEmailServer();
    }

    private function viewEmailServer(): void
    {
        $view = new ConfigView("Adms/Views/emailconfig/addConfigEmail", $this->data);
        $view->loadView();
    }

}