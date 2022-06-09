<?php

namespace Mysqli;

class DB
{
    /**
     * The database name
     */
    const DB_NAME = 'default-002';

    /**
     * The database host
     */
    const DB_HOST = '127.0.0.1';

    /**
     * The database user
     */
    const DB_USER = 'root';

    /**
     * The database password
     */
    const DB_PASS = 'aje12o14';

    /**
     * The database port
     */
    const DB_PORT = 3306;

    /**
     * @var mysqli
     */
    private static $connection;

    /**
     * Return the mysqli instance
     *
     * @return mysqli
     */
    public static function conn()
    {
        if (false === self::$connection instanceof mysqli) {
            self::$connection = new mysqli(
                self::DB_HOST,
                self::DB_USER,
                self::DB_PASS,
                self::DB_NAME,
                self::DB_PORT
            );
        }

        return self::$connection;
    }

    /**
     * Closes an open mysqli connection
     */
    public static function close(){
        if (true === self::$connection instanceof mysqli){
            self::$connection->close();
        }
    }
}