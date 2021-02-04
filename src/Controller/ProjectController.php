<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\EditProjectType;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ProjectController
 * @package App\Controller
 * @Route("/project", name="project_")
 */
class ProjectController extends AbstractController
{
    /**
     * @param ProjectRepository $projectRepository
     * @return Response
     * @Route("/", name="index", methods={"GET", "POST"})
     */
    public function index(ProjectRepository $projectRepository, UserRepository $userRepository): Response
    {
        return $this->render('project/index.html.twig', [
            'projects' => $projectRepository->findAll(),
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'project_new', methods: ['GET', 'POST'])]

    /**
     * @param Request $request
     * @return Response
     * @Route("/new", name="new")
     */
    public function new(Request $request): Response
    {
        $user = $this->getUser();
        $project = new Project();
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $project->setUser($user);
            $entityManager->persist($project);
            $entityManager->flush();

            return $this->redirectToRoute('profil_index');
        }

        return $this->render('project/new.html.twig', [
            'project' => $project,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Project $project
     * @return Response
     * @Route("/{id}", name="show", methods={"GET", "POST"})
     */
    public function show(Project $project): Response
    {
        return $this->render('project/show.html.twig', [
            'project' => $project,
        ]);
    }

    /**
     * @param Request $request
     * @param Project $project
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Project $project, EntityManagerInterface $entityManager): Response
    {
        $project = new Project();
        $form = $this->createForm(EditProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($project);
            $entityManager->flush();

            $this->addFlash('success', 'Le projet a été modifié avec succès !');
            return $this->redirectToRoute('profil_index');
        }

        return $this->render('project/edit.html.twig', [
            'project' => $project,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @param Project $project
     * @return Response
     * @Route("/{id}", name="delete", methods={"DELETE"})
     */
    public function delete(Request $request, Project $project): Response
    {
        if ($this->isCsrfTokenValid('delete'.$project->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($project);
            $entityManager->flush();
        }

        return $this->redirectToRoute('project_index');
    }
}
