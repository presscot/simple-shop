<?php
/**
 * Created by PhpStorm.
 * User: pprusek
 * Date: 14.11.19
 * Time: 12:36
 */

namespace App\Tests;

use App\Entity\Product;
use App\Paginator\Paginator;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use PHPUnit\Framework\TestCase;

class PaginatorTest extends TestCase
{
    public function testPaginatorWhenArgumentsIsValid():void{

        $product = new Product();
        $product->setName("test");

        $query = new class($product){
            private $product;
            public function __construct($product){$this->product = $product;}
            public function getResult(){return [$this->product];}
        };

        $queryBuilder = $this->createMock(QueryBuilder::class);

        $queryBuilder
            ->expects($this->any())
            ->method("getQuery")
            ->willReturn($query);
        ;

        $queryBuilder
            ->expects($this->any())
            ->method("setMaxResults")
            ->willReturn($queryBuilder);
        ;
        $queryBuilder
            ->expects($this->any())
            ->method("setFirstResult")
            ->willReturn($queryBuilder);
        ;
        try{
            $paginator = new Paginator('test',$queryBuilder,1);
            $paginator->getPaginate();
        }catch( \Throwable $e ){
            $this->fail("");
        }

        $this->assertTrue(true);
    }
}