<?php
/**
 * Created by PhpStorm.
 * User: pprusek
 * Date: 13.11.19
 * Time: 13:09
 */

namespace App\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class ProductRepository extends EntityRepository
{
    public function defaultQueryList(): QueryBuilder{
        return $this->createQueryBuilder("p")->orderBy("p.id","ASC");
    }
}