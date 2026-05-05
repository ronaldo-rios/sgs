<?php

namespace App\Adms\Controllers;

use App\Adms\Models\UpdateProfileModel;
use App\Helpers\Flash;
use App\Helpers\Redirect;
use Core\ConfigView;

class UpdateProfile
{
    private ?array $data = [];

    public function index(): void
    {
        $formData = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
      
        if (!empty($formData['send_edit_profile'])) {
           $this->editProfile($formData);
        } 
        else {
            $viewProfile = new UpdateProfileModel();
            $profile = $viewProfile->viewProfile();
            if ($profile) {
                $this->data['profile'] = $profile;
                $this->viewEditProfile();
            }
            else {
                Redirect::to('login/index');
            }
        }
    }

    private function viewEditProfile()
    {
        $view = new ConfigView("Adms/Views/profile/updateProfile", $this->data);
        $view->loadView();
    }

    private function editProfile(?array $formData): void
    {
        if (! empty($formData['send_edit_profile'])) {

            $profile = new UpdateProfileModel();
            $updatedProfile = $profile->update($formData);

            if ($updatedProfile) {
                Redirect::to('view-profile/index');
            } else {
                $current = $profile->viewProfile();
                $this->data['profile'] = array_merge($current, $formData);
                $this->viewEditProfile();
            }
        }
        else {
            Flash::danger('Usuário não encontrado!');
            Redirect::to('login/index');
        }
    }
}