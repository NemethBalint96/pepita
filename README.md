Egy megrendelő szeretne egy alkalmazást, amivel nyilvántarthatja a bejelentkezett ügyfeleit. Segítsünk neki.

#### Feladat:
Egy PHP frameworkben (Laravel előnyben) hozz létre egy olyan alkalmazást, amelynek az a feladata, hogy egy naptárat jelenít meg, melyen láthatók az ügyfélfogadási idők és a már foglalt időpontok az ügyfelek nevével együtt.

A megrendelőnek lehetősége van új időpont rögzítésére úgy, hogy a naptárban kijelöli a foglalás kezdő- és végidőpontját és egy popupban megadja az ügyfél nevét.

Ekkor a rendszernek backend oldalon ellenőriznie kell, hogy az adott intervallum foglalható-e (ügyfélfogadási időre esik és nem ütközik más foglalással) és ha igen, akkor le kell ezeket az adatokat tárolni az adatbázisba.

A felhasználót értesíteni kell a sikeres/sikertelen műveletről, majd a naptárat aktualizálni kell. A frontend lehet magyar nyelvű.

#### Techinfo:
A megjelenítéshez a FullCalendar js plugint kell használni (https://fullcalendar.io). Támogatni kell a havi, heti és napi nézetet.

Ajax végponton keresztül kell átadni az eseményeket: background eseményként a rendelési időket, normál event-ként a már meglévő foglalásokat.

A FullCalendar select() metódusára rá kell ülni, és egy popup-ot feldobni az ügyfél nevének bekéréséhez (window.prompt() -is elég). Ajax-al el kell küldeni a foglalás adatait, validálni kell és vissza kell jelezni a sikeres/sikertelen kimenetet. Ezután frissíthető a calendar. 

Hozz létre egy SQL adatbázist, amelynek egyik táblája alkalmas legyen ügyfélfogadási idők tárolására. Egy ilyen ügyfélfogadási időpont a következő adatokkal rendelkezik:
- kezdő időpont
- vég időpont (ha van)
- nincs ismétlődés/minden héten/páros/páratlan héten jelzés
- hét napja
- napon belüli időpont

Tölts fel az alábbi időpontokat (command-al, seed-el vagy ahogy szeretnéd. Lényeg, hogy reprodukálható legyen, azaz bárki el tudja indítani és bekerüljenek a táblába az adatok)
- 2023-09-08-án 8-10 óra
- 2023-01-01-től minden páros héten hétfőn 10-12 óra
- 2023-01-01-től minden páratlan héten szerda 12-16 óra
- 2023-01-01-től minden héten pénteken 10-16 óra
- 2023-06-01-től 2023-11-30-ig minden héten csütörtökön 16-20 óra
