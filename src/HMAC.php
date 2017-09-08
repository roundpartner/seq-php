<?php

namespace RoundPartner\Seq;

class HMAC
{
    const DEFAULT_ALGO = 'sha256';

    /**
     * @var string
     */
    protected $key;

    /**
     * @var string
     */
    protected $algo;

    /**
     * @param string $key
     */
    public function __construct($key)
    {
        $this->key = $key;
        $this->algo = self::DEFAULT_ALGO;
    }

    /**
     * @param string $data
     *
     * @return string
     */
    public function generate($data)
    {
        return base64_encode(hash_hmac($this->algo, $data, $this->key, true));
    }

    /**
     * @param string $data
     * @param string $hash
     *
     * @return bool
     */
    public function validate($data, $hash)
    {
        $digest = $this->generate($data);
        return hash_equals($digest, $hash);
    }
}
