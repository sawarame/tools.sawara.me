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

    private $dateTimeService;

    public function __construct($dateTimeService)
    {
        $this->dateTimeService = $dateTimeService;
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
            try {
                $response['date'] = $this->dateTimeService->generateDateStrings($form->getData()['query']);
            } catch (\Exception $e) {
                // $response['date'] = $this->dateTimeService->generateDateStrings();
                $response['message'] = 'failed to date conversion.';
            }
        }
        
        return new ViewModel($response);
    }
}
