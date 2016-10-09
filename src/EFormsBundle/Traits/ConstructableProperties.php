<?php

namespace EFormsBundle\Traits;

trait ConstructableProperties
{
    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            $isId = substr($key, -3) === '_id';
            $key = $isId ? substr($key, 0, -3) : $key;

            if (property_exists($this, $key)) {
                $this->$key = $value;
            } else {
                $msg = sprintf('Property %s does not exist on %s.', $key, get_class());
                throw new \InvalidArgumentException($msg);
            }
        }
    }
}
