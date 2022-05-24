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
    ],
    'mimes' => 'Файлы должны быть только типов :values',
    'numeric' => 'Поле :attribute должно быть числом',
    'email' => 'Поле :attribute должно быть email',
    'attributes' => [
        'text' => 'Текст отзыва',
        'author_name' => 'Имя автора',
        'grade' => 'Оценка',
        'quantity' => 'Количество',
        'price' => 'Цена',
        'name' => 'Название',
        'name_en' => 'Название на английском',
        'description' => 'Описание',
        'description_en' => 'Описание на английском',
        'code' => 'Код',
        'title' => 'Заголовок',
        'title_en' => 'Заголовок на английском',
        'button_href' => 'Ссылка на кнопке',
        'button_text' => 'Текст на кнопке',
        'button_text_en' => 'Текст на кнопке на английском',
        'password' => 'Пароль',
        'email' => 'Email',
        'sort' => 'Сортировка',
        'phone' => 'Телефон',
        'address_delivery' => 'Адрес доставки'
    ]
];
