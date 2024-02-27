<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('statuses')->insert([
            'id'          => 1,
            'name'        => 'Te huur',
            'description' => 'Dit wordt door de administratief medewerker ingesteld wanneer een huurder de woning verlaten heeft en Rentit op zoek is naar een nieuwe huurder',
            'created_at'  => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'  => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('statuses')->insert([
            'id'          => 2,
            'name'        => 'In gebruik',
            'description' => 'Deze status wordt automatisch ingesteld wanneer een nieuwe huurder het huurcontract ondertekent voor een woning',
            'created_at'  => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'  => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('statuses')->insert([
            'id'          => 3,
            'name'        => 'Gereserveerd',
            'description' => 'Dit wordt door de administratief medewerker ingesteld wanneer een nieuwe huurder langskomt voor de contractondertekening. Na ondertekening schakelt de status automatisch naar ‘In gebruik’',
            'created_at'  => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'  => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('statuses')->insert([
            'id'          => 4,
            'name'        => 'Open',
            'description' => 'Moet nog gepland worden',
            'created_at'  => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'  => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('statuses')->insert([
            'id'          => 5,
            'name'        => 'Gepland',
            'description' => 'De monteurs gaat op een afgesproken moment langs',
            'created_at'  => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'  => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('statuses')->insert([
            'id'          => 6,
            'name'        => 'Gesloten',
            'description' => 'De monteur is langs geweest en heeft het probleem verholpen',
            'created_at'  => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'  => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
