<?php

namespace App;

class User {

    public function isValid(string $email, string $password) {
        $users = json_decode(file_get_contents(ROOT_DIR.'/db/users.json'), true);
        $myusers = array_filter($users, function($n) use ($email, $password) {
            return $n['email'] == $email && $n['password'] == $password;
        });
        return count($myusers) == 1 ? $myusers[0] : false;
    }

    public function getBySession(string $session) {
        $users = json_decode(file_get_contents(ROOT_DIR.'/db/users.json'), true);
        $myusers = array_filter($users, function($n) use ($session) {
            return md5($n['email']) == $session;
        });
        return count($myusers) == 1 ? $myusers[0] : false;
    }
}
