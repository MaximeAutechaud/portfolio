<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\ProjectRepository;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class UserController
 * @package App\Controller
 * @Route("/portfolio", name="portfolio_")
 */
class UserController extends AbstractController
{

    /**
     * @param UserRepository $userRepository
     * @param ProjectRepository $projectRepository
     * @return Response
     * @Route("/index", name="index", methods={"GET", "POST"})
     */
    public function index(UserRepository $userRepository, ProjectRepository $projectRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
            'projects' => $projectRepository->findAll()
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/new", name="new", methods={"GET", "POST"})
     */
    public function new(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param User $user
     * @param ProjectRepository $projectRepository
     * @return Response
     * @Route("/{slug}", name="show", methods={"GET"})
     * @ParamConverter("user", class="App\Entity\User", options={"mapping": {"slug": "slug"}})
     */
    public function show(User $user, ProjectRepository $projectRepository): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
            'projects' => $projectRepository->findBy([
                'user' => $user->getId()
            ]),
        ]);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return Response
     * @Route("/{slug}/edit", name="edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('portfolio_index');
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return Response
     * @Route("/{slug}", name="delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('portfolio_index');
    }
}
