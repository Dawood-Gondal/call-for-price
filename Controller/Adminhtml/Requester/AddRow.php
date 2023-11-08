<?php
/**
 * @category    M2Commerce Enterprise
 * @package     M2Commerce_CallForPrice
 * @copyright   Copyright (c) 2023 M2Commerce Enterprise
 * @author      dawoodgondaldev@gmail.com
 */

namespace M2Commerce\CallForPrice\Controller\Adminhtml\Requester;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use M2Commerce\CallForPrice\Model\DataStorage;
use M2Commerce\CallForPrice\Model\RequesterFactory;
use M2Commerce\CallForPrice\Model\ResourceModel\Requester;

class AddRow extends Action
{
    /**
     * @var DataStorage
     */
    protected $dataStorage;

    /**
     * @var Requester
     */
    private $requesterResourceModel;

    /**
     * @var RequesterFactory
     */
    private $requesterFactory;

    /**
     * @param Context $context
     * @param RequesterFactory $requesterFactory
     * @param Requester $requesterResourceModel
     * @param DataStorage $dataStorage
     */
    public function __construct(
        Context $context,
        RequesterFactory $requesterFactory,
        Requester $requesterResourceModel,
        DataStorage $dataStorage
    ) {
        parent::__construct($context);
        $this->requesterFactory = $requesterFactory;
        $this->requesterResourceModel = $requesterResourceModel;
        $this->dataStorage = $dataStorage;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|ResultInterface|void
     */
    public function execute()
    {
        $rowId = (int)$this->getRequest()->getParam('id');
        $rowData = $this->requesterFactory->create();
        if ($rowId) {
            $this->requesterResourceModel->load($rowData, $rowId);
            $rowTitle = $rowData->getName();
            $this->dataStorage->setValue('row_data', $rowData);
            $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
            $title = $rowId ? __('View Call For Price - ') . $rowTitle : __('Add Call For Price');
            $resultPage->getConfig()->getTitle()->prepend($title);
            return $resultPage;
        }
    }

    /**
     * @return bool
     */
    protected function _isAllowed(): bool
    {
        return $this->_authorization->isAllowed('M2Commerce_CallForPrice::add_row');
    }
}
