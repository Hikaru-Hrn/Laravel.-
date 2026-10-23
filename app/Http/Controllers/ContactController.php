<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ContactController extends Controller{
    public function showForm(){
        return view('contact');
    }

    public function handleForm(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|max:50',
            'message' => 'required',
        ], [
            'name.required' => 'Нужно ввести имя',
            'name.min' => 'Минимальное количество символов для имени - :min',
            'name.max' => 'Максимальное количество символов для имени - :max',
            'email.required' => 'Требуется ввести email',
            'email.max' => "Максимальное количество символов для email - :max",
            'message.required' => 'Требуется ввести сообщение',
            'message.min' => 'Минимальное количество символов для сообщения - :min',
            'message.max' => "Максимальное количество символов для сообщения - :max"
        ]);
        $filename = 'formdata/' .uniqid() . ".json";
        $payload = array_merge($validatedData, [
            'submitted_at' => now()->toDateTimeString(),
        ]);

        $jsonContent = json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        // Сохранение внутри /storage/app
        Storage::disk('local')->put('contacts/' . $filename, $jsonContent);

        // Редирект назад с flash-сообщением об успехе в сессию
        return redirect()->route('contact.show')->with('success', 'Ваше сообщение успешно отправлено и сохранено!');
    }

    public function listSubmissions(Request $request){
        $submissions = [];
        $files = Storage::disk('local')->files('contacts/formdata');
        foreach ($files as $file) {
            // Проверяем, что файл .json
            if (pathinfo($file, PATHINFO_EXTENSION) === 'json') {
                $content = Storage::disk('local')->get($file);
                $data = json_decode($content, true);

                if ($data) {
                    // Сохраняем имя файла (может пригодиться как ID заявки)
                    $data['filename'] = basename($file);
                    $submissions[] = $data;
                }
            }
        }

        // Сортируем новые заявки сверху (по дате отправки)
        usort($submissions, function ($a, $b) {
            return strtotime($b['submitted_at'] ?? 0) <=> strtotime($a['submitted_at'] ?? 0);
        });

        return view('submissions', compact('submissions'));
    }
}
