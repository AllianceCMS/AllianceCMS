<?php
namespace Acms\Core\Data;

class Security
{
    public function randomBlowfishSalt()
    {
        return sprintf('$2y$%02d$', 12).substr(str_replace('+', '.', base64_encode(pack('N4', mt_rand(), mt_rand(), mt_rand(), mt_rand()))), 0, 22).'$';
    }

    /*
    public function generateToken($length = 128)
    {
        $chars = explode(" ", "a b c d e f g h i j k l m n o p q r s t u v w x y z 0 1 2 3 4 5 6 7 8 9");

        for($i = 0; $i < $max; $i++){
            $rnd = array_rand($chars);
            $rtn .= base64_encode(md5($chars[$rnd]));
        }

        return substr(str_shuffle(strtolower($rtn)), 0, $max);
    }
    //*/
}