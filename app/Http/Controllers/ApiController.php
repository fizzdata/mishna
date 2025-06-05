<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class ApiController extends Controller
{
    public function index(Request $request){

        $family_uid = (int) $request->family_uid;

        $family_id = DB::table('family')
            ->where('uid', $family_uid)
            ->value('id');

        //dd($family_id);

        $query = DB::select("SELECT 
    m.name AS mesechta_name, 
    mp.perek, 
    u.name AS user_name,
    s.name AS seder_name,
    mp.id AS id

FROM 
    mesechta m
JOIN 
    mesechta_perek mp ON m.id = mp.mesechta_id
JOIN
    seder s ON m.seder_id = s.id
LEFT JOIN 
    users_perek up ON mp.id = up.perek_id AND up.family_id = {$family_id}
LEFT JOIN 
    users u ON up.users_id = u.id
ORDER BY 
    m.id, 
    mp.perek");

        return response()->json($query);
    }

    public function store(Request $request){

       // Validate request data
    $validated = $request->validate([
        '*' => 'required|array',
        '*.id' => 'required|integer',
        '*.user_name' => 'required|string|max:255',
        '*.phone' => 'required|string|max:20',
    ]);

    // Find family
    $family = DB::table('family')->where('uid', $request->family_uid)->first();
    if (!$family) {
        return response()->json(['error' => 'Family not found'], 404);
    }

    // Process updates
    $results = [];
    $errors = [];

    foreach ($validated as $update) {
        try {
            // Find or create user
            $user = User::firstOrCreate(
                ['phone' => $update['phone']],
                ['name' => $update['user_name']]
            );
            

            // Update or create the perek assignment
            DB::table('users_perek')->updateOrInsert(
                [
                    'perek_id' => $update['id'],
                    'family_id' => $family->id,
                     'users_id' => $user->id,

                ],
                [
                    'updated_at' => now(),
                ]
            );

            $results[] = $update['id'];
        } catch (\Exception $e) {
            $errors[] = [
                'id' => $update['id'],
                'message' => $e->getMessage()
            ];
        }
    }

    return response()->json([
        'success' => count($results),
        'errors' => count($errors),
        'updated_ids' => $results,
        'error_details' => $errors
    ], count($errors) ? 207 : 200); // 207 Multi-Status for partial success
}
}
