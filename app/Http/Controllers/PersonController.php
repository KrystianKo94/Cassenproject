<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function index()
    {
        $people = Person::all();
        return response()->json($people, 200);
    }

    public function store(Request $request, $name, $surname)
    {
        $existingPerson = Person::where('name', $name)
            ->where('surname', $surname)
            ->first();

        if ($existingPerson) {
            return response()->json(['message' => 'Dane już istnieja w bazie'], 400);
        }

        $person = Person::create([
            'name' => $name,
            'surname' => $surname,
        ]);

        return response()->json($person, 201);
    }

    public function destroy($id)
    {
        $person = Person::findOrFail($id);
        $person->delete();

        return response()->json(['message' => 'Dane usuniete pomyslnie'], 200);
    }

    public function showById($id)
    {
        $person = Person::find($id);

        if (!$person) {
            return response()->json(['message' => 'Użytkownik o podanym ID nie istnieje'], 404);
        }

        return response()->json($person, 200);
    }
}
