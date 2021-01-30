<?php

namespace PierreMiniggio\SimpleCrypter;

class SimpleCrypter implements Crypter
{
    
    private string $ciphering = 'AES-128-CTR';
    private string $encryptionIV = '1234567891011121';
    private int $options = 0;

    public function __construct(private string $encryptionKey)
    {}

    /**
     * @throws InvalidArgumentException
     */
    public function crypt(string $string): string
    {
        if ($string === '') {
            throw new InvalidArgumentException();
        }

        return urlencode(base64_encode(openssl_encrypt(
            $string,
            $this->ciphering,
            $this->encryptionKey,
            $this->options,
            $this->encryptionIV
        )));
    }

    /**
     * @throws BadEncodedStringException
     * @throws InvalidArgumentException
     */
    public function decrypt(string $string): string
    {
        if ($string === '') {
            throw new InvalidArgumentException();
        }

        $raw = openssl_decrypt(
            base64_decode(urldecode($string)),
            $this->ciphering,
            $this->encryptionKey,
            $this->options,
            $this->encryptionIV
        );

        if ($raw === '') {
            throw new BadEncodedStringException();
        }

        return $raw;
    }
}
