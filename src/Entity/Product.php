<?php

namespace App\Entity;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use JsonSerializable;

/**
 * Description of Product
 *
 * @author frigg
 */
class Product {
    
    /**
     * @var int
     */
    private int $id;
    
    /**
     * @var string
     */
    private string $name;
    
    /**
     * @var float
     */
    private float $price;
    
    function __construct(int $id, string $name, float $price) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }
    
    /**
     * 
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * 
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * 
     * @return float
     */
    public function getPrice(): float{
        return $this->price;
    }
}
