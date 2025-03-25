<?php

return [
    'mixed' => 'El campo :attribute debe contener al menos una letra mayúscula y una minúscula.',
    'letters' => 'El campo :attribute debe contener al menos una letra.',
    'numbers' => 'El campo :attribute debe contener al menos un número.',
    'symbols' => 'El campo :attribute debe contener al menos un símbolo.',
    'uncompromised' => 'El :attribute proporcionado ha aparecido en una filtración de datos. Por favor elige un :attribute diferente.',
    'required' => 'El campo :attribute es obligatorio.',
    'string' => 'El campo :attribute debe ser texto.',
    'min' => [
        'string' => 'El campo :attribute debe tener al menos :min caracteres.',
    ],
    'max' => [
        'string' => 'El campo :attribute no puede tener más de :max caracteres.',
    ],
    'email' => 'El campo :attribute debe ser una dirección de correo válida.',
    'unique' => 'El valor del campo :attribute ya está en uso.',
    'confirmed' => 'La confirmación del campo :attribute no coincide.',
    'attributes' => [
        'name' => 'nombre',
        'email' => 'correo electrónico',
        'password' => 'contraseña',
        'dni' => 'DNI',
        'birth_date' => 'Fecha de nacimiento',
        'address' => 'Dirección',
        'phone' => 'Teléfono',
        'image' => 'Imagen',
    ],
];