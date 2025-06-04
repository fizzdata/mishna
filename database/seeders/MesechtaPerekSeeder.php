<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MesechtaPerekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Define the number of Perakim for each Mesechta
        $perakim_count = [
            // **Zeraim**
            'ברכות' => 9, 'פאה' => 8, 'דמאי' => 7, 'כלאים' => 9, 'שביעית' => 10, 'תרומות' => 11, 'מעשרות' => 5, 
            'מעשר שני' => 5, 'חלה' => 4, 'ערלה' => 3, 'בכורים' => 3,

            // **Moed**
            'שבת' => 24, 'עירובין' => 10, 'פסחים' => 10, 'שקלים' => 8, 'יומא' => 8, 'סוכה' => 5, 'ביצה' => 5, 
            'ראש השנה' => 4, 'תענית' => 4, 'מגילה' => 4, 'מועד קטן' => 3, 'חגיגה' => 3,

            // **Nashim**
            'יבמות' => 16, 'כתובות' => 13, 'נדרים' => 11, 'נזיר' => 9, 'סוטה' => 9, 'גיטין' => 9, 'קדושין' => 4,

            // **Nezikin**
            'בבא קמא' => 10, 'בבא מציעא' => 10, 'בבא בתרא' => 10, 'סנהדרין' => 11, 'מכות' => 3, 'שבועות' => 8, 
            'עדיות' => 8, 'עבודה זרה' => 5, 'אבות' => 5, 'הוריות' => 3,

            // **Kodashim**
            'זבחים' => 14, 'מנחות' => 13, 'חולין' => 12, 'בכורות' => 9, 'ערכין' => 9, 'תמורה' => 7, 'כריתות' => 6, 
            'מעילה' => 6, 'תמיד' => 7, 'מדות' => 3, 'קנים' => 3,

            // **Taharos**
            'כלים' => 30, 'אהלות' => 18, 'נגעים' => 14, 'פרה' => 12, 'טהרות' => 10, 'מקואות' => 10, 'נדה' => 10, 
            'מכשירין' => 6, 'זבים' => 5, 'טבול יום' => 4, 'ידים' => 4, 'עוקצין' => 3
        ];

        // Fetch all Mesechtas from the database
        $mesechtas = DB::table('mesechta')->get();

        foreach ($mesechtas as $mesechta) {
            $name = $mesechta->name;
            $mesechta_id = $mesechta->id;
            $num_perakim = $perakim_count[$name] ?? 10; // Default to 10 if not specified

            for ($i = 1; $i <= $num_perakim; $i++) {
                DB::table('mesechta_perek')->insert([
                    'mesechta_id' => $mesechta_id,
                    'perek' => "פרק " . $this->convertToHebrewNumber($i),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    /**
     * Convert Arabic numbers to Hebrew.
     */
    private function convertToHebrewNumber(int $number): string
    {
        $hebrewNumbers = [
            1 => 'א', 2 => 'ב', 3 => 'ג', 4 => 'ד', 5 => 'ה',
            6 => 'ו', 7 => 'ז', 8 => 'ח', 9 => 'ט', 10 => 'י',
            11 => 'יא', 12 => 'יב', 13 => 'יג', 14 => 'יד', 15 => 'טו',
            16 => 'טז', 17 => 'יז', 18 => 'יח', 19 => 'יט', 20 => 'כ',
            21 => 'כא', 22 => 'כב', 23 => 'כג', 24 => 'כד', 25 => 'כה',
            26 => 'כו', 27 => 'כז', 28 => 'כח', 29 => 'כט', 30 => 'ל'
        ];

        return $hebrewNumbers[$number] ?? (string) $number; 
    
    }
}
