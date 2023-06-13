<?php

namespace Core\HTML;

class BootstrapForm extends Form
{

    protected function surround($html): string
    {
        return "<div class=\"form-group\">{$html}</div>";
    }

    public function input($name, $label, $option = []): string
    {
        $type = $option['type'] ?? 'text';
        $label = '<label>' . $label . '</label>';
        if ($type === 'textarea') {
            $input = '<textarea name="' . $name . '" class="form-control">' . $this->getValue($name) . '</textarea>';
        } else {
            $input = '<input type="' . $type . '" name="' . $name . '" value="' . $this->getValue($name) . '" class="form-control">';
        }
        return $this->surround($label . $input);
    }

    public function submit(): string
    {
        return $this->surround('<button type="submit" class="btn btn-primary">Envoyer</button>');
    }

    public function select($name, $label, $option): string
    {
        $label = '<label>' . $label . '</label>';
        $input = '<select class="form-control" name="' . $name . '">';
        foreach ($option as $key => $value) {
            $attributes = '';
            if($key === $this->getValue($name)){
                $attributes = 'selected';
            }
            $input .= "<option value='$key' $attributes>$value</option>";
        }
        $input .= '</select>';
        return $this->surround($label . $input);
    }
}