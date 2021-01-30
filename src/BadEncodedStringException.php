<?php

namespace PierreMiniggio\SimpleCrypter;

use Exception;

class BadEncodedStringException extends Exception implements CrypterException
{
    
    public function __construct()
    {
        parent::__construct('This string wasn\'t crypted using this crypter');
    }
}
