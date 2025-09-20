# Készíts route-okat egy egyszerű webshophoz!

- GET route-ot a termékek listázásához (/products)
- POST route-ot új termék hozzáadásához (/products/create)
- PUT route-ot termék módosításához (/products/{id}/edit)
- DELETE route-ot termék törléséhez (/products/{id}/delete)

Minden route különböző HTTP metódust használjon, és térjen vissza egyszerű JSON szöveges válasszal, ami jelzi melyik művelet fut le.

# Hozz létre egy /user/{id}/post/{postid} route-ot, amely két paramétert fogad. Jelenítse meg: "Felhasználó: {id}, Bejegyzés: {postid}". Például /user/5/post/10 esetén: "Felhasználó: 5, Bejegyzés: 10".

# Készíts egy /welcome/{name?} route-ot opcionális paraméterrel. Ha megadják a nevet, köszöntsön név szerint ("Üdv {név}!"), ha nem adnak meg nevet, akkor általános üdvözlés legyen ("Üdv Vendég!").

# Hozz létre egy /profile route-ot és adj neki "profile.show" nevet a ->name() metódussal. Készíts egy másik route-ot /test, amely a route('profile.show') helper függvénnyel generálja és jelenítse meg a profile route URL-jét.

# Hozz létre egy PageController-t a make:controller paranccsal. Készíts benne egy home() metódust, amely a view() helper-rel visszaad egy 'welcome' nézetet. Kösd össze a / route-ot ezzel a controller metódussal. A controller-ben használd a config() helper-t az alkalmazás nevének megjelenítéséhez.
