<?php
/**
 * Created by PhpStorm.
 * User: pprusek
 * Date: 14.11.19
 * Time: 14:46
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

class ShopController extends AbstractController
{
    public function index(Request $request){

        /** @var ProductRepository $repo */
        $repo = $this->getDoctrine()->getRepository(Product::class);

        $paginator = new Paginator("p", $repo->defaultQueryList(), $request->get('page', 1) );

        return $this->render(
            'shop/index.html.twig',
            [
                'paginator' => $paginator
            ]
        );
    }
}