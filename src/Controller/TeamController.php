<?php

namespace App\Controller;

use App\Entity\Team;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Form\TeamType;

class TeamController extends Controller
{
    const PER_PAGE = 10;

    /**
     * @Route("/team", name="team")
     */
    public function index(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT t
                                      FROM App:Team t
                                      ORDER BY t.id DESC');
        $teams = $query->getResult();

        $paginator = $this->get('knp_paginator');
        $teams = $paginator->paginate(
            $teams,
            $request->query->getInt('page', 1),
            self::PER_PAGE
        );

        return $this->render(
            'team/index.html.twig',
            array(
                't_paginated' => $teams,
            )
        );
    }

    /**
     * @Route("/team/edit/{teamId}/{page}",
     *     defaults={"teamId" = 0, "page" = 1},
     *     requirements={"teamId": "\d+"},
     *     name="team_edit")
     * )
     */
    public function edit($teamId, $page, Request $request)
    {
        if (empty($teamId)) {
            $postData = $request->get('team');
            if (isset($postData['id'])) {
                $teamId = intval($postData['id']);
            }
        }

        if (empty($teamId)) {
            $team = new Team();
        } else {
            $team = $this->getDoctrine()
                ->getRepository('App:Team')
                ->find($teamId);
            if (empty($team)){
                throw $this->createNotFoundException(
                    'No book work found for id '.$teamId
                );
            }
        }

        $teamForm = $this->createForm(TeamType::class, $team);
        $teamForm->get('page')->setData($page);

        $teamForm->handleRequest($request);

        if ($teamForm->isSubmitted() && $teamForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($team);
            try {
                $em->flush();
                return $this->redirect($this->generateUrl('team', ['page'=>$teamForm->get('page')->getData()]));
            } catch (\Exception $e) {
                throw $e;
            }
        }

        return $this->render(
            'team/edit.html.twig',
            array(
                'team_form' => $teamForm->createView()
            )
        );
    }
}
