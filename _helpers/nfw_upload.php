<?php
function upload($a = '', $b = '', $c = '')
{
    if (!isset($_FILES[$a]) || $_FILES[$a]['error'] === 4) {
        return false;
    }
    $handle = new \Verot\Upload\Upload($_FILES[$a]);
    $ex = explode('.', $_FILES[$a]['name']);
    $ext = $ex[(count($ex) - 1)];
    if ($handle->uploaded) {
        $handle->file_new_name_body = rand(1, 100) . date('dmyhis');
        $handle->file_new_name_ext = $ext;
        $handle->file_force_extension = false;
        $handle->file_overwrite = true;
        $handle->file_safe_name = true;
        $handle->jpeg_quality = 50;
        if ($b === 'geojson') {
            $handle->mime_types['geojson'] = 'application/json';
            $handle->allowed[] = 'application/geo+json';
            $handle->allowed[] = 'application/json';
            $handle->allowed[] = 'text/plain';
        }
        $handle->process($c . 'assets/unggah/' . $b . '/');
        if ($handle->processed) {
            return $handle->file_dst_name;
        } else {
            if (session_status() === PHP_SESSION_ACTIVE) {
                $_SESSION['upload_error'] = $handle->error;
                $_SESSION['upload_error_details'] = 'ext=' . $ext . ' mime=' . ($handle->file_src_mime ?? 'unknown');
            }
            return false;
        }
    }
}
