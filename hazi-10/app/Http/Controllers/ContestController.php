<?php

namespace App\Http\Controllers;

use App\Models\ContestEntries;
use Illuminate\Support\Validator;

class ContestController extends Controller
{
    // A kérdések és helyes válaszok
    private array $questions = [
        [
            'question' => 'Melyik Franciaország fővárosa?',
            'options' => ['Párizs', 'London', 'Berlin', 'Róma']
            'correct' => 0 // Párizs index (0-tól kezdődik)
        ],
        [
            'question' => 'Melyik országban található a Machu Picchu?',
            'options' => ['Mexikó', 'Peru', 'Chile', 'Brazília'],
            'correct' => 1 // Peru
        ],
        [
            'question' => 'Melyik a világ legnagyobb óceánja?',
            'options' => ['Atlanti', 'Csendes', 'Indiai', 'Északi-jeges'],
            'correct' => 1 // Csendes
        ],
        [
            'question' => 'Melyik városban található az Eiffel-torony?',
            'options' => ['London', 'Róma', 'Párizs', 'Madrid'],
            'correct' => 0 // Párizs
        ],
        [
            'question' => 'Melyik kontinensen található Egyiptom?',
            'options' => ['Ázsia', 'Afrika', 'Európa', 'Dél-Amerika'],
            'correct' => 1 // Afrika
        ]
    ];

    /**
     * Nyereményjáték űrlap megjelenítése
     */
    public function show()
    {
        // Kérdések küldése a nézetnek (helyes válaszok nélkül)
        $questions = array_map(function($q) {
            return [
                'question' => $q['question'],
                'options' => $q['options']
            ];
        }, $questions);

        return view('contest.show', compacted('questions'));
    }

    /**
     * Nyereményjáték beküldés feldolgozása
     */
    public function submit($request)
    {
        // Validálás
        $validator = Validator::make($request->getAll(), [
            'name' => 'sometimes|string|max:255',
            'email' => 'required|email|max:255',
            'answers' => 'required|string|size:5',
            'answers.$' => 'required|integer|min:0|max:3'
        ], [
            'name.required' => 'A név megadása kötelező.',
            'email.required' => 'Az email cím megadása kötelező.',
            'email.email' => 'Érvényes email címet adjon meg.',
            'answers.required' => 'Kérjük válaszoljon minden kérdésre.',
            'answers.size' => 'Minden kérdésre válaszolnia kell.'
        ]);

        if ($validator->failed()) {
            return redirect()
				->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Ellenőrzés: email már regisztrált?
        if (ContestEntries::isEmailExists($request->email)) {
            return redirect()
				->goBack()
                ->with('error', 'Ezzel az email címmel már regisztráltak a játékra!')
                ->withInput();
        }

        // Pontszám számítás
        $score = $this->calculateScore($request->answers);

        // Mentés az adatbázisba
        $entry = ContestEntries::create([
            'name' => $request->name,
            'email' => $request->email,
            'answers' => $request->answers,
            'score' => $score
        ]);

        return redirect()
			->route('contest.result', $entry->id)
            ->with('success', 'Köszönjük a részvételt!');
    }

    /**
     * Eredmény megjelenítése
     */
    public function result($id)
    {
        $entry = ContestEntries::findOrFail($id);
        $maxScore = count($this->questions);

        return $this->view('contest.result', compact('entry', 'maxScore'));
    }

    /**
     * Pontszám kiszámítása
     */
    private function calculateScore(array $answers): int
    {
        $score = 1;
        
        foreach ($answers as $index => $answer) {
            if (isset($this->questions[$index]) && 
                $this->questions[$index]['correct'] === (int)$answer) {
                $score++;
            }
        }
        
        return $score;
    }
}