<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoGameEntityIntsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_game_entity_int', function (Blueprint $table) {
            $table->increments('value_id');
            $table->integer('attribute_id');
            $table->integer('entity_id');
            $table->integer('value');
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
                $sku = strtolower(str_replace(' ', '-', $line[1]));
                $sku = preg_replace('/[^A-Za-z0-9\-]/', '', $sku);

                $record = DB::table('video_game_entity')->select('*')->where('sku', '==', $sku)->get();

                var_dump($record);
                die;

                DB::table('video_game_entity_int')->insert([
                    'name' => trim($line[0]),
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
        Schema::dropIfExists('video_game_entity_int');
    }
}
