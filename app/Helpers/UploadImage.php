<?php

namespace App\Helpers;

use Core\Config;

class UploadImage
{
    private const ALLOWED_EXTENSIONS = ['jpg', 'jpeg', 'png'];

    /** Caminho absoluto: raiz do projeto + PATH_USER_IMAGE (sem DOCUMENT_ROOT — evita path errado no Docker). */
    private static function userImageDir(int|string $userId): string
    {
        $segment = str_replace('/', DIRECTORY_SEPARATOR, trim(Config::PATH_USER_IMAGE, '/\\'));

        return dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . $segment . DIRECTORY_SEPARATOR . $userId . DIRECTORY_SEPARATOR;
    }

    /**
     * Upload user image
     * @param array $dataImage
     * @return string|bool
     */
    public static function uploadUserImage(array $dataImage): string|bool
    {
        $path = self::userImageDir($dataImage['id']);
        if (! is_dir($path)) {
            $ok = @mkdir($path, 0775, true);
            if (! $ok && ! is_dir($path)) {
                $why = error_get_last();
                $msg = $why['message'] ?? 'sem detalhe do SO';
                Flash::danger(
                    'Não foi possível criar a pasta da imagem. Ajuste permissões do host em public/assets/img/users '
                    . '(ex.: chmod 775 ou dono do processo PHP com escrita). Detalhe: ' . $msg
                );
                return false;
            }
        }

        // Validate image extension
        $fileExtension = strtolower(pathinfo($dataImage['image']['name'], PATHINFO_EXTENSION));
        if (! in_array($fileExtension, self::ALLOWED_EXTENSIONS)) {
            Flash::danger('Formato de imagem inválido!');
            return false;
        }

        $tmp = $dataImage['image']['tmp_name'] ?? '';
        if ($tmp === '' || ! is_uploaded_file($tmp)) {
            Flash::danger('Arquivo de imagem inválido ou não recebido pelo servidor (verifique post_max_size / upload_max_filesize).');
            return false;
        }

        $newFileName = uniqid() . "." . $fileExtension;

        if (move_uploaded_file($tmp, $path . $newFileName)) {
            $dataImage['image'] = (string) $newFileName;
            return $dataImage['image'];
        }
        else {
            Flash::danger('Erro ao fazer upload da imagem!');
            return false;
        }
    }

    /** Delete old image from user directory server */
    public static function deleteBeforeImage(array $data, string $resultDbImage): void
    {
        $imagePath = self::userImageDir($data['id']) . basename($resultDbImage);
        if (file_exists($imagePath) && is_file($imagePath)) {
            unlink($imagePath);
        }
    }
}