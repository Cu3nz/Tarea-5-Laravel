<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Fontawesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>@yield('titulo')</title>
</head>

<body style="background-color: silver">
    <!-- NavBar -->
    <nav class="bg-white border-gray-200 dark:bg-gray-900">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul
                    class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        {{-- todo Esta ruta te lleva a la pagina donde se muestran todas las imagenes --}}
                        <a href="{{route('home')}}" class="block py-2 px-3 rounded text-blue-500"
                            aria-current="page"><i class="fas fa-home mr-2"></i>Home
                        </a>
                    </li>
                    <li>
                        <a href="{{route('films.index')}}"
                            class="block py-2 px-3 rounded text-black dark:text-white" aria-current="page">
                            <i class="fas fa-gears mr-2"></i> Gestionar Peliculas
                        </a>
                    </li>
                    <li>
                        <a href="{{route('tags.index')}}"
                            class="block py-2 px-3 rounded text-black dark:text-white" aria-current="page">
                            <i class="fas fa-gears mr-2"></i> Gestionar Tags
                        </a>
                    </li>
                    <li>
                        <a href="{{route('mail.pintar')}}" class="block py-2 px-3 rounded text-black dark:text-white" aria-current="page">
                            <i class="fas fa-envelope mr-2"></i> Contactar
                        </a>
                    </li>
                    
                </ul>
            </div>
        </div>
    </nav>
    <!-- FinNavBar -->
    <h1 class="mt-2 mb-2 text-center text-xl font-bold mt-4">@yield('cabecera')</h1>
    <div class="mx-auto w-3/4 p-8">
        @yield('contenido')
    </div>
    @if (session('mensaje')) <!--Si existe la variable de sesion info-->
    <script>
        Swal.fire({
  icon: "success",
  title: "{{session('mensaje')}}",
  showConfirmButton: false,
  timer: 1500
});
    </script>
    @endif
</body>
</html>