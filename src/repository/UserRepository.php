<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository {
    public function getUserByLogin(string $login): ?User {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.users WHERE login = :login
        ');
        $stmt->bindParam(':login', $login, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return null;
        }

        return new User(
            $user['login'],
            $user['password'],
            $user['email'],
            $user['profile-image'],
            $user['permission']
        );
    }

    public function getUserByEmail(string $email): ?User {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.users WHERE email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return null;
        }

        return new User(
            $user['login'],
            $user['password'],
            $user['email'],
            $user['profile-image'],
            $user['permission']
        );
    }

    public function addUser(User $user) {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO users (login, password, email)
            VALUES (?, ?, ?)
        ');

        $stmt->execute([
            $user->getLogin(),
            $user->getPassword(),
            $user->getEmail()
        ]);
    }

    public function changePassword($newPassword) {
        $stmt = $this->database->connect()->prepare('
            UPDATE users SET password = :newPassword WHERE (login = :login)
        ');

        $stmt->bindValue(':login', $_SESSION['userLogin']);
        $stmt->bindValue(':newPassword', $newPassword, PDO::PARAM_STR);

        $stmt->execute();
    }
}