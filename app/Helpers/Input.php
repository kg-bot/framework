<?php

namespace App\Helpers;

class Input
{
    /**
     * Method used to sanitaze HTTP arguments, to prevent XSS attack
     * 
     * @return array Array of sanitazed arguments
     */
    public static function getArguments(array $arguments)
    {
        $sanitazed = [];

        foreach ($arguments as $argument) {
            array_push($sanitazed, htmlspecialchars($argument, ENT_QUOTES, 'UTF-8'));
        }

        // We skip first two items because those are controller and method
        return array_slice($sanitazed, 2);
    }
}