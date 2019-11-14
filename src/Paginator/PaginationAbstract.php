<?php
/**
 * Created by PhpStorm.
 * User: pprusek
 * Date: 13.11.19
 * Time: 13:04
 */

namespace App\Paginator;


abstract class PaginationAbstract
{
    /** @var string $name */
    private $name;
    /** @var int $page */
    private $page;
    /** @var int $limit */
    private $limit;
    /** @var int $offset */
    private $offset;
    /** @var array $sort */
    private $sort = [];

    /**
     * Pagination constructor.
     * @param string $name
     * @param int $page
     * @param int $limit
     */
    public function __construct( $name, $page = 1, $limit = 10)
    {
        $this->name = $name;
        $this->page = $page;
        $this->setSort("{$name}.id","asc");

        $this->setLimit($limit);
    }

    /**
     * @param int $limit
     * @return $this
     */
    protected function setLimit( $limit ){
        $page = $this->page;

        $this->limit = $limit;
        $this->offset = ($page - 1) * $limit;

        return $this;
    }

    public function setParameters( array $params ){
        $limit = (int)$params['limit'];
        $sort = $params['sort'];

        if( $limit > 0 && $limit < 1000  ){
            $this->setLimit($limit);
        }

        $this->sort = $sort;
    }

    /**
     * @return int
     */
    public abstract function getCount();

    /**
     * @return int
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @return int
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }


    protected function _paginate(){
        $count = $this->getCount();
        $limit = $this->getLimit();
        $page = $this->getPage();
        $offset = $this->getOffset();

        $max = ceil($count / $limit);
        $pf = $page - 5;
        $pl = $page + 5 + ($pf < 0 ? abs($pf) + 1 : 0);

        if ($pl > $max) {
            $pf -= $pl - $max;
            $pl = $max;
        }

        if ($pf < 1) {
            $pf = 1;
        }

        $from = $offset + 1;
        $to = $offset + $limit;

        if ($to > $count) {
            $to = $count;
        }

        return
            [
                'count' => $count,
                'from' => $from,
                'to' => $to,
                'page' => $page,
                'max' => $max,
                'pf' => $pf,
                'pl' => $pl,
            ];
    }

    protected function setSort($field,$sort){
        $this->sort = [ "{$this->name}.{$field}" => $sort ];

        return $this;
    }

    protected function getSort(){
        return $this->sort;
    }
}