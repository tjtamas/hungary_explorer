<?php
declare(strict_types=1);

/**
 * Gallery Configuration - Magyarország Felfedezői Szövetség
 * 
 * Album names and settings
 * 
 * @package MagyarorszagFelfedezoi
 * @version 2.0.0
 */

// ============================================
// ALBUM NEVEK (mappa név => megjelenítési név)
// ============================================

define('ALBUM_NAMES', [
    // Táborok
    'camp'          => 'Nyári tábor',
    'tabor'         => 'Nyári tábor',
    
    // Megemlékezések
    '1848'          => '1848-as megemlékezés',
    'memorial'      => 'Megemlékezés',
    
    // Programok
    'citera'        => 'Citera találkozó',
    'csemadok'      => 'Csemadok program',
    
    // Túrák, kirándulások
    'erdely'        => 'Erdélyi túra',
    'hiking'        => 'Túra',
    'kirandulas'    => 'Kirándulás',
    
    // Találkozók
    'meeting'       => 'Találkozó',
    'talalkozo'     => 'Találkozó',
    
    // Játékok, versenyek
    'varjatek'      => 'Várjáték',
    'verseny'       => 'Verseny',
    
    // Egyéb
    'main'          => 'Fő események',
    'other'         => 'Egyéb',
]);

// ============================================
// HELPER FUNCTION
// ============================================

/**
 * Get album display name
 * 
 * @param string $folderName Mappa neve
 * @return string Megjelenítési név
 */
function getAlbumName(string $folderName): string
{
    return ALBUM_NAMES[$folderName] ?? ucfirst($folderName);
}