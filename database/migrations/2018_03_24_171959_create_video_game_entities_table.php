<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoGameEntitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_game_entity', function (Blueprint $table) {
            $table->increments('entity_id');
            $table->string('sku');
            $table->timestamps();
        });

        $nesLibraryCsv = public_path('docs/collection.csv');

        if (file_exists($nesLibraryCsv)) {
            $lines = file_get_contents($nesLibraryCsv);
            $lines = explode(PHP_EOL, $lines);
            array_shift($lines);

            foreach ($lines as $line) {
                $line = str_getcsv($line);

                if ($line[0] == '') {
                    continue;
                }
                $sku = strtolower(str_replace(' ', '-', $line[0]));
                $sku = preg_replace('/[^A-Za-z0-9\-]/', '', $sku);

                DB::table('video_game_entity')->insert([
                    'sku' => trim($sku),
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => null
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('video_game_entity');
    }
}
