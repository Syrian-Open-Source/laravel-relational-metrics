<?php

namespace SOS\RelationalMetrics\Classes;

use Illuminate\Database\Eloquent\Model;
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
     * class constructor
     *
     * @throws \Exception
     * @author zainaldeen
     * @var string
     */
    public function __construct(string $class)
    {
        $className = $this->validateClass($class);

        $this->model = $className;
    }

    /**
     * return simple count for the model
     *
     * @return  array
     * @author zainaldeen
     */
    public function getBasicMetrics()
    {
        return $this->returnFinalResponse(
            $this->getCountDirectly()
        );
    }

    /**
     * return count for the model's relation depending on the relation type (where, when ... etc), column and value
     *
     * @param  string  $relation
     * @param  string  $column
     * @param  mixed  $value
     *
     * @return  array
     * @author zainaldeen
     */
    public function getRelationalMetrics($relation, $column, $value)
    {
        return $this->returnFinalResponse(
            $this->returnRelationalCount($relation, $column, $value)
        );

    }

    /**
     * return count for the model depending on the passing conditions
     *
     * @param  array  $conditions
     *
     * @return  array
     * @author zainaldeen
     */
    public function getConditionalMetrics($conditions)
    {
        return $this->returnFinalResponse(
            $this->getCountWithConditions($conditions)
        );
    }

    /**
     * check if user insert a correct class name, otherwise we will ty to resolve the model class name
     *
     * @param  string  $class
     *
     * @return \SOS\RelationalMetrics\Classes\string|string
     * @throws \Exception
     * @author karam mustafa
     */
    private function validateClass(string $class)
    {
        $fixedClassName = str_contains("App\\Models", $class)
            ? $class
            : "\\App\\Models\\$class";

        if (!class_exists($fixedClassName) && $fixedClassName instanceof Model) {
            throw new \Exception("model $class not found !!");
        }

        return $fixedClassName;
    }


}
