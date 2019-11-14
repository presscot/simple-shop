<?php
/**
 * Created by PhpStorm.
 * User: pprusek
 * Date: 13.11.19
 * Time: 13:47
 */

namespace App\Form;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Exception\ValidatorException;

abstract class FormHandlerAbstract
{
    private $request;
    private $form;

    abstract protected function update();
    /*
    {
        $request = $this->getRequest();
        $form = $this->getForm();
        $config = $form->getConfig();
        $name = $config->getName();
        $item = $form->getData();

        $data = $request->get( $name );
        return $this;
    }
    */

    public function __construct( Request $request, FormInterface $form  ){
        $this->form = $form;
        $this->request = $request;

    }

    protected function before(){

    }

    public function process( $exception = false ){
        $request = $this->getRequest();
        $form = $this->getForm();

        $this->before();

        if( $request->isMethod('POST') ){
            $form->handleRequest( $request );

            if ( $form->isSubmitted() ) {
                if($form->isValid()){
                    $this->update();
                    return true;
                }elseif($exception){
                    throw new ValidatorException();
                }
            }
        }

        return false;
    }

    public function getErrors(){
        return $this->form->getErrors(true);
    }

    protected function getData(){
        $form = $this->getForm();

        return $form->getData();
    }

    /**
     * @return Request
     */
    protected function getRequest(){
        return $this->request;
    }

    /**
     * @return FormInterface
     */
    protected function getForm(){
        return $this->form;
    }
}