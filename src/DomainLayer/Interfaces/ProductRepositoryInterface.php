<?php
namespace App\DomainLayer\Interfaces;

interface ProductRepositoryInterface 
{
    public function findAllWithLimit();
    public function findAllByCriteria(array $array);
}