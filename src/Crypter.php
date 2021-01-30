<?php

namespace PierreMiniggio\SimpleCrypter;

interface Crypter
{
    public function crypt(string $string): string;
    public function decrypt(string $string): string;
}
