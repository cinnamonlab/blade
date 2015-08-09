<?php
namespace Framework\Blade;

class Helper
{
    static function starts_with($haystack, $needles) {
        foreach ((array) $needles as $needle) {
            if (strpos($haystack, $needle) === 0) return true;
        }
        return false;
    }

    static function view($view, $data = array()){
        return Laravel\View::make($view, $data);
    }

    static function str_contains($haystack, $needle) {
        foreach ((array) $needle as $n) {
            if (strpos($haystack, $n) !== false) return true;
        }
        return false;
    }
}