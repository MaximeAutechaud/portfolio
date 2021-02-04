<?php

namespace App\Controller;

use App\Repository\ProjectRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\EditProfilType;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class ProfilController
 * @package App\Controller
 * @Route("/profile", name="profil_")
 */
class ProfilController extends AbstractController
{

    /**
     * @param ProjectRepository $projectRepository
     * @param Request $request
     * @return Response
     * @Route("/index", name="index")
     */
    public function index(ProjectRepository $projectRepository, Request $request): Response
    {
        $user = $this->getUser();
        $projects = $projectRepository->findBy(
            ['user' => $user]
        );
        $form = $this->createForm(EditProfilType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Votre profil a été modifié');
            return $this->redirectToRoute('profil_index');
        }

        return $this->render('profile/index.html.twig', [
            'projects' => $projects,
            'user' => $user,
            'formProfil' => $form->createView(),
        ]);

    }

}
