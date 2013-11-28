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
use Immobilier\ManagerBundle\Entity\AnnonceRepository;
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
    /**************** List gouvernorats **********************/
    public function getGouvernoratsAction(Request $request)
    {
        $idPays = $request->request->get('idPays');
        if (is_numeric($idPays)){
            $pays = $this->getDoctrine()->getRepository('ImmobilierManagerBundle:Pays')->find($idPays);
            $listGouvernorats = $pays->getGouvernorats();
            return $this->render('ImmobilierManagerBundle:Default:list_options.html.twig', array(
                'list_options' => $listGouvernorats,
                'select_field' => 'gouvernorat'
            ));
        }else{
            throw $this->createNotFoundException(' id doit etre de type entier : '.$idPays);
        }
    }

    /**************** List delegations **********************/
    public function getDelegationsAction(Request $request)
    {
        $idGouvernorat = $request->request->get('idPays');
        if (is_numeric($idGouvernorat)){
            $gov = $this->getDoctrine()->getRepository('ImmobilierManagerBundle:Gouvernorat')->find($idGouvernorat);
            $listDelegations = $gov->getDelegations();
            return $this->render('ImmobilierManagerBundle:Default:list_options.html.twig', array(
                'list_options' => $listDelegations,
                'select_field' => 'delegation'
            ));
        }else{
            throw $this->createNotFoundException(' id doit etre de type entier : '.$idGouvernorat);
        }
    }
    /**************** List localites **********************/
    public function getLocationsAction(Request $request)
    {
        $idDelegation = $request->request->get('idPays');
        if (is_numeric($idDelegation)){
            $del = $this->getDoctrine()->getRepository('ImmobilierManagerBundle:Delegation')->find($idDelegation);
            $listLocalites = $del->getLocalites();
            return $this->render('ImmobilierManagerBundle:Default:list_options.html.twig', array(
                'list_options' => $listLocalites,
                'select_field' => 'localite'
            ));
        }else{
            throw $this->createNotFoundException(' id doit etre de type entier : '.$idDelegation);
        }
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

        //echo "<pre>";
        //var_dump($request->files->get('annonce'));
        //var_dump($request->request->get('nom'));
        //var_dump($request->request->get('annonce'));
        //die();
        $form->handleRequest($request);

        if( $form->isValid() )
        { // perform some action, such as saving the task to the database

            $user = new User();
            $user->setLogin($request->request->get('nom'));
            $user->setEmail($request->request->get('email'));
            //$this->persistAndFlush($user);
            $idUser = $user->getId();
            $annonce->setIdUser($idUser);
            $annonce->setCreated(time());
            $annonce->setUpdated(time());
            $this->persistAndFlush($annonce);

            $aPhotos = $request->files->get('annonce');
            $nbPhotos = count( $aPhotos['photos']);
            if( $nbPhotos > 0)
            {
                for($i= 0; $i< $nbPhotos;$i++ )
                {
                    $photo = new Photo();
                    $photo->setFile($aPhotos['photos'][$i]);
                    $photo->setIdAnnonce( $annonce->getId());
                    $this->persistAndFlush($photo);
                }
            }
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
        $annonce    = $this->getDoctrine()->getRepository('ImmobilierManagerBundle:Annonce')->find($id);
        if( !$annonce )
            throw $this->createNotFoundException(
                'Annonce not exist with id : '.$id
            );
        $photos     = $this->getDoctrine()->getRepository('ImmobilierManagerBundle:Photo')->findBy(array('idAnnonce'=> $id));
        $type       = $this->getDoctrine()->getRepository('ImmobilierManagerBundle:Type')->findOneBy(array('id'=> $annonce->getIdType()));
        $listPhotos = array();
        if(count($photos)>0)
        {
            $i = 0;
            while($i<count($photos))
            {
             $photo =  $photos[$i];
             $listPhotos[] =  $photo->getWebPath($photo->getId(),$photo->path);
             $i++;
            }
        }

        return $this->render('ImmobilierManagerBundle:Default:show_annonce.html.twig',
                              array('annonce' => $annonce,
                                    'type' => $type->getName(),
                                    'list_photos' => $listPhotos
                              ));
    }

    /*********************** List Annonces *******************************/
    public function listAnnoncesAction(Request $request)
    {
        if($request->request->get('filter'))
        {

            $cond['idLocalite'] = $request->request->get('idLocalite');
            $cond['idDelegation'] = $request->request->get('idDelegation');
            $cond['idGouvernorat'] = $request->request->get('idGouvernorat');
            $cond['idPays'] = $request->request->get('idPays');
            $cond['idType'] = $request->request->get('idType');
            $cond['idNature'] = $request->request->get('idNature');
            $cond['idRubrique'] = $request->request->get('idRubrique');
            $cond['minPrice'] = $request->request->get('minPrice');
            $cond['maxPrice'] = $request->request->get('maxPrice');
            $cond['minArea'] = $request->request->get('minArea');
            $cond['maxArea'] = $request->request->get('maxArea');
            $listAnnonces = $this->getDoctrine()->getRepository('ImmobilierManagerBundle:Annonce')->filterAnnonces($cond);
        }
        else
        {
            $listAnnonces = $this->getDoctrine()->getRepository('ImmobilierManagerBundle:Annonce')->findAll();
        }
        //$queury = 'SELECT DISTINCT  ph.id,ph.idAnnonce FROM Immobilier\ManagerBundle\Entity\Photo ph group By ph.idAnnonce ';
        //$listPhotos = $this->getDoctrine()->getManager()->createQuery($queury)->getResult();
        $photoRepos = $this->getDoctrine()->getRepository('ImmobilierManagerBundle:Photo');
        $queryPhotos = $photoRepos->createQueryBuilder('ph')
                    ->select('ph.id,ph.idAnnonce,ph.path')
                    ->distinct()
                    ->groupBy('ph.idAnnonce')
                    ->getQuery();
        $listPhotos = $queryPhotos->getResult();
        if(count($listPhotos) > 0 )
        {
            $oPhoto = new Photo();
            foreach( $listPhotos as $photo )
                $listPhotosLine[$photo['idAnnonce']] = $oPhoto->getWebPath($photo['id'],$photo['path']);
        }
        //var_dump($listPhotosLine);
        //die();
        return $this->render(   'ImmobilierManagerBundle:Default:list_annonces.html.twig',
                                array(  'list_annonces' => $listAnnonces,
                                        'list_photos' => $listPhotosLine
                                )
                            );
    }
}
