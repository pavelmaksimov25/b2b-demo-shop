<?php

namespace Pyz\Yves\Customer\Controller;

use Generated\Shared\Transfer\CustomerTransfer;
use Pyz\Yves\Customer\CustomerDependencyContainer;
use Pyz\Yves\Customer\Plugin\Provider\CustomerControllerProvider;
use SprykerEngine\Yves\Application\Controller\AbstractController;
use SprykerFeature\Client\Customer\CustomerClientInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use SprykerFeature\Shared\Customer\Code\Messages;

/**
 * @method CustomerDependencyContainer getDependencyContainer()
 * @method CustomerClientInterface getClient()
 */
class CustomerController extends AbstractController
{

    /**
     * @param Request $request
     *
     * @return array|RedirectResponse
     */
    public function forgotPasswordAction(Request $request)
    {
        $form = $this
            ->buildForm($this->getDependencyContainer()->createFormForgot())
            ->handleRequest($request);

        if ($form->isValid()) {
            $customerTransfer = new CustomerTransfer();
            $customerTransfer->fromArray($form->getData());
            $this->getClient()->forgotPassword($customerTransfer);
            $this->addSuccessMessage(Messages::CUSTOMER_PASSWORD_RECOVERY_MAIL_SENT);

            return $this->redirectResponseInternal('home');
        }

        return ['form' => $form->createView()];
    }

    /**
     * @param Request $request
     *
     * @return array|RedirectResponse
     */
    public function restorePasswordAction(Request $request)
    {
        $form = $this
            ->buildForm($this->getDependencyContainer()->createFormRestore())
            ->handleRequest($request);

        if ($form->isValid()) {
            $customerTransfer = new CustomerTransfer();
            $customerTransfer->setUsername($this->getUsername());
            $customerTransfer->setRestorePasswordKey($request->query->get('token'));
            $this->getClient()->restorePassword($customerTransfer);
            $this->getClient()->logout($customerTransfer);

            return $this->redirectResponseInternal(CustomerControllerProvider::ROUTE_LOGIN);
        }

        return ['form' => $form->createView()];
    }

    /**
     * @param Request $request
     *
     * @return array|RedirectResponse
     */
    public function deleteAction(Request $request)
    {
        $form = $this
            ->buildForm($this->getDependencyContainer()->createFormDelete())
            ->handleRequest($request);

        if ($form->isValid()) {
            $customerTransfer = new CustomerTransfer();
            $customerTransfer->setEmail($this->getUsername());
            if ($this->getClient()->deleteCustomer($customerTransfer)) {
                $this->getClient()->logout($customerTransfer);

                return $this->redirectResponseInternal('home');
            } else {
                $this->addErrorMessage(Messages::CUSTOMER_DELETE_FAILED);
            }
        }

        return ['form' => $form->createView()];
    }

    /**
     * @param Request $request
     *
     * @return array|RedirectResponse
     */
    public function profileAction(Request $request)
    {
        $customerTransfer = new CustomerTransfer();

        $form = $this
            ->buildForm($this->getDependencyContainer()->createFormProfile())
            ->handleRequest($request);

        if ($form->isValid()) {
            $customerTransfer->fromArray($form->getData());
            $customerTransfer->setEmail($this->getUsername());
            $this->getClient()->updateCustomer($customerTransfer);

            return $this->redirectResponseInternal(CustomerControllerProvider::ROUTE_CUSTOMER_PROFILE);
        }

        $form->setData($customerTransfer->toArray());

        return [
            'form' => $form->createView(),
            'addresses' => $customerTransfer->getAddresses(),
        ];
    }

}