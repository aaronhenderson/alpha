<?php

class Template
{
    /**
     * Base directory to look for templates under
     */
    const TEMPLATE_DIRECTORY = '../templates/';

    /**
     * The HTML as a string
     *
     * @var string
     */
    private $html;

    /**
     * Template constructor.
     *
     * @param string $template
     * @throws Exception
     */
    public function __construct($template)
    {
        if(false === is_string($template)){
            throw new Exception('Bad template parameter. Expects parameter of type "string".');
        }

        $template_path = self::TEMPLATE_DIRECTORY . $template;

        if(false === file_exists($template_path)){
            throw new Exception('Template not found with path: "' . $template_path . '".');
        }
    
        $this->html = file_get_contents($template_path);
    }

    /**
     * Append some HTML to the template
     *
     * @param string $html
     */
    public function append($html)
    {
        $this->html .= $html;
    }

    /**
     * Prepend some HTML to the template
     *
     * @param string $html
     */
    public function prepend($html)
    {
        $this->html = $html . $this->html;
    }

    /**
     * Return the template HTML
     *
     * @return string
     */
    public function get()
    {
        return $this->html;
    }
}