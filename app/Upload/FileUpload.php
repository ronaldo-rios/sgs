<?php

namespace App\Upload;

use App\Helpers\Flash;

final class FileUpload
{
    public static function requestUploadedFile(string $fieldName): array|null|false
    {
        $file = $_FILES[$fieldName] ?? null;
        if (! is_array($file)) {
            return null;
        }

        $error = (int) ($file['error'] ?? -1);
        if ($error === \UPLOAD_ERR_NO_FILE) {
            return null;
        }

        if ($error !== \UPLOAD_ERR_OK) {
            Flash::danger('Falha no envio do ficheiro.');

            return false;
        }

        $tmp = $file['tmp_name'] ?? '';
        if ($tmp === '' || ! is_uploaded_file($tmp)) {
            Flash::danger('Upload inválido ou não recebido (post_max_size / upload_max_filesize).');

            return false;
        }

        return $file;
    }

    public static function upload(
        array $file,
        string $directoryAbsolute,
        array $allowedExtensions,
        ?int $maxBytes = null,
    ): string|false 
    {
        $dir = $directoryAbsolute;

        if (! is_dir($dir)) {
            $ok = @mkdir($dir, 0775, true);
            if (! $ok && ! is_dir($dir)) {
                $why = error_get_last();
                $msg = $why['message'] ?? 'sem detalhe do SO';
                Flash::danger("Não foi possível criar a pasta do upload. Detalhe: {$msg}");
                return false;
            }
        }

        $ext = strtolower(pathinfo($file['name'] ?? '', PATHINFO_EXTENSION));
        if ($ext === '' || ! in_array($ext, $allowedExtensions, true)) {
            Flash::danger('Formato de ficheiro não permitido para este upload.');
            return false;
        }

        if ($maxBytes !== null && isset($file['size']) && (int) $file['size'] > $maxBytes) {
            Flash::danger('Ficheiro excede o tamanho máximo permitido.');
            return false;
        }

        $tmp = $file['tmp_name'] ?? '';
        if ($tmp === '' || ! is_uploaded_file($tmp)) {
            Flash::danger('Upload inválido ou não recebido (post_max_size / upload_max_filesize).');
            return false;
        }

        $newName = uniqid('', true) . '.' . $ext;
        $dest = $dir . $newName;

        if (! move_uploaded_file($tmp, $dest)) {
            Flash::danger('Erro ao gravar o ficheiro no servidor.');
            return false;
        }

        return $newName;
    }

    public static function unlinkIfExists(string $absoluteFilePath): void
    {
        if (is_file($absoluteFilePath)) {
            unlink($absoluteFilePath);
        }
    }
}
