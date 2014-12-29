<?php


namespace Vjroby\LaravelPbkdf2;


class Pbkdf2 {

    /**
     * @var string
     */
    protected $hashAlgorithm = 'sha256';

    /**
     * @var int
     */
    protected $iterations = 1000;

    /**
     * @var int
     */
    protected $saltBytes = 32;

    /**
     * @var int
     */
    protected $hashBytes = 64;

    public function __construct($options = []){
        // it can pe used with the default
        if (count($options) != 0){
            if (array_key_exists('hash_algorithm', $options)) {
                $this->hashAlgorithm = $options['hash_algorithm'];
            }

            if (array_key_exists('iterations', $options)) {
                $this->iterations = $options['iterations'];
            }

            if (array_key_exists('salt_bytes', $options)) {
                $this->saltBytes = $options['salt_bytes'];
            }
            if (array_key_exists('hash_bytes', $options)) {
                $this->hashBytes = $options['hash_bytes'];
            }
        }
    }


    public function createHash($password, $salt){
        return $this->pbkdf2(
            $this->hashAlgorithm,
            $password,
            $salt,
            $this->iterations,
            $this->hashBytes
        );
    }

    /**
     * @param $safePassword
     * @param $safeSalt
     * @param $input
     * @return bool
     */
    public function passwordValidation($safePassword, $safeSalt, $input){

        $inputHash = $this->pbkdf2(
            $this->hashAlgorithm,
            $input,
            $safeSalt,
            $this->iterations,
            strlen($safePassword)
        );
        
        return $this->safeEquals($inputHash, $safePassword);
    }

    /**
     * @param $safeHash
     * @param $inputHash
     * @return bool
     */
    public function safeEquals($safeHash, $inputHash){
        // Prevent issues if string length is 0

        $safeHash .= chr(0);
        $inputHash .= chr(0);

        $safeLen = strlen($safeHash);
        $inputLen = strlen($inputHash);

        // Set the result to the difference between the lengths
        $result = $safeLen - $inputLen;

        // Note that we ALWAYS iterate over the user-supplied length
        // This is to prevent leaking length information
        for ($i = 0; $i < $inputLen; $i++) {
            // Using % here is a trick to prevent notices
            // It's safe, since if the lengths are different
            // $result is already non-0
            $result |= (ord($safeHash[$i % $safeLen]) ^ ord($inputHash[$i]));
        }

        // They are only identical strings if $result is exactly 0...
        return $result === 0;
    }

    /**
     * @param $algorithm
     * @param $password
     * @param $salt
     * @param $iterrations
     * @param $keySize
     * @return mixed
     */
    public function pbkdf2($algorithm, $password, $salt, $iterrations, $keySize){

        $hashingAlgorithm = strtolower($algorithm);

        if (!in_array($hashingAlgorithm, hash_algos(), true)){
            throw new \RuntimeException('Hashing algorithm is invalid.');
        }

        if ($iterrations <= 0 || $keySize <=0){
            throw new \InvalidArgumentException('Iterrations and key size must pe positive integers');
        }

        return hash_pbkdf2($hashingAlgorithm, $password, $salt, $iterrations, $keySize);

    }

    /**
     * creates random salt
     *
     * @return string
     */
    public function createSalt(){
        return base64_encode(mcrypt_create_iv($this->saltBytes, MCRYPT_DEV_URANDOM));
    }

} // end of class