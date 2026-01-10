<div class="relative p-8 bg-white rounded-[3rem] shadow-xl border-4 border-purple-100 overflow-hidden">
    <svg viewBox="0 -40 600 200" class="w-full h-auto drop-shadow-sm">
        {{-- Estilos de Animación --}}
        <defs>
            <filter id="glow" x="-50%" y="-50%" width="200%" height="200%">
                <feGaussianBlur stdDeviation="3" result="blur" />
                <feComposite in="SourceGraphic" in2="blur" operator="over" />
            </filter>
        </defs>

        {{-- Clave Musical (Posicionamiento Técnico Real) --}}
        @if($clef === 'sol')
            {{-- Centrada en la 2da línea del pentagrama (Sol) --}}
            <text x="10" y="88" style="font-size: 150px;" class="fill-purple-300 font-serif select-none pointer-events-none">𝄞</text>
        @else
            {{-- Centrada en la 4ta línea del pentagrama (Fa) --}}
            <text x="10" y="55" style="font-size: 125px;" class="fill-purple-300 font-serif select-none pointer-events-none">𝄢</text>
        @endif

        {{-- Líneas Principales del Pentagrama --}}
        <g stroke="currentColor" stroke-width="2" class="text-purple-300">
            @for ($i = 0; $i < 5; $i++)
                <line x1="10" y1="{{ $i * 20 }}" x2="550" y2="{{ $i * 20 }}" />
            @endfor
        </g>

        {{-- Líneas Adicionales (Siempre visibles según requerimiento) --}}
        <g stroke="currentColor" stroke-width="1.5" stroke-dasharray="4 4" class="text-purple-100 italic">
            <line x1="10" y1="-20" x2="550" y2="-20" /> {{-- Arriba 1 --}}
            <line x1="10" y1="100" x2="550" y2="100" /> {{-- Abajo 1 --}}
            <line x1="10" y1="120" x2="550" y2="120" /> {{-- Abajo 2 --}}
        </g>

        {{-- Zonas de Clic para el modo Interactivo (Solo si $interactive es true) --}}
        @if($interactive)
            @foreach($this->getMapping() as $pitch => $p)
                @php $yPos = 80 - ($p * 10); @endphp
                <rect x="0" y="{{ $yPos - 10 }}" width="600" height="20" 
                      class="fill-transparent hover:fill-blue-500/10 cursor-pointer transition-colors"
                      wire:click="emitNoteClick('{{ $pitch }}')" />
            @endforeach
        @endif

        {{-- Renderizado de Notas --}}
        @foreach ($activeNotes as $index => $note)
            @if(!$note) @continue @endif
            @php
                $pos = $this->getNotePosition($note['pitch']);
                $y = 80 - ($pos * 10);
                $x = 100 + ($index * 60);
            @endphp

            <g class="transition-all duration-500 ease-out animate-appear" 
               style="animation-delay: {{ $index * 0.2 }}s">
                
                {{-- Línea adicional corta (si la nota la requiere) --}}
                @if ($pos <= -2 || $pos >= 10)
                    <line x1="{{ $x - 15 }}" y1="{{ $y }}" x2="{{ $x + 15 }}" y2="{{ $y }}" 
                          stroke="currentColor" stroke-width="2" class="text-purple-600" />
                @endif

                {{-- Cabeza de la Nota (Solo si no está oculta) --}}
                @if(!($note['hidden'] ?? false))
                    <ellipse cx="{{ $x }}" cy="{{ $y }}" rx="8" ry="6"
                             transform="rotate(-20 {{ $x }} {{ $y }})"
                             class="{{ $note['highlighted'] ? 'text-yellow-400 fill-current' : 'text-purple-600 fill-current' }} transition-colors duration-300"
                             @if($note['highlighted']) filter="url(#glow)" @endif
                    />

                    {{-- Plica (Stem) --}}
                    <line x1="{{ $x + 7 }}" y1="{{ $y }}" x2="{{ $x + 7 }}" y2="{{ $y - 35 }}" 
                          stroke="currentColor" stroke-width="1.5" class="text-purple-600" />
                @endif
                
                {{-- Etiqueta de la nota (Para aprendizaje) --}}
                @if($showNames)
                    <text x="{{ $x }}" y="{{ $y + 25 }}" text-anchor="middle" 
                        class="text-[10px] font-black {{ $note['highlighted'] ? 'text-yellow-600' : 'text-purple-300' }} fill-current uppercase">
                        {{ $this->getNoteName($note['pitch']) }}
                    </text>
                @endif
            </g>
        @endforeach
    </svg>

    {{-- Feedback Visual Inferior --}}
    <div class="mt-4 flex justify-center gap-2">
        @foreach($activeNotes as $index => $note)
            <div class="w-3 h-3 rounded-full transition-all duration-300 {{ $note['highlighted'] ? 'bg-yellow-400 scale-125 shadow-lg' : 'bg-purple-100' }}"></div>
        @endforeach
    </div>

    <style>
        @keyframes appear {
            from { opacity: 0; transform: scale(0.5) translateY(10px); }
            to { opacity: 1; transform: scale(1) translateY(0); }
        }
        .animate-appear {
            animation: appear 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) both;
        }
    </style>
</div>
