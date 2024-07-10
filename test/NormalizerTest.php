<?php

namespace multidialogo\test\LineEndingNormalizer;

use multidialogo\LineEndingNormalizer\Normalizer;
use PHPUnit\Framework\TestCase;

class NormalizerTest extends TestCase
{
    /**
     * @dataProvider provideData
     */
    public function testNormalizeFileContentsAndReturnFilePath(string $caseName, bool $override): void
    {
        static::assertFileEquals(
            __DIR__ . "/fixtures/output/{$caseName}.txt",
            Normalizer::normalizeFileContentsAndReturnFilePath(__DIR__ . "/fixtures/input/{$caseName}.txt", $override),
            "{$caseName} failed"
        );
    }

    public function provideData(): array
    {
        return [
            ['carriage.return', false],
            ['line.feed', false],
            ['carriage.return.line.feed', false],
            ['next.line', false],
            ['vertical.tab', false],
            ['form.feed', false],
            ['line.separator', false],
            ['paragraph.separator', false],
        ];
    }
}