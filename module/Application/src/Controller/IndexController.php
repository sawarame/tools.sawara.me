<?php

/**
 * @see       https://github.com/laminas/laminas-mvc-skeleton for the canonical source repository
 * @copyright https://github.com/laminas/laminas-mvc-skeleton/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-mvc-skeleton/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Application\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Application\Form\DatetimeForm;

class IndexController extends AbstractActionController
{

    private $dateService;

    public function __construct($dateService)
    {
        $this->dateService = $dateService;
    }

    public function indexAction()
    {
        return new ViewModel();
    }

    /**
     * Date format conversion tool page.
     *
     * @return ViewModel
     */
    public function dateAction() : ViewModel
    {
        $response = [];
        $form = new DatetimeForm($this->params()->fromQuery());
        $response['form'] = $form;

        if ($form->isValid()) {
            $response['date'] = $this->dateService->generateDateStrings($form->getData()['query']);
        }
        
        return new ViewModel($response);
    }
}
