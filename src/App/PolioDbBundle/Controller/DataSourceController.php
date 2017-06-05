<?php

namespace App\PolioDbBundle\Controller;

use App\PolioDbBundle\Entity\DataSource;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Datasource controller.
 *
 * @Route("data_source")
 */
class DataSourceController extends Controller
{
    /**
     * Lists all dataSource entities.
     *
     * @Route("/", name="data_source_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $dataSources = $em->getRepository('AppPolioDbBundle:DataSource')->findAll();

        return $this->render('datasource/index.html.twig', array(
            'dataSources' => $dataSources,
        ));
    }

    /**
     * Creates a new dataSource entity.
     *
     * @Route("/new", name="data_source_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $dataSource = new DataSource();
        $form = $this->createForm('App\PolioDbBundle\Form\DataSourceType', $dataSource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($dataSource);
            $em->flush($dataSource);

            return $this->redirectToRoute('data_source_show', array('id' => $dataSource->getId()));
        }

        return $this->render('datasource/new.html.twig', array(
            'dataSource' => $dataSource,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a dataSource entity.
     *
     * @Route("/{id}", name="data_source_show")
     * @Method("GET")
     */
    public function showAction(DataSource $dataSource)
    {
        $deleteForm = $this->createDeleteForm($dataSource);

        return $this->render('datasource/show.html.twig', array(
            'dataSource' => $dataSource,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing dataSource entity.
     *
     * @Route("/{id}/edit", name="data_source_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, DataSource $dataSource)
    {
        $deleteForm = $this->createDeleteForm($dataSource);
        $editForm = $this->createForm('App\PolioDbBundle\Form\DataSourceType', $dataSource);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('data_source_edit', array('id' => $dataSource->getId()));
        }

        return $this->render('datasource/edit.html.twig', array(
            'dataSource' => $dataSource,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a dataSource entity.
     *
     * @Route("/{id}", name="data_source_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, DataSource $dataSource)
    {
        $form = $this->createDeleteForm($dataSource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($dataSource);
            $em->flush($dataSource);
        }

        return $this->redirectToRoute('data_source_index');
    }

    /**
     * Creates a form to delete a dataSource entity.
     *
     * @param DataSource $dataSource The dataSource entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(DataSource $dataSource)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('data_source_delete', array('id' => $dataSource->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
