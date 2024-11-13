<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function index()
    {
        // Mostrar el formulario de generación de contraseñas
        return view('password.generator');
    }

    public function generate(Request $request)
    {
        // Definir los caracteres que se pueden usar
        $lowercase = 'abcdefghijklmnopqrstuvwxyz';
        $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numbers = '0123456789';
        $special = '!@#$%^&*()-_=+[]{}|;:,.<>?';

        // Obtener las configuraciones de longitud y tipos de caracteres
        $length = $request->input('length', 12); // Longitud predeterminada es 12
        $includeUppercase = $request->has('include_uppercase');
        $includeNumbers = $request->has('include_numbers');
        $includeSpecial = $request->has('include_special');

        // Construir el conjunto de caracteres posibles
        $characters = $lowercase;
        if ($includeUppercase) {
            $characters .= $uppercase;
        }
        if ($includeNumbers) {
            $characters .= $numbers;
        }
        if ($includeSpecial) {
            $characters .= $special;
        }

        // Generar la contraseña aleatoria
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[random_int(0, strlen($characters) - 1)];
        }

        // Retornar la vista con la contraseña generada
        return view('password.generator', ['password' => $password]);
    }
}
