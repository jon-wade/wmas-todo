<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Task;
use Symfony\Component\HttpFoundation\Request;

class ToDoController extends Controller
{

    /**
     * @param Request $request
     * @Route("/", name="homepage")
     * @return Response
     */

    public function indexAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Task');
        $tasks = $repository->findAll();
        return $this->render('default/task.html.twig', array('tasks' => $tasks));
    }

    /**
     * Matches /create/*
     * @param $data
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/create/{data}", name="create")
     */

    public function createAction($data) {

        $em = $this->getDoctrine()->getManager();
        $task = new Task();
        $task->setItem($data);
        $em->persist($task);
        $em->flush();
        return $this->redirectToRoute('homepage');

    }

    /**
     * Matches /delete/*
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/delete/{id}", name="delete", requirements={"id": "\d+"})
     */

    public function deleteAction($id) {

        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository('AppBundle:Task');
        $task = $repository->find($id);
        $em->remove($task);
        $em->flush();
        return $this->redirectToRoute('homepage');
    }

    /**
     * Matches /update/*
     * @param $id
     * @param $value
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/update/{id}/{value}", name="update", requirements={"id": "\d+"})
     */

    public function updateAction($id, $value) {

        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository('AppBundle:Task');
        $task = $repository->find($id);
        $task->setItem($value);
        $em->flush();
        return $this->redirectToRoute('homepage');
    }

}