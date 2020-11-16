<?php


namespace App\Controller;


use App\Entity\UserTest;
use App\Form\Type\UserTestType;
use App\Repository\UserTestRepository;
use ProxyManager\Example\GhostObjectSkippedProperties\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserTestController extends AbstractController
{
    /**
     * @Route("/user-test-form", name="new_user", methods={"GET", "POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request) : Response
    {
        $user = new UserTest();
        $form = $this->createForm(UserTestType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('all_users');

        }

        return $this->render('usertest/new.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/", name="all_users", methods={"GET"})
     * @return Response
     */
    public function readUsers()
    {
        $users = $this->getDoctrine()->getRepository('App:UserTest')->findAll();

        return $this->render('usertest/users.html.twig', [
            'users' => $users
        ]);
    }


    /**
     * @Route("/user-test-form/{id}", name="edit_user", methods={"GET", "POST"})
     */
    public function editUser(Request $request, $id): Response
    {
        $user = $this->getDoctrine()->getRepository(UserTest::class)->find($id);
        $form = $this->createForm(UserTestType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('all_users', [
                'id' => $id,
            ]);
        }

        return $this->render('usertest/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/user-test-form/delete/{id}", name="delete_user", methods={"DELETE", "POST"})
     */
    public function deleteUser(Request $request, $id)
    {
        $user = $this->getDoctrine()->getRepository(UserTest::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($user);
        $entityManager->flush();

        return new JsonResponse(["id" => $id]);
    }

}