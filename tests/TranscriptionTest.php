<?php
namespace Tests;

use Laracasts\Transcriptions\Line;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Laracasts\Transcriptions\Transcription;

class TranscriptionTest extends TestCase
{
    protected Transcription $transcription;
    protected function setUp(): void
    {
        $this->transcription = Transcription::load(
            __DIR__ . '/stubs/basic-example.vtt'
        );
    }

    #[Test]
    function it_load_a_vtt_file()
    {
        $this->assertStringContainsString('Here is a', $this->transcription);
        $this->assertStringContainsString('example of a VTT file', $this->transcription);
    }

    #[Test]
    function it_can_convert_to_an_array_of_line_objects()
    {
        $lines = $this->transcription->lines();

        $this->assertCount(2, $lines);
        $this->assertContainsOnlyInstancesOf(Line::class, $lines);
    }
    
    #[Test]
    public function it_discard_irrelevant_lines_from_the_vtt_file()
    {

        $this->assertStringNotContainsString("WEBVTT", $this->transcription);
        $this->assertCount(2, $this->transcription->lines());
    }

    #[Test]
    public function it_renders_the_lines_as_html()
    {
        $expected = <<<EOT
            <a href="?time=00:03">Here is a,</a>
            <a href="?time=00:04">example of a VTT file.</a>
            EOT;

        $this->assertEquals($expected, $this->transcription->lines()->asHtml());
    }
}