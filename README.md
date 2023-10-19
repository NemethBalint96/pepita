# Requirements

## Backend (Laravel):
- **PHP**: Laravel is a PHP framework, so you need PHP installed on your system. Make sure you have a version compatible with Laravel.

- **Composer**: Composer is a PHP dependency manager. You will need it to install PHP packages and dependencies for your Laravel project.

- **Database**: You will need a database management system. Laravel supports various databases, but MySQL is commonly used. Make sure you have MySQL or another compatible database system installed and running.

## Frontend (Next.js):
- **Node.js**: Next.js is a JavaScript framework built on top of Node.js. You need Node.js installed on your system to run and manage JavaScript packages with npm.

- **npm or Yarn**: npm (Node Package Manager) is included with Node.js. Alternatively, you can use Yarn, another package manager. You will use either npm or Yarn to install JavaScript packages and manage dependencies for your Next.js project.

## General:
- **Git**: You need Git to clone and manage your project's source code from a version control repository

# Setup

## Backend Setup (Laravel)

### 1. Clone the repository and navigate to the backend directory:

```bash
git clone <repository-url>
cd pepita/backend
```

### 2. Install PHP dependencies using Composer:
```bash
composer install
```

### 3. Create a new database for your application.

### 4. Copy the example environment file and configure your database connection by editing the `.env` file:

```bash
cp .env.example .env
```
Update the `.env` file with your database information, like the database name, username, and password.

### 5. Generate an application key:
```bash
php artisan key:generate
```

### 6. Run the database migrations and seed the database with sample data:
```bash
php artisan migrate --seed
```

### 7. Start the Laravel development server:
```bash
php artisan serve
```
Your Laravel backend should now be running.

## Frontend Setup (Next.js)

### 1. In a new terminal, navigate to the frontend directory:
```bash
cd ../frontend
```

### 2. Install Node.js dependencies using npm:
```bash
npm install
```

### 3. Copy the example local environment file and configure the backend API route by editing the `.env.local` file:
```bash
cp .env.local.example .env.local
```
Replace http://localhost:8000/api/events with the actual URL of your Laravel backend if it's running on a different address.

### 4. Start the Next.js development server:
```bash
npm run dev
```

Your Next.js frontend should now be running, and it will be able to make API requests to your Laravel backend.


# Feladat

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
