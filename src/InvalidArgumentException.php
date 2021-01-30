<?php

namespace PierreMiniggio\SimpleCrypter;

class InvalidArgumentException extends \InvalidArgumentException implements CrypterException
{

    public function __construct()
    {
        parent::__construct('Input string can\'t be empty');
    }
}
