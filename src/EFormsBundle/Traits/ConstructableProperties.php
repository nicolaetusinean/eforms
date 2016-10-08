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
            if (property_exists($this, $key)) {
                $this->$key = $value;
            } else {
                $msg = sprintf('Property %s does not exist on Widget.', $key);
                throw new \InvalidArgumentException($msg);
            }
        }
    }
}
