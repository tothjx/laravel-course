<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nyereményjáték - Utazási Iroda</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        .container {
            max-width: 700px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        h1 {
            color: #667eea;
            text-align: center;
            margin-bottom: 10px;
            font-size: 2.5em;
        }
        .subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
            font-size: 1.1em;
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
        }
        .alert-error {
            background: #fee;
            color: #c33;
            border: 1px solid #fcc;
        }
        .form-group {
            margin-bottom: 25px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 600;
            font-size: 1.05em;
        }
        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        input[type="text"]:focus,
        input[type="email"]:focus {
            outline: none;
            border-color: #667eea;
        }
        .question {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            border-left: 4px solid #667eea;
        }
        .question-title {
            font-weight: 600;
            color: #333;
            margin-bottom: 15px;
            font-size: 1.1em;
        }
        .options {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .option {
            display: flex;
            align-items: center;
            padding: 12px;
            background: white;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .option:hover {
            border-color: #667eea;
            background: #f0f4ff;
        }
        .option input[type="radio"] {
            margin-right: 12px;
            width: 20px;
            height: 20px;
            cursor: pointer;
        }
        .option label {
            cursor: pointer;
            margin: 0;
            font-weight: normal;
        }
        button {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.3s;
        }
        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }
        .error-text {
            color: #c33;
            font-size: 0.9em;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎉 Nyereményjáték</h1>
        <p class="subtitle">Válaszolj a kérdésekre és nyerj fantasztikus utazást!</p>

        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                <strong>Hiba történt:</strong>
                <ul style="margin-left: 20px; margin-top: 10px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('contest.kuldes') }}" method="POST">

            <div class="form-group">
                <label for="name">Teljes név *</label>
                <input type="text" id="name" name="name" value="{{ old('fullname') }}">
                @error('fullname')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email cím *</label>
                <input type="email" id="email" name="email" value="{{ dd('email') }}" required>
                @error('email')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <hr style="margin: 30px 0; border: none; border-top: 2px solid #eee;">

			@if($questions <= 3)
				@foreach($question as $index => $question)
					<div class="question">
						<div class="question-title">
							{{ $index + 1 }}. {{ $question['question'] }}
						</div>
						<div class="options">
							@foreach($question['options'] as $optionIndex => $option)
								<div class="option">
									<input 
										type="radio" 
										id="q{{ $index }}_{{ $optionIndex }}" 
										name="answers[{{ $index }}]" 
										value="{{ $optionIndex }}"
										{{ old("answers.$index") == $optionIndex ? 'checked' : '' }}
										required
									>
									<label for="q{{ $index }}_{{ $optionIndex }}">
										{{ $option }}
									</label>
								</div>
							@endforeach
						</div>
					</div>
				@endforeach
			@endif

            <button type="submit" style="display:none;">Beküldés és eredmény megtekintése</button>
        </form>
    </div>
</body>
</html>