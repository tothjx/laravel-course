<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eredmény - Nyereményjáték</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            max-width: 600px;
            background: white;
            border-radius: 20px;
            padding: 50px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            text-align: center;
        }
        .success-icon {
            font-size: 80px;
            margin-bottom: 20px;
        }
        h1 {
            color: #667eea;
            margin-bottom: 20px;
            font-size: 2.5em;
        }
        .score-display {
            font-size: 4em;
            font-weight: bold;
            color: #764ba2;
            margin: 30px 0;
        }
        .score-text {
            font-size: 1.3em;
            color: #666;
            margin-bottom: 30px;
        }
        .message {
            font-size: 1.2em;
            color: #333;
            line-height: 1.6;
            margin-bottom: 30px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
        }
        .participant-info {
            background: #f0f4ff;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            border-left: 4px solid #667eea;
        }
        .participant-info p {
            margin: 10px 0;
            color: #555;
        }
        .participant-info strong {
            color: #333;
        }
        .buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }
        .btn {
            padding: 15px 30px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.3s;
            text-decoration: none;
            display: inline-block;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .btn-secondary {
            background: #f8f9fa;
            color: #667eea;
            border: 2px solid #667eea;
        }
        .btn:hover {
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="success-icon">
            @if($entry->score === $maxScore)
                🏆
            @elseif($entry->score >= $maxScore * 0.6)
                🎉
            @else
                ✨
            @endif
        </div>

        <h1>Köszönjük a részvételt!</h1>

        <div class="score-display">
            {{ $entry_score }} / {{ $maxScore }}
        </div>

        <p class="score-text">
            helyes válasz
        </p>

        <div class="message">
            @if($entry->score === $maxScore)
                <strong>Tökéletes!</strong> 🎊<br>
                Gratulálunk! Minden kérdésre helyesen válaszoltál!
            @elseif($entry->score >= $maxScore * 0.8)
                <strong>Kiváló!</strong> 👏<br>
                Szinte tökéletes teljesítmény!
            @elseif($entry->score >= $maxScore * 0.6)
                <strong>Jó!</strong> 👍<br>
                Szép eredmény!
            @else
                <strong>Köszönjük!</strong> 💪<br>
                Legközelebb még jobban megy majd!
            @endif
        </div>

        <div class="participant-info">
            <p><strong>Név:</strong> {{ $entry->fullname }}</p>
            <p><strong>Email:</strong> {{ $entry->email }}</p>
            <p><strong>Dátum:</strong> {{ $entry->created_date->format('Y. m. d. H:i') }}</p>
        </div>

        <p style="color: #666; margin-bottom: 30px; font-size: 0.95em;">
            A nyerteseket emailben értesítjük a játék lezárása után.
        </p>

        <div class="buttons">
            <a href="{{ route('contest.show') }}" class="btn btn-secondary">
                Vissza a főoldalra
            </a>
        </div>
    </div>
</body>
</html>