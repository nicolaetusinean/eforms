<?php

namespace EFormsBundle\DataFixtures\MongoDB;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EFormsBundle\Document\Widget;

class LoadWidgets implements FixtureInterface
{
    protected $widgets = array(
        array(
            'type' => 'header',
            'subtype' => 'h1',
            'label' => 'Header field',
            'className' => 'header',
        ),
        array(
            'type' => 'paragraph',
            'subtype' => 'p',
            'label' => 'A paragraph',
            'className' => 'paragraph',
        ),
        array(
            'type' => 'number',
            'label' => 'Number field',
            'description' => 'A default number field',
            'min' => '0',
            'max' => '18446744073000000000',
            'step' => '1',
            'className' => 'form-control',
            'value' => '0',
        ),
        array(
            'type' => 'date',
            'label' => 'Date Field',
            'description' => 'A default date field',
            'className' => 'calendar',
            'value' => '2016-10-21',
        ),
        array(
            'type' => 'text',
            'subtype' => 'email',
            'label' => 'Text field',
            'description' => 'A default text field',
            'placeholder' => 'type your text here',
            'className' => 'form-control',
            'name' => 'text',
            'maxlength' => '10',
        ),
        array(
            'type' => 'select',
            'label' => 'Select field',
            'description' => 'A default select field',
            'placeholder' => 'Select your option',
            'className' => 'form-control',
            'values' =>
                array(
                    array(
                        'label' => 'Option 1',
                        'value' => 'option-1',
                        'selected' => true,
                    ),
                    array(
                        'label' => 'Option 2',
                        'value' => 'option-2',
                        'selected' => false,
                    ),
                    array(
                        'label' => 'Option 3',
                        'value' => 'option-3',
                        'selected' => false,
                    ),
                ),
        ),
    );

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->widgets as $widget) {
            $this->loadEach($manager, $widget);
        }

        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     * @param array         $widget
     */
    public function loadEach(ObjectManager $manager, array $widget = [])
    {
        $widget = new Widget($widget);

        $manager->persist($widget);
    }
}