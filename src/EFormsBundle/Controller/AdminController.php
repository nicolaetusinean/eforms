<?php

namespace EFormsBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class AdminController extends Controller
{
    const STATIC_DUMMYE_DATA = '{"id":"57f92169c6047b800f1e2122","label":"Cerere pentru acordarea indemnizatiei de crestere a copilului","description":"Cerere pentru acordarea indemnizaţiei de creştere a copilului / stimulentului de inserţie / indemnizaţiei lunare / sprijinului lunar şi alocaţiei de stat pentru copii","sections":[{"type":"field-group","label":"Cerere","fields":[{"type":"number","label":"Numar","description":"info box","min":"0","step":"1","name":"cerere-numar","widget_id":"57f921c5c6047b800f1e2124"}]},{"type":"field-group","label":"Datele personale ale solicitantului","fields":[{"type":"text","required":true,"label":"Nume","subtype":"text","name":"solicitant-nume","widget_id":"57f921aac6047b800f1e2123"},{"type":"text","required":true,"label":"Prenume","subtype":"text","name":"solicitant-prenume","widget_id":"57f921aac6047b800f1e2123"},{"type":"select","required":true,"label":"Cetatenie","description":"info box","placeholder":"placeholder","name":"solicitant-cetatenie","values":[{"label":"Romana","value":"Ro","selected":true},{"label":"Alta","value":"","selected":false}],"widget_id":"57f921fbc6047b800f1e2126"},{"type":"text","required":true,"label":"CNP","subtype":"text","name":"solicitant-cnp","validator":"^d{13}$","widget_id":"57f921aac6047b800f1e2123"},{"type":"date","required":true,"label":"Data eliberare CI","subtype":"text","name":"solicitant-cnp","validator":"","widget_id":"57f921e6c6047b800f1e2125"}]}]}';


    /**
     * @Route("/admin")
     * @Template
     */
    public function indexAction(Request $request)
    {
        return array('a' => 'c');
        // replace this example code with whatever you need
        /*return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);*/
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
     * @Route("/admin/list")
     * @Template
     */
    public function listAction(Request $request)
    {
        $data = [json_decode(self::STATIC_DUMMYE_DATA, true), json_decode(self::STATIC_DUMMYE_DATA, true),json_decode(self::STATIC_DUMMYE_DATA, true)];
        return ["data" => $data];
    }
}
