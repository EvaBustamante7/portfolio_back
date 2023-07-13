<?php

namespace App\Controller;

use App\Entity\Front;
use App\Form\FrontType;
use App\Repository\FrontRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

#[Route('/front')]
class FrontController extends AbstractController
{
    #[Route('/', name: 'app_front_index', methods: ['GET'])]
    public function index(FrontRepository $frontRepository): Response
    {
        return $this->render('front/index.html.twig', [
            'fronts' => $frontRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_front_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FrontRepository $frontRepository): Response
    {
        $front = new Front();
        $form = $this->createForm(FrontType::class, $front);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Obtener el archivo del logo desde el formulario
            $logoFile = $form->get('logo')->getData();

            // Generar un nombre único para el archivo del logo
            $logoFileName = md5(uniqid()) . '.' . $logoFile->guessExtension();

            // Mover el archivo del logo a la carpeta public/img
            $logoFile->move(
                $this->getParameter('kernel.project_dir') . '/public/front',
                $logoFileName
            );

            // Guardar el nombre del archivo en el campo 'logo' de la entidad 'Back'
            $front->setLogo($logoFileName);

            $frontRepository->save($front, true);

            return $this->redirectToRoute('app_front_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('front/new.html.twig', [
            'front' => $front,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_front_show', methods: ['GET'])]
    public function show(Front $front): Response
    {
        return $this->render('front/show.html.twig', [
            'front' => $front,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_front_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Front $front, FrontRepository $frontRepository): Response
    {
        $form = $this->createForm(FrontType::class, $front);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Obtener el archivo del logo desde el formulario
            $logoFile = $form->get('logo')->getData();

            // Generar un nombre único para el archivo del logo
            $logoFileName = md5(uniqid()) . '.' . $logoFile->guessExtension();

            // Mover el archivo del logo a la carpeta public/img
            $logoFile->move(
                $this->getParameter('kernel.project_dir') . '/public/front',
                $logoFileName
            );

            // Guardar el nombre del archivo en el campo 'logo' de la entidad 'Back'
            $front->setLogo($logoFileName);

            $frontRepository->save($front, true);

            return $this->redirectToRoute('app_front_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('front/edit.html.twig', [
            'front' => $front,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_front_delete', methods: ['POST'])]
    public function delete(Request $request, Front $front, FrontRepository $frontRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$front->getId(), $request->request->get('_token'))) {
            $frontRepository->remove($front, true);
        }

        return $this->redirectToRoute('app_front_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/front/{filename}", name="app_front_image", methods={"GET"})
     */
    public function image2(string $filename): Response
    {
        $filePath = $this->getParameter('kernel.project_dir') . '/public/front/' . $filename;

        if (!file_exists($filePath)) {
            throw $this->createNotFoundException('Image not found');
        }

        $response = new BinaryFileResponse($filePath);
        $response->headers->set('Content-Type', 'image/png');

        return $response;
    }
}
