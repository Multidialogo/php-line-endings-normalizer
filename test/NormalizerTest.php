<?php

namespace multidialogo\test\LineEndingNormalizer;

use multidialogo\LineEndingNormalizer\Normalizer;
use PHPUnit\Framework\TestCase;

class NormalizerTest extends TestCase
{

    /**
     * @dataProvider provideNormalizeCases
     */
    public function testNormalize($caseName, $input): void
    {
        static::assertEquals(
            static::getTokenizedText(PHP_EOL),
            Normalizer::normalize($input),
            "{$caseName} failed"
        );
    }

    public function provideNormalizeCases(): array
    {
        $inputs = [];
        foreach (Normalizer::HEX_MAP as $label => $hexValue) {
            $inputs[] = [
                str_replace('_', ' ', $label),
                static::getTokenizedText($hexValue)
            ];
        }

        return $inputs;
    }

    private function getTokenizedText(string $hexValue): string
    {
        return "This is{$hexValue}a simply{$hexValue}{$hexValue}test on new lines{$hexValue}...thanks{$hexValue}";
    }
}