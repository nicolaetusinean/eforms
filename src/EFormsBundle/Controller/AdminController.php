<?php

namespace EFormsBundle\Controller;

use EFormsBundle\Document\Form;
use EFormsBundle\Document\FormWidget;
use EFormsBundle\Document\Section;
use EFormsBundle\Document\Widget;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class AdminController extends Controller
{

    /**
     * @Route("/admin")
     * @Template
     */
    public function listAction(Request $request)
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
    public function createAction(Request $request)
    {
        return array('a' => 'c');
        // replace this example code with whatever you need
        /*return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);*/
    }

    /**
     * @Route("/admin/save")
     */
    public function saveAction(Request $request)
    {
        $widgets = json_decode($request->request->get('json'));
        $widgets = json_decode(json_encode($widgets), true);

        $form = new Form();
        $form->label = $request->request->get('name');

        $section = new Section();
        $section->label = "Test Section";

        foreach($widgets as $widgetData) {
            $widget = new Widget($widgetData);
            $section->widgets[] = $widget;
        }

        $form->sections[] = $section;
        $dm = $this->get('doctrine_mongodb')->getManager();
        $dm->persist($form);
        $dm->flush();

        $response = new JsonResponse();
        $response->setData(array(
            'valid' => 1
        ));
        return $response;
    }
}
