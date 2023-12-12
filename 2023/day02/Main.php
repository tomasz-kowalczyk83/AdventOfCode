<?php

declare(strict_types=1);

$games = array_map(
    fn($string) => explode(":", trim($string)),
    file(__DIR__.'/input.txt')
);

$possibleGamesSumOfIDs = array_reduce($games, function ($sumOfIDs, $gameset) {
    [$gameString, $subsetsString] = $gameset;
    
    $subsetsList = explode(";", $subsetsString);

    $filtered = array_filter($subsetsList, function($subset) {
        $original = explode(",", trim($subset));

        $filtered = array_filter($original, function ($item) {
            $input = [
                'red' => 12,
                'green' => 13,
                'blue' => 14
            ];

            [$quantity, $color] = explode(" ", trim($item));
        
            return $quantity <= $input[trim($color)];
        });
        
        return count($filtered) === count($original);
    });
    
    $gameId = preg_replace('/[^0-9]/', '', $gameString);

    var_dump(count($filtered) === count($subsetsList), $gameId);
    return count($filtered) === count($subsetsList) ? $sumOfIDs + $gameId: $sumOfIDs;
}, 0);

var_dump($possibleGamesSumOfIDs);