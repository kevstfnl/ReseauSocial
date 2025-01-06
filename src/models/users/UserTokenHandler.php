<?php

class UserTokenHandler extends Database
{
    public static function create(UserToken $token): void
    {
        $query = "INSERT INTO user_tokens (user_id, hashed_agent, last_address, created_at, expires_at, hashed_token) 
                  VALUES (:user_id, :hashed_agent, :last_address, :created_at, :expires_at, :hashed_token)";

        self::request($query, [
            ':user_id' => $token->getUserId(),
            ':hashed_agent' => $token->getHashedAgent(),
            ':last_address' => $token->getLastAddress(),
            ':created_at' => $token->getCreatedAt(),
            ':expires_at' => $token->getExpiresAt(),
            ':hashed_token' => $token->getHashedToken(),
        ]);
    }

    public static function delete(int $userId): void
    {
        setcookie("keep", "", time() - 3600, "/");

        $query = "DELETE FROM user_tokens WHERE user_id = :user_id";

        self::request($query, [
            ':user_id' => $userId,
        ]);
    }

    public static function clearExpired(): void
    {
        $query = "DELETE FROM user_tokens WHERE expires_at < NOW()";

        self::request($query);
    }

    public static function getId(): ?int
    {
        if (!isset($_COOKIE["keep"])) {
            return null;
        }

        $hashedToken = hash("sha256", $_COOKIE["keep"]);
        $query = "SELECT user_id FROM user_tokens WHERE hashed_token = :hashed_token AND expires_at > NOW()";

        $r = self::request($query, [
            ':hashed_token' => $hashedToken,
        ])->fetch();

        return $r ? (int) $r["user_id"] : null;
    }

    public static function validate(): bool
    {
        if (!isset($_COOKIE["keep"])) {
            return false;
        }

        $hashedToken = hash("sha256", $_COOKIE["keep"]);
        $query = "SELECT * FROM user_tokens WHERE hashed_token = :hashed_token AND expires_at > NOW()";

        $r = self::request($query, [
            ':hashed_token' => $hashedToken,
        ])->fetch();

        if ($r) {
            if ($r["hashed_agent"] === $_SERVER["HTTP_USER_AGENT"] && $r["last_address"] === $_SERVER["REMOTE_ADDR"]) {
                $_SESSION["user"]["id"] = $r["user_id"];
                $_SESSION["user"]["agent"] = $_SERVER["HTTP_USER_AGENT"];
                $_SESSION["user"]["ip"] = $_SERVER["REMOTE_ADDR"];
                return true;
            } else {
                self::delete((int) $r["user_id"]);
            }
        }

        return false;
    }
}
