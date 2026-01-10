<?php

namespace Database\Seeders;

use App\Models\Reward;
use Illuminate\Database\Seeder;

class RewardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rewards = [
            // Medallas
            ['name' => 'Maestro Principiante', 'description' => 'Completa el nivel 10', 'icon' => '🥇', 'type' => 'medal', 'code' => 'level_10'],
            ['name' => 'Experto en Pentagrama', 'description' => 'Completa el nivel 20', 'icon' => '🏆', 'type' => 'medal', 'code' => 'level_20'],
            ['name' => 'Virtuoso Musical', 'description' => 'Completa el nivel 30', 'icon' => '👑', 'type' => 'medal', 'code' => 'level_30'],
            ['name' => 'Leyenda del Sol', 'description' => 'Completa el mundo de Clave de Sol', 'icon' => '☀️', 'type' => 'medal', 'code' => 'world_sol_complete'],
            ['name' => 'Rey de los Graves', 'description' => 'Completa el mundo de Clave de Fa', 'icon' => '⚓', 'type' => 'medal', 'code' => 'world_fa_complete'],
            
            // Personajes (Avatares)
            ['name' => 'Zorro Astuto', 'description' => 'Desbloqueado por tu talento', 'icon' => '🦊', 'type' => 'character', 'code' => 'char_fox'],
            ['name' => 'Oso Melodioso', 'description' => '¡Qué buen ritmo tienes!', 'icon' => '🐻', 'type' => 'character', 'code' => 'char_bear'],
            ['name' => 'León Rugiente', 'description' => '¡Tu música es poderosa!', 'icon' => '🦁', 'type' => 'character', 'code' => 'char_lion'],
            
            // Instrumentos
            ['name' => 'Piano de Cola', 'description' => 'El rey de los instrumentos', 'icon' => '🎹', 'type' => 'instrument', 'code' => 'inst_piano'],
            ['name' => 'Guitarra Eléctrica', 'description' => '¡A rockear!', 'icon' => '🎸', 'type' => 'instrument', 'code' => 'inst_guitar'],
            ['name' => 'Violín Mágico', 'description' => 'Sonido dulce y elegante', 'icon' => '🎻', 'type' => 'instrument', 'code' => 'inst_violin'],
            ['name' => 'Trompeta Brillante', 'description' => '¡Que suene fuerte!', 'icon' => '🎺', 'type' => 'instrument', 'code' => 'inst_trumpet'],
            ['name' => 'Tambor Alegre', 'description' => 'Marca el compás', 'icon' => '🥁', 'type' => 'instrument', 'code' => 'inst_drum'],
        ];

        foreach ($rewards as $reward) {
            Reward::updateOrCreate(['code' => $reward['code']], $reward);
        }
    }
}
