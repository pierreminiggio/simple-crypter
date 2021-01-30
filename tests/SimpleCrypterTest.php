<?php

namespace PierreMiniggio\SimpleCrypterTest;

use PHPUnit\Framework\TestCase;
use PierreMiniggio\SimpleCrypter\BadEncodedStringException;
use PierreMiniggio\SimpleCrypter\InvalidArgumentException;
use PierreMiniggio\SimpleCrypter\SimpleCrypter;

class SimpleCrypterTest extends TestCase
{
    public function testBothWays(): void
    {

        $tests = [
            1 => 'bnc9PQ%3D%3D',
            2 => 'bkE9PQ%3D%3D',
            3 => 'blE9PQ%3D%3D',
            'a' => 'enc9PQ%3D%3D',
            'b' => 'ekE9PQ%3D%3D',
            'c' => 'elE9PQ%3D%3D',
            'ab' => 'endVPQ%3D%3D',
            'bb' => 'ekFVPQ%3D%3D',
            'cb' => 'elFVPQ%3D%3D',
            'aab' => 'endZTw%3D%3D',
            'abb' => 'endVTw%3D%3D',
            'acb' => 'endRTw%3D%3D',
        ];

        $crypter = new SimpleCrypter('some key');
        foreach ($tests as $raw => $crypted) {
            $this->assertSame($crypted, $crypter->crypt($raw));
            $this->assertSame((string) $raw, $crypter->decrypt($crypted));
        }
    }

    public function testEmptyStringToEncode(): void
    {
        $crypter = new SimpleCrypter('some key');
        $this->expectException(InvalidArgumentException::class);
        $crypter->crypt('');
    }

    public function testEmptyStringToDecode(): void
    {
        $crypter = new SimpleCrypter('some key');
        $this->expectException(InvalidArgumentException::class);
        $crypter->decrypt('');
    }

    public function testBadStringToDecode(): void
    {
        $crypter = new SimpleCrypter('some key');
        $this->expectException(BadEncodedStringException::class);
        $crypter->decrypt('test');
    }
}
