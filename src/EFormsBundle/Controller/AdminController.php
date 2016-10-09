<?php

namespace EFormsBundle\Controller;

use EFormsBundle\Document\Form;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class AdminController extends Controller
{

    /**
     * @param Request $request
     * 
     * @Route("/admin")
     * @Template
     */
    public function indexAction(Request $request)
    {
        $dm = $this->container->get('doctrine_mongodb.odm.document_manager');
        $qb = $dm->createQueryBuilder();
        $query = $qb->find(Form::class)->getQuery();

        return ["data" => $query->execute()];
    }

    /**
     * @Route("/admin/create")
     * @Template
     */
    public function createAction(Request $request, $id = null)
    {
        return array('a' => 'c');
        // replace this example code with whatever you need
        /*return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);*/
    }


    /**
     * @param Request $request
     * @param string $id
     * 
     * @Route("/admin/delete/{id}")
     */
    public function deleteAction(Request $request, $id = null)
    {
        $dm = $this->container->get('doctrine_mongodb.odm.document_manager');
        $item = $dm->find(Form::class, $id);
        
        $dm->remove($item);
        $dm->flush();

        return $this->redirect('/admin');
    }
}
