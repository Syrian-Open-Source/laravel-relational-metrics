<?php

namespace SOS\RelationalMetrics\Classes;

use SOS\RelationalMetrics\Abstracts\RelationalRelationAbstract;
use SOS\RelationalMetrics\Interfaces\RelationalInterface;

/**
 * Class ClassToBuild
 *
 * @author Zainaldeen
 * @package SOS\RelationalMetrics\Classes
 */
class RelationalMetrics extends RelationalRelationAbstract implements RelationalInterface
{
    /**
     * description
     *
     * @author zainaldeen
     * @var string
     */
    public function __construct(string $target)
    {
        if (class_exists($target)) {
            $this->model = app("App\\Models" . $target);
        } else {
            return "Target Model ". $target. " Is Not Found!";
        }
    }

    /**
     * return simple count for the model
     *
     * @author zainaldeen
     * @return  array
     */
    public function getBasicMetrics()
    {
        $model_count = $this->getCountDirectly();

        return $this->returnFinalResponse($model_count);
    }

    /**
     * return count for the model's relation depending on the relation type (where, when ... etc), column and value
     *
     * @author zainaldeen
     * @param string $relation
     * @param string $column
     * @param mixed $value
     * @return  array
     */
    public function getRelationalMetrics($relation, $column, $value)
    {
        $model_count = $this->returnRelationalCount($relation, $column, $value);

        return $this->returnFinalResponse($model_count);
    }

    /**
     * return count for the model depending on the passing conditions
     *
     * @author zainaldeen
     * @param array $conditions
     * @return  array
     */
    public function getConditionalMetrics($conditions)
    {
        $model_count = $this->getCountWithConditions($conditions);

        return $this->returnFinalResponse($model_count);
    }
}
