<?php

namespace EFormsBundle\Controller;

use EFormsBundle\Document\Form;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HomeController extends Controller
{
    /**
     * @Route("/")
     *
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

        if ($form === null) {
            $msg = sprintf('Missing form object form id %s.', $id);

            throw new NotFoundHttpException($msg);
        }

        $form = $this->container->get('serializer')->normalize($form);
        $section = reset($form['sections']);
        $widgets = $section['widgets'];

        return array('widgets' => $widgets);
    }
}
