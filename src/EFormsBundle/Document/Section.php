<?php

namespace EFormsBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use EFormsBundle\Traits\ConstructableProperties;

/**
 * @ODM\EmbeddedDocument
 */
class Section
{
    use ConstructableProperties {
        __construct as _construct;
    }

    /**
     * @var string
     *
     * @ODM\Field
     */
    public $label;

    /**
     * @var Widget[]
     *
     * @ODM\EmbedMany(targetDocument="Widget")
     */
    public $widgets = [];

    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $widgets = $data['widgets'] ?? [];
        foreach ($widgets as &$widget) {
            $widget = new Widget($widget);
        }

        $this->_construct($data);
    }
}
