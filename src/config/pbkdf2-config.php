<?php
/**
 * Configuration settings for PBKDF2 package
 */
return [
  'pbkdf2' => [
      'hash_algorithm'  => 'sha256',
      'iterations'      => 10000,
      'salt_bytes'      => 32,
      'hash_bytes'      => 32,
  ]
];