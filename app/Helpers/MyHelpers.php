<?php

function makeMessagesLogin()
{
    $messages = [
        'email.required' => "Debe ingresar su correo electrónico para iniciar sesión.",
        'email.email' => "Usuario no registrado o contraseña incorrecta.",
        'password.required' => "Debe ingresar su contraseña para iniciar sesión."
    ];
    return $messages;
}

function makeMessagesRegister(){

    $messages = [
        'email.required' => "Debe ingresar el correo electrónico del sorteador.",
        'email.email' => "Debe ingresar el correo electrónico del sorteador.",
        'email.unique' => "El correo electrónico ingresado ya existe en el sistema.",
        'password.required' => "Debe ingresar la contraseña del sorteador.",
        'name.required' => "Debe ingresar el campo nombre del sorteador.",
        'age.required' => "Debe ingresar la edad del sorteador.",
        'age.min' => 'La edad del sorteador no puede ser inferior a 18 y mayor a 65',
        'age.max' => 'La edad del sorteador no puede ser inferior a 18 y mayor a 65',
        'age.integer' => "La edad del sorteador debe ser númerica."
        ];

    return $messages;
}

function makeMessagesTickets(){

    $messages = [
        'id.unique' => "El código generado aleatoriamente ya se encuentra en el sistema, lo sentimos, intente nuevamente.",
    ];

    return $messages;
}
