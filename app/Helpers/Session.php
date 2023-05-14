<?php

namespace App\Helpers;

class Session
{
    /**
     * Mulai sesi
     *
     * @return void
     */
    public static function start()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Set nilai ke dalam sesi
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public static function put($key, $value)
    {
        self::start();

        $_SESSION[$key] = $value;
    }

    /**
     * Ambil nilai dari sesi
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get($key, $default = null)
    {
        self::start();

        return $_SESSION[$key] ?? $default;
    }

    /**
     * Cek apakah sesi memiliki nilai tertentu
     *
     * @param string $key
     * @return bool
     */
    public static function has($key)
    {
        self::start();

        return isset($_SESSION[$key]);
    }

    /**
     * Hapus nilai dari sesi
     *
     * @param string $key
     * @return void
     */
    public static function forget($key)
    {
        self::start();

        unset($_SESSION[$key]);
    }

    /**
     * Hapus semua nilai dari sesi
     *
     * @return void
     */
    public static function flush()
    {
        self::start();

        session_unset();
    }

    /**
     * Hancurkan sesi
     *
     * @return void
     */
    public static function destroy()
    {
        self::start();

        session_destroy();
    }
}
