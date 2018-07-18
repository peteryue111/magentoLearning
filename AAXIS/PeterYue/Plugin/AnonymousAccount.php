<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AAXIS\PeterYue\Plugin;

use Magento\Customer\Model\Session;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\Action\AbstractAction;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\Result\RedirectFactory;

class AnonymousAccount
{
    /**
     * @var Session
     */
    protected $session;

    /**
     * @var PageFactory
     */
    protected $resultRedirectFactory;

    /**
     * @param Context $context
     * @param Session $customerSession
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
    	Context $context,
        Session $customerSession,
        RedirectFactory $resultRedirectFactory
    ) {
        $this->session = $customerSession;
        $this->$resultRedirectFactory = $resultRedirectFactory;
    }

    /**
     * Dispatch actions allowed for not authorized users
     *
     * @param AbstractAction $subject
     * @param RequestInterface $request
     * @return void
     */
    public function beforeDispatch(AbstractAction $subject, RequestInterface $request)
    {
    	if (!$this->session->isLoggedIn()) {
    		$resultRedirect = $this->resultRedirectFactory->create();
    		$resultRedirect->setPath('/');
    		return $resultRedirect;
    	}
    }

}
