<?php
//REFER TO README.rtf for more PHP information

function translate($question = "")
{
    preg_match(
        "/What is (-?\d+) (plus|minus|multiplied by|divided by|) "
        . "(-?\d+)(?: (plus|minus|multiplied by|divided by|) (-?\d+))?\?/",
        $question,
        $matches
    );

    if (empty($matches[2])) {
        throw new InvalidArgumentException();
    }

    //switch case, remember to break and set defaut
    switch ($matches[2]) {
        case 'plus':
            $numberValue = $matches[1] + $matches[3];
            break;
        case 'minus':
            $numberValue = $matches[1] - $matches[3];
            break;
        case 'multiplied by':
            $numberValue = $matches[1] * $matches[3];
            break;
        case 'divided by':
            $numberValue = $matches[1] / $matches[3];
            break;
        default:
            $numberValue = 0;
    }

    if (isset($matches[4]) && isset($matches[5])) {
        switch ($matches[4]) {
            case 'plus':
                $numberValue += $matches[5];
                break;
            case 'minus':
                $numberValue -= $matches[5];
                break;
            case 'multiplied by':
                $numberValue *= $matches[5];
                break;
            case 'divided by':
                $numberValue /= $matches[5];
                break;
        }
    }

    return $numberValue;
}