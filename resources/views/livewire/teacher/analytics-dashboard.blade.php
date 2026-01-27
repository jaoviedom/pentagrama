<div
    class="bg-gray-50 min-h-[600px] p-6 lg:p-10 rounded-[2.5rem] border border-gray-200 shadow-sm font-['Outfit',sans-serif]">
    <!-- Encabezado del Panel -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
        <div>
            <h2 class="text-3xl font-bold text-gray-800 tracking-tight">Seguimiento Pedagógico</h2>
            <p class="text-gray-500 font-medium">Análisis detallado del progreso de tus alumnos</p>
        </div>
        <div class="flex flex-col gap-3">
            @if (session()->has('success'))
                <div
                    class="bg-green-100 border border-green-200 text-green-700 px-6 py-3 rounded-2xl font-bold animate-fade-in">
                    {{ session('success') }}
                </div>
            @endif
            <div class="bg-white px-5 py-3 rounded-2xl shadow-sm border border-gray-100 ml-auto">
                <span class="text-xs font-black text-gray-400 uppercase block leading-none mb-1">Total Jugadores</span>
                <span class="text-2xl font-bold text-purple-600">{{ count($playersData) }}</span>
            </div>
        </div>
    </div>

    <!-- Lista de Estudiantes -->
    <div class="space-y-8">
        @forelse($playersData as $data)
            <div class="bg-white rounded-[2rem] p-8 border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex flex-col lg:flex-row gap-10">
                    <!-- Información Básica y Tiempo -->
                    <div class="lg:w-1/4">
                        <div class="flex items-center gap-4 mb-4">
                            <div
                                class="w-16 h-16 bg-purple-50 rounded-2xl flex items-center justify-center text-4xl border border-purple-100">
                                {{ $data['player']->avatar }}
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">{{ $data['player']->nickname }}</h3>
                                <p class="text-sm text-gray-400 font-semibold uppercase">{{ $data['usage_time'] }} min
                                    jugados</p>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="text-[11px] font-black text-gray-400 uppercase tracking-widest">Última actividad
                            </div>
                            <div class="text-sm text-gray-600 font-medium">
                                {{ $data['player']->updated_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>

                    <!-- Progreso en Mundos -->
                    <div class="flex-1 space-y-6">
                        <div class="text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2">Progreso por Mundo
                        </div>

                        <!-- Barra Clave de Sol -->
                        <div class="space-y-1 group/row">
                            <div class="flex justify-between items-center text-sm font-bold">
                                <span class="text-purple-600">Clave de Sol</span>
                                <div class="flex items-center gap-3">
                                    <span class="text-gray-500">Nivel {{ $data['progress']['sol'] }}/80</span>
                                    <button 
                                        wire:click="confirmReset({{ $data['player']->id }}, '{{ $data['player']->nickname }}', 'sol')"
                                        class="opacity-0 group-hover/row:opacity-100 text-red-400 hover:text-red-600 transition-all text-[10px] uppercase font-black"
                                    >
                                        [Reiniciar]
                                    </button>
                                </div>
                            </div>
                            <div class="h-3 w-full bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-purple-500 rounded-full transition-all duration-1000"
                                    style="width: {{ ($data['progress']['sol'] / 80) * 100 }}%"></div>
                            </div>
                        </div>

                        <!-- Barra Clave de Fa -->
                        <div class="space-y-1 group/row">
                            <div class="flex justify-between items-center text-sm font-bold">
                                <span class="text-blue-600">Clave de Fa</span>
                                <div class="flex items-center gap-3">
                                    <span class="text-gray-500">Nivel {{ $data['progress']['fa'] }}/80</span>
                                    <button 
                                        wire:click="confirmReset({{ $data['player']->id }}, '{{ $data['player']->nickname }}', 'fa')"
                                        class="opacity-0 group-hover/row:opacity-100 text-red-400 hover:text-red-600 transition-all text-[10px] uppercase font-black"
                                    >
                                        [Reiniciar]
                                    </button>
                                </div>
                            </div>
                            <div class="h-3 w-full bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-blue-500 rounded-full transition-all duration-1000"
                                    style="width: {{ ($data['progress']['fa'] / 80) * 100 }}%"></div>
                            </div>
                        </div>

                        <!-- Minijuegos -->
                        <div class="grid grid-cols-1 mt-4">
                            <div class="bg-cyan-50 p-4 rounded-2xl border border-cyan-100">
                                <span class="text-[10px] font-black text-cyan-600 uppercase block mb-1">Velocidad
                                    (Record)</span>
                                <div class="flex items-center gap-2">
                                    <span class="text-xl">⚡</span>
                                    <span class="text-lg font-black text-cyan-700">{{ $data['minigames']['speed_record'] }}
                                        pts</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Alertas Pedagógicas: Notas más falladas -->
                    <div class="lg:w-1/3 bg-gray-50 rounded-2xl p-6 border border-gray-100">
                        <div class="flex items-center gap-2 mb-4 text-orange-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="text-xs font-black uppercase tracking-widest">Dificultades detectadas</span>
                        </div>

                        @if(count($data['top_failed']) > 0)
                            <div class="flex flex-wrap gap-2">
                                @foreach($data['top_failed'] as $pitch => $count)
                                    <div
                                        class="bg-white px-4 py-2 rounded-xl border border-orange-100 flex items-center gap-2 shadow-sm">
                                        <span
                                            class="font-bold text-gray-700">{{ $noteNames[substr($pitch, 0, 1)] ?? $pitch }}{{ substr($pitch, 1) }}</span>
                                        <span
                                            class="w-5 h-5 bg-orange-100 text-orange-600 text-[10px] font-black rounded-full flex items-center justify-center">{{ $count }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-sm text-green-600 font-bold italic">¡Excelente puntería! Sin errores notables aún.
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-20 bg-white rounded-[2rem] border border-dashed border-gray-200">
                <div class="text-6xl mb-4 text-gray-200">👤</div>
                <h3 class="text-xl font-bold text-gray-400">Aún no hay jugadores vinculados</h3>
                <p class="text-gray-300">Crea tu primer perfil de jugador para ver las métricas.</p>
            </div>
        @endforelse
    </div>

    <!-- Modal de Confirmación Premium -->
    @if($confirmingReset)
        <div class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-purple-900/60 backdrop-blur-md animate-fade-in">
            <div class="bg-white max-w-sm w-full rounded-[3rem] p-10 text-center shadow-2xl relative overflow-hidden border-b-8 border-gray-100">
                <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-red-500 to-orange-500"></div>
                
                <div class="text-6xl mb-6 animate-bounce-short">⚠️</div>
                
                <h2 class="text-2xl font-black text-gray-800 mb-4 leading-tight">
                    ¿Reiniciar <span class="text-red-500 capitalize">{{ $worldToReset }}</span>?
                </h2>
                
                <p class="text-gray-500 mb-8 font-medium leading-relaxed">
                    Estás a punto de borrar el progreso de <span class="font-bold text-gray-700">{{ $playerToResetNickname }}</span> en este mundo. 
                    <br><span class="text-xs text-red-400 font-bold uppercase tracking-widest">¡Esta acción no se puede deshacer!</span>
                </p>

                <div class="flex flex-col gap-3">
                    <button wire:click="resetProgress" 
                        class="w-full px-6 py-4 bg-gradient-to-r from-red-500 to-orange-500 text-white rounded-3xl font-black shadow-lg hover:shadow-red-200 transition-all active:scale-95 shadow-red-100">
                        SÍ, REINICIAR TODO 🔥
                    </button>
                    <button wire:click="cancelReset" 
                        class="w-full px-6 py-4 bg-gray-100 text-gray-500 rounded-3xl font-black hover:bg-gray-200 transition-all active:scale-95">
                        MANTENER PROGRESO
                    </button>
                </div>
            </div>
        </div>
    @endif

    <style>
        @keyframes bounce-short {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .animate-bounce-short {
            animation: bounce-short 2s ease-in-out infinite;
        }
        .animate-fade-in {
            animation: fadeIn 0.3s ease-out forwards;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }
    </style>
</div>