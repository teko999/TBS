<?php

class User extends Model
{
    public function getByLogin($user, $password)
    {
        $login = $this->db->escape($user);
        $password = $this->db->escape($password);
        $hash = md5(Config::get('salt') . $password);

        $sql = "SELECT * FROM users WHERE login = '{$login}' AND password = '{$hash}' LIMIT 1";
        $result = $this->db->query($sql);

        return is($result, 0 , false);
    }
}
