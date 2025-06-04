<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\models\User;

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

    public function store(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|integer',
            'user_name' => 'required|string',
            'phone' => 'required|string',
        ]);

        $family_uid = (int) $request->family_uid;

        $family_id = DB::table('family')
            ->where('uid', $family_uid)
            ->value('id');

        if(!$family_id):
            return response()->json(['error' => 'invalid id']);

        $user = User::firstOrCreate([
            'name' => $data['user_name'],
            'phone' => $data['phone'],
        ]);

        DB::table('users_perek')->insert([
            'perek_id' => $data['id'],
            'family_id' => $family_id,
            'users_id' => $user->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['message' => 'Perek added successfully'], 201);
        
    }
}
