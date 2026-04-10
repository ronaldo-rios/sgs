<?php

namespace Core;

use Core\Config;
use Core\SlugControllerOrMethod;

class ConfigController 
{
    private const MAX_ROUTE_PATH_LENGTH = 512;

    private ?string $url;
    private array $urlArray;
    private string $urlController;
    private string $urlMethod;
    private string $urlParameter;
    private array $format;

    public function __construct()
    {
        $route = $this->routePathFromRequest();

        if ($route !== null && $route !== '') {
            $this->url = $route;
            $this->clearUrl();
            $this->urlArray = explode('/', $this->url);

            isset($this->urlArray[0]) 
                ? $this->urlController = SlugControllerOrMethod::slugController($this->urlArray[0])
                : $this->urlController = SlugControllerOrMethod::slugController(Config::CONTROLLER);

            isset($this->urlArray[1]) 
                ? $this->urlMethod = SlugControllerOrMethod::slugMethod($this->urlArray[1])
                : $this->urlMethod = SlugControllerOrMethod::slugMethod(Config::METHOD);

            isset($this->urlArray[2]) 
                ? $this->urlParameter = $this->urlArray[2]
                : $this->urlParameter = '';
        }
        else {
            $this->urlController = SlugControllerOrMethod::slugController(Config::CONTROLLER_ERROR);
            $this->urlMethod = SlugControllerOrMethod::slugMethod(Config::METHOD);
            $this->urlParameter = '';
        }
    }

    private function routePathFromRequest(): ?string
    {
        $path = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);
        if (! is_string($path)) {
            return null;
        }

        $path = trim($path, '/');

        if ($path === '' || strcasecmp($path, 'index.php') === 0) {
            return null;
        }

        if (strlen($path) > self::MAX_ROUTE_PATH_LENGTH) {
            return null;
        }

        if (str_contains($path, "\0")) {
            return null;
        }

        if (str_contains(rawurldecode($path), '..')) {
            return null;
        }

        return $path;
    }

    public function loadPage(): void
    {
        LoadPageLevels::load($this->urlController, $this->urlMethod, $this->urlParameter);
    }

    /**
     * This method is responsible for cleaning the URL:
     * @return void
     */
    private function clearUrl(): void
    {
        $this->url = strip_tags($this->url);
        $this->url = trim($this->url);
        $this->url = rtrim($this->url, '/');
        $this->format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:.,\\\'<>°ºª ';
        $this->format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr------------------------------------
        -------------------------------------------------------------';
        $this->url = strtr(
            mb_convert_encoding($this->url, 'ISO-8859-1', 'UTF-8'), 
            mb_convert_encoding($this->format['a'], 'ISO-8859-1', 'UTF-8'), 
            $this->format['b']
        );
    }

}