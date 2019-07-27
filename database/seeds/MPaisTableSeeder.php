<?php

use Illuminate\Database\Seeder;
use App\Models\Master\MPai;

class MPaisTableSeeder extends Seeder
{
    private $names = [
        '1mnz', '2mnz', '3mnz', '4mnz', '5mnz', '6mnz', '7mnz', '8mnz', '9mnz',
        '1pnz', '2pnz', '3pnz', '4pnz', '5pnz', '6pnz', '7pnz', '8pnz', '9pnz',
        '1suz', '2suz', '3suz', '4suz', '5suz', '6suz', '7suz', '8suz', '9suz',
        'ton', 'nan', 'sya', 'pei', 'hk', 'ht', 'tyn', '5rmnz', '5rpnz', '5rsuz'
    ];


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->names as $key => $name) {
            $Month = new MPai();

            $Month->name = $name;
            $Month->rank = $key+1;

            $Month->save();
        }
    }
}
