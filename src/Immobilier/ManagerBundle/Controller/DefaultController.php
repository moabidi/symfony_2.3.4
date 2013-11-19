<?php

namespace Immobilier\ManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Immobilier\ManagerBundle\Entity\Pays;
use Immobilier\ManagerBundle\Entity\Gouvernorat;
use Immobilier\ManagerBundle\Form\Type\GouvernoratType;
use Immobilier\ManagerBundle\Entity\Delegation;
use Immobilier\ManagerBundle\Form\Type\DelegationType;
use Immobilier\ManagerBundle\Entity\Type;
use Immobilier\ManagerBundle\Form\Type\TypeType;
use Immobilier\ManagerBundle\Entity\Nature;
use Immobilier\ManagerBundle\Form\Type\NatureType;
use Immobilier\ManagerBundle\Entity\Category;
use Immobilier\ManagerBundle\Form\Type\CategoryType;
use Immobilier\ManagerBundle\Entity\Annonce;
use Immobilier\ManagerBundle\Form\Type\AnnonceType;
use Immobilier\ManagerBundle\Entity\User;
use Immobilier\ManagerBundle\Entity\Photo;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

    private function persistAndFlush( $object)
    {
        $em = $this->getDoctrine()->getManager();
        $em->persist($object);
        $em->flush();
    }

    public function indexAction()
    {

        return $this->render('ImmobilierManagerBundle:Default:index.html.twig');
    }

/***************** Pays **********************/
    public function createPaysAction()
    {

        $pays = new Pays();
        $pays->setName('Tunis');
        $this->persistAndFlush($pays);


        return new Response('Created pays id '.$pays->getId());
    }

    public function createSynchroPaysAction($namePays)
    {

        $pays = new Pays();
        $pays->setName($namePays);
        $this->persistAndFlush($pays);

        return new Response('Created pays id '.$pays->getId());
    }

    public function showPaysAction($id)
    {
        $pays = $this->getDoctrine()
            ->getRepository('ImmobilierManagerBundle:Pays')
            ->find($id);

        if (!$pays) {
            throw $this->createNotFoundException(
                'No pays found for id '.$id
            );
        }

        return new Response('Pays dont id '.$id.' is '.$pays->getName());
    }
    /***********************  Photo *************************/
    public function createPhotoAction($namePhoto)
    {


        //$photo = new Photo();
        $document = new Photo();
        $form = $this->createFormBuilder($document)
            ->add('file')
            ->getForm()
        ;
        echo '<pre>';
        if ($this->getRequest()->isMethod('POST')) {
            $form->bind($this->getRequest());
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                //$document->upload();
                var_dump($document);

                $em->persist($document);
                $em->flush();
                return new Response('ok');
                //$this->redirect($this->generateUrl(...));
        }
        }

        return $this->render('ImmobilierManagerBundle:Default:new_gov.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function showPhotoAction($id)
    {
        $photo = $this->getDoctrine()
            ->getRepository('ImmobilierManagerBundle:Photo')
            ->find($id);

        if (!$photo) {
            throw $this->createNotFoundException(
                'No photo found for id '.$id
            );
        }

        return new Response('Photo dont id '.$id.' is '.$photo->getName());
    }

    /***********************  Gouvernorat *************************/

    public function createGovActionOld()
    {
        $gov = new Gouvernorat();
        $form = $this->createForm(new GouvernoratType(), $gov);
        return $this->render('ImmobilierManagerBundle:User:new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function createGovAction(Request $request)
    {
        // just setup a fresh $task object (remove the dummy data)
        $gov = new Gouvernorat();

        $form = $this->createForm(  new GouvernoratType() ,
                                    $gov,
                                    array(
                                           'action' => $this->generateUrl('immobilier_manager_createGov'),
                                           'method' => 'POST',
                                          ));

        $form->handleRequest($request);

        if ($form->isValid())
        {
            $this->persistAndFlush($gov);
            return new Response('ok');
        }else{
            return $this->render('ImmobilierManagerBundle:Default:new_gov.html.twig', array(
                        'form' => $form->createView(),
                    ));
        }
    }

    /***********************  Delegation *************************/

    public function createDelAction(Request $request)
    {
        // just setup a fresh $task object (remove the dummy data)
        $del = new Delegation();

        $form = $this->createForm(  new DelegationType() ,
                                    $del,
                                    array(
                                           'action' => $this->generateUrl('immobilier_manager_createDel'),
                                           'method' => 'POST',
                                          ));

        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->persistAndFlush($del);
            return new Response('ok');
        }else{
            return $this->render('ImmobilierManagerBundle:Default:new_del.html.twig', array(
                        'form' => $form->createView(),
                    ));
        }
    }

    /***********************  Type **************************/
    public function createSynchroTypeAction($nameType)
    {

        $type = new Type();
        $type->setName($nameType);
        $this->persistAndFlush($type);

        return new Response('Created pays id '.$type->getId());
    }

    public function showTypeAction($id)
    {
        $type = $this->getDoctrine()
            ->getRepository('ImmobilierManagerBundle:Type')
            ->find($id);

        if (!$type) {
            throw $this->createNotFoundException(
                'No type found for id '.$id
            );
        }

        return new Response('Type dont id '.$id.' is '.$type->getName());
    }

    /************************ Nature ******************************/
    public function createTypeAction(Request $request)
    {
        $nature = new Type();
        $form = $this->createForm(  new TypeType,
            $nature,
            array( 'action' => $this->generateUrl('immobilier_manager_createType'),
                'method' => 'POST'
            )
        );
        $form->handleRequest($request);
        if($form->isValid())
        {
            $this->persistAndFlush($nature);
            return new Response('ok');
        }else{
            return $this->render(  'ImmobilierManagerBundle:Default:new_category.html.twig',
                array('form' => $form->createView())
            );
        }
    }

    /************************ Nature ******************************/
    public function createNatureAction(Request $request)
    {
        $nature = new Nature();
        $form = $this->createForm(  new NatureType,
                                    $nature,
                                    array( 'action' => $this->generateUrl('immobilier_manager_createNature'),
                                            'method' => 'POST'
                                    )
                                );
        $form->handleRequest($request);
        if($form->isValid())
        {
            $this->persistAndFlush($nature);
            return new Response('ok');
        }else{
            return $this->render(  'ImmobilierManagerBundle:Default:new_category.html.twig',
                array('form' => $form->createView())
            );
        }
    }

    /************************ Category ******************************/
    public function createCategoryAction(Request $request)
    {
        $category = new Category();
        $form = $this->createForm(  new CategoryType,
                                    $category,
                                    array( 'action' => $this->generateUrl('immobilier_manager_createCategory'),
                                            'method' => 'POST'
                                    )
                                  );
        $form->handleRequest($request);
        if($form->isValid())
        {
            $this->persistAndFlush($category);
            return new Response('ok');
        }else{
            return $this->render(  'ImmobilierManagerBundle:Default:new_category.html.twig',
                                    array('form' => $form->createView())
                                );
        }
    }

    /***********************  Annonce *************************/
    public function createAnnonceAction(Request $request)
    {
        // obtenir respectivement des variables GET et POST
        //$request->query->get('foo');
        //$request->request->get('bar', 'valeur par défaut si bar est inexistant');

        // obtenir les variables SERVER
        //$request->server->get('HTTP_HOST');

        // obtenir une instance de UploadedFile identifiée par foo
        //$request->files->get('foo');

        // obtenir la valeur d'un COOKIE value
        //equest->cookies->get('PHPSESSID');

        // obtenir un entête de requête HTTP request header, normalisé en minuscules
        //$request->headers->get('host');
        //$request->headers->get('content_type');

        //$request->getMethod();          // GET, POST, PUT, DELETE, HEAD
        //$request->getLanguages();       // un tableau des langues que le client accepte

        $annonce = new Annonce();
        $form   = $this->createForm( new AnnonceType,
                                     $annonce,
                                     array( 'action' => $this->generateUrl('immobilier_manager_createAnnonce'),
                                            'method' => 'POST'
                                           )
                                    );
        $photo = new Photo();
        $form_photo = $this->createFormBuilder($photo)
            ->add('file')
            ->getForm()
        ;
        //var_dump($request->request->get('name'));
        //var_dump($request->request->get('annonce'));
        //die();
        $form->handleRequest($request);
        $form_photo->handleRequest($request);
        if( $form->isValid() )
        { // perform some action, such as saving the task to the database


            $user = new User();
            $user->setLogin($request->request->get('name'));
            $user->setEmail($request->request->get('email'));
            $this->persistAndFlush($user);
            $idUser = $user->getId();
            $annonce->setUser($idUser);
            $this->persistAndFlush($annonce);
            return $this->redirect($this->generateUrl(  'immobilier_manager_showAnnonce',
                                                        array('id' => $annonce->getId())
                                                    ));

        }else{
             return $this->render(  'ImmobilierManagerBundle:Default:new_annonce.html.twig',
                                    array(  'form' => $form->createView(),
                                            //'form_photo' => $form_photo->createView()
                                    )
                                );
         }
    }
    /*********************** Show Annonce *******************************/
    public function showAnnonceAction($id)
    {
        $annonce  = $this->getDoctrine()->getRepository('ImmobilierManagerBundle:Annonce')->find($id);
        if( !$annonce )
            throw $this->createNotFoundException(
                'Annonce not exist with id : '.$id
            );
        return $this->render('ImmobilierManagerBundle:Default:show_annonce.html.twig',
                              array('annonce' => $annonce)
                            );
    }

    /*********************** List Annonces *******************************/
    public function listAnnoncesAction()
    {
        $listAnnonces = $this->getDoctrine()->getRepository('ImmobilierManagerBundle:Annonce')->findAll();
        return $this->render(   'ImmobilierManagerBundle:Default:list_annonces.html.twig',
                                array('list_annonces'=>$listAnnonces)
                            );
    }
}
