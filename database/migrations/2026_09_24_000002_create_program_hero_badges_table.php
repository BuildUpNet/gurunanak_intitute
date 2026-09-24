<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('program_hero_badges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_detail_id')->constrained()->cascadeOnDelete();
            $table->string('icon')->nullable();
            $table->string('text');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Backfill: turn every program's existing 3 hero chips (level / duration / locations) into editable rows
        $now = now();
        foreach (DB::table('program_details')->get(['id', 'level', 'duration', 'locations']) as $program) {
            $chips = [
                ['fas fa-layer-group',    $program->level],
                ['fas fa-clock',          $program->duration],
                ['fas fa-map-marker-alt', $program->locations],
            ];
            $order = 0;
            foreach ($chips as [$icon, $text]) {
                $text = trim(html_entity_decode(strip_tags((string) $text)));
                if ($text === '') {
                    continue;
                }
                DB::table('program_hero_badges')->insert([
                    'program_detail_id' => $program->id,
                    'icon'              => $icon,
                    'text'              => $text,
                    'sort_order'        => $order++,
                    'created_at'        => $now,
                    'updated_at'        => $now,
                ]);
            }
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('program_hero_badges');
    }
};
