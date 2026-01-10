<div class="min-h-screen bg-[#FDFCF0] p-4 md:p-8 font-['Outfit',sans-serif]">
    <div class="max-w-5xl mx-auto">
        <!-- Header - El Álbum -->
        <div class="bg-white rounded-[3rem] p-8 mb-12 shadow-[0_20px_0_0_#E5E7EB] border-4 border-gray-200 relative overflow-hidden">
            <!-- Patrón de fondo tipo hoja de álbum -->
            <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#000 1px, transparent 1px); background-size: 20px 20px;"></div>
            
            <div class="relative flex flex-col md:flex-row items-center gap-10">
                <!-- Avatar Sticker -->
                <div class="relative group">
                    <div class="w-48 h-48 bg-white p-4 rounded-3xl shadow-xl border-4 border-dashed border-purple-300 transform -rotate-3 group-hover:rotate-0 transition-transform duration-500">
                        <div class="w-full h-full bg-gradient-to-br from-purple-100 to-pink-100 rounded-2xl flex items-center justify-center text-8xl">
                            {{ $player->avatar }}
                        </div>
                    </div>
                    <div class="absolute -bottom-4 -right-4 bg-yellow-400 text-purple-900 font-black px-6 py-2 rounded-full shadow-lg border-2 border-white transform rotate-6">
                        ¡Hola, {{ $player->nickname }}!
                    </div>
                </div>

                <!-- Stats Stickers -->
                <div class="flex-1 grid grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Sticker: Estrellas -->
                    <div class="bg-white p-4 rounded-2xl shadow-md border-2 border-gray-100 transform rotate-2 hover:rotate-0 transition-transform">
                        <span class="text-3xl block mb-1">⭐</span>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Estrellas</p>
                        <p class="text-2xl font-black text-yellow-500">{{ $stats['total_stars'] }}</p>
                    </div>

                    <!-- Sticker: Mundos -->
                    <div class="bg-white p-4 rounded-2xl shadow-md border-2 border-gray-100 transform -rotate-2 hover:rotate-0 transition-transform">
                        <span class="text-3xl block mb-1">🗺️</span>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Mundos</p>
                        <p class="text-2xl font-black text-green-500">{{ $stats['completed_worlds'] }}</p>
                    </div>

                    <!-- Sticker: Niveles -->
                    <div class="bg-white p-4 rounded-2xl shadow-md border-2 border-gray-100 transform rotate-1 hover:rotate-0 transition-transform">
                        <span class="text-3xl block mb-1">🎹</span>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Niveles</p>
                        <p class="text-2xl font-black text-purple-500">{{ $stats['total_levels'] }}</p>
                    </div>

                    <!-- Sticker: Puntos -->
                    <div class="bg-white p-4 rounded-2xl shadow-md border-2 border-gray-100 transform -rotate-3 hover:rotate-0 transition-transform">
                        <span class="text-3xl block mb-1">✨</span>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Puntos</p>
                        <p class="text-2xl font-black text-blue-500">{{ $stats['points'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Sección: Álbum de Medallas -->
            <div class="lg:col-span-2">
                <div class="flex items-center gap-4 mb-8">
                    <h2 class="text-3xl font-black text-gray-700 uppercase tracking-tight">Mi Álbum de Medallas</h2>
                    <div class="h-1 flex-1 bg-gray-200 rounded-full"></div>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 gap-8">
                    @foreach($allMedals as $medal)
                        @php
                            $earned = $medals->where('code', $medal->code)->first();
                        @endphp
                        <div class="relative group">
                            <div class="aspect-square bg-white rounded-3xl p-6 shadow-lg border-4 border-white transition-all duration-500 {{ $earned ? 'transform hover:scale-110 hover:rotate-3 shadow-xl' : 'opacity-20 grayscale border-dashed border-gray-300' }}">
                                <div class="w-full h-full rounded-2xl flex flex-col items-center justify-center border-2 border-gray-50 bg-gray-50/50">
                                    <span class="text-5xl mb-2">{{ $medal->icon }}</span>
                                    <span class="text-[10px] font-black text-center text-gray-500 uppercase">{{ $medal->name }}</span>
                                </div>
                            </div>
                            @if(!$earned)
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                    <span class="bg-gray-800 text-white text-[10px] px-3 py-1 rounded-full font-bold">BLOQUEADO 🔒</span>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Sección: Stickers Recientes -->
            <div class="lg:col-span-1">
                <div class="flex items-center gap-4 mb-8">
                    <h2 class="text-3xl font-black text-gray-700 uppercase tracking-tight">Últimos Pegados</h2>
                </div>

                <div class="bg-white rounded-[2.5rem] p-8 shadow-xl border-4 border-gray-100 min-h-[400px]">
                    <div class="space-y-6">
                        @forelse($recentRewards as $reward)
                            <div class="flex items-center gap-4 p-4 rounded-2xl bg-gray-50 border-2 border-white shadow-sm transform hover:-translate-x-2 transition-transform cursor-pointer">
                                <div class="w-16 h-16 bg-white rounded-xl flex items-center justify-center text-3xl shadow-sm border-2 border-gray-100">
                                    {{ $reward->icon }}
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-black text-gray-700 text-sm uppercase">{{ $reward->name }}</h4>
                                    <p class="text-[10px] text-purple-400 font-bold uppercase tracking-wider">¡Lo encontraste!</p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-20">
                                <span class="text-6xl mb-4 block">🔍</span>
                                <p class="text-gray-400 font-bold uppercase text-xs">El álbum está vacío...<br>¡Empieza a jugar!</p>
                            </div>
                        @endforelse
                    </div>

                    @if($recentRewards->count() > 0)
                        <div class="mt-8 text-center">
                            <a href="{{ route('game.trophies') }}" class="text-purple-500 font-black uppercase text-xs tracking-widest hover:text-purple-600 transition-colors">
                                Ver todo mi álbum →
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Botón Volver -->
        <div class="mt-16 text-center">
            <a href="{{ route('game.map') }}" class="bg-purple-600 text-white px-12 py-5 rounded-[2rem] font-black text-xl shadow-[0_10px_0_0_#4C1D95] hover:translate-y-1 hover:shadow-[0_6px_0_0_#4C1D95] transition-all inline-flex items-center gap-4">
                <span>VOLVER A LA AVENTURA</span>
                <span class="text-2xl">🗺️</span>
            </a>
        </div>
    </div>
</div>
