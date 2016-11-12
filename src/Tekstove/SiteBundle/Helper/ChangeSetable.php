<?php

namespace Tekstove\SiteBundle\Helper;

/**
 * @author potaka
 */
trait ChangeSetable
{
    /**
     * @var array
     */
    protected $changedFields = [];
    
    /**
     * Check if fields is changed
     * @param string $field
     * @return boolean
     */
    public function isChanged($field)
    {
        if (isset($this->changedFields[$field])) {
            return true;
        }
        
        return false;
    }
    
    /**
     * @return array
     */
    public function getChangedFields()
    {
        return $this->changedFields;
    }
    
    /**
     * @return array
     */
    public function getChangeSet()
    {
        $return = [];
        foreach ($this->getChangedFields() as $field) {
            $getter = 'get' . $field;
            $value = $this->{$getter}();
            if (is_array($value)) {
                $return[$field] = [];
                foreach ($value as $nestedSet) {
                    $return[$field][] = $nestedSet->getId();
                }
            } else {
                $return[$field] = $value;
            }
        }
        
        return $return;
    }
}
