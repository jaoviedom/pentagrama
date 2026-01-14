<x-layouts.app title="Registrarse - Exploradores del Pentagrama">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md">
            <!-- Logo o Título -->
            <div class="text-center mb-8">
                <h1
                    class="text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600 mb-2">
                    🎵 Exploradores del Pentagrama
                </h1>
                <p class="text-gray-600 text-lg">Registro de Guardianes</p>
            </div>

            <!-- Tarjeta de Registro -->
            <div class="bg-white rounded-3xl shadow-2xl p-8 border-4 border-pink-200">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Crea tu cuenta</h2>

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border-2 border-red-300 rounded-xl">
                        <ul class="list-disc list-inside text-red-700 text-sm font-semibold">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <!-- Nombre Completo -->
                    <div>
                        <label for="nombre_completo" class="block text-sm font-bold text-gray-700 mb-1">
                            👋 Nombre Completo
                        </label>
                        <input type="text" id="nombre_completo" name="nombre_completo"
                            value="{{ old('nombre_completo') }}" required autofocus
                            class="w-full px-4 py-2 border-2 border-pink-300 rounded-xl focus:outline-none focus:ring-4 focus:ring-pink-100 focus:border-pink-500 transition-all text-lg"
                            placeholder="Tu nombre">
                    </div>

                    <!-- Username -->
                    <div>
                        <label for="username" class="block text-sm font-bold text-gray-700 mb-1">
                            👤 Usuario
                        </label>
                        <input type="text" id="username" name="username" value="{{ old('username') }}" required
                            class="w-full px-4 py-2 border-2 border-pink-300 rounded-xl focus:outline-none focus:ring-4 focus:ring-pink-100 focus:border-pink-500 transition-all text-lg"
                            placeholder="Nombre de usuario">
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-bold text-gray-700 mb-1">
                            🔒 Contraseña
                        </label>
                        <input type="password" id="password" name="password" required
                            class="w-full px-4 py-2 border-2 border-pink-300 rounded-xl focus:outline-none focus:ring-4 focus:ring-pink-100 focus:border-pink-500 transition-all text-lg"
                            placeholder="Mínimo 8 caracteres">
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-bold text-gray-700 mb-1">
                            ✅ Confirmar Contraseña
                        </label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                            class="w-full px-4 py-2 border-2 border-pink-300 rounded-xl focus:outline-none focus:ring-4 focus:ring-pink-100 focus:border-pink-500 transition-all text-lg"
                            placeholder="Repite tu contraseña">
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-pink-500 to-purple-500 text-white font-bold py-4 px-6 rounded-xl hover:from-pink-600 hover:to-purple-600 transform hover:scale-105 transition-all duration-200 shadow-lg text-lg mt-4">
                        ✨ Registrarse
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-gray-600">
                        ¿Ya tienes cuenta?
                        <a href="{{ route('login') }}" class="text-purple-600 font-bold hover:underline">Inicia sesión
                            aquí</a>
                    </p>
                </div>
            </div>

            <!-- Footer -->
            <p class="text-center text-gray-500 text-sm mt-6">
                ¡Empieza la aventura hoy! 🌟
            </p>
        </div>
    </div>
</x-layouts.app>