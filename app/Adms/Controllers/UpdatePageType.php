<?php

namespace App\Adms\Controllers;

use App\Adms\Models\UpdatePageTypeModel;
use App\Helpers\Flash;
use Core\ConfigView;
use App\Helpers\Redirect;

class UpdatePageType
{
    private ?array $data = [];

    public function index(string|int $id)
    {
        $formData = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

        if(! empty($id) && empty($formData['send_update_page_type'])) {
            $id = (int) $id;
            $pageType = new UpdatePageTypeModel();
            $details = $pageType->viewInfoPageType($id);

            if ($details !== []) {
                $this->data['pagetype'] = $details;
                $this->viewEditPageType();
            } else {
                Flash::danger("Tipo de página não encontrado!");
                Redirect::to("page-types/index");
            }
        }
        else {
            $this->editPageType($formData);
        }
    }

    private function viewEditPageType(): void
    {
        $view = new ConfigView("Adms/Views/pagetypes/updatePageType", $this->data);
        $view->loadView();
    }

    private function editPageType(?array $formData): void
    {
        if (! empty($formData['send_update_page_type'])) {
            $pageType = new UpdatePageTypeModel();
            $updated = $pageType->update($formData);
            if ($updated) {
                Redirect::to("page-types/index");
            }
            else {
                $this->data['pagetype'] = $formData;
                $this->viewEditPageType();
            }
        }
        else {
            Flash::danger("Tipo de página não encontrado!");
            Redirect::to("page-types/index");
        }
    }
}
