<?php


namespace Thunderbug\QuakeConnection\Server;

/**
 * Class Colors
 *
 * Colors in a server name are defined by special chars starting with ^ and a number or letter
 *
 * @package Thunderbug\QuakeConnection\Gameserver
 */
class Colors
{
    private static $dark_colors = array(
        0 => "#ffffff", 1 => "#ff0000", 2 => "#00ff00", 3 => "#ffff00",
        4 => "#0000ff", 5 => "#00ffff", 6 => "#ff00ff", 7 => "#ffffff",
        8 => "#ff7f00", 9 => "#7f7f7f", 10 => "#bfbfbf", 11 => "#bfbfbf",
        12 => "#007f00", 13 => "#7f7f00", 14 => "#00007f", 15 => "#7f0000",
        16 => "#7f3f00", 17 => "#ff9919", 18 => "#007f7f", 19 => "#7f007f",
        20 => "#007fff", 21 => "#7f00ff", 22 => "#3399cc", 23 => "#ccffcc",
        24 => "#006633", 25 => "#ff0033", 26 => "#b21919", 27 => "#993300",
        28 => "#cc9933", 29 => "#999933", 30 => "#ffffbf", 31 => "#ffff7f");

    private static $light_colors = array(
        0 => "#000000", 1 => "#ff0000", 2 => "#00ff00", 3 => "#ffe100",
        4 => "#0000ff", 5 => "#00ffff", 6 => "#ff00ff", 7 => "#000000",
        8 => "#ff7f00", 9 => "#7f7f7f", 10 => "#bfbfbf", 11 => "#bfbfbf",
        12 => "#007f00", 13 => "#7f7f00", 14 => "#00007f", 15 => "#7f0000",
        16 => "#7f3f00", 17 => "#ff9919", 18 => "#007f7f", 19 => "#7f007f",
        20 => "#007fff", 21 => "#7f00ff", 22 => "#3399cc", 23 => "#ccffcc",
        24 => "#006633", 25 => "#ff0033", 26 => "#b21919", 27 => "#993300",
        28 => "#cc9933", 29 => "#999933", 30 => "#ffffbf", 31 => "#ffff7f");

    /**
     * Replace Color q3 tags to HTML Colors
     * @param string $text Text with q3 colors
     * @param ColorType $colorType
     * @return string Text with HTML Colors
     */
    public static function colorize(string $text, ColorType $colorType = null): string
    {
        switch ($colorType) {
            case ColorType::LIGHT:
                $colors = self::$light_colors;
                break;
            case ColorType::DARK:
            default:
                $colors = self::$dark_colors;
                break;
        }


        $currentColor = -1;
        $nextColor = 7;

        $buffer = "";
        for ($x = 0; $x < strlen($text); $x++) {
            if ($text[$x] == '^' && $text[$x + 1] != '^') {
                $nextColor = (ord($text[$x + 1]) + 16) & 31;
                $x++;
                continue;
            }
            if ($currentColor != $nextColor) {
                if ($currentColor != -1) {
                    $buffer .= "</span>";
                }
                $currentColor = $nextColor;
                $buffer .= sprintf("<span style=\"color: %s;\">", $colors[$currentColor]);
            }
            $buffer .= htmlspecialchars($text[$x]);
        }

        if ($currentColor != -1) {
            $buffer .= "</span>";
        }

        return $buffer;
    }

    /**
     * Remove colors from a text
     * @param $text string text
     * @return string Colorless text
     */
    public static function removeColors(string $text): string
    {
        return preg_replace('|\^.|', "", $text);
    }
}