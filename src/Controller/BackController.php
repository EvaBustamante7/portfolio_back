<?php

namespace App\Controller;

use App\Entity\Back;
use App\Form\BackType;
use App\Repository\BackRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

#[Route('/back')]
class BackController extends AbstractController
{
    #[Route('/', name: 'app_back_index', methods: ['GET'])]
    public function index(BackRepository $backRepository): Response
    {
        return $this->render('back/index.html.twig', [
            'backs' => $backRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_back_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BackRepository $backRepository): Response
    {
        $back = new Back();
        $form = $this->createForm(BackType::class, $back);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Obtener el archivo del logo desde el formulario
            $logoFile = $form->get('logo')->getData();

            // Generar un nombre único para el archivo del logo
            $logoFileName = md5(uniqid()) . '.' . $logoFile->guessExtension();

            // Mover el archivo del logo a la carpeta public/img
            $logoFile->move(
                $this->getParameter('kernel.project_dir') . '/public/img',
                $logoFileName
            );

            // Guardar el nombre del archivo en el campo 'logo' de la entidad 'Back'
            $back->setLogo($logoFileName);

            $backRepository->save($back, true);

            return $this->redirectToRoute('app_back_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/new.html.twig', [
            'back' => $back,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_back_show', methods: ['GET'])]
    public function show(Back $back): Response
    {
        return $this->render('back/show.html.twig', [
            'back' => $back,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_back_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Back $back, BackRepository $backRepository): Response
    {
        $form = $this->createForm(BackType::class, $back);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Obtener el archivo del logo desde el formulario
            $logoFile = $form->get('logo')->getData();

            // Generar un nombre único para el archivo del logo
            $logoFileName = md5(uniqid()) . '.' . $logoFile->guessExtension();

            // Mover el archivo del logo a la carpeta public/img
            $logoFile->move(
                $this->getParameter('kernel.project_dir') . '/public/img',
                $logoFileName
            );

            // Guardar el nombre del archivo en el campo 'logo' de la entidad 'Back'
            $back->setLogo($logoFileName);

            $backRepository->save($back, true);

            return $this->redirectToRoute('app_back_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/edit.html.twig', [
            'back' => $back,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_back_delete', methods: ['POST'])]
    public function delete(Request $request, Back $back, BackRepository $backRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$back->getId(), $request->request->get('_token'))) {
            $backRepository->remove($back, true);
        }

        return $this->redirectToRoute('app_back_index', [], Response::HTTP_SEE_OTHER);
    }
    /**
     * @Route("/img/{filename}", name="app_back_image", methods={"GET"})
     */
    public function image(string $filename): Response
    {
        $filePath = $this->getParameter('kernel.project_dir') . '/public/img/' . $filename;

        if (!file_exists($filePath)) {
            throw $this->createNotFoundException('Image not found');
        }

        $response = new BinaryFileResponse($filePath);
        $response->headers->set('Content-Type', 'image/png');

        return $response;
    }
}
