<?php

return [
    'required' => 'Поле :attribute должно быть заполнено!',
    'unique' => ':attribute уже существует, выберите другой!',
    'max' => [
        'numeric' => 'Поле :attribute должно быть не больше чем :max.',
        'string' => 'Поле :attribute должно содержать не более :max знаков.',
    ],
    'min' => [
        'numeric' => 'Поле :attribute должно быть не менее чем :min.',
        'string' => 'Поле :attribute должно содержать не менее :min знаков.',
    ],
    'confirmed' => 'Поле :attribute не совпадает с предыдущим',
    'attributes' => [
        'email' => __('auth.email_field'),
        'name' => __('auth.name_field'),
        'password' => __('auth.password_field')
    ]
];
