<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserDAO
 *
 * @author duarte
 */
class UserDAO {
    
    public static function insert(User $user) {
        $cmn = false;
        $conn = ConexaoMySQLDB::openConnection();
        $conn->beginTransaction();
        
        try {
            $stm = $conn->prepare("INSERT INTO user (name, lastname, birthdate, email, status) VALUES(?,?,?,?,?)");
            $stm->bindValue(1, $user->getName(), PDO::PARAM_STR);
            $stm->bindValue(2, $user->getLastname(), PDO::PARAM_STR);
            $stm->bindValue(3, $user->getBirthdate(), PDO::PARAM_STR);
            $stm->bindValue(4, $user->getEmail(), PDO::PARAM_STR);
            $stm->bindValue(5, 'A', PDO::PARAM_STR);
            $stm->execute();

            $cmn = $conn->commit();
        
        } catch (PDOException $e) {
            die('Error: Não foi possível inserir um novo usuário'.$e);
        }
        $conn = ConexaoMySQLDB::closeConnection();
        return $cmn;
    }
    
    public static function listAll() {
        $list = new ArrayObject();
        $conn = ConexaoMySQLDB::openConnection();
        
        try {
            $stm = $conn->prepare("SELECT id, name, lastname, birthdate, email, status FROM user");
            $stm->execute();
            while ($row = $stm->fetch(PDO::FETCH_BOTH)) {
                $u = new User();
                $u->setId($row['id']);
                $u->setName($row['name']);
                $u->setLastname($row['lastname']);
                $u->setBirthdate($row['birthdate']);
                $u->setEmail($row['email']);
                $u->setStatus($row['status']);
                $list->append($u);
            }
        } catch (Exception $e) {
            die('Error: Não foi possível listar os usuários.');
        }
        
        $conn = ConexaoMySQLDB::closeConnection();
        return $list;
    
    }
    
    public static function selectPerId($id) {
        $conn = ConexaoMySQLDB::openConnection();
        
        try {
            $stm = $conn->prepare("SELECT id, name, lastname, birthdate, email, status FROM user WHERE id = ?");
            $stm->bindValue(1, $id, PDO::PARAM_INT);
            $stm->execute();
            
            $row = $stm->fetch(PDO::FETCH_BOTH);
            $user = new User();
            $user->setId($row['id']);
            $user->setName($row['name']);
            $user->setLastname($row['lastname']);
            $user->setBirthdate($row['birthdate']);
            $user->setEmail($row['email']);
            $user->setStatus($row['status']);
            
        } catch (PDOException $e) {
            die('Error: Não foi possível selecionar o usuário.');
        }
        
        $conn = ConexaoMySQLDB::closeConnection();
        return $user;
    }
    
}
