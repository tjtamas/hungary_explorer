<?php
declare(strict_types=1);

/**
 * TemplateEngine - SOLID PHP Template System
 * 
 * Single Responsibility: Renders PHP template files with data
 * Open/Closed: Extendable via inheritance
 * Liskov Substitution: Can be replaced with any compatible renderer
 * Interface Segregation: Minimal public API
 * Dependency Inversion: Depends on abstractions (array data)
 * 
 * @package MagyarorszagFelfedezoi
 * @author Tóth Tamás
 * @version 1.0.0
 */
class TemplateEngine
{
    private string $templatePath;
    private array $data = [];
    private array $globals = [];
    
    /**
     * Constructor
     * 
     * @param string $path Base path for template files
     */
    public function __construct(string $path = 'templates/')
    {
         // Ha nem abszolút útvonal, akkor BASE_PATH-hoz adjuk
    if ($path[0] !== '/' && strpos($path, ':') === false) {
        $path = BASE_PATH . '/' . $path;
    }
    $this->templatePath = rtrim($path, '/') . '/';
    }
    
    /**
     * Set a template variable
     * 
     * @param string $key Variable name
     * @param mixed $value Variable value
     * @return self For method chaining
     */
    public function set(string $key, mixed $value): self
    {
        $this->data[$key] = $value;
        return $this;
    }
    
    /**
     * Set multiple variables at once
     * 
     * @param array $data Associative array of variables
     * @return self For method chaining
     */
    public function setMultiple(array $data): self
    {
        $this->data = array_merge($this->data, $data);
        return $this;
    }
    
    /**
     * Set a global variable (available in all templates)
     * 
     * @param string $key Variable name
     * @param mixed $value Variable value
     * @return self For method chaining
     */
    public function setGlobal(string $key, mixed $value): self
    {
        $this->globals[$key] = $value;
        return $this;
    }
    
    /**
     * Get a template variable
     * 
     * @param string $key Variable name
     * @param mixed $default Default value if not found
     * @return mixed
     */
    public function get(string $key, mixed $default = null): mixed
    {
        return $this->data[$key] ?? $default;
    }
    
    /**
     * Check if a variable exists
     * 
     * @param string $key Variable name
     * @return bool
     */
    public function has(string $key): bool
    {
        return isset($this->data[$key]);
    }
    
    /**
     * Render a template file
     * 
     * @param string $template Template filename (without .php extension)
     * @return void
     * @throws RuntimeException If template file not found
     */
    public function render(string $template): void
    {
        $file = $this->templatePath . $template . '.php';
        
        if (!file_exists($file)) {
            throw new RuntimeException("Template not found: {$template} (looked in: {$file})");
        }
        
        // Extract data and globals into current scope
        extract($this->globals);
        extract($this->data);
        
        // Include the template file
        include $file;
        
        // Clear template-specific data after rendering
        $this->data = [];
    }
    
    /**
     * Render a template and return as string
     * 
     * @param string $template Template filename
     * @return string Rendered content
     */
    public function renderToString(string $template): string
    {
        ob_start();
        try {
            $this->render($template);
            return ob_get_clean();
        } catch (\Exception $e) {
            ob_end_clean();
            throw $e;
        }
    }
    
    /**
     * Escape HTML output (XSS protection)
     * 
     * @param mixed $value Value to escape
     * @return string
     */
    public function escape(mixed $value): string
    {
        if ($value === null) {
            return '';
        }
        return htmlspecialchars((string)$value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }
    
    /**
     * Shorthand for escape (use in templates)
     * 
     * @param mixed $value Value to escape
     * @return string
     */
    public function e(mixed $value): string
    {
        return $this->escape($value);
    }
    
    /**
     * Set the template path
     * 
     * @param string $path New template path
     * @return self
     */
    public function setTemplatePath(string $path): self
    {
        $this->templatePath = rtrim($path, '/') . '/';
        return $this;
    }
    
    /**
     * Get the current template path
     * 
     * @return string
     */
    public function getTemplatePath(): string
    {
        return $this->templatePath;
    }
    
    /**
     * Clear all template data
     * 
     * @return self
     */
    public function clear(): self
    {
        $this->data = [];
        return $this;
    }
    
    /**
     * Clear all global data
     * 
     * @return self
     */
    public function clearGlobals(): self
    {
        $this->globals = [];
        return $this;
    }
}