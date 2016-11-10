<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Task;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {

        $task = new Task();
        $task->setItem('Bollox');

        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository('AppBundle:Task');

        //saves tasks in the db
        $em->persist($task);
        $em->flush();

        //gets all tasks from the db
        $tasks = $repository->findAll();

        return $this->render('default/task.html.twig', array(
            'tasks' => $tasks,
        ));
    }
}