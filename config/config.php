<?php

Config::set('site_name', 'Ticket Bying System');
Config::set('version', '1.0.0');
Config::set('langs', ['en', 'bg']);
Config::set('routes', [
    'default' => '',
    'admin' => 'admin_',
]);
Config::set('default_route','default');
Config::set('default_lang','en');
Config::set('default_controller','event');
Config::set('default_action','index');

// DB Configs
Config::set('db_host','localhost');
Config::set('db_user','root');
Config::set('db_password','');
Config::set('db_name','tbs');

Config::set('salt','vS8ZiGm29ehF1j8D');
