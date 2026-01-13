<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Exploradores del Pentagrama - Aventura Musical</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;700;900&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-sky-50 font-['Outfit',sans-serif] min-h-screen flex items-center justify-center p-4 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-purple-100/50 via-transparent to-orange-50/50 overflow-hidden">
        
        <main class="max-w-5xl w-full flex flex-col justify-center py-2">
            <!-- Título Hero con Logo -->
            <div class="text-center mb-10 animate-fade-in-down flex flex-col items-center">
                <img src="{{ asset('images/logo.png') }}" alt="Exploradores del Pentagrama" class="h-40 md:h-64 object-contain mb-4 drop-shadow-2xl">
                <p class="text-xl md:text-2xl text-gray-500 font-bold max-w-2xl mx-auto">
                    La aventura musical donde tú eres el maestro.
                </p>
            </div>

            <!-- Opciones de Entrada -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 px-4">
                <!-- Entrada Niños (Aventureros) -->
                <a href="{{ route('game.player-login') }}" 
                    class="group relative bg-gradient-to-br from-purple-600 to-indigo-700 p-1.5 rounded-[3.5rem] shadow-2xl transform hover:scale-105 transition-all duration-300">
                    <div class="bg-white rounded-[3.3rem] p-8 md:p-10 h-full flex flex-col items-center text-center group-hover:bg-transparent transition-colors">
                        <div class="text-8xl mb-6 transform group-hover:animate-bounce transition-transform duration-500">🎨</div>
                        <h3 class="text-3xl font-black mb-2 group-hover:text-white uppercase tracking-tight">¡A Jugar!</h3>
                        <p class="text-lg text-gray-500 group-hover:text-white/80 font-bold mb-6 leading-snug">
                            Entra a tu mundo musical y gana estrellas.
                        </p>
                        <div class="mt-auto bg-purple-600 text-white px-8 py-3 rounded-[2rem] font-black text-xl group-hover:bg-white group-hover:text-purple-600 transition-all shadow-lg uppercase tracking-wider">
                            Empezar 🚀
                        </div>
                    </div>
                </a>

                <!-- Entrada Padres/Profesores (Guardianes) -->
                <a href="{{ route('login') }}" 
                    class="group relative bg-gradient-to-br from-blue-500 to-emerald-600 p-1.5 rounded-[3.5rem] shadow-2xl transform hover:scale-105 transition-all duration-300">
                    <div class="bg-white rounded-[3.3rem] p-8 md:p-10 h-full flex flex-col items-center text-center group-hover:bg-transparent transition-colors">
                        <div class="text-8xl mb-6 transform group-hover:rotate-12 transition-transform duration-500">🔑</div>
                        <h3 class="text-3xl font-black mb-2 group-hover:text-white uppercase tracking-tight">Guardianes</h3>
                        <p class="text-lg text-gray-500 group-hover:text-white/80 font-bold mb-6 leading-snug">
                            Gestiona alumnos y sigue su progreso.
                        </p>
                        <div class="mt-auto bg-blue-600 text-white px-8 py-3 rounded-[2rem] font-black text-xl group-hover:bg-white group-hover:text-blue-600 transition-all shadow-lg uppercase tracking-wider">
                            Entrar 🔒
                        </div>
                    </div>
                </a>
            </div>

            <!-- Footer Decorativo -->
            <div class="mt-10 text-center opacity-20 select-none">
                <span class="text-3xl">🎵 🎹 🎼 </span>
            </div>
        </main>

        <style>
            @keyframes fade-in-down {
                from { opacity: 0; transform: translateY(-30px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .animate-fade-in-down { animation: fade-in-down 0.8s ease-out forwards; }
        </style>
    </body>
</html>
