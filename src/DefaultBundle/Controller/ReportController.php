<?php

namespace DefaultBundle\Controller;

use DefaultBundle\Entity\Report;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Report controller.
 *
 */
class ReportController extends Controller
{
    /**
     * Lists all report entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $reports = $em->getRepository('DefaultBundle:Report')->findAll();

        $arr=[];
        foreach ($reports as $report){
            $ar= $report->jsonSerialize();
            array_push($arr,$ar);
        }

        $response = new JsonResponse($arr);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * Creates a new report entity.
     *
     */
    public function newAction(Request $request, $idUser)
    {
        $manager = $this->getDoctrine()->getManager();
        $user = $manager->getRepository("DefaultBundle:Users")->find($idUser);
        //$to = $user->getId();

        $report = new Report();
        $form = $this->createForm('DefaultBundle\Form\ReportType', $report);
        $form->handleRequest($request);
        $report->setUser($user);

        if ($form->isSubmitted() && $form->isValid()) {

            $errorList = $this->get('validator')->validate($report);
            if ($errorList->count() > 0)
            {
                foreach ($errorList as $error) {
                    $this->addFlash('error', $error->getMessage());
                }
                return $this->redirectToRoute("report_new");
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($report);
            $em->flush();

            return $this->redirectToRoute('report_show', array('id' => $report->getId()));
        }

        return $this->render('report/new.html.twig', array(
            'report' => $report,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a report entity.
     *
     */
    public function showAction($id)
    {
        $report = $this->getDoctrine()->getManager()->getRepository('DefaultBundle:Report')->find($id);
        $arr= $report->jsonSerialize();
        $response = new JsonResponse($arr);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }


    /**
     * Deletes a report entity.
     *
     */
    public function deleteAction(Request $request, Report $report)
    {
        $form = $this->createDeleteForm($report);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($report);
            $em->flush();
        }

        return $this->redirectToRoute('report_index');
    }

    /**
     * Creates a form to delete a report entity.
     *
     * @param Report $report The report entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Report $report)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('report_delete', array('id' => $report->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
