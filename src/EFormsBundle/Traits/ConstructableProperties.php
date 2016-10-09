<?php

namespace EFormsBundle\Traits;

use Doctrine\Common\Collections\ArrayCollection;

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
            $value = is_array($value) ? new ArrayCollection($value) : $value;

            if (property_exists($this, $key)) {
                $this->$key = $value;
            } else {
                $msg = sprintf('Property %s does not exist on %s.', $key, get_class());
                throw new \InvalidArgumentException($msg);
            }
        }
    }
}
