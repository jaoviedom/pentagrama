<x-layouts.app title="Seleccionar Jugador - Exploradores del Pentagrama">
    <div class="min-h-screen p-8 bg-[#FDFCF0] flex flex-col items-center justify-center font-['Outfit',sans-serif]">
        <!-- Cabecera Amigable -->
        <div class="text-center mb-12 animate-fade-in-down">
            <h1 class="text-5xl font-black text-gray-800 tracking-tight mb-4">¿Quién va a jugar ahora?</h1>
            <p class="text-xl text-gray-500 font-bold">Selecciona tu avatar para continuar la aventura</p>
        </div>

        <div class="max-w-4xl w-full">
            <!-- Selección de Jugador (Componente Livewire centralizado) -->
            <div class="bg-white rounded-[3.5rem] p-4 shadow-2xl border-b-8 border-gray-200">
                @livewire('players.select-player')
            </div>
        </div>

    </div>

    <style>
        @keyframes fade-in-down {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-down { animation: fade-in-down 0.5s ease-out; }
    </style>
</x-layouts.app>
