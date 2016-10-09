<?php

namespace EFormsBundle\DataFixtures\MongoDB;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EFormsBundle\Document\Form;

class LoadForms implements FixtureInterface
{
    protected $forms = array(
        array(
            'id' => '57f92169c6047b800f1e2122',
            'label' => 'Cerere pentru acordarea indemnizatiei de crestere a copilului',
            'description' => 'Cerere pentru acordarea indemnizaţiei de creştere a copilului / stimulentului de inserţie / indemnizaţiei lunare / sprijinului lunar şi alocaţiei de stat pentru copii',
            'sections' => array(
                array(
                    'label' => 'Datele personale ale solicitantului',
                    'widgets' =>
                        array(
                            array(
                                'type' => 'text',
                                'required' => true,
                                'label' => 'Nume',
                                'subtype' => 'text',
                                'name' => 'solicitant-nume',
                            ),
                            array(
                                'type' => 'text',
                                'required' => true,
                                'label' => 'Prenume',
                                'subtype' => 'text',
                                'name' => 'solicitant-prenume',
                            ),
                            array(
                                'type' => 'select',
                                'required' => true,
                                'label' => 'Cetatenie',
                                'description' => 'info box',
                                'placeholder' => 'placeholder',
                                'name' => 'solicitant-cetatenie',
                                'values' =>
                                    array(
                                        array(
                                            'label' => 'Romana',
                                            'value' => 'Ro',
                                            'selected' => true,
                                        ),
                                        array(
                                            'label' => 'Alta',
                                            'value' => '',
                                            'selected' => false,
                                        ),
                                    ),
                            ),
                            array(
                                'type' => 'text',
                                'required' => true,
                                'label' => 'CNP',
                                'subtype' => 'text',
                                'name' => 'solicitant-cnp',
                            ),
                            array(
                                'type' => 'date',
                                'required' => true,
                                'label' => 'Data eliberare CI',
                                'subtype' => 'text',
                                'name' => 'solicitant-cnp',
                            ),
                        ),
                ),
            ),
        )
    );

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->forms as $forms) {
            $this->loadEach($manager, $forms);
        }

        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     * @param array $form
     */
    public function loadEach(ObjectManager $manager, array $form = [])
    {
        $form = new Form($form);

        $manager->persist($form);
    }
}