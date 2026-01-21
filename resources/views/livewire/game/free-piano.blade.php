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
            ], key: 'staff-'.$clef.'-'.($lastNote ?? 'none'))
        </div>
        @if(!$lastNote)
            <div class="text-center mt-2 text-gray-300 font-black italic text-sm">Empieza a tocar... 🎼</div>
        @endif
    </div>



    <!-- El Teclado de Pantalla Completa -->
    <div class="flex-1 flex items-end justify-center w-full px-4 mb-4">
        <div class="w-full bg-gray-900 p-4 md:p-6 rounded-[3rem] shadow-[0_40px_100px_-20px_rgba(0,0,0,0.5)] border-b-[12px] border-gray-950 relative overflow-hidden group">
            
            <div class="absolute top-2 left-1/2 -translate-x-1/2 flex items-center gap-2 opacity-30">
                <div class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-ping"></div>
                <span class="text-[8px] font-black text-white uppercase tracking-[0.4em]">Interactive Audio Surface</span>
            </div>

            <div class="flex justify-center pt-6 overflow-x-auto pb-2 scrollbar-hide">
                @php
                    $pianoKeys = [
                        'F1','G1','A1','B1',
                        'C2','D2','E2','F2','G2','A2','B2',
                        'C3','D3','E3','F3','G3','A3','B3',
                        'C4','D4','E4','F4','G4','A4','B4',
                        'C5','D5','E5','F5','G5','A5','B5',
                        'C6','D6','E6'
                    ];
                @endphp

                <div class="flex relative h-48 md:h-64">
                    @foreach($pianoKeys as $index => $pitch)
                        @php
                            $hasBlack = in_array(substr($pitch, 0, 1), ['C', 'D', 'F', 'G', 'A']);
                        @endphp
                        <button 
                            @click="playNote('{{ $pitch }}')"
                            class="flex-1 min-w-[20px] md:min-w-[35px] bg-white border-r-[1px] border-gray-200 first:rounded-l-2xl last:rounded-r-2xl shadow-inner transition-all hover:bg-gray-50 active:bg-gray-200 relative group"
                        >
                            @if($pitch === 'C4')
                                <div class="absolute bottom-4 left-1/2 -translate-x-1/2 w-3 h-3 bg-blue-400 rounded-full shadow-sm"></div>
                            @endif

                            @if($hasBlack)
                                <div class="absolute top-0 -right-[10px] md:-right-[15px] w-[20px] md:w-[30px] h-28 md:h-40 bg-gray-900 rounded-b-lg z-20 pointer-events-auto hover:bg-black transition-colors shadow-xl"
                                     @click.stop="playNote('{{ substr($pitch, 0, 1) . '#' . substr($pitch, 1) }}')">
                                </div>
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
