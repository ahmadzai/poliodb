<?php

namespace App\PolioDbBundle\Controller;

use App\PolioDbBundle\Entity\Campaign;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Campaign controller.
 *
 * @Route("campaign")
 */
class CampaignController extends Controller
{
    /**
     * Lists all campaign entities.
     *
     * @Route("/", name="campaign_index")
     * @Method("GET")
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $campaigns = $em->getRepository('AppPolioDbBundle:Campaign')->findAll();

        return $this->render('campaign/index.html.twig', array(
            'campaigns' => $campaigns,
        ));
    }

    /**
     * Creates a new campaign entity.
     *
     * @Route("/new", name="campaign_new")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function newAction(Request $request)
    {
        $campaign = new Campaign();
        $form = $this->createForm('App\PolioDbBundle\Form\CampaignType', $campaign);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($campaign);
            $em->flush($campaign);

            return $this->redirectToRoute('campaign_show', array('id' => $campaign->getCampaignId()));
        }

        return $this->render('campaign/new.html.twig', array(
            'campaign' => $campaign,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a campaign entity.
     *
     * @Route("/{id}", name="campaign_show")
     * @Method("GET")
     */
    public function showAction(Campaign $campaign)
    {
        $deleteForm = $this->createDeleteForm($campaign);

        return $this->render('campaign/show.html.twig', array(
            'campaign' => $campaign,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing campaign entity.
     *
     * @Route("/{id}/edit", name="campaign_edit")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editAction(Request $request, Campaign $campaign)
    {
        $deleteForm = $this->createDeleteForm($campaign);
        $editForm = $this->createForm('App\PolioDbBundle\Form\CampaignType', $campaign);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('campaign_edit', array('id' => $campaign->getCampaignId()));
        }

        return $this->render('campaign/edit.html.twig', array(
            'campaign' => $campaign,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a campaign entity.
     *
     * @Route("/{id}", name="campaign_delete")
     * @Method("DELETE")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction(Request $request, Campaign $campaign)
    {
        $form = $this->createDeleteForm($campaign);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($campaign);
            $em->flush($campaign);
        }

        return $this->redirectToRoute('campaign_index');
    }

    /**
     * Creates a form to delete a campaign entity.
     *
     * @param Campaign $campaign The campaign entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Campaign $campaign)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('campaign_delete', array('id' => $campaign->getCampaignId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
