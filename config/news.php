<?php
declare(strict_types=1);

/**
 * News Configuration - Magyarország Felfedezői Szövetség
 * 
 * Központi hírek adatbázis
 * 
 * @package MagyarorszagFelfedezoi
 * @version 2.0.0
 */

// ============================================
// KATEGÓRIÁK
// ============================================

define('NEWS_CATEGORIES', [
    'tabor' => [
        'name' => 'Tábor',
        'icon' => 'fas fa-campground',
        'color' => 'green'
    ],
    'jelentkezes' => [
        'name' => 'Jelentkezés',
        'icon' => 'fas fa-user-plus',
        'color' => 'red'
    ],
    'megemlekezes' => [
        'name' => 'Megemlékezés',
        'icon' => 'fas fa-flag',
        'color' => 'gold'
    ],
    'esemeny' => [
        'name' => 'Esemény',
        'icon' => 'fas fa-calendar-alt',
        'color' => 'blue'
    ],
    'program' => [
        'name' => 'Program',
        'icon' => 'fas fa-users',
        'color' => 'purple'
    ],
]);

// ============================================
// HÍREK ADATBÁZIS
// ============================================

define('NEWS_ITEMS', [
    // ========== 2026 ==========
    [
        'id' => 'jelentkezes-2026',
        'slug' => '2026/jelentkezes',
        'title' => 'Pásztortűz tábor 2026',
        'date' => '2026-01-15',
        'year' => 2026,
        'category' => 'jelentkezes',
        'image' => 'galeria/2026/tabor/tabor2026.jfif',
        'excerpt' => 'Várjuk jelentkezésedet idei nyári táborunkba, ahol ismét felejthetetlen élmények várnak!',
        'featured' => true,
        'registration_active' => true,
        'registration_deadline' => '2026-06-30',
        'camp_date_start' => '2026-07-20',
        'camp_date_end' => '2026-07-27',
        'camp_price' => 38000,
        'hide_in_news_list' => true,
    ],

  
    // ========== 2025 ==========

        [
        'id' => 'magyar-kalvaria-2025',
        'slug' => '2025/kalvaria',
        'title' => 'Magyar Kálvárián járt csapatunk',
        'date' => '2025-10-23',
        'year' => 2025,
        'category' => 'program',
        'image' => 'gallery/2025/camp/06.jpg',
        'excerpt' => 'A felsőszeli Bercsényi Miklós Hagyományőrző Csapat tagjai emléktúrán vettek részt a sátoraljaújhelyi Magyar Kálvárián.',
        'featured' => false,
    ],
      [
        'id' => '11-11-megemlekezes-2025',
        'slug' => '2025/11-11-megemlekezes',
        'title' => '11-11-11 Megemlékezés',
        'date' => '2025-11-11',
        'year' => 2025,
        'category' => 'megemlekezes',
        'image' => 'gallery/2025/memorial/02.jpg',
        'excerpt' => 'Felsőszeliben november 11-én 11 óra 11 perckor megemlékeztek az I. világháborúban elesett hősökről.',
        'featured' => false,
    ],

    [
        'id' => 'tabor-2025',
        'slug' => '2025/tabor2025',
        'title' => 'Pásztortűz 2025',
        'date' => '2025-07-28',
        'year' => 2025,
        'category' => 'tabor',
        'image' => 'gallery/2025/camp/05.jpg',
        'excerpt' => '2025. július 21-től július 28-ig ismét felfedezők lepték el a Magyarország Felfedezői Szövetség táborát.',
        'featured' => false,
    ],
    [
        'id' => '1848-megemlekezes-2025',
        'slug' => '2025/1848',
        'title' => '1848-as megemlékezés',
        'date' => '2025-03-15',
        'year' => 2025,
        'category' => 'megemlekezes',
        'image' => 'gallery/2025/1848/01.jpg',
        'excerpt' => 'Szövetségünk ifi vezetőivel idén is megemlékeztünk a Március idusán történt eseményekről.',
        'featured' => false,
    ],
    [
        'id' => 'citera-2025',
        'slug' => '2025/citera',
        'title' => 'Citerák napja',
        'date' => '2025-03-22',
        'year' => 2025,
        'category' => 'esemeny',
        'image' => 'gallery/2025/citera/01.jpg',
        'excerpt' => 'A Felsőszeliben működő Kikelet citerazenekar nyitotta meg a Néprajzi Múzeumban a "Citerák napja" rendezvényét.',
        'featured' => false,
    ],
    [
        'id' => 'csemadok-2025',
        'slug' => '2025/csemadok',
        'title' => 'Csemadok 1848-as megemlékezés',
        'date' => '2025-03-15',
        'year' => 2025,
        'category' => 'megemlekezes',
        'image' => 'gallery/2025/csemadok/05.jpg',
        'excerpt' => 'A Csemadok Felsőszeli Alapszervezete a helyi temetőben levő kopjafánál tartotta a megemlékezést.',
        'featured' => false,
    ],
    [
        'id' => 'erdely-tavasz-2025',
        'slug' => '2025/erdely',
        'title' => 'Erdélyi tavaszi beszámoló',
        'date' => '2025-04-10',
        'year' => 2025,
        'category' => 'esemeny',
        'image' => 'gallery/2025/erdely/07.jpg',
        'excerpt' => 'Március, április igazán tartalmas időszak volt csapatunk életében. Új tagokat avattunk és megemlékezéseket tartottunk.',
        'featured' => false,
    ],

    // ========== 2024 ==========
    [
        'id' => 'tabor-2024',
        'slug' => '2024/tabor2024',
        'title' => 'Pásztortűz 2024',
        'date' => '2024-08-04',
        'year' => 2024,
        'category' => 'tabor',
        'image' => 'gallery/2024/camp/09.jpg',
        'excerpt' => '2024. július 28-tól augusztus 4-ig ismét felfedezők lepték el a Magyarország Felfedezői Szövetség táborát.',
        'featured' => false,
    ],
    [
        'id' => 'europa-nap-2024',
        'slug' => '2024/europanap',
        'title' => 'Az Európai Kultúra Napja',
        'date' => '2024-09-20',
        'year' => 2024,
        'category' => 'megemlekezes',
        'image' => 'gallery/2024/culture/01.jpg',
        'excerpt' => 'A Falvak Kultúrájáért Alapítvány szervezésében az elhunyt Magyar Kultúra Lovagjaira emlékeztünk.',
        'featured' => false,
    ],

    // ========== 2023 ==========
    [
        'id' => 'tabor-2023',
        'slug' => '2023/tabor2023',
        'title' => 'Pásztortűz 2023',
        'date' => '2023-08-05',
        'year' => 2023,
        'category' => 'tabor',
        'image' => 'gallery/2023/camp/31.jpg',
        'excerpt' => '2023. július 28-tól augusztus 5-ig ismét felfedezők lepték el a Magyarország Felfedezői Szövetség táborát.',
        'featured' => false,
    ],
    [
        'id' => 'oktober23-2023',
        'slug' => '2023/oktober23',
        'title' => 'Október 23-i megemlékezés',
        'date' => '2023-10-23',
        'year' => 2023,
        'category' => 'megemlekezes',
        'image' => 'gallery/2023/memorial/20.jpg',
        'excerpt' => 'Október 23-án egy kellemes délutáni sétára indultunk a Nemzeti sírkertben ahol 1956 hőseire emlékeztünk.',
        'featured' => false,
    ],

    // ========== 2022 ==========
    [
        'id' => 'tabor-2022',
        'slug' => '2022/tabor2022',
        'title' => 'Pásztortűz 2022',
        'date' => '2022-07-30',
        'year' => 2022,
        'category' => 'tabor',
        'image' => 'gallery/2022/camp/02.jpg',
        'excerpt' => 'Két hosszú év kihagyás után, idén a Magyarország Felfedezői Szövetség sárospataki tábora újra megtelt élettel.',
        'featured' => false,
    ],

    // ========== 2019 ==========
    [
        'id' => 'orokseg-serleg-2019',
        'slug' => '2019/orokseg-serleg',
        'title' => 'Örökség Serleg Elismerés',
        'date' => '2019-01-19',
        'year' => 2019,
        'category' => 'esemeny',
        'image' => 'gallery/2019/heritage/24.jpg',
        'excerpt' => 'Hálával és örömmel közöljük, hogy a kibédi Mátyus István Hagyományőrző Csapat az Örökség serleg elismerésében részesült.',
        'featured' => false,
    ],
    [
        'id' => '30-eves-2019',
        'slug' => '2019/30-eves',
        'title' => '30 éves a Magyarország Felfedezői Szövetség',
        'date' => '2019-09-21',
        'year' => 2019,
        'category' => 'esemeny',
        'image' => 'gallery/2019/30year/01.jpg',
        'excerpt' => 'Harminc évvel ezelőtt, 1989 szeptemberében néhány lelkes pedagógus kezdeményezésére megalakult a Magyarország Felfedezői Szövetség.',
        'featured' => false,
    ],
    [
        'id' => 'vetelkedo-2019',
        'slug' => '2019/vetelkedo',
        'title' => '"Mert a Haza nem eladó" vetélkedő',
        'date' => '2019-11-09',
        'year' => 2019,
        'category' => 'esemeny',
        'image' => 'gallery/2019/quiz/01.jpg',
        'excerpt' => 'Ezzel a mottóval szerveztünk vetélkedőt november 9-én, szombaton Erdély felfedezői számára Makfalván.',
        'featured' => false,
    ],

    // ========== 2018 ==========
    [
        'id' => 'beszamolo-2018',
        'slug' => '2018/beszamolo',
        'title' => 'Beszámoló októberi és novemberi tevékenységeinkről',
        'date' => '2018-11-30',
        'year' => 2018,
        'category' => 'esemeny',
        'image' => 'gallery/2018/presentation/01.jpg',
        'excerpt' => 'Eseménydús, tartalmas októbere volt a Szent István utódai hagyományőrző csapatnak.',
        'featured' => false,
    ],
]);

// ============================================
// HELPER FUNCTIONS
// ============================================

/**
 * Get all news items sorted by date (newest first)
 */
function getNewsItems(): array
{
    $items = NEWS_ITEMS;
    usort($items, fn($a, $b) => strtotime($b['date']) - strtotime($a['date']));
    return $items;
}

/**
 * Get news by ID
 */
function getNewsById(string $id): ?array
{
    foreach (NEWS_ITEMS as $item) {
        if ($item['id'] === $id) {
            return $item;
        }
    }
    return null;
}

/**
 * Get news by slug
 */
function getNewsBySlug(string $slug): ?array
{
    foreach (NEWS_ITEMS as $item) {
        if ($item['slug'] === $slug) {
            return $item;
        }
    }
    return null;
}

/**
 * Get news by year
 */
function getNewsByYear(int $year): array
{
    return array_filter(NEWS_ITEMS, fn($item) => $item['year'] === $year);
}

/**
 * Get news by category
 */
function getNewsByCategory(string $category): array
{
    return array_filter(NEWS_ITEMS, fn($item) => $item['category'] === $category);
}

/**
 * Get featured news
 */
function getFeaturedNews(): array
{
    return array_filter(NEWS_ITEMS, fn($item) => $item['featured'] ?? false);
}

/**
 * Get active registration (if any)
 */
function getActiveRegistration(): ?array
{
    foreach (NEWS_ITEMS as $item) {
        if (($item['registration_active'] ?? false) === true) {
            $deadline = strtotime($item['registration_deadline'] ?? '');
            if ($deadline && $deadline >= time()) {
                return $item;
            }
        }
    }
    return null;
}

/**
 * Get category info
 */
function getCategoryInfo(string $category): array
{
    return NEWS_CATEGORIES[$category] ?? [
        'name' => ucfirst($category),
        'icon' => 'fas fa-newspaper',
        'color' => 'gray'
    ];
}

/**
 * Format date in Hungarian
 */
function formatDateHu(string $date): string
{
    $months = [
        1 => 'Január', 2 => 'Február', 3 => 'Március', 4 => 'Április',
        5 => 'Május', 6 => 'Június', 7 => 'Július', 8 => 'Augusztus',
        9 => 'Szeptember', 10 => 'Október', 11 => 'November', 12 => 'December'
    ];
    
    $timestamp = strtotime($date);
    $year = date('Y', $timestamp);
    $month = $months[(int)date('n', $timestamp)];
    $day = date('j', $timestamp);
    
    return "$year. $month $day.";
}

/**
 * Get available years
 */
function getNewsYears(): array
{
    $years = array_unique(array_column(NEWS_ITEMS, 'year'));
    rsort($years);
    return $years;
}