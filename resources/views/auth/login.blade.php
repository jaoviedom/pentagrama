<x-layouts.app title="Iniciar Sesión - Pentagrama">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md">
            <!-- Logo o Título -->
            <div class="text-center mb-8">
                <h1 class="text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600 mb-2">
                    🎵 Pentagrama
                </h1>
                <p class="text-gray-600 text-lg">App Educativa Infantil</p>
            </div>

            <!-- Tarjeta de Login -->
            <div class="bg-white rounded-3xl shadow-2xl p-8 border-4 border-purple-200">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">¡Bienvenido!</h2>

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border-2 border-red-300 rounded-xl">
                        <p class="text-red-700 text-sm font-semibold">{{ $errors->first() }}</p>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Username -->
                    <div>
                        <label for="username" class="block text-sm font-bold text-gray-700 mb-2">
                            👤 Nombre de Usuario
                        </label>
                        <input 
                            type="text" 
                            id="username" 
                            name="username" 
                            value="{{ old('username') }}"
                            required 
                            autofocus
                            class="w-full px-4 py-3 border-2 border-purple-300 rounded-xl focus:outline-none focus:ring-4 focus:ring-purple-200 focus:border-purple-500 transition-all text-lg"
                            placeholder="Escribe tu usuario"
                        >
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-bold text-gray-700 mb-2">
                            🔒 Contraseña
                        </label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            required
                            class="w-full px-4 py-3 border-2 border-purple-300 rounded-xl focus:outline-none focus:ring-4 focus:ring-purple-200 focus:border-purple-500 transition-all text-lg"
                            placeholder="Escribe tu contraseña"
                        >
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input 
                            type="checkbox" 
                            id="remember" 
                            name="remember"
                            class="w-5 h-5 text-purple-600 border-2 border-purple-300 rounded focus:ring-purple-500"
                        >
                        <label for="remember" class="ml-2 text-sm font-semibold text-gray-700">
                            Recordarme
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit"
                        class="w-full bg-gradient-to-r from-purple-500 to-pink-500 text-white font-bold py-4 px-6 rounded-xl hover:from-purple-600 hover:to-pink-600 transform hover:scale-105 transition-all duration-200 shadow-lg text-lg"
                    >
                        🚀 Entrar
                    </button>
                </form>
            </div>

            <!-- Footer -->
            <p class="text-center text-gray-500 text-sm mt-6">
                Diseñado para el aprendizaje infantil 🌟
            </p>
        </div>
    </div>
</x-layouts.app>
