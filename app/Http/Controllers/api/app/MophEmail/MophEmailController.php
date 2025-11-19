<?php

namespace App\Http\Controllers\api\app\MophEmail;

use App\Http\Controllers\Controller;
use App\Models\MophEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MophEmailController extends Controller
{
    public function index()
    {
       
        $rows = DB::table('moph_emails as me')
            ->select('me.id', 'me.moph_id', 'me.email', 'me.directorate')
            ->orderByDesc('me.id')
            ->get();

        return response()->json($rows, 200);
    }

    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'directorate' => 'required|string|max:255',
            'email' => 'required|email|unique:moph_emails,email',
        ]);

        $generatedId = 'ME-' . strtoupper(Str::random(8));

        $row = MophEmail::create([
            'moph_id' => $generatedId,
            'directorate' => $validated['directorate'],
            'email' => $validated['email'],
        ]);

        return response()->json(['message' => 'Created', 'data' => $row], 201);
    }

    public function update(Request $request, string $id)
    {
      
        $row = MophEmail::findOrFail($id);

        $validated = $request->validate([
            'directorate' => 'required|string|max:255',
            'email' => 'required|email|unique:moph_emails,email,' . $row->id,
        ]);

        $row->update([
            'directorate' => $validated['directorate'],
            'email' => $validated['email'],
        ]);

        return response()->json(['message' => 'Updated', 'data' => $row], 200);
    }

    public function destroy(string $id)
    {
        
        $row = MophEmail::findOrFail($id);
        $row->delete();

        return response()->json(['message' => 'Deleted'], 200);
    }


     public function checkEmailAddress(Request $request)
    {
        $email = $request->input('email');

        $exists = \App\Models\MophEmail::where('email', $email)->exists();

        return response()->json([
            'exists' => $exists,
            'message' => $exists ? 'This email address is already taken!' : ''
        ]);
    }
}
