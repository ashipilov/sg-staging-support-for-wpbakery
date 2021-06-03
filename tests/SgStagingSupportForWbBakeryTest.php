<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

require_once('plugin/SgStagingSupportForWbBakery.php');

final class SgStagingSupportForWbBakeryTest extends TestCase
{
    public function testConstructor(): void
    {
        $this->assertInstanceOf(
            SgStagingSupportForWbBakery::class,
            new SgStagingSupportForWbBakery('https://example.com')
        );
    }

    /**
     * @dataProvider stageData
     */
    public function testStage($homeUrl, $content, $expected): void
    {
        $subject = new SgStagingSupportForWbBakery($homeUrl);
        $result = $subject -> stage($content);
        $this->assertSame($expected, $result);
    }

    public function stageData(): array
    {
        return [
            ['https://example.com', 'whatever https%3A%2F%2Fexample.com something', 'whatever https%3A%2F%2Fexample.com something'],
            ['https://staging55.example.com', 'whatever https%3A%2F%2Fexample.com something', 'whatever https%3A%2F%2Fstaging55.example.com something'],
            ['https://staging55.example.com', 'whatever http%3A%2F%2Fexample.com something', 'whatever http%3A%2F%2Fstaging55.example.com something'],
        ];
    }

    /**
     * @dataProvider unStageData
     */
    public function testUnStage($homeUrl, $content, $expected): void
    {
        $subject = new SgStagingSupportForWbBakery($homeUrl);
        $result = $subject -> unStage($content);
        $this->assertSame($expected, $result);
    }

    public function unStageData(): array
    {
        return [
            ['https://example.com', 'whatever https%3A%2F%2Fexample.com something', 'whatever https%3A%2F%2Fexample.com something'],
            ['https://staging55.example.com', 'whatever https%3A%2F%2Fstaging55.example.com something', 'whatever https%3A%2F%2Fexample.com something'],
            ['https://staging55.example.com', 'whatever http%3A%2F%2Fstaging55.example.com something', 'whatever http%3A%2F%2Fexample.com something'],
        ];
    }
}