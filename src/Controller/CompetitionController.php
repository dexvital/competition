<?php

namespace App\Controller;

use App\Entity\Competition;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Form\CompetitionType;

class CompetitionController extends Controller
{
    const PER_PAGE = 10;

    /**
     * @Route("/", name="competition")
     */
    public function index(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT c 
                                      FROM App:Competition c
                                      ORDER BY c.id DESC');
        $competitions = $query->getResult();

        $paginator = $this->get('knp_paginator');
        $competitions = $paginator->paginate(
            $competitions,
            $request->query->getInt('page', 1),
            self::PER_PAGE
        );

        return $this->render(
            'competition/index.html.twig',
            array(
                'c_paginated' => $competitions,
            )
        );
    }

    /**
     * @Route("/competition/edit/{competitionId}/{page}",
     *     defaults={"competitionId" = 0, "page" = 1},
     *     requirements={"competitionId": "\d+"},
     *     name="competition_edit")
     * )
     */
    public function edit ($competitionId, $page, Request $request)
    {
        if (empty($competitionId)) {
            $postData = $request->get('competition');
            if (isset($postData['id'])) {
                $competitionId = intval($postData['id']);
            }
        }

        if (empty($competitionId)) {
            $competition = new Competition();
        } else {
            $competition = $this->getDoctrine()
                ->getRepository('App:Competition')
                ->find($competitionId);
            if (empty($competition)){
                throw $this->createNotFoundException(
                    'No book work found for id '.$competitionId
                );
            }
        }

        $competitionForm = $this->createForm(CompetitionType::class, $competition);
        $competitionForm->get('page')->setData($page);

        $competitionForm->handleRequest($request);

        if ($competitionForm->isSubmitted() && $competitionForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($competition);
            try {
                $em->flush();
                return $this->redirect($this->generateUrl('competition', ['page'=>$competitionForm->get('page')->getData()]));
            } catch (\Exception $e) {

            }
        }

        return $this->render(
            'competition/edit.html.twig',
            array(
                'competition_form' => $competitionForm->createView()
            )
        );
    }

}
