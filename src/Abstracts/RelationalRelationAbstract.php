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
        if (is_null($this->count)){
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
     * @param string $relation
     * @param string $column
     * @param mixed $value
     * @return int
     * @author zainaldeen
     */
    protected function returnRelationalCount(string $relation, string $column, $value): int
    {
        $model_value = $this->model::query()
            ->whereHas($relation, function ($q) use ($column, $value) {
                return $q->latest()->where($column, $value);
            })->get();

        return $model_value->count();
    }

    /**
     * return count for the model depending on the passing conditions
     *
     * @param array $conditions
     * @return int
     * @author zainaldeen
     */
    protected function getCountWithConditions(array $conditions): int
    {
        $model_value = $this->model::query();
        foreach ($conditions as $condition) {
            $model_value = $model_value
                ->{$condition["method"]}(
                    ($condition["column"]),
                    $condition['operator'] ?? '',
                    $condition["value"] ?? ''
                );
        }
        $model_value = $model_value->get();

        return count($model_value);
    }

    /**
     * return simple count for the model
     *
     * @return int
     * @author zainaldeen
     */
    protected function getCountDirectly()
    {
        $this->count = $this->model::query()->get()->count();

        return $this->count;
    }

    /**
     * append final values to their properties
     *
     * @param $model_count
     *
     * @return array
     * @author karam mustafa
     */
    protected function returnFinalResponse($model_count): array
    {
        return  [
            'name' => $this->getResponseName(),
            'count' => $model_count,
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
