<?php

namespace App\Controller;

use App\Entity\Link;
use App\Repository\LinkRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class LinkController extends AbstractController
{
    public function getHomepage(): Response
    {
        return $this->render('link/homepage.html.twig', [
            'slag' => ''
        ]);
    }

    public function postLink(Request $request): Response
    {
        $originalUrl = $request->get('original-url');
        $link = new Link($originalUrl);

        $repository = new LinkRepository(__DIR__);
        $repository->save($link);

        return $this->render('link/homepage.html.twig', [
            'slag' => 'http://127.0.0.1:8000/short/' . $link->getSlag()
        ]);

    }

    public function getLink(string $slag): Response
    {
        $repository = new LinkRepository(__DIR__);

        $originalUrl = $repository->getOriginalUrl($slag);
        if ($originalUrl === '') {
            $error = 'Ссылка не найдена';
            return $this->render('link/error.html.twig', [
                'error' => $error,
            ]);
        }
        return $this->redirect($originalUrl);
    }
}
