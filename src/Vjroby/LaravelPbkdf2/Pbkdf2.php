<?php
/**
 * Created by PhpStorm.
 * User: Robert Gabriel Dinu
 * Date: 12/29/14
 * Time: 12:05
 */

namespace Vjroby\LaravelPbkdf2;


class Pbkdf2 {

    const PBKDF2_HASH_ALGORITHM = 'sha256';

    const PBKDF2_ITERATIONS = 1000;

    const PBKDF2_SALT_BYTES = 32;

    const PBKDF2_HASH_BYTES = 32;

    /**
     * creates random salt
     *
     * @return string
     */
    public function createSalt(){
        return base64_encode(mcrypt_create_iv(self::PBKDF2_SALT_BYTES, MCRYPT_DEV_URANDOM));
    }

} // end of class