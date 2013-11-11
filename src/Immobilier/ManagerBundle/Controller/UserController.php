<?php

namespace Immobilier\ManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Immobilier\ManagerBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class UserController extends Controller
{
    public function indexAction($name)
    {

        return $this->render('ImmobilierManagerBundle:Default:index.html.twig', array('name' => $name));
    }


    public function createUserFormAction(Request $request)
    {
        // create a task and give it some dummy data for this example
        $user = new User();
        /*$user->setLogin('mabidi');
        $user->setPassword('mabidi');
        $user->setEmail('mabidi@gmail.com');*/

        $form = $this->createFormBuilder($user)
            ->add('login', 'text')
            ->add('password', 'password')
            ->add('email', 'email')
            ->add('save', 'submit')
            ->add('saveAndAdd', 'submit')
            ->getForm();

        $form->handleRequest($request);
        if ($form->isValid()) {
            $nextAction = $form->get('saveAndAdd')->isClicked()
                ? 'immobilier_manager_createUserForm'
                : 'immobilier_manager_showUser';

            return $this->redirect($this->generateUrl($nextAction,array('id'=>'2')));
        }
        return $this->render('ImmobilierManagerBundle:User:new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function createUserAction()
    {

        $user = new User();
        $user->setLogin('m.abidi');
        $user->setPassword('m.abidi');
        $user->setEmail('m.abidi@gmail.com');

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return new Response('Created user id '.$user->getId());
    }

    public function createSynchroUserAction($login, $passwd, $email)
    {

        $user = new User();
        $user->setLogin($login);
        $user->setPassword($passwd);
        $user->setEmail($email);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return new Response('Created pays id '.$user->getId());
    }

    public function showUserAction($id)
    {
        $user = $this->getDoctrine()
            ->getRepository('ImmobilierManagerBundle:User')
            ->find($id);

        if (!$user) {
            throw $this->createNotFoundException(
                'No pays found for id '.$id
            );
        }

        return new Response('Pays dont id '.$id.' is '.$user->getLogin());
    }
}
