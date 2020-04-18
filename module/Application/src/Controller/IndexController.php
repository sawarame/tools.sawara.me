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
use Application\Form;
use Domain\Service;

class IndexController extends AbstractActionController
{
    private $translator;
    private $service;

    public function __construct(
        $translator,
        Service\IndexService $service
    ) {
        $this->translator = $translator;
        $this->service = $service;
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
        $form = new Form\DateTimeForm($this->params()->fromQuery());
        $response['form'] = $form;

        if ($form->isValid()) {
            try {
                $response['date'] = $this->service->generateDateStrings($form->getData()['q']);
            } catch (\Exception $e) {
                $form->get(Form\DateTimeForm::TEXT_DATETIME_QUERY)
                    ->setMessages([$this->translator->translate('failed to date conversion.', 'date')]);
            }
        }

        return new ViewModel($response);
    }

    /**
     * Generate password tool page.
     *
     * @return ViewModel
     */
    public function passwordAction(): ViewModel
    {
        $response = [];

        $query = $this->params()->fromQuery();

        // set defaults;
        $query[Form\PasswordForm::TEXT_NUMBER_OF_CHARACTERS] =
            isset($query[Form\PasswordForm::TEXT_NUMBER_OF_CHARACTERS])
            ? (int) $query[Form\PasswordForm::TEXT_NUMBER_OF_CHARACTERS] : 16;
        $query[Form\PasswordForm::TEXT_NUMBER_OF_PASSWORDS] =
            isset($query[Form\PasswordForm::TEXT_NUMBER_OF_PASSWORDS])
            ? (int) $query[Form\PasswordForm::TEXT_NUMBER_OF_PASSWORDS] : 3;
        $query[Form\PasswordForm::TEXT_EXCLUDE_CHARACTERS] =
            isset($query[Form\PasswordForm::TEXT_EXCLUDE_CHARACTERS])
            ? $query[Form\PasswordForm::TEXT_EXCLUDE_CHARACTERS] : '';
        $query[Form\PasswordForm::CHECKBOX_IS_DISALLOW_SAME_CHARACTER] =
            isset($query[Form\PasswordForm::CHECKBOX_IS_DISALLOW_SAME_CHARACTER])
            ? (int) $query[Form\PasswordForm::CHECKBOX_IS_DISALLOW_SAME_CHARACTER] : 0;

        $form = new Form\PasswordForm($query);
        $response['form'] = $form;

        if ($form->isValid()) {
            $values = $form->getData();
            $response['password'] = $this->service->generatePasswords(
                $query[Form\PasswordForm::TEXT_NUMBER_OF_PASSWORDS],
                $query[Form\PasswordForm::TEXT_NUMBER_OF_CHARACTERS],
                str_split($query[Form\PasswordForm::TEXT_EXCLUDE_CHARACTERS]),
                $values[Form\PasswordForm::CHECKBOX_IS_DISALLOW_SAME_CHARACTER] ? false : true
            );
        }

        return new ViewModel($response);
    }
}
