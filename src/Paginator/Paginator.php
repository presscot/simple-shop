<?php
/**
 * Created by PhpStorm.
 * User: pprusek
 * Date: 13.11.19
 * Time: 13:02
 */

namespace App\Paginator;

use DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\Orm\QueryBuilder;

class Paginator extends PaginationAbstract
{
    /** @var QueryBuilder $qb */
    private $qb;
    /** @var Collection $data */
    private $data;
    /** @var int $count */
    private $count;
    /** @var array $paginate */
    private $paginate;

    /**
     * Pagination constructor.
     * @param string $name
     * @param QueryBuilder $qb
     * @param int $page
     * @param int $limit
     */
    public function __construct($name, QueryBuilder $qb, $page = 1, $limit = 10 )
    {
        parent::__construct($name, $page, $limit);

        $this->qb = $qb;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        if (null === $this->count) {
            $this->count = count( $this->execute($this->getQueryBuilder()) );
        }

        return $this->count;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        if (null === $this->data) {
            $this->data = $this->execute($this->setRange($this->getQueryBuilder()));
        }

        return $this->data;
    }

    public function getPaginate(): array
    {
        if (!($this->paginate)) {
            $this->paginate = $this->_paginate();
        }

        return $this->paginate;
    }

    /**
     * @param QueryBuilder $qb
     * @return QueryBuilder
     */
    protected function setRange(QueryBuilder $qb): QueryBuilder
    {
        $limit = $this->getLimit();
        $offset = $this->getOffset();

        $nqb = clone($qb);

        $sort = []; $this->getSort();

        foreach ($sort as $key => $s) {
            $nqb->orderBy($key, $s);
            break;
        }

        return $nqb
            ->setMaxResults($limit)
            ->setFirstResult($offset);
    }

    /**
     * @param QueryBuilder $qb
     * @return array
     */
    protected function execute(QueryBuilder $qb): array
    {
        return $qb->getQuery()->getResult();
    }


    /**
     * @return QueryBuilder
     */
    protected function getQueryBuilder(): QueryBuilder
    {
        return $this->qb;
    }
}