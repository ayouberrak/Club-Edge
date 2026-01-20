<?php

namespace Core;

class Helpers
{
    public static function url($path = '')
    {
        $scriptName = $_SERVER['SCRIPT_NAME'];
        $dir = dirname($scriptName);
        $dir = str_replace('\\', '/', $dir);
        
        // Remove /public if we are using the root redirection
        $dir = str_replace('/public', '', $dir);
        
        if ($dir === '/') $dir = '';
        
        return $dir . ($path ? '/' . ltrim($path, '/') : '');
    }
}