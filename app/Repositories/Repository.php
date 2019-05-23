<?php

namespace App\Repositories;

class Repository
{
    /**
     * @var \Illuminate\Database\Eloquent\Model $model
     */
    protected $model = false;

    /**
     * @var string
     */
    protected $select = '*';

    /**
     * @var array
     */
    protected $with = [];

    /**
     * @var bool
     */
    protected $take = false;

    /**
     * @var bool
     */
    protected $pagination = false;

    /**
     * @var array
     */
    protected $where = [];

    /**
     * @var array
     */
    protected $orderBy = [];

    /**
     * @var bool|\Illuminate\Database\Query\Builder
     */
    protected $builder = false;

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @return bool|\Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection
     */
    public function get()
    {
        if ($this->isBuilder() && $this->getPagination()) {

            return $this->builder->paginate($this->getPagination());
        }
        if ($this->isBuilder()) {
            return $this->isBuilder()->get();
        }
        return false;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|bool
     */
    public function one()
    {
        if ($this->isBuilder()) {

            return $this->isBuilder()->first();
        }
        return false;
    }

    /**
     * @return bool|\Illuminate\Database\Query\Builder
     */
    public function isBuilder()
    {
        $this->builder = $this->model->select($this->getSelect());

        if (is_array($this->getWith()) && current($this->getWith())) {
            foreach ($this->getWith() as $value) {
                $this->builder->with($value);
            }
        }

        if (is_array($this->getOrderBy()) && current($this->getOrderBy())) {
            $this->builder->orderBy(key($this->getOrderBy()), current($this->getOrderBy()));
        }

        if ($this->isTake()) {
            $this->builder->take($this->isTake());
        }

        if (is_array($this->getWhere()) && current($this->getWhere())) {
            foreach ($this->getWhere() as $key => $value) {
                $this->builder->where($key, $value);
            }
        }

        return $this->builder;
    }

    /**
     * @param bool|\Illuminate\Database\Query\Builder $builder
     */
    public function setBuilder(bool $builder): void
    {
        $this->builder = $builder;
    }

    /**
     * @param bool $arg
     * @return bool|\Illuminate\Database\Eloquent\Collection
     */
    public function make($arg = false)
    {
        return $this->get();
    }

    /**
     * @return string
     */
    public function getSelect(): string
    {
        return $this->select;
    }

    /**
     * @param string $select
     */
    public function setSelect(string $select): void
    {
        $this->select = $select;
    }


    /**
     * @return string
     */
    public function isTake(): string
    {
        return $this->take;
    }

    /**
     * @param string $take
     */
    public function setTake(string $take): void
    {
        $this->take = $take;
    }

    /**
     * @return array
     */
    public function getOrderBy(): array
    {
        return $this->orderBy;
    }

    /**
     * @param array $orderBy
     */
    public function setOrderBy(array $orderBy): void
    {
        $this->orderBy = $orderBy;
    }

    /**
     * @return array
     */
    public function getWhere(): array
    {
        return $this->where;
    }

    /**
     * @param array $where
     */
    public function setWhere(array $where): void
    {
        $this->where = $where;
    }

    /**
     * @return int
     */
    public function getPagination(): int
    {
        return $this->pagination;
    }

    /**
     * @param int $pagination
     */
    public function setPagination(int $pagination): void
    {
        $this->pagination = $pagination;
    }

    /**
     * @param array $data
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getWith(): array
    {
        return $this->with;
    }

    /**
     * @param array $with
     */
    public function setWith(array $with): void
    {
        $this->with = $with;
    }

    protected function setDefault()
    {
        $this->setSelect('*');
        $this->setWith([]);
        $this->setTake(false);
        $this->setPagination(false);
        $this->setWhere([]);
        $this->setOrderBy([]);
        $this->setBuilder(false);
    }


}