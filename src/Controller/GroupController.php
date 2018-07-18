<?php

namespace App\Controller;

use App\Entity\Groups;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Form\GroupType;

class GroupController extends Controller
{
    const PER_PAGE = 10;

    /**
     * @Route("/group", name="group")
     */
    public function index(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT g
                                      FROM App:Groups g
                                      ORDER BY g.id DESC');
        $groups = $query->getResult();

        $paginator = $this->get('knp_paginator');
        $groups = $paginator->paginate(
            $groups,
            $request->query->getInt('page', 1),
            self::PER_PAGE
        );

        return $this->render(
            'group/index.html.twig',
            array(
                'g_paginated' => $groups,
            )
        );
    }

    /**
     * @Route("/group/edit/{groupId}/{page}",
     *     defaults={"groupId" = 0, "page" = 1},
     *     requirements={"groupId": "\d+"},
     *     name="group_edit")
     * )
     */
    public function edit($groupId, $page, Request $request)
    {
        if (empty($groupId)) {
            $postData = $request->get('group');
            if (isset($postData['id'])) {
                $groupId = intval($postData['id']);
            }
        }

        if (empty($groupId)) {
            $group = new Groups();
        } else {
            $group = $this->getDoctrine()
                ->getRepository('App:Groups')
                ->find($groupId);
            if (empty($group)){
                throw $this->createNotFoundException(
                    'No book work found for id '.$groupId
                );
            }
        }

        $groupForm = $this->createForm(GroupType::class, $group);
        $groupForm->get('page')->setData($page);

        $groupForm->handleRequest($request);

        if ($groupForm->isSubmitted() && $groupForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($group);
            try {
                $em->flush();
                return $this->redirect($this->generateUrl('group', ['page'=>$groupForm->get('page')->getData()]));
            } catch (\Exception $e) {
                throw $e;
            }
        }

        return $this->render(
            'group/edit.html.twig',
            array(
                'group_form' => $groupForm->createView()
            )
        );
    }

    /**
     * @Route("/group/team/add/{groupId}/{page}",
     *     defaults={"groupId" = 0, "page" = 1},
     *     requirements={"groupId": "\d+"},
     *     name="group_team_add")
     * )
     */
    public function team_add($groupId, $page, Request $request)
    {
        return $this->render(
            'group/team_edit.html.twig',
            array(
//                'group_form' => $groupForm->createView()
            )
        );
    }
}
