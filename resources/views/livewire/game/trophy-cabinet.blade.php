<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50 p-4 md:p-8">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div
            class="flex flex-col md:flex-row justify-between items-center mb-12 gap-6 bg-white p-8 rounded-[3rem] shadow-xl border-b-8 border-indigo-100">
            <div class="flex items-center gap-6">
                <a href="{{ route('game.map') }}"
                    class="w-16 h-16 bg-indigo-50 hover:bg-indigo-100 flex items-center justify-center rounded-[1.5rem] transition-all group">
                    <span class="text-3xl group-hover:scale-110 transition-transform">🗺️</span>
                </a>
                <div>
                    <h1 class="text-4xl font-black text-indigo-900 uppercase tracking-tight">Cofre de Tesoros</h1>
                    <p class="text-indigo-400 font-bold uppercase text-xs tracking-widest">Colección mística de
                        {{ $player->nickname }}
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-4 bg-indigo-50 px-8 py-4 rounded-3xl border-2 border-indigo-100">
                <div class="text-right">
                    <p class="text-[10px] font-black text-indigo-300 uppercase leading-none">Total Ganados</p>
                    <p class="text-3xl font-black text-indigo-600 leading-none">{{ $player->rewards->count() }}</p>
                </div>
                <span class="text-4xl">🏆</span>
            </div>
        </div>

        <!-- Categorías -->
        <div class="space-y-16">
            @php
                $titles = [
                    'medal' => ['icon' => '🏅', 'title' => 'Mis Medallas', 'desc' => 'Hitos de tu gran esfuerzo musical'],
                    'character' => ['icon' => '🎭', 'title' => 'Amigos Musicales', 'desc' => 'Personajes que se han unido a tu aventura'],
                    'instrument' => ['icon' => '🎻', 'title' => 'Instrumentos Mágicos', 'desc' => 'Objetos legendarios que has encontrado']
                ];
            @endphp

            @foreach($titles as $type => $info)
                @if(isset($rewards[$type]))
                    <section class="animate-fade-in">
                        <div class="flex items-center gap-4 mb-8">
                            <span class="text-5xl drop-shadow-sm">{{ $info['icon'] }}</span>
                            <div>
                                <h2 class="text-3xl font-black text-slate-800">{{ $info['title'] }}</h2>
                                <p class="text-slate-400 font-bold text-sm">{{ $info['desc'] }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                            @foreach($rewards[$type] as $reward)
                                <div class="relative group h-full">
                                    <div
                                        class="bg-white rounded-[2.5rem] p-6 shadow-lg border-2 border-slate-100 transition-all duration-500 {{ $reward['is_earned'] ? 'hover:-translate-y-2 hover:shadow-2xl hover:border-indigo-300' : 'opacity-40 grayscale blur-[1px]' }} h-full flex flex-col">
                                        <!-- Icono/Imagen -->
                                        <div
                                            class="aspect-square bg-slate-50 rounded-[2rem] flex items-center justify-center text-6xl mb-4 relative overflow-hidden">
                                            @if($reward['is_earned'])
                                                <div
                                                    class="absolute inset-0 bg-gradient-to-br from-yellow-100/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                                                </div>
                                                <span
                                                    class="relative transform group-hover:scale-110 transition-transform duration-500">{{ $reward['icon'] }}</span>
                                            @else
                                                <span class="text-slate-300">❓</span>
                                            @endif
                                        </div>

                                        <!-- Info -->
                                        <div class="text-center">
                                            <h3 class="font-black text-slate-800 leading-tight mb-1 text-sm uppercase">
                                                {{ $reward['is_earned'] ? $reward['name'] : '???' }}
                                            </h3>
                                            @if($reward['is_earned'])
                                                <p class="text-[10px] font-bold text-indigo-400 uppercase">
                                                    Ganado el {{ \Carbon\Carbon::parse($reward['earned_at'])->format('d/m/y') }}
                                                </p>
                                            @else
                                                <p class="text-[10px] font-bold text-slate-400 uppercase leading-tight italic">
                                                    {{ $reward['description'] }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>

                                    @if(!$reward['is_earned'])
                                        <div
                                            class="absolute -top-2 -right-2 w-8 h-8 bg-slate-200 rounded-full flex items-center justify-center text-xs shadow-md border-2 border-white">
                                            🔒
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif
            @endforeach
        </div>

        <!-- Footer -->
        <div class="mt-20 text-center pb-12">
            <p class="text-slate-400 font-bold mb-6">¡Sigue tocando para desbloquearlos todos!</p>
            <a href="{{ route('game.map') }}"
                class="inline-flex items-center gap-3 bg-indigo-600 text-white px-10 py-5 rounded-[2rem] font-black text-xl shadow-xl hover:bg-indigo-500 hover:scale-105 transition-all">
                <span>VUELVE AL MAPA</span>
                <span class="text-2xl">✨</span>
            </a>
        </div>
    </div>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.6s ease-out forwards;
        }
    </style>
</div>