<?php

/**
 * @see       https://github.com/laminas/laminas-mvc-skeleton for the canonical source repository
 * @copyright https://github.com/laminas/laminas-mvc-skeleton/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-mvc-skeleton/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Application\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\JsonModel;
use Laminas\View\Model\ViewModel;
use Laminas\Stdlib\ArrayObject;
use Application\Form;
use Domain\Service;

class IndexController extends AbstractActionController
{
    private $translator;
    private $service;

    public function __construct(
        $translator,
        Service\IndexControllerService $service
    ) {
        $this->translator = $translator;
        $this->service = $service;
    }

    public function indexAction(): ViewModel
    {
        return new ViewModel();
    }

    /**
     * Date format converter page.
     *
     * @return ViewModel
     */
    public function dateAction(): ViewModel
    {
        $query = new ArrayObject($this->params()->fromQuery());
        $form = new Form\DateTimeForm($query->getArrayCopy());

        if ($form->isValid()) {
            try {
                $date = $this->service->generateDateStrings($form->getData()['q']);
            } catch (\Exception $e) {
                $form->get(Form\DateTimeForm::TEXT_DATETIME_QUERY)
                    ->setMessages(["日付の変換に失敗しました。"]);
            }
        }
        if ($query->offsetGet('ajax')) {
            return new JsonModel([
                'messages' => $form->getMessages(),
                'formValues' => $form->getData(),
                'date' => isset($date) ? $date : null,
            ]);
        }
        return new ViewModel([
            'messages' => $form->getMessages(),
            'formValues' => $form->getData(),
            'date' => isset($date) ? $date : null,
        ]);
    }

    public function dateDifferenceAction(): ViewModel
    {
        $query = new ArrayObject($this->params()->fromQuery());
        $form = new Form\DatetimeDifferenceForm($query->getArrayCopy());
        if ($form->isValid()) {
            try {
                $dateDifference = $this->service->calculateDateDifference(
                    $form->getData()['since'],
                    $form->getData()['until']
                );
            } catch (\Exception $e) {
                $form->setMessages(["日付の変換に失敗しました。"]);
            }
        }

        if ($query->offsetGet('ajax')) {
            return new JsonModel([
                'messages' => $form->getMessages(),
                'formValues' => $form->getData(),
                'dateDifference' => isset($dateDifference) ? $dateDifference : null,
            ]);
        }
        return new ViewModel([
            'messages' => $form->getMessages(),
            'formValues' => $form->getData(),
            'dateDifference' => isset($dateDifference) ? $dateDifference : null,
        ]);
    }

    /**
     * Generate password tool page.
     *
     * @return ViewModel
     */
    public function passwordAction(): ViewModel
    {
        $query = new ArrayObject($this->params()->fromQuery());
        $form = new Form\PasswordForm($query->getArrayCopy());

        if ($form->isValid()) {
            $values = $form->getData();
            $password = $this->service->generatePasswords(
                $values[Form\PasswordForm::TEXT_NUMBER_OF_PASSWORDS],
                $values[Form\PasswordForm::TEXT_NUMBER_OF_CHARACTERS],
                str_split($values[Form\PasswordForm::TEXT_EXCLUDE_CHARACTERS]),
                $values[Form\PasswordForm::CHECKBOX_IS_DISALLOW_SAME_CHARACTER] ? false : true
            );
        }
        if ($query->offsetGet('ajax')) {
            return new JsonModel([
                'messages' => $form->getMessages(),
                'formValues' => $form->getData(),
                'password' => isset($password) ? $password : null,
            ]);
        }
        return new ViewModel([
            'form' => $form,
            'messages' => $form->getMessages(),
            'formValues' => $form->getData(),
            'password' => isset($password) ? $password : null,
        ]);
    }
}
