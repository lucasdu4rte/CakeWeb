<?php

class ConexaoMySQLDB {
    
    public function openConnection() {
        
        $dsn = 'mysql:host=localhost; port=3306;dbname=livroreceitas';
        $username = 'cakeweb';
        $password = '$ynV7PmCU7UpPUcoC';
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        ); 
        $conn = null;
        
        try {
            $conn = new PDO($dsn, $username, $password, $options);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch (PDOException $e) {
            die('Erro ao conectar com o MySQL: ' . $e->getMessage());
        }
        
        return $conn;
    }
    
    public function closeConnection() {
        return null;
    }

    
}
