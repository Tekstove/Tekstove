<?php

namespace Tekstove\SiteBundle\Model\Gateway\Tekstove;

/**
 * @author po_taka <angel.koilov@gmail.com
 */
class CompositeFilter
{
    /**
     * Condition type, possible values [And, Or]
     *
     * @var string
     */
    private $condition;

    private $filters =  [];

    /**
     * @var CompositeFilter[]
     */
    private $compositeFilters = [];

    /**
     * Condition type - [and, or]
     *
     * @param string $condition
     */
    public function __construct($condition)
    {
        $this->condition = $condition;
    }

    /**
     * @param string $field
     * @param string $value
     * @param string $operator
     */
    public function addFilter($field, $value, $operator = '=')
    {
        $this->filters[] = [
            'field' => $field,
            'value' => $value,
            'operator' => $operator,
        ];
    }

    public function addCompositeFilter(CompositeFilter $filter)
    {
        $this->compositeFilters[] = $filter;
    }

    /**
     * @return array
     */
    public function toArray() : Array
    {
        $filters = $this->filters;
        foreach ($this->compositeFilters as $filter) {
            $filters[] = $filter->toArray();
        }

        $returnData = [
            'operator' => $this->condition,
            'value' => $filters,
        ];

        return $returnData;
    }
}
