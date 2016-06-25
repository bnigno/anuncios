<?php

return [
    'upload-path' => env('\public\uploads'),
    'validator'   => [
        'file'    => 'required|mimes:png,gif,jpeg,jpg,bmp'
    ],
    'validator-messages' => [
        'file.mimes'     => 'O arquivo não está em um formato de imagem válido',
        'file.required'  => 'Imagem é necessária'
    ],
    'encode'      => 'jpg'
];