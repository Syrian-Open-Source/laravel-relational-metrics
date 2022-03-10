<?php

namespace SOS\RelationalMetrics\Abstracts;

abstract class RelationalRelationAbstract
{
    protected $model = '';

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
        $model_value = $this->model::get();

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
        return $this->model::query()->get()->count();
    }

    protected function returnFinalResponse($model_count): array
    {
        return  [
            'name' => $this->getResponseName(),
            'count' => $model_count,
        ];
    }

    protected function getResponseName()
    {
        $path = explode('\\', $this->model);

        return 'Total '.$path[count($path) - 1].' Number';
    }
}
