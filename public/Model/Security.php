<?php

namespace App\Model;

class Security {
    public static function hasher($pass) {
        $pass_hash = hash('sha256', $pass);
        return $pass_hash;
    }
}