<?php
/**
 * Created by PhpStorm.
 * User: pprusek
 * Date: 13.11.19
 * Time: 14:41
 */

namespace App\Security\Encoder;

use Symfony\Component\Security\Core\Encoder\BasePasswordEncoder;
use Symfony\Component\Security\Core\Encoder\EncoderAwareInterface;

class PlainPasswordEncoder extends BasePasswordEncoder
{
    public function encodePassword($raw, $salt){
        return $raw;
    }

    public function isPasswordValid($encoded, $raw, $salt){
        return $encoded === $raw;
    }
}