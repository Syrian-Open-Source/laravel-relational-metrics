<?php

namespace SOS\RelationalMetrics\Interfaces;

interface RelationalInterface
{
    /**
     * return simple count for the model
     *
     * @author zainaldeen
     * @return  array
     */
    public function getBasicMetrics();

    /**
     * return count for the model's relation depending on the relation type (where, when ... etc), column and value
     *
     * @author zainaldeen
     * @param string $relation
     * @param string $column
     * @param mixed $value
     * @return  array
     */
    public function getRelationalMetrics($relation, $column, $value);

    /**
     * return count for the model depending on the passing conditions
     *
     * @author zainaldeen
     * @param array $conditions
     * @return  array
     */
    public function getConditionalMetrics($conditions);
}
