<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Tiquette\Domain;

interface PasswordEncoder
{
    public function encode(string $password, string $salt): EncodedPassword;
}
