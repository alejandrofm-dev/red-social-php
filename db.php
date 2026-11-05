<?php
class DB
{
    public static function connect(): mysqli
    {
        return new mysqli(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_NAME'));
    }
}