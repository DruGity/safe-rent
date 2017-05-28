<?php

namespace DefaultBundle\Controller;

use DefaultBundle\Entity\Users;
use DefaultBundle\Entity\UserOrder;
use DefaultBundle\Entity\OrderAdvert;
use DefaultBundle\Form\UserOrderType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\ConstraintViolationList;

class BasketController extends Controller
{
    public function addToBasketAction($idAdvert)
    {
        $manager = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $order = $manager->getRepository("DefaultBundle:UserOrder")->getOrCreateOrder($user);

        $dql = 'select a from DefaultBundle:OrderAdvert a where a.order = :renterOrder and a.idAdvert = :idAdvert';
        /** @var OrderAdvert $orderAdvert */
        $orderAdvert = $manager->createQuery($dql)->setParameters([
            'idAdvert' => $idAdvert,
            'renterOrder' => $order])->getOneOrNullResult();

        if ($orderAdvert !== null) {
            $manager->persist($orderAdvert);
            $manager->flush();
        } else {
            $advert = $manager->getRepository("DefaultBundle:Adverts")->find($idAdvert);
            $orderAdvert = new OrderAdvert();
            $orderAdvert->setDescription($advert->getDiscription());
            $orderAdvert->setPricePerMonth($advert->getPricePerMonth());
            $orderAdvert->setIdAdvert($advert->getId());
            $orderAdvert->setOrder($order);
            $manager->persist($orderAdvert);
            $manager->flush();
        }
            return $this->redirectToRoute("adverts_index");
    }

    public function indexAction()
    {
        $manager = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $order = $manager->getRepository('DefaultBundle:UserOrder')->getOrCreateOrder($user);

        return $this->render('basket/index.html.twig', array('order' => $order));
    }

    public function confirmAction(Request $request){
        $manager = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $order = $manager->getRepository('DefaultBundle:UserOrder')->getOrCreateOrder($user);


            $order->setStatus(UserOrder::STATUS_DONE);
            $manager->persist($order);
            $manager->flush();

        return $this->render('basket/confirm.html.twig', array(
           'order' => $order
        ));

    }
    public function removeOrderAction($id)
    {
        $manager= $this->getDoctrine()->getManager();
        $orderAdvert = $manager->getRepository('DefaultBundle:OrderAdvert')->find($id);
        $manager->remove($orderAdvert);
        $manager->flush();

        return $this->redirectToRoute("basket_index");
    }
}
