<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Task;
use AppBundle\Entity\TaskInput;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class ToDoController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $taskInput = new TaskInput();
        $form = $this->createFormBuilder($taskInput)
            ->add('task', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Save ToDo'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $input = $form->getData();
            $taskData = $input->getTask();
            $em = $this->getDoctrine()->getManager();
            $task = new Task();
            $task->setItem($taskData);
            $em->persist($task);
            $em->flush();
        }

        $repository = $this->getDoctrine()->getRepository('AppBundle:Task');

        //gets all tasks from the db
        $tasks = $repository->findAll();

        return $this->render('default/task.html.twig', array(
            'tasks' => $tasks,
            'form' => $form->createView()
        ));
    }

    /**
     * Matches /delete/*
     *
     * @Route("/delete/{id}", name="delete", requirements={"id": "\d+"})
     */
    public function deleteAction($id) {

        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository('AppBundle:Task');

        $task = $repository->find($id);

        if (!$task) {
            throw $this->createNotFoundException(
                'No task found for id '.$id
            );
        }

        $em->remove($task);
        $em->flush();

        return $this->redirectToRoute('homepage');
    }


}