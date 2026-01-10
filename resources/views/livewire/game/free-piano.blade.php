<div class="min-h-[700px] bg-[#fdfcf0] rounded-[4rem] p-8 md:p-12 font-['Outfit',sans-serif] flex flex-col items-center"
     x-data="{
        playNote(pitch) {
            if (!pitch) return;
            const url = 'https://gleitz.github.io/midi-js-soundfonts/FluidR3_GM/acoustic_grand_piano-mp3/' + pitch + '.mp3';
            const audio = new Audio(url);
            audio.play().catch(e => console.warn('Audio blocked:', e));
            $wire.playNote(pitch);
        }
     }"
>
    <!-- Encabezado del Piano -->
    <div class="w-full max-w-5xl flex flex-col md:flex-row justify-between items-center mb-12 gap-6">
        <div>
            <h2 class="text-5xl font-black text-gray-800 tracking-tight leading-none">Piano <span class="text-emerald-500">Libre</span> 🎹</h2>
            <p class="text-gray-500 font-bold text-xl mt-2">¡Crea tus propias melodías mágicas!</p>
        </div>
        
        <div class="flex bg-white p-2 rounded-[2rem] shadow-xl border-4 border-white">
            <button wire:click="setClef('sol')" class="px-8 py-3 rounded-2xl font-black transition-all {{ $clef === 'sol' ? 'bg-purple-600 text-white shadow-lg' : 'text-gray-400 hover:text-purple-400' }}">
                𝄞 SOL
            </button>
            <button wire:click="setClef('fa')" class="px-8 py-3 rounded-2xl font-black transition-all {{ $clef === 'fa' ? 'bg-indigo-600 text-white shadow-lg' : 'text-gray-400 hover:text-indigo-400' }}">
                𝄢 FA
            </button>
        </div>
    </div>

    <div class="w-full max-w-6xl grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- El Teclado -->
        <div class="lg:col-span-2 bg-gray-800 p-8 rounded-[3.5rem] shadow-[0_30px_60px_-15px_rgba(0,0,0,0.3)] border-b-[20px] border-gray-900 relative">
            <div class="absolute top-4 left-1/2 -translate-x-1/2 flex items-center gap-2">
                <div class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></div>
                <span class="text-[10px] font-black text-gray-500 uppercase tracking-[0.3em]">Audio Engine Active</span>
            </div>

            <div class="flex justify-center pt-8 overflow-x-auto pb-4 scrollbar-hide">
                @php
                    $keysSol = [
                        ['p' => 'B3', 'l' => 'Si'], ['p' => 'C4', 'l' => 'Do'], ['p' => 'D4', 'l' => 'Re'], 
                        ['p' => 'E4', 'l' => 'Mi'], ['p' => 'F4', 'l' => 'Fa'], ['p' => 'G4', 'l' => 'Sol'], 
                        ['p' => 'A4', 'l' => 'La'], ['p' => 'B4', 'l' => 'Si'], ['p' => 'C5', 'l' => 'Do↑'], 
                        ['p' => 'D5', 'l' => 'Re↑'], ['p' => 'E5', 'l' => 'Mi↑'], ['p' => 'F5', 'l' => 'Fa↑'], 
                        ['p' => 'G5', 'l' => 'Sol↑'], ['p' => 'A5', 'l' => 'La↑'], ['p' => 'B5', 'l' => 'Si↑']
                    ];
                    $keysFa = [
                        ['p' => 'B1', 'l' => 'Si'], ['p' => 'C2', 'l' => 'Do'], ['p' => 'D2', 'l' => 'Re'], 
                        ['p' => 'E2', 'l' => 'Mi'], ['p' => 'F2', 'l' => 'Fa'], ['p' => 'G2', 'l' => 'Sol'], 
                        ['p' => 'A2', 'l' => 'La'], ['p' => 'B2', 'l' => 'Si'], ['p' => 'C3', 'l' => 'Do↑'], 
                        ['p' => 'D3', 'l' => 'Re↑'], ['p' => 'E3', 'l' => 'Mi↑'], ['p' => 'F3', 'l' => 'Fa↑'], 
                        ['p' => 'G3', 'l' => 'Sol↑'], ['p' => 'A3', 'l' => 'La↑'], ['p' => 'B3', 'l' => 'Si↑']
                    ];
                    $currentKeys = $clef === 'sol' ? $keysSol : $keysFa;
                @endphp

                <div class="flex relative">
                    @foreach($currentKeys as $index => $key)
                        <button 
                            @click="playNote('{{ $key['p'] }}')"
                            class="relative w-12 md:w-16 h-64 md:h-80 bg-white border-r-[1px] border-gray-200 first:rounded-l-2xl last:rounded-r-2xl shadow-inner transition-all hover:bg-gray-50 active:translate-y-2 active:shadow-none flex flex-col justify-end items-center pb-8 group"
                        >
                            <span class="text-[10px] md:text-xs font-black text-gray-300 group-hover:text-purple-400 transition-colors uppercase">{{ $key['l'] }}</span>
                            
                            {{-- Teclas Negras: Si empezamos en B(0), hay negras después de 1,2, 4,5,6, 8,9, 11,12,13 --}}
                            @if(in_array($index, [1, 2, 4, 5, 6, 8, 9, 11, 12, 13]))
                                <div class="absolute top-0 -left-4 md:-left-5 w-8 md:w-10 h-40 md:h-48 bg-gray-900 rounded-b-xl shadow-lg z-10 transition-transform hover:scale-x-95"></div>
                            @endif
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Pantalla Visual y Registro -->
        <div class="flex flex-col gap-6">
            <!-- El Pentagrama Dinámico -->
            <div class="bg-white rounded-[3rem] p-4 shadow-xl border-4 border-emerald-50 relative min-h-[300px] flex items-center justify-center overflow-hidden">
                <div class="absolute top-6 left-6 text-xs font-black text-gray-300 uppercase tracking-widest z-10">Vista de Pentagrama</div>
                
                <div class="w-full transform scale-110">
                    @livewire('game.staff-renderer', [
                        'clef' => $clef,
                        'activeNotes' => $lastNote ? [['pitch' => $lastNote, 'highlighted' => true]] : [],
                        'showNames' => true
                    ], key('staff-'.$clef.'-'.($lastNote ?? 'none')))
                </div>

                @if(!$lastNote)
                    <div class="absolute inset-0 flex items-center justify-center bg-white/60 backdrop-blur-[2px] z-20">
                        <div class="text-center text-gray-400 font-bold">
                            <span class="text-4xl block mb-2">🎹</span>
                            Toca una tecla
                        </div>
                    </div>
                @endif
            </div>

            <!-- Historial Musical -->
            <div class="bg-white rounded-[3rem] p-8 shadow-xl border-4 border-purple-50 flex-1 overflow-hidden flex flex-col">
                <div class="flex justify-between items-center mb-6">
                    <span class="text-xs font-black text-gray-300 uppercase tracking-widest">Tus Notas</span>
                    @if(count($history) > 0)
                        <button wire:click="clearHistory" class="text-[10px] font-black text-red-400 hover:text-red-600 transition-colors">LIMPIAR</button>
                    @endif
                </div>

                <div class="flex flex-wrap gap-3 overflow-y-auto max-h-[300px] content-start">
                    @forelse($history as $h)
                        <div class="bg-purple-50 px-4 py-2 rounded-2xl border border-purple-100 flex items-center gap-2 animate-fade-in-up">
                            <span class="text-purple-600 font-black">{{ $h['pitch'] }}</span>
                            <span class="text-[10px] text-purple-300 font-bold">{{ $h['time'] }}</span>
                        </div>
                    @empty
                        <div class="w-full h-full flex items-center justify-center text-gray-300 font-medium">
                            Historial vacío
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <style>
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
        @keyframes fade-in-up {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up { animation: fade-in-up 0.3s ease-out forwards; }
    </style>
</div>
