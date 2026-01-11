<x-layouts.app title="Guardianes - Exploradores del Pentagrama">
    <div class="min-h-screen bg-gradient-to-br from-indigo-100 via-purple-50 to-pink-100">
        <!-- Header Principal -->
        <header class="bg-white/70 backdrop-blur-md sticky top-0 z-40 border-b-4 border-purple-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-gradient-to-tr from-purple-600 to-pink-500 rounded-2xl flex items-center justify-center text-3xl shadow-lg border-b-4 border-purple-800">
                            🎵
                        </div>
                        <div>
                            <h1 class="text-3xl font-black text-gray-800 tracking-tight">
                                Centro de Guardianes
                            </h1>
                            <p class="text-purple-600 font-bold text-sm flex items-center gap-2">
                                <span class="flex h-2 w-2 relative">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-purple-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-purple-500"></span>
                                </span>
                                PANEL DE CONTROL ACTIVO
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-6">
                        <div class="text-right hidden sm:block">
                            <p class="text-gray-400 text-xs font-black uppercase tracking-widest">Registrado como</p>
                            <p class="text-gray-800 font-bold">{{ auth()->user()->nombre_completo }}</p>
                        </div>
                        
                        <div class="h-10 w-px bg-gray-200"></div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="bg-white hover:bg-red-50 text-red-500 px-6 py-3 rounded-2xl font-black shadow-sm hover:shadow-md transition-all border-2 border-red-100 flex items-center gap-2 group">
                                <span class="group-hover:scale-110 transition-transform">🔒</span> Salir
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- Contenido Principal -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
                
                <!-- Columna Izquierda: Perfil y Stats Rápidos -->
                <div class="lg:col-span-1 space-y-8">
                    @livewire('config.user-profile')
                </div>

                <!-- Columna Derecha: Gestión de Exploradores -->
                <div class="lg:col-span-3">
                    @livewire('guardian.explorer-management')
                    
                    <!-- Sección de Analytics (Omitida por ahora o movida abajo) -->
                    <div class="mt-16">
                        <div class="mb-8">
                            <h2 class="text-2xl font-black text-gray-800 flex items-center gap-3">
                                📊 Resumen de Actividad
                            </h2>
                        </div>
                        @livewire('teacher.analytics-dashboard')
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-layouts.app>

