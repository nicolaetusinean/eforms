<?php

namespace EFormsBundle\Controller;

use EFormsBundle\Document\Form;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class HomeController extends Controller
{
    /**
     * @Route("/")
     *
     * @Template
     */
    public function indexAction(Request $request)
    {
        return array('a' => 'b');
    }

    /**
     * @param Request $request
     * @param int     $id
     *
     * @return array
     *
     * @Route("/view/{id}", name="eforms_home_view")
     *
     * @Template
     */
    public function viewAction(Request $request, $id = null)
    {
        $dm = $this->container->get('doctrine_mongodb.odm.document_manager');
        $form = $dm->find(Form::class, $id);
        $form = $this->container->get('serializer')->normalize($form);
        $section = reset($form['sections']);
        $widgets = $section['widgets'];

        return array('widgets' => $widgets);
    }
}
