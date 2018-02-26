<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Recipes
 *
 * @author Lucas.Duarte
 */
class Recipes {
    private $id, 
            $title,
            $category,
            $id_author,
            $ingredients,
            $instructions;
    
    function getId() {
        return $this->id;
    }

    function getTitle() {
        return $this->title;
    }

    function getCategory() {
        return $this->category;
    }

    function getId_author() {
        return $this->id_author;
    }

    function getIngredients() {
        return $this->ingredients;
    }

    function getInstructions() {
        return $this->instructions;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTitle($title) {
        $this->title = $title;
    }

    function setCategory($category) {
        $this->category = $category;
    }

    function setId_author($id_author) {
        $this->id_author = $id_author;
    }

    function setIngredients($ingredients) {
        $this->ingredients = $ingredients;
    }

    function setInstructions($instructions) {
        $this->instructions = $instructions;
    }
}
