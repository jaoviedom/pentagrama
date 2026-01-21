<div class="h-screen bg-[#fdfcf0] font-['Outfit',sans-serif] flex flex-col p-4 md:p-8 overflow-hidden relative"
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
    <!-- Decoración de Fondo -->
    <div class="fixed top-20 -left-20 w-80 h-80 bg-purple-200/30 rounded-full blur-3xl -z-10 animate-pulse"></div>

    <!-- Barra de Herramientas y Control (Flotante Superior Izquierda) -->
    <div class="absolute top-8 left-8 z-30 flex flex-col gap-4">
        <a href="{{ route('game.lessons') }}" class="w-16 h-16 bg-white hover:bg-gray-50 text-gray-600 rounded-[1.5rem] shadow-xl border-b-8 border-gray-200 active:border-b-0 active:translate-y-1 transition-all flex items-center justify-center text-3xl">
            🏠
        </a>
        <div class="bg-white p-2 rounded-[2rem] shadow-2xl border-4 border-white flex flex-col gap-2">
            <button wire:click="setClef('sol')" class="px-6 py-3 rounded-2xl font-black transition-all {{ $clef === 'sol' ? 'bg-purple-600 text-white shadow-lg' : 'text-gray-400 hover:text-purple-400' }}">
                𝄞
            </button>
            <button wire:click="setClef('fa')" class="px-6 py-3 rounded-2xl font-black transition-all {{ $clef === 'fa' ? 'bg-indigo-600 text-white shadow-lg' : 'text-gray-400 hover:text-indigo-400' }}">
                𝄢
            </button>
        </div>
    </div>

    <!-- Título Flotante -->
    <div class="absolute top-10 left-32 z-30 hidden md:block">
        <h2 class="text-4xl font-black text-gray-800 tracking-tight leading-none mb-1">Piano <span class="text-emerald-500">Libre</span></h2>
        <p class="text-gray-400 font-bold text-sm tracking-widest uppercase">¡Toca tu imaginación!</p>
    </div>

    <!-- El Pentagrama Dinámico (Flotante Superior Derecha) -->
    <div class="absolute top-8 right-8 z-30 w-[350px] md:w-[600px] bg-white/40 backdrop-blur-2xl rounded-[3.5rem] p-8 shadow-[0_50px_100px_-20px_rgba(0,0,0,0.2)] border-4 border-white overflow-hidden transition-all duration-500">
        <div class="absolute top-4 left-10 text-xs font-black text-gray-300 uppercase tracking-[0.3em] z-10">Escucha y Observa</div>
        <div class="transform scale-110 md:scale-125 origin-center mt-4">
            @livewire('game.staff-renderer', [
                'clef' => $clef,
                'activeNotes' => $lastNote ? [['pitch' => $lastNote, 'highlighted' => true]] : [],
                'showNames' => true,
                'minimal' => true
            ], key('staff-'.$clef.'-'.($lastNote ?? 'none')))
        </div>
        @if(!$lastNote)
            <div class="text-center mt-2 text-gray-300 font-black italic text-sm">Empieza a tocar... 🎼</div>
        @endif
    </div>



    <!-- El Teclado de Pantalla Completa -->
    <div class="flex-1 flex items-end justify-center w-full px-4 mb-4">
        <div class="w-full bg-gray-800 p-6 md:p-10 rounded-[4rem] shadow-[0_40px_100px_-20px_rgba(0,0,0,0.5)] border-b-[24px] border-gray-900 relative overflow-hidden group">
            
            <div class="absolute top-6 left-1/2 -translate-x-1/2 flex items-center gap-3 opacity-30">
                <div class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></div>
                <span class="text-[10px] font-black text-white uppercase tracking-[0.5em]">Interactive Audio Surface</span>
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

                <div class="flex relative w-full h-[400px] md:h-[500px]">
                    @foreach($currentKeys as $index => $key)
                        <button 
                            @click="playNote('{{ $key['p'] }}')"
                            class="flex-1 min-w-[50px] md:min-w-[65px] bg-white border-r-[1px] border-gray-100 first:rounded-l-3xl last:rounded-r-3xl shadow-inner transition-all hover:bg-gray-50 active:translate-y-4 active:shadow-none flex flex-col justify-end items-center pb-12 group/key relative"
                        >
                            
                            {{-- Teclas Negras: Si empezamos en B(0), NO hay negra entre B(0) y C(1) --}}
                            {{-- Las negras están: C-D(idx2), D-E(idx3), F-G(idx5), G-A(idx6), A-B(idx7), C-D(idx9), D-E(idx10), F-G(idx12), G-A(idx13), A-B(idx14) --}}
                            @if(in_array($index, [2, 3, 5, 6, 7, 9, 10, 12, 13, 14]))
                                <div class="absolute top-0 -left-[20px] md:-left-[25px] w-[40px] md:w-[50px] h-48 md:h-64 bg-gray-900 rounded-b-2xl shadow-2xl z-20 transition-all hover:scale-x-95 active:bg-gray-700"></div>
                            @endif
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <style>
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</div>
