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

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

//        $task = new Task();
//        $task->setItem('Bollox');
        $taskInput = new TaskInput();


        $form = $this->createFormBuilder($taskInput)
            ->add('task', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Create Post'))
            ->getForm();


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $input = $form->getData();
            echo $input->getTask();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $em = $this->getDoctrine()->getManager();
            // $em->persist($task);
            // $em->flush();
//
//            return $this->redirectToRoute('task_success');
        }




//        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository('AppBundle:Task');

        //saves tasks in the db
//        $em->persist($task);
//        $em->flush();

        //gets all tasks from the db
        $tasks = $repository->findAll();

        return $this->render('default/task.html.twig', array(
            'tasks' => $tasks,
            'form' => $form->createView()
        ));
    }
}