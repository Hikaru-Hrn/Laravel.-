<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TestController extends Controller
{
    // Приветсвие
    public function greeting(): string
    {
        return 'Привет из GET-запроса через контроллер!';
    }

    // Метод с параметром {id}
    public function showUser(string $id): string
    {
        return "Вы запросили пользователя с ID: {$id}";
    }

    // Post
    public function submitData(Request $request): JsonResponse
    {
        $username = $request->input('username', 'Аноним');

        return response()->json([
            'status' => 'success',
            'message' => "Данные успешно получены для: {$username}",
        ]);
    }



    public function home()
    {
        return view('home');
    }
}
