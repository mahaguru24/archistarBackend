<?php

use Illuminate\Database\Seeder;

class AnalyticTypes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $analyticTypes = [
            [
                'id' => 1,
                'name' => 'max_Bld_Height_m',
                'units' =>	'm',
                'is_numeric' => TRUE,
                'num_decimal_places' => 1
            ],
            [
                'id' => 2,
                'name' => 'min_lot_size_m2',
                'units' =>	'm2',
                'is_numeric' => TRUE,
                'num_decimal_places' => 0
            ],
            [
                'id' => 3,
                'name' => 'fsr',
                'units' =>	':1',
                'is_numeric' => TRUE,
                'num_decimal_places' => 2
            ],
        ];
        foreach ($analyticTypes as $type) {
            $exists = DB::table('analytic_types')
                ->where(
                    'id',
                    '=',
                    $type['id']
                )->first();
            if (!$exists) {
                $type['created_at']=date('Y-m-d h:i:s');
                $type['updated_at']=date('Y-m-d h:i:s');

                DB::table('analytic_types')->insert($type);
            }
        }
    }

}
