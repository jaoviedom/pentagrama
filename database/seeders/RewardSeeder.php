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
            // Medallas Clave de Sol (Brillo/Luz)
            ['name' => 'Aprendiz de Sol', 'description' => 'Nivel 10 en Clave de Sol', 'icon' => '🕯️', 'type' => 'medal', 'code' => 'sol_level_10'],
            ['name' => 'Explorador Estelar', 'description' => 'Nivel 20 en Clave de Sol', 'icon' => '🚀', 'type' => 'medal', 'code' => 'sol_level_20'],
            ['name' => 'Mago Melódico', 'description' => 'Nivel 30 en Clave de Sol', 'icon' => '🪄', 'type' => 'medal', 'code' => 'sol_level_30'],
            ['name' => 'Guardián de la Clave', 'description' => 'Nivel 40 en Clave de Sol', 'icon' => '🛡️', 'type' => 'medal', 'code' => 'sol_level_40'],
            ['name' => 'Maestro del Olimpo', 'description' => 'Nivel 60 en Clave de Sol', 'icon' => '🏛️', 'type' => 'medal', 'code' => 'sol_level_60'],
            ['name' => 'Virtuoso del Piano', 'description' => 'Nivel 70 en Clave de Sol', 'icon' => '🎹', 'type' => 'medal', 'code' => 'sol_level_70'],
            ['name' => 'Gran Maestro de la Luz', 'description' => 'Nivel 80 en Clave de Sol', 'icon' => '✨', 'type' => 'medal', 'code' => 'sol_level_80'],
            ['name' => 'Leyenda del Sol', 'description' => 'Completa el mundo de Clave de Sol', 'icon' => '☀️', 'type' => 'medal', 'code' => 'world_sol_complete'],

            // Medallas Clave de Fa (Profundidades)
            ['name' => 'Rumbo a los Graves', 'description' => 'Nivel 10 en Clave de Fa', 'icon' => '🚣', 'type' => 'medal', 'code' => 'fa_level_10'],
            ['name' => 'Buceador de Notas', 'description' => 'Nivel 20 en Clave de Fa', 'icon' => '🤿', 'type' => 'medal', 'code' => 'fa_level_20'],
            ['name' => 'Capitán del Ritmo', 'description' => 'Nivel 30 en Clave de Fa', 'icon' => '⚓', 'type' => 'medal', 'code' => 'fa_level_30'],
            ['name' => 'Maestro Profundo', 'description' => 'Nivel 40 en Clave de Fa', 'icon' => '🧜', 'type' => 'medal', 'code' => 'fa_level_40'],
            ['name' => 'Titán del Abismo', 'description' => 'Nivel 60 en Clave de Fa', 'icon' => '🔱', 'type' => 'medal', 'code' => 'fa_level_60'],
            ['name' => 'Gran Pianista Bajo', 'description' => 'Nivel 70 en Clave de Fa', 'icon' => '🎼', 'type' => 'medal', 'code' => 'fa_level_70'],
            ['name' => 'Señor de las Profundidades', 'description' => 'Nivel 80 en Clave de Fa', 'icon' => '🐙', 'type' => 'medal', 'code' => 'fa_level_80'],
            ['name' => 'Rey de los Graves', 'description' => 'Completa el mundo de Clave de Fa', 'icon' => '🐋', 'type' => 'medal', 'code' => 'world_fa_complete'],

            // Personajes (Avatares)
            ['name' => 'Zorro Astuto', 'description' => 'Nivel 25 en Clave de Sol', 'icon' => '🦊', 'type' => 'character', 'code' => 'char_fox'],
            ['name' => 'Oso Melodioso', 'description' => 'Nivel 25 en Clave de Fa', 'icon' => '🐻', 'type' => 'character', 'code' => 'char_bear'],
            ['name' => 'León Rugiente', 'description' => 'Nivel 55 en Clave de Fa', 'icon' => '🦁', 'type' => 'character', 'code' => 'char_lion'],

            // Instrumentos
            ['name' => 'Piano de Cola', 'description' => 'Nivel 15 en Clave de Sol', 'icon' => '🎹', 'type' => 'instrument', 'code' => 'inst_piano'],
            ['name' => 'Guitarra Eléctrica', 'description' => 'Nivel 35 en Clave de Sol', 'icon' => '🎸', 'type' => 'instrument', 'code' => 'inst_guitar'],
            ['name' => 'Violín Mágico', 'description' => 'Nivel 55 en Clave de Sol', 'icon' => '🎻', 'type' => 'instrument', 'code' => 'inst_violin'],
            ['name' => 'Trompeta Brillante', 'description' => 'Nivel 35 en Clave de Fa', 'icon' => '🎺', 'type' => 'instrument', 'code' => 'inst_trumpet'],
            ['name' => 'Tambor Alegre', 'description' => 'Nivel 15 en Clave de Fa', 'icon' => '🥁', 'type' => 'instrument', 'code' => 'inst_drum'],
        ];

        foreach ($rewards as $reward) {
            Reward::updateOrCreate(['code' => $reward['code']], $reward);
        }
    }
}
