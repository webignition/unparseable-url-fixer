<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\UnparseableUrlFixer\Tests;

use webignition\UnparseableUrlFixer\UnparseableUrlFixer;

class UnparseableUrlFixerTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var UnparseableUrlFixer
     */
    private $fixer;

    protected function setUp()
    {
        parent::setUp();

        $this->fixer = new UnparseableUrlFixer();
    }

    /**
     * @dataProvider fixTripleSlashesAfterSchemeDataProvider
     */
    public function testFix(string $url, string $expectedFixedUrl)
    {
        $fixedUrl = $this->fixer->fix($url);

        $this->assertEquals($expectedFixedUrl, $fixedUrl);
    }

    public function fixTripleSlashesAfterSchemeDataProvider(): array
    {
        return [
            'fix triple slashes: no triple slashes' => [
                'url' => 'http://example.com/',
                'expectedFixedUrl' => 'http://example.com/',
            ],
            'fix triple slashes: http:///' => [
                'url' => 'http:///example.com/',
                'expectedFixedUrl' => 'http://example.com/',
            ],
            'fix triple slashes: https:///' => [
                'url' => 'https:///example.com/',
                'expectedFixedUrl' => 'https://example.com/',
            ],
            'fix triple slashes: ftp:///' => [
                'url' => 'ftp:///example.com/',
                'expectedFixedUrl' => 'ftp://example.com/',
            ],
        ];
    }
}
