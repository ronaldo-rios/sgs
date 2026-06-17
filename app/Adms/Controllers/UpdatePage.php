<?php

namespace App\Adms\Controllers;

use App\Adms\Models\UpdatePageModel;
use App\Helpers\Flash;
use Core\ConfigView;
use App\Helpers\Redirect;

class UpdatePage
{
    private ?array $data = [];

    public function index(string|int $id)
    {
        $formData = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

        if(! empty($id) && empty($formData['send_update_page'])) {
            $id = (int) $id;
            $page = new UpdatePageModel();
            $details = $page->viewInfoPage($id);

            if ($details !== []) {
                $this->data['page'] = $details;
                $this->viewEditPage();
            } else {
                Flash::danger("Página não encontrada!");
                Redirect::to("pages/index");
            }
        }
        else {
            $this->editPage($formData);
        }
    }

    private function viewEditPage(): void
    {
        $page = new UpdatePageModel();
        $this->data['page_types'] = $page->listPageTypes();
        $this->data['page_modules'] = $page->listPageModules();

        $view = new ConfigView("Adms/Views/pages/updatePage", $this->data);
        $view->loadView();
    }

    private function editPage(?array $formData): void
    {
        if (! empty($formData['send_update_page'])) {
            $page = new UpdatePageModel();
            $updated = $page->update($formData);
            if ($updated) {
                Redirect::to("pages/index");
            }
            else {
                $this->data['page'] = $formData;
                $this->viewEditPage();
            }
        }
        else {
            Flash::danger("Página não encontrada!");
            Redirect::to("pages/index");
        }
    }
}
