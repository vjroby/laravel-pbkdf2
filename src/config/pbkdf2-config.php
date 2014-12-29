<?php
/**
 * Configuration settings for PBKDF2 package
 */
return [
    /**
     * Hashing Algorithm
     * if is not se properly it will throw an error
     */
    'hash_algorithm'  => 'sha256',

    /**
     * Number of iterations... bigger is better :)
     */
    'iterations'      => 10000,

    /**
     * Number of bytes for the salt
     */
    'salt_bytes'      => 32,

    /**
     * Number of bytes for the hash
     */
    'hash_bytes'      => 64,
];