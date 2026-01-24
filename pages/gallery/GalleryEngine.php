<?php
declare(strict_types=1);

/**
 * GalleryEngine - SOLID Gallery Controller
 * 
 * Handles gallery data, images, and rendering
 * Single Responsibility: Gallery management only
 * 
 * @package MagyarorszagFelfedezoi
 * @version 3.0.0
 */

// Load gallery config
require_once __DIR__ . '/../../config/gallery.php';

class GalleryEngine
{
    private string $year;
    private string $album;
    private array $images = [];
    
    /**
     * Constructor
     * 
     * @param string $year Album year (e.g., "2024")
     * @param string $album Album folder name (e.g., "camp")
     */
    public function __construct(string $year, string $album)
    {
        $this->year = $year;
        $this->album = $album;
        $this->loadImages();
    }
    
    /**
     * Load images from directory
     * 
     * @return void
     */
    private function loadImages(): void
    {
        $imagePath = 'images/gallery/' . $this->year . '/' . $this->album . '/';
        $fullPath = BASE_PATH . '/' . $imagePath;
        
        if (!is_dir($fullPath)) {
            return;
        }
        
        $files = scandir($fullPath);
        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'jfif'];
        
        foreach ($files as $file) {
            if ($file === '.' || $file === '..' || $file === 'small') {
                continue;
            }
            
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            
            if (in_array($ext, $imageExtensions)) {
                // Check if thumbnail exists
                $thumbPath = $fullPath . 'small/' . pathinfo($file, PATHINFO_FILENAME) . '.jpeg';
                $hasThumb = file_exists($thumbPath);
                
                $this->images[] = [
                    'filename' => $file,
                    'full' => BASE_URL . '/' . $imagePath . $file,
                    'thumb' => $hasThumb 
                        ? BASE_URL . '/' . $imagePath . 'small/' . pathinfo($file, PATHINFO_FILENAME) . '.jpeg' 
                        : BASE_URL . '/' . $imagePath . $file,
                    'alt' => $this->getTitle() . ' - ' . pathinfo($file, PATHINFO_FILENAME)
                ];
            }
        }
        
        // Sort images by filename
        usort($this->images, function($a, $b) {
            return strnatcmp($a['filename'], $b['filename']);
        });
    }
    
    /**
     * Get album title (from config or folder name)
     * 
     * @return string
     */
    public function getTitle(): string
    {
        return getAlbumName($this->album);
    }
    
    /**
     * Get album description
     * 
     * @return string
     */
    public function getDescription(): string
    {
        return $this->getTitle() . ' - ' . $this->year;
    }
    
    /**
     * Get album date
     * 
     * @return string
     */
    public function getDate(): string
    {
        return $this->year;
    }
    
    /**
     * Get all images
     * 
     * @return array
     */
    public function getImages(): array
    {
        return $this->images;
    }
    
    /**
     * Get image count
     * 
     * @return int
     */
    public function getImageCount(): int
    {
        return count($this->images);
    }
    
    /**
     * Get year
     * 
     * @return string
     */
    public function getYear(): string
    {
        return $this->year;
    }
    
    /**
     * Get album name
     * 
     * @return string
     */
    public function getAlbum(): string
    {
        return $this->album;
    }
    
    /**
     * Get all available years (static method)
     * 
     * @return array
     */
    public static function getAvailableYears(): array
    {
        $galleryPath = BASE_PATH . '/images/gallery/';
        
        if (!is_dir($galleryPath)) {
            return [];
        }
        
        $years = [];
        $dirs = scandir($galleryPath, SCANDIR_SORT_DESCENDING);
        
        foreach ($dirs as $dir) {
            if ($dir === '.' || $dir === '..') {
                continue;
            }
            
            if (is_dir($galleryPath . $dir) && is_numeric($dir)) {
                $years[] = [
                    'year' => $dir,
                    'path' => 'images/gallery/' . $dir,
                    'cover' => self::getYearCoverImage($dir),
                    'albumCount' => self::getAlbumCount($dir)
                ];
            }
        }
        
        return $years;
    }
    
    /**
     * Get all albums for a specific year
     * 
     * @param string|int $year
     * @return array
     */
    public static function getAlbumsForYear(string|int $year): array
    {
        $year = (string)$year;
        $yearPath = BASE_PATH . '/images/gallery/' . $year . '/';
        
        if (!is_dir($yearPath)) {
            return [];
        }
        
        $albums = [];
        $dirs = scandir($yearPath);
        
        foreach ($dirs as $dir) {
            if ($dir === '.' || $dir === '..') {
                continue;
            }
            
            $albumPath = $yearPath . $dir;
            
            if (is_dir($albumPath)) {
                $albums[] = [
                    'folder' => $dir,
                    'name' => getAlbumName($dir),
                    'cover' => self::getAlbumCoverImage($year, $dir),
                    'imageCount' => self::getAlbumImageCount($year, $dir)
                ];
            }
        }
        
        // Sort albums by name
        usort($albums, function($a, $b) {
            return strcmp($a['name'], $b['name']);
        });
        
        return $albums;
    }
    
    /**
     * Get album count for a year
     * 
     * @param string|int $year
     * @return int
     */
    public static function getAlbumCount(string|int $year): int
    {
        $year = (string)$year;
        $yearPath = BASE_PATH . '/images/gallery/' . $year . '/';
        
        if (!is_dir($yearPath)) {
            return 0;
        }
        
        $count = 0;
        $dirs = scandir($yearPath);
        
        foreach ($dirs as $dir) {
            if ($dir === '.' || $dir === '..') {
                continue;
            }
            
            if (is_dir($yearPath . $dir)) {
                $count++;
            }
        }
        
        return $count;
    }
    
    /**
     * Get cover image for a year (first image from first album)
     * 
     * @param string|int $year
     * @return string|null
     */
    public static function getYearCoverImage(string|int $year): ?string
    {
        $year = (string)$year;
        $yearPath = BASE_PATH . '/images/gallery/' . $year . '/';
        
        if (!is_dir($yearPath)) {
            return null;
        }
        
        $dirs = scandir($yearPath);
        
        foreach ($dirs as $dir) {
            if ($dir === '.' || $dir === '..') {
                continue;
            }
            
            if (is_dir($yearPath . $dir)) {
                $cover = self::getAlbumCoverImage($year, $dir);
                if ($cover) {
                    return $cover;
                }
            }
        }
        
        return null;
    }
    
    /**
     * Get cover image for an album (first image)
     * 
     * @param string|int $year
     * @param string $album
     * @return string|null
     */
    public static function getAlbumCoverImage(string|int $year, string $album): ?string
    {
        $year = (string)$year;
        $albumPath = BASE_PATH . '/images/gallery/' . $year . '/' . $album . '/';
        
        if (!is_dir($albumPath)) {
            return null;
        }
        
        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'jfif'];
        $files = scandir($albumPath);
        
        foreach ($files as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }
            
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            
            if (in_array($ext, $imageExtensions)) {
                return BASE_URL . '/images/gallery/' . $year . '/' . $album . '/' . $file;
            }
        }
        
        return null;
    }
    
    /**
     * Get image count for an album
     * 
     * @param string|int $year
     * @param string $album
     * @return int
     */
    public static function getAlbumImageCount(string|int $year, string $album): int
    {
        $year = (string)$year;
        $albumPath = BASE_PATH . '/images/gallery/' . $year . '/' . $album . '/';
        
        if (!is_dir($albumPath)) {
            return 0;
        }
        
        $count = 0;
        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'jfif'];
        $files = scandir($albumPath);
        
        foreach ($files as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }
            
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            
            if (in_array($ext, $imageExtensions)) {
                $count++;
            }
        }
        
        return $count;
    }
}