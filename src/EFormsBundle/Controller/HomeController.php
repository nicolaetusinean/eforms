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
        // replace this example code with whatever you need
        /*return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);*/
    }

    /**
     * @param Request $request
     * @param int     $id
     *
     * @return array
     *
     * @Route("/view/{id}", name="view")
     *
     * @Template
     */
    public function viewAction(Request $request, $id = null)
    {
        $dm = $this->container->get('doctrine_mongodb.odm.document_manager');
        $form = $dm->find(Form::class, $id);
        $form = $this->container->get('serializer')->normalize($form);

        return array(
            'form' => reset($form['sections'])['widgets'],
        );
    }
}
