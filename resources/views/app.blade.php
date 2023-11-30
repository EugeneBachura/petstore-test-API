<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@hasSection ('title')
            @yield('title')
        @else
            {{ config('app.name') }}
        @endif</title>

        <style>
             table {
                margin: auto;
                text-align: center;
                border-collapse: collapse;
            }

            td {
                border: 1px solid #333;
                height: auto;
                max-width: 100%;
                word-break: break-word;
            }
            table tr td.td2:last-child {
                word-break: break-word;
            }
        </style>

    </head>
    <body style="margin: 0; padding: 0;">
        <div>
            @include('navigation')
            @if(session('success'))
                <h2 style="color: green; margin: 15px;">
                    {{ session('success') }}
                </h2>
            @endif
            @if($errors->any())
                <h2 style="color: red; margin: 15px;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </h2>
            @endif
            {{-- Page Content --}}
            <main style="padding: 15px">
                @hasSection('content')
                    @yield('content')
                @endif
            </main>
        </div>
        @stack('scripts')
    </body>
</html>