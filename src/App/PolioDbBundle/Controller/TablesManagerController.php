<?php

namespace App\PolioDbBundle\Controller;

use App\PolioDbBundle\Entity\TablesManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Tablesmanager controller.
 *
 * @Route("data_source")
 */
class TablesManagerController extends Controller
{

    /**
     * @Route("/menu", name="data_source_menu")
     * @Method("GET")
     */
    public function menuAction() {
        $em = $this->getDoctrine()->getManager();
        $menu = $em->getRepository('AppPolioDbBundle:TablesManager')->findAll();
        return $this->render("html/common/nav_left.html.twig", ['menu' => $menu]);
    }

    /**
     * Lists all tablesManager entities.
     *
     * @Route("/", name="data_source_index")
     * @Method("GET")
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        //$tablesManagers = $em->getRepository('AppPolioDbBundle:TablesManager')->findBy(array('enabled'=>1));
        $tablesManagers = $em->getRepository('AppPolioDbBundle:TablesManager')->findAll(array('orderBy'=>'sortNo'));

        return $this->render('tablesmanager/index.html.twig', array(
            'tablesManagers' => $tablesManagers,
        ));
    }

    /**
     * Creates a new tablesManager entity.
     *
     * @Route("/new", name="data_source_new")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function newAction(Request $request)
    {
        $tablesManager = new Tablesmanager();
        $form = $this->createForm('App\PolioDbBundle\Form\TablesManagerType', $tablesManager);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tablesManager);
            $em->flush($tablesManager);

            return $this->redirectToRoute('data_source_show', array('id' => $tablesManager->getId()));
        }

        return $this->render('tablesmanager/new.html.twig', array(
            'tablesManager' => $tablesManager,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tablesManager entity.
     *
     * @Route("/{id}", name="data_source_show")
     * @Method("GET")
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function showAction(TablesManager $tablesManager)
    {
        $deleteForm = $this->createDeleteForm($tablesManager);

        return $this->render('tablesmanager/show.html.twig', array(
            'tablesManager' => $tablesManager,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tablesManager entity.
     *
     * @Route("/{id}/edit", name="data_source_edit")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function editAction(Request $request, TablesManager $tablesManager)
    {
        $deleteForm = $this->createDeleteForm($tablesManager);
        $editForm = $this->createForm('App\PolioDbBundle\Form\TablesManagerType', $tablesManager);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('data_source_edit', array('id' => $tablesManager->getId()));
        }

        return $this->render('tablesmanager/edit.html.twig', array(
            'tablesManager' => $tablesManager,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tablesManager entity.
     *
     * @Route("/{id}", name="data_source_delete")
     * @Method("DELETE")
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function deleteAction(Request $request, TablesManager $tablesManager)
    {
        $form = $this->createDeleteForm($tablesManager);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tablesManager);
            $em->flush($tablesManager);
        }

        return $this->redirectToRoute('data_source_index');
    }

    /**
     * Creates a form to delete a tablesManager entity.
     *
     * @param TablesManager $tablesManager The tablesManager entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TablesManager $tablesManager)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('data_source_delete', array('id' => $tablesManager->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
