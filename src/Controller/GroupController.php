<?php

namespace App\Controller;

use App\Entity\Groups;
use App\Entity\GroupsTeam;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Form\GroupType;
use App\Form\GroupsTeamType;

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

        if (empty($groupId)) {
            $postData = $request->get('groups_team');
            if (isset($postData['group_id'])) {
                $groupId = (int)$postData['group_id'];
            }
        }

        $group = $this->getDoctrine()
            ->getRepository('App:Groups')
            ->find($groupId);
        if (empty($group)){
            throw $this->createNotFoundException(
                'No group work found for id '.$groupId
            );
        }

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
                    'SELECT g
                    FROM App:GroupsTeam g
                    WHERE g.group = :group
                    ORDER BY g.id DESC'
                )->setParameter('group', $group);
        $teams = $query->getResult();

        $paginator = $this->get('knp_paginator');
        $teams = $paginator->paginate(
            $teams,
            $request->query->getInt('page', 1),
            self::PER_PAGE
        );

        $groupsTeam = new GroupsTeam();
        $groupsTeam->setGroup($group);

        $groupsTeamForm = $this->createForm(GroupsTeamType::class, $groupsTeam);
        $groupsTeamForm->get('page')->setData($page);
        $groupsTeamForm->get('group_id')->setData($groupId);

        $groupsTeamForm->handleRequest($request);

        if ($groupsTeamForm->isSubmitted() && $groupsTeamForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($groupsTeam);
            try {
                $em->flush();
                return $this->redirect($this->generateUrl('group_team_add', [
                    'groupId' => $groupId,
                    'page'=>$groupsTeamForm->get('page')->getData()
                ]));
            } catch (\Exception $e) {
                throw $e;
            }
        }


        return $this->render(
            'group/team_add.html.twig',
            array(
                't_paginated' => $teams,
                'groups_team_form' => $groupsTeamForm->createView()
            )
        );
    }

    /**
     * @Route("/group/team/delete/{groupsTeamId}/{page}",
     *     defaults={"groupsTeamId" = 0, "page" = 1},
     *     requirements={"groupsTeamId": "\d+"},
     *     name="group_team_delete")
     * )
     */
    public function team_delete($groupsTeamId, $page, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $groupsTeam = $em->getRepository('App:GroupsTeam')->find($groupsTeamId);
        $groupId = $groupsTeam->getGroup()->getId();
        if (!$groupsTeam) {
            throw $this->createNotFoundException(
                'No category found for id '.$groupsTeamId
            );
        }

        $em->remove($groupsTeam);
        $em->flush();
        return $this->redirect($this->generateUrl('group_team_add', ['groupId' => $groupId, 'page'=>$page]));
    }
}
