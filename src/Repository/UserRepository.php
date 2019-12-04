<?php


namespace Wog\Repository;


use PDO;
use Wog\Model\UserModel;
use Wog\Database\Manager;

require '../config/bdd.php';

class UserRepository

{
    public function __construct()
    {
    }


    /**
     * @param UserModel $userModel
     * @throws \PDOException fir user exists or errors
     */

    public function insert(UserModel $userModel)
    {
        $dbh = Manager::getConnection();
        $dbhStatement = 'INSERT INTO users (email, password, surname, first_name, last_name, phone, adress, city, zip, token)
                        VALUES (:email, :password, :surname, :first_name, :last_name, :phone, :adress, :city, :zip, :token)';
        $sth = $dbh->prepare($dbhStatement);

        $sth->bindValue('email', $userModel->getEmail());
        $sth->bindValue('password', $userModel->getPassword());
        $sth->bindValue('surname', $userModel->getSurname());
        $sth->bindValue('first_name', $userModel->getFirstName());
        $sth->bindValue('last_name', $userModel->getLastName());
        $sth->bindValue('phone', $userModel->getPhone());
        $sth->bindValue('adress', $userModel->getAdress());
        $sth->bindValue('city', $userModel->getCity());
        $sth->bindValue('zip', $userModel->getZip());
        $sth->bindValue('token', $userModel->getToken());
        $sth->execute();
        //$sth->lastInsertId();
    }

    public function select(): array
    {
        $dbh = Manager::getConnection()->prepare("SELECT * FROM `users`");
        $dbh->setFetchMode(PDO::FETCH_CLASS, UserModel::class);
        $dbh->execute();
        return $dbh->fetchAll();
    }

    public function selectUser()
    {
        $dbh = Manager::getConnection()->prepare("SELECT * FROM `users`");
        $dbh->setFetchMode(PDO::FETCH_CLASS, UserModel::class);
        $dbh->execute();
        return $dbh->fetch();

    }

    public function selectByEmail(string $email): UserModel
    {
        $dbh = Manager::getConnection()->prepare("SELECT * FROM `users` WHERE email =:email");
        $dbh->setFetchMode(PDO::FETCH_CLASS, UserModel::class);
        $dbh->bindValue(":email", $email);
        $dbh->execute();
        return $dbh->fetch();

    }
}

