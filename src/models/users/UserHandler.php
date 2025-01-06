<?php
class UserHandler extends Database
{
    public static function create(User $user): void
    {
        $firstName = $user->getFirstName();
        $lastName = $user->getLastName();
        $email = $user->getEmail();
        $password = $user->getPassword();

        $query = "INSERT INTO users (first_name, last_name, email, password) 
                  VALUES (:first_name, :last_name, :email, :password)";

        self::request($query, [
            ':first_name' => $firstName,
            ':last_name' => $lastName,
            ':email' => $email,
            ':password' => password_hash($password, PASSWORD_BCRYPT),
        ]);
    }

    public static function getByEmail(string $email): ?User
    {
        $query = "SELECT * FROM users WHERE email = :email";

        $r = self::request($query, [':email' => $email])->fetch();
        return $r ? new User($r['first_name'], $r['last_name'], $r['email'], $r['password'], $r['id'], $r['description']) : null;
    }

    public static function getById(string $id): ?User
    {
        $query = "SELECT * FROM users WHERE id = :id";

        $r = self::request($query, [':id' => $id])->fetch();
        return $r ? new User($r['first_name'], $r['last_name'], $r['email'], $r['password'], $r['id'], $r['description']) : null;
    }

    public static function updateDescription(int $userId, string $description): void
    {
        $query = "UPDATE users SET description = :description WHERE id = :id";
        self::request($query, [
            ':description' => $description,
            ':id' => $userId,
        ]);
    }

    public static function update(User $user): void
    {
        $firstName = $user->getFirstName();
        $lastName = $user->getLastName();
        $description = $user->getDescription();
        $email = $user->getEmail();
        $password = $user->getPassword();

        $query = "UPDATE users 
                  SET first_name = :first_name, 
                      last_name = :last_name, 
                      email = :email, 
                      password = :password, 
                      description = :description
                  WHERE id = :id";

        self::request($query, [
            ':first_name' => $firstName,
            ':last_name' => $lastName,
            ':email' => $email,
            ':password' => password_hash($password, PASSWORD_BCRYPT),
            ':description' => $description,
            ':id' => $user->getId(),
        ]);
    }
}
