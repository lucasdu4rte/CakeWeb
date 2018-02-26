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
class RecipesDAO {
    
    public static function insert(Recipes $recipe) {
        $cmn = false;
        $conn = ConexaoMySQLDB::openConnection();
        $conn->beginTransaction();
        
        try {
            $stm = $conn->prepare("INSERT INTO recipes (title, category, id_author, ingredients, instructions) VALUES(?,?,?,?,?)");
            $stm->bindValue(1, $recipe->getTitle(), PDO::PARAM_STR);
            $stm->bindValue(2, $recipe->getCategory(), PDO::PARAM_STR);
            $stm->bindValue(3, $recipe->getId_author(), PDO::PARAM_INT);
            $stm->bindValue(4, $recipe->getIngredients(), PDO::PARAM_STR);
            $stm->bindValue(5, $recipe->getInstructions(), PDO::PARAM_STR);
            $stm->execute();

            $cmn = $conn->commit();
        
        } catch (PDOException $e) {
            die('Error: Não foi possível inserir uma nova receita');
        }
        $conn = ConexaoMySQLDB::closeConnection();
        return $cmn;
    }
    
    public static function listAll() {
        $list = new ArrayObject();
        $conn = ConexaoMySQLDB::openConnection();
        
        try {
            $stm = $conn->prepare("SELECT id, title, category, id_author, ingredients, instructions FROM recipes");
            $stm->execute();
            while ($row = $stm->fetch(PDO::FETCH_BOTH)) {
                $r = new Recipes();
                $r->setId($row['id']);
                $r->setTitle($row['title']);
                $r->setCategory($row['category']);
                $r->setId_author($row['id_author']);
                $r->setIngredients($row['ingredients']);
                $r->setInstructions($row['instructions']);
                $list->append($r);
            }
        } catch (Exception $e) {
            die('Error: Não foi possível listar as receitas.');
        }
        
        $conn = ConexaoMySQLDB::closeConnection();
        return $list;
    }
    
    public static function selectPerId($id) {
        $conn = ConexaoMySQLDB::openConnection();
        
        try {
            $stm = $conn->prepare("SELECT id, title, category, id_author, ingredients, instructions FROM recipes WHERE id = ?");
            $stm->bindValue(1, $id, PDO::PARAM_INT);
            $stm->execute();
            
            $row = $stm->fetch(PDO::FETCH_BOTH);
            $recipe = new Recipes();
            $recipe->setId($row['id']);
            $recipe->setTitle($row['title']);
            $recipe->setCategory($row['category']);
            $recipe->setId_author($row['id_author']);
            $recipe->setIngredients($row['ingredients']);
            $recipe->setInstructions($row['instructions']);
            
            
        } catch (PDOException $e) {
            die('Error: Não foi possível selecionar a receita.');
        }
        
        $conn = ConexaoMySQLDB::closeConnection();
        return $recipe;
    }
    
}
