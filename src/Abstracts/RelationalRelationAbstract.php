<?php

namespace SOS\RelationalMetrics\Abstracts;

/**
 * Class RelationalRelationAbstract
 *
 * @author karam mustafa
 * @package SOS\RelationalMetrics\Abstracts
 */
abstract class RelationalRelationAbstract
{
    /**
     * model to handle
     * @author karam mustafa
     * @var string
     */
    protected $model = '';

    /**
     * count of rows
     * @author karam mustafa
     * @var string
     */
    private $count = null;

    /**
     * message for a count
     * @author karam mustafa
     * @var string
     */
    private $name = '';

    /**
     * @return string
     * @author karam mustafa
     */
    public function getCount()
    {
        if (is_null($this->count)) {
            $this->getCountDirectly();
        }

        return $this->count;
    }

    /**
     * @param  string  $count
     *
     * @return RelationalRelationAbstract
     * @author karam mustafa
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * @return string
     * @author karam mustafa
     */
    public function getName()
    {
        if (is_null($this->name)) {
            $this->name = $this->getResponseName();
        }

        return $this->name;
    }

    /**
     * @param  string  $name
     *
     * @return RelationalRelationAbstract
     * @author karam mustafa
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     *  return count for the model's relation depending on the relation type (where, when ... etc), column and value
     *
     * @param  string  $relation
     * @param  string  $column
     * @param  mixed  $value
     *
     * @return \SOS\RelationalMetrics\Abstracts\RelationalRelationAbstract
     * @author zainaldeen
     */
    protected function returnRelationalCount(
        string $relation,
        string $column,
        $value
    ): RelationalRelationAbstract {
        $result = $this->model::query()
            ->whereHas($relation, function ($q) use ($column, $value) {
                return $q->latest()->where($column, $value);
            })->get();

        $this->setCount($result->count());

        return $this;
    }

    /**
     * return count for the model depending on the passing conditions
     *
     * @param  array  $conditions
     *
     * @return RelationalRelationAbstract
     * @author zainaldeen
     */
    protected function getCountWithConditions(array $conditions): RelationalRelationAbstract
    {
        $result = $this->model::query();
        foreach ($conditions as $condition) {
            $result = $result
                ->{$condition["method"]}(
                    ($condition["column"]),
                    $condition['operator'] ?? '',
                    $condition["value"] ?? ''
                );
        }

        $this->setCount(count($result->get()));

        return $this;
    }

    /**
     * return simple count for the model
     *
     * @return RelationalRelationAbstract
     * @author zainaldeen
     */
    protected function getCountDirectly()
    {
        $this->count = $this->model::query()->get()->count();

        return $this;
    }

    /**
     * append final values to their properties
     *
     * @return array
     * @author karam mustafa
     */
    protected function returnFinalResponse(): array
    {
        return [
            'name' => $this->getResponseName(),
            'count' => $this->getCount(),
        ];
    }

    /**
     * description
     *
     * @return string
     * @author karam mustafa
     */
    protected function getResponseName()
    {
        $path = explode('\\', $this->model);

        return 'Total '.$path[count($path) - 1].' Number';
    }
}
