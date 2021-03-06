<?php

namespace Core\system\models;

class View
{
    public string $templatesPath;
    public string $baseTemplate;
    public string $requiredView;
    public array $requiredParameters;
    public array $defaultParameters;

    public function __construct($templatesPath, $baseTemplate, $defaultParameters = [])
    {
        $this->templatesPath = $templatesPath;
        $this->baseTemplate = $baseTemplate;
        $this->defaultParameters = $defaultParameters;
        $this->requiredView = '';
    }

    public function renderDefaultLayout()
    {
        $content = null;
        if ($this->requiredView != '') {
            $content = file_get_contents($this->requiredView);
            foreach ($this->requiredParameters as $key => $parameter) {
                $content = str_replace('{' . $key . '}', $parameter, $content);
            }
        }
        include $this->templatesPath . $this->baseTemplate;
    }

    public function render(string $viewPath, array $parameters = [])
    {
        if (!file_exists($viewPath)) {
            die('Sorry, but render file missing. Path: ' . $viewPath);
        }
        $this->requiredView = $viewPath;
        $this->requiredParameters = $parameters;
    }

    public function getViewContent(string $viewPath, array $parameters = [])
    {
        if(file_exists($viewPath)) {
            $content = file_get_contents($viewPath);
            foreach ($parameters as $key => $parameter) {
                $content = str_replace('{' . $key . '}', $parameter, $content);
            }
            return $content;
        }
        return 'File not found';
    }

    public function getViewContentArray(string $viewPath, array $items) {
        if(file_exists($viewPath)) {
            $globalContent = '';
            foreach ($items as $key => $parameter) {
                $content = file_get_contents($viewPath);
                foreach ($parameter as $itemKey => $itemParameter) {
                    $content = str_replace('{' . $itemKey . '}', $itemParameter, $content);
                }
                $globalContent .= $content;
            }
            return $globalContent;
        }
        return 'File not found';
    }
}