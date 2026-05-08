<?php
class AuthMiddleware
{
    public function handle()
    {
        print($_COOKIE['token']);
    }
}
