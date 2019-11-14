<?php
/**
 * Created by PhpStorm.
 * User: pprusek
 * Date: 13.11.19
 * Time: 13:48
 */

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductFormHandler;
use App\Form\ProductFormType;
use App\Paginator\Paginator;
use App\Repository\ProductRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends AbstractController
{
    public function list(Request $request){

        /** @var ProductRepository $repo */
        $repo = $this->getDoctrine()->getRepository(Product::class);

        $paginator = new Paginator("p", $repo->defaultQueryList(), $request->get('page', 1) );

        return $this->render(
            'product/list.html.twig',
            [
                'paginator' => $paginator
            ]
        );
    }

    public function newProduct(Request $request){
        $em = $this->getDoctrine()->getManager();

        $product = new Product();

        $form = $this->createForm( ProductFormType::class , $product );

        $handler = new ProductFormHandler($request,$form);

        if( $handler->process()){
            $em->persist($product);
            $em->flush();

            return $this->redirectToRoute("edit_product", ["id" => $product->getId()]);
        }

        return $this->render(
            'product/new_product.html.twig',
            [
                'form' => $form->createView(),
                'product' => $product,
            ]
        );
    }

    public function removeProduct(Product $product, Request $request){
        $em = $this->getDoctrine()->getManager();


        $form = $this->createForm( ProductFormType::class , $product );

        $handler = new ProductFormHandler($request,$form);

        if( $handler->process()){
            $em->persist($product);
            $em->flush();
        }

        return $this->render(
            'product/new_product.html.twig',
            [
                'form' => $form->createView(),
                'product' => $product,
            ]
        );
    }

    public function updateProduct(Request $request){
        $em = $this->getDoctrine()->getManager();

        $product = $em->getRepository(Product::class)->find($request->get("id"));

        $form = $this->createForm( ProductFormType::class , $product, ["new"=>false] );

        $handler = new ProductFormHandler($request,$form);

        if( $handler->process()){
            $em->flush();
        }

        return $this->render(
            'product/new_product.html.twig',
            [
                'form' => $form->createView(),
                'product' => $product,
            ]
        );
    }
}