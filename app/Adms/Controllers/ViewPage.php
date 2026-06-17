<?php

namespace App\Adms\Controllers;

use App\Adms\Models\ViewPageModel;
use App\Helpers\Flash;
use App\Helpers\Redirect;
use Core\ConfigView;

class ViewPage
{
    private ?array $data = [];

    public function index(int|string $id): void
    {
        if (! empty($id)) {
            $id = (int) $id;
            $page = new ViewPageModel();
            $details = $page->viewInfo($id);

            if ($details !== []) {
                $this->data['page'] = $details;
                $this->viewPageDetails();
            } else {
                Flash::danger('Página não encontrada!');
                Redirect::to("pages/index");
            }
        }
        else {
            Flash::danger('Página não encontrada!');
            Redirect::to("pages/index");
        }
    }

    private function viewPageDetails(): void
    {
        $view = new ConfigView("Adms/Views/pages/viewPage", $this->data);
        $view->loadView();
    }
}
