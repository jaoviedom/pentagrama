<x-layouts.app title="Dashboard - Pentagrama">
    <div class="min-h-screen">
        <!-- Header -->
        <header class="bg-white shadow-lg border-b-4 border-purple-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">
                            🎵 Pentagrama
                        </h1>
                        <p class="text-gray-600 text-sm">¡Hola, {{ auth()->user()->nombre_completo }}!</p>
                    </div>
                    
                    <div class="flex items-center gap-4">
                        <span class="px-4 py-2 bg-purple-100 text-purple-700 rounded-full font-semibold text-sm">
                            {{ ucfirst(auth()->user()->rol) }}
                        </span>
                        
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button 
                                type="submit"
                                class="px-4 py-2 bg-red-500 text-white rounded-xl hover:bg-red-600 transition-colors font-semibold"
                            >
                                Salir
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Columna Izquierda: Perfil -->
                <div class="lg:col-span-1">
                    @livewire('config.user-profile')
                </div>

                <!-- Columna Derecha: Acciones -->
                <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Card 1 -->
                <a href="{{ route('game.map') }}" class="bg-gradient-to-br from-yellow-400 to-orange-500 rounded-3xl p-6 shadow-xl text-white transform hover:scale-105 transition-transform group">
                    <div class="text-5xl mb-4 group-hover:animate-bounce">🗺️</div>
                    <h3 class="text-2xl font-bold mb-2">¡A Jugar!</h3>
                    <p class="text-yellow-100">Explora los mundos musicales</p>
                </a>

                <!-- Card 2 -->
                <a href="{{ route('game.lessons') }}" class="bg-gradient-to-br from-purple-400 to-purple-600 rounded-3xl p-6 shadow-xl text-white transform hover:scale-105 transition-transform group">
                    <div class="text-5xl mb-4 group-hover:rotate-12 transition-transform">📚</div>
                    <h3 class="text-2xl font-bold mb-2">Mis Lecciones</h3>
                    <p class="text-purple-100">Aprende cosas nuevas cada día</p>
                </a>

                    <!-- Card 3 -->
                    <a href="{{ route('game.trophies') }}" class="bg-gradient-to-br from-blue-400 to-blue-600 rounded-3xl p-6 shadow-xl text-white transform hover:scale-105 transition-transform group">
                        <div class="text-5xl mb-4 group-hover:rotate-12 transition-transform">⭐</div>
                        <h3 class="text-2xl font-bold mb-2">Mis Logros</h3>
                        <p class="text-blue-100">Mira todo lo que has conseguido</p>
                    </a>

                    <!-- Card 4 -->
                    <div class="bg-gradient-to-br from-green-400 to-green-600 rounded-3xl p-6 shadow-xl text-white transform hover:scale-105 transition-transform">
                        <div class="text-5xl mb-4">👥</div>
                        <h3 class="text-2xl font-bold mb-2">Amigos</h3>
                        <p class="text-green-100">Aprende con tus compañeros</p>
                    </div>
                </div>
            </div>

            <!-- Sección de Seguimiento Pedagógico (Analytics) -->
            <div class="mt-12">
                @livewire('teacher.analytics-dashboard')
            </div>
        </main>
    </div>
</x-layouts.app>
