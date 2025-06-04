<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MesechtaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $zrueim = ['ברכות', 'פאה', 'דמאי', 'כלאים', 'שביעית', 'תרומות', 'מעשרות', 'מעשר שני', 'חלה', 'ערלה', 'בכורים'];

        $moed = ['שבת', ' עירובין', 'פסחים', 'שקלים', 'יומא', 'סוכה', 'ביצה', 'ראש השנה', 'תענית', 'מגילה', 'מועד קטן', 'חגיגה'];

        $nushim = ['יבמות', 'כתובות', 'נדרים', 'נזיר', 'סוטה', 'גיטין', 'קדושין'];

        $nezikin = ['בבא קמא', 'בבא מציעא', 'בבא בתרא', 'סנהדרין', 'מכות', 'שבועות', 'עדיות', 'עבודה זרה', 'אבות', 'הוריות'];

        $kudoshim = ['זבחים','מנחות', 'חולין', 'בכורות', 'ערכין', 'תמורה', 'כריתות', 'מעילה', 'תמיד', 'מדות', 'קנים'];

        $teharos = ['כלים', 'אהלות', 'נגעים', 'פרה', 'טהרות', 'מקואות', 'נדה', 'מכשירין', 'זבים', 'טבול יום', 'ידים', 'עוקצין'];

        foreach($zrueim as $z):
            DB::table('mesechta')
            ->insert([
                'seder_id' => 1,
                'name' => $z,
                'created_at' => now(),
                'updated_at' => now()

            ]);
        endforeach;


        foreach($moed as $m):
            DB::table('mesechta')
            ->insert([
                'seder_id' => 2,
                'name' => $m,
                'created_at' => now(),
                'updated_at' => now()

            ]);
        endforeach;


        foreach($nushim as $n):
            DB::table('mesechta')
            ->insert([
                'seder_id' => 3,
                'name' => $n,
                'created_at' => now(),
                'updated_at' => now()

            ]);
        endforeach;
        
        foreach($nezikin as $n):
            DB::table('mesechta')
            ->insert([
                'seder_id' => 4,
                'name' => $n,
                'created_at' => now(),
                'updated_at' => now()

            ]);
        endforeach;

        foreach($kudoshim as $k):
            DB::table('mesechta')
            ->insert([
                'seder_id' => 5,
                'name' => $k,
                'created_at' => now(),
                'updated_at' => now()

            ]);
        endforeach;

        foreach($teharos as $t):
            DB::table('mesechta')
            ->insert([
                'seder_id' => 6,
                'name' => $t,
                'created_at' => now(),
                'updated_at' => now()

            ]);
        endforeach;
    }
}
