<!-- Таблица -->
@extends('layouts.app')

@section('title', 'Список полученных заявок')

@section('content')
    <div style="max-width: 900px; margin: 0 auto; padding: 20px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2>Полученные сообщения</h2>
            <a href="{{ route('contact.show') }}" style="text-decoration: none; padding: 8px 14px; background: #28a745; color: #fff; border-radius: 4px;">
                + Написать новое
            </a>
        </div>

        @if(empty($submissions))
            <div style="padding: 15px; background: #e9ecef; border-radius: 4px; text-align: center; color: #6c757d;">
                Пока нет ни одного отправленного сообщения.
            </div>
        @else
            <table style="width: 100%; border-collapse: collapse; text-align: left; background: #fff; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <thead>
                <tr style="background-color: #f4f4f4; border-bottom: 2px solid #ddd;">
                    <th style="padding: 12px; border: 1px solid #ddd;">Дата и время</th>
                    <th style="padding: 12px; border: 1px solid #ddd;">Имя</th>
                    <th style="padding: 12px; border: 1px solid #ddd;">Email</th>
                    <th style="padding: 12px; border: 1px solid #ddd;">Сообщение</th>
                </tr>
                </thead>
                <tbody>
                @foreach($submissions as $item)
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 10px 12px; border: 1px solid #ddd; white-space: nowrap; font-size: 0.9em; color: #555;">
                            {{ $item['submitted_at'] ?? '—' }}
                        </td>
                        <td style="padding: 10px 12px; border: 1px solid #ddd; font-weight: bold;">
                            {{ $item['name'] ?? '—' }}
                        </td>
                        <td style="padding: 10px 12px; border: 1px solid #ddd;">
                            <a href="mailto:{{ $item['email'] ?? '' }}">{{ $item['email'] ?? '—' }}</a>
                        </td>
                        <td style="padding: 10px 12px; border: 1px solid #ddd; word-break: break-word;">
                            {{ $item['message'] ?? '—' }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
