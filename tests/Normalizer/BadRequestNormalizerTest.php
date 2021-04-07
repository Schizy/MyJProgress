<?php

namespace App\Tests\Normalizer;

use App\Normalizer\BadRequestNormalizer;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;

class BadRequestNormalizerTest extends TestCase
{
    private BadRequestNormalizer $subject;

    public function setUp(): void
    {
        $this->subject = new BadRequestNormalizer();
    }

    public function testSupportsNormalization(): void
    {
        $this->assertFalse($this->subject->supportsNormalization(new \Stdclass()));
        $this->assertTrue($this->subject->supportsNormalization(new ConstraintViolationList()));
    }

    public function testNormalize()
    {
        $result = $this->subject->normalize([]);
        $this->assertCount(1, $result);
        $this->assertSame(400, $result['status']);

        $error = $this->createStub(ConstraintViolation::class);
        $error->method('getPropertyPath')->willReturn('propertyName');
        $error->method('getMessage')->willReturn('some reason');

        $result = $this->subject->normalize((new ConstraintViolationList([$error])));

        $this->assertCount(2, $result);
        $this->assertCount(1, $result['errors']);
        $this->assertSame('some reason', $result['errors'][0]['message']);
        $this->assertSame('propertyName', $result['errors'][0]['property']);
    }
}
