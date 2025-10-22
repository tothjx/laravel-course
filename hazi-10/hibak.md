# hibák

## database/migration/2025_10_10_contest_entries_table.php

01. hibás könyvtárnév: database/migrations
02. hibás file-név: 2025_10_10_contest_entries_table.php
03. hiányzó phone mező
04. hibás séma: contest_entries
05. e-mail mező nem egyedi
06. down()-ban is hibás a séma: contest_entries

## routes/web.php

07. hiányzó Route: use Illuminate\Support\Facades\Route;
08. felesleges ű betű az utolsó route végén
09. submit esetén post-ot javasolnék
10. kuldes helyett meg submit lenne az igazi, ha már a controller-ben az szerepel

## app/Http/Controllers/ContestController.php

11. hibás path: use App\Models\ContestEntry;
12. hibás path: Illuminate\Support\Facades\Validator
13. talán jól jönne egy Request: use Illuminate\Http\Request;
14. az hiba sorszámának megfelelő sorban hiányzik a vessző
15. ez sok hibának számít: szinte sehol nincs típusdefiníció és a return típusa is hiányzik
16. a validator-ban a name-hez required kell sometimes helyett
17. a validator-ban az answers tömb kéne legyen
18. a validator-ban az answers.$ helyett egész biztosan más kéne legyen
19. az email vizsgálatánál ContestEntry kellene szerepeljen
20. ugyanitt az isEmailRegistered lenne javasolt, mert az van a model-ben
21. a mentésből hiányzik a phone mező
22. a result-ban is rossz a model neve, ContestEntry kellene szerepeljen

## app/Models/ContestEntry.php

23. a phone mező előtt csúnya tab-ok vannak szép space-ek helyett
24. hibás típus a created_at esetén, datetime kéne legyen
25. hibás típus az isEmailRegistered() paraméteréhez, string kellene
26. hibás típus az isEmailRegistered() return-jéhez, bool kellene

## resources/views/play_for_prize/show.blade.php

27. nem következetes a könyvtár elnevezés, a play_for_prize sehol nem szerepel másutt a kódban
28. contest.submit megfelelőbb lenne a contest.kuldes helyett
29. a form-on fullname helyett name lenne a megfelelő
30. @error('fullname') esetén szintén a fenti javaslatom lenne
31. a dd() szerepeltetését illetően, sztem nem kéne debug ide
32. a @if($questions <= 3) nem elég alapos, hiszen a questions tömb kellene legyen
33. iterációnál ez biztos h nem tartalmaz semmit: $question['question']
34. a style="display:none;" miatt nem lesz submit gomb

## resources/views/play_for_prize/result.balde.php

35. a file neve nem következetes, így nehezen találja meg az alkalmazás
36. nem következetes a könyvtár elnevezés, a play_for_prize sehol nem szerepel másutt a kódban
37. kiiratásnál itt is name kéne fullname helyett
38. ugyanitt a created_date property is indokolatlan, sokkal kielégítőbb eredményt adna a konvencióknak is megfelelő created_at

# Összegzés
Mivel több hibát jeleztél előre, ezek vélhetőleg már nagyrészt összefüggenek az öncélú name - fullname felcserélésekkel, az egyes- illetve többes számok körüli trükközéssel. Azt sem tartom kizártnak hogy a mérhetelen méretű css és html még tartalmazhatnak további csapdákat, ám ezek böngészése kevés laravel tudást ad, ezért eltekintettem a nüanszokba hajló vizsgálatuktól.

A CSRF laravel-beli alkalmazásával kapcsolatban még nem rendelkezem megfelelő szellemi infrastruktúrával, azért ilyen hibát nem jeleztem a listában, de határozott ígéretet teszek rá, hogy ezzel kapcsolatos tudásomat a közeljövőben jelentősen pallérozni fogom.

A pontosság kedvéért jelzem - bár tudom h ez egy játék - hogy a jelzett hibák egy része nem igazi hiba, ám az elvárásoknak megfelelően, a konvenciókat sértő elnevezéseket is akként számoltam el.


