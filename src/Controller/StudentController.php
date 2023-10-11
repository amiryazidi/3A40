<?php

namespace App\Controller;

use App\Entity\Student;
use App\Repository\StudentRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    #[Route('/student', name: 'app_student')]
    public function index(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }
    #[Route('/fetch', name: 'fetch')]
    public function fetch(StudentRepository $repo): Response{
        $result=$repo->findAll();
        return $this->render('student/test.html.twig',[
            'response'=>$result,
        ]);
    }
    #[Route('/add', name: 'add')]
    public function add(ManagerRegistry $mr):Response 
    {
        $s=new Student();
        $s->setName('test');
        $s->setEmail('test@gmail.com');
        $s->setAge('25');

        $em=$mr->getManager();
        $em->persist($s);
        $em->flush();
        return $this->redirectToRoute('fetch');
    }
    #[Route('/remove/{id}', name: 'remove')]
    public function remove(ManagerRegistry $mr , $id,StudentRepository $repo):Response
    {
      $student=$repo->find($id);

      $em=$mr->getManager();
      $em->remove($student);
      $em->flush();
      return $this->redirectToRoute('fetch');

      return new Response('removed');
    }


}
