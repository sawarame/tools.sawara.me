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
    private $translator;
    private $dateTimeService;

    public function __construct(
        $translator,
        $dateTimeService
    ) {
        $this->translator = $translator;
        $this->dateTimeService = $dateTimeService;
    }

    public function indexAction(): ViewModel
    {
        return new ViewModel();
    }

    /**
     * Date format conversion tool page.
     *
     * @return ViewModel
     */
    public function dateAction(): ViewModel
    {
        $response = [];
        $form = new DatetimeForm($this->params()->fromQuery());
        $response['form'] = $form;

        if ($form->isValid()) {
            try {
                $response['date'] = $this->dateTimeService->generateDateStrings($form->getData()['q']);
            } catch (\Exception $e) {
                $form->get('q')->setMessages([$this->translator->translate('failed to date conversion.', 'date')]);
            }
        }

        return new ViewModel($response);
    }
}
