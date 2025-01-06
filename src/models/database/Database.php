<?php
abstract class Database
{
    private static ?PDO $pdo;
    private static string $destination = "mysql:host=127.0.0.1;dbname=social;charset=utf8mb4";
    private static array $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    protected static function open(): PDO
    {
        self::$pdo = new PDO(self::$destination, "root", "", self::$options);
        return self::$pdo;
    }

    protected static function close(): void
    {
        self::$pdo = null;
    }

    protected static function request(string $request, array $params = []): PDOStatement | false
    {
        $pdo = self::open();
        $statement = $pdo->prepare($request);
        $success = $statement->execute($params);
        self::close();
        return $success ? $statement : false;
    }
}
