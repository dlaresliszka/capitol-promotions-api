<?php
namespace App\InfraLayer;

use App\DomainLayer\Interfaces\ProductRepositoryInterface;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\DomainLayer\Models\Product;

class ProductRepository extends ServiceEntityRepository implements ProductRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function findAllWithLimit($limit = 5)
    {
        $queryBuilder = $this->createQueryBuilder('p');
        $queryBuilder->setMaxResults($limit);
        $query = $queryBuilder->getQuery();

        return $query->execute();
    }


    public function findAllByCriteria(array $criteria)
    {
        $queryBuilder = $this->createQueryBuilder('p');
        
        foreach($criteria as $index => $parameter) {
            ['name' => $name, 'operator' => $operator, 'value' => $value] = $parameter;
            if($index == 0) {
                $queryBuilder->where("p.{$name} {$operator} {$value}");
            } else {
                $queryBuilder->andWhere("p.{$name} {$operator} {$value}");
            }   
            
        }
        
        $queryBuilder->setMaxResults(5);
        $query = $queryBuilder->getQuery();

        return $query->execute();
    }
}
