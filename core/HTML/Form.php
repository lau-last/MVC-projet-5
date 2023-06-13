<?php

namespace Core\HTML;

class Form
{
    protected $data;
    public string $surround = 'p';

    public function __construct($data)
    {
        $this->data = $data;
    }

    protected function surround($html): string
    {
        return "<div class=\"form-group\">{$html}</div>";
    }

    protected function getValue($index)
    {
        if(is_object($this->data)){
            return $this->data->$index;
        }
        return $this->data[$index] ?? null;
    }


    public function submit(): string
    {
        return $this->surround('<button type="submit">Envoyer</button>');
    }

    public function input($name, $label, $option = []): string
    {
        $type = $option['type'] ?? 'text';
        return $this->surround('<label>' . $name . '</label><input type="text" name="' . $name . '" value="' . $this->getValue($name) . '" class="form-control">');
    }

}