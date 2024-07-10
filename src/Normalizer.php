<?php

namespace multidialogo\LineEndingNormalizer;


class Normalizer
{
    # ORDER IS IMPORTANT, carriage return + line feed must be evaluated before carriage return and line feed
    public const HEX_MAP = [
            '1.carriage_return_line_feed' => "\x0A \x0D",
            '2.carriage_return' => "\x0D",
            '3.line_feed' => "\x0A",
            '4.next_line' => "\x85",
            '5.vertical_tab' => "\x0B",
            '6.form_feed' => "\x0C",
            '7.line_separator' => "\xE2\x80\xA8",
            '8.paragraph_separator' => "\xE2\x80\xA9",
        ];
    public static function normalize(string $input): string
    {
        foreach (static::HEX_MAP as $hexValue) {
            $input = str_ireplace("{$hexValue}", PHP_EOL, $input);
        }

        return $input;
    }

    public static function normalizeFileContentsAndReturnFilePath(string $filePath, bool $override = false): string
    {
        $normalizedFileContent = static::normalize(file_get_contents($filePath));

        if (!$override) {
            $filePath = sys_get_temp_dir() . '/' . uniqid() . '_' . basename($filePath);
        }

        file_put_contents($filePath, $normalizedFileContent);

        return $filePath;
    }
}
