<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_games', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->decimal('loose_price');
            $table->decimal('complete_price');
            $table->decimal('new_price');
            $table->timestamps();
        });

        $nesLibraryCsv = public_path('docs/nes_library.csv');

        if (file_exists($nesLibraryCsv)) {
            $lines = file_get_contents($nesLibraryCsv);
            $lines = explode(PHP_EOL, $lines);
            array_shift($lines);

            foreach ($lines as $line) {
                $line = explode(',', $line);

                if ($line[0] == '') {
                    continue;
                }

                $loosePrice = (!empty($line[1]) ? str_replace('$', '', trim($line[1])) : 0.00);
                $completePrice = (!empty($line[2]) ? str_replace('$', '', trim($line[2])) : 0.00);
                $newPrice = (!empty($line[3]) ? str_replace('$', '', trim($line[3])) : 0.00);

                DB::table('video_games')->insert([
                    'name' => trim($line[0]),
                    'loose_price' => $loosePrice,
                    'complete_price' => $completePrice,
                    'new_price' => $newPrice,
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
        Schema::dropIfExists('video_games');
    }
}
