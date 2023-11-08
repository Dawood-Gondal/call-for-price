<?php
/**
 * @category    M2Commerce Enterprise
 * @package     M2Commerce_CallForPrice
 * @copyright   Copyright (c) 2023 M2Commerce Enterprise
 * @author      dawoodgondaldev@gmail.com
 */

namespace M2Commerce\CallForPrice\Controller\Index;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use M2Commerce\CallForPrice\Model\RequesterFactory;
use M2Commerce\CallForPrice\Model\ResourceModel\Requester;

class PostForm implements HttpPostActionInterface
{
    /**
     * @var JsonFactory
     */
    protected $resultJsonFactory;

    /**
     * @var RequesterFactory
     */
    protected $requesterFactory;

    /**
     * @var Requester
     */
    protected $requesterResourceModel;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @param RequesterFactory $requesterFactory
     * @param JsonFactory $resultJsonFactory
     * @param Requester $requesterResourceModel
     * @param RequestInterface $request
     */
    public function __construct(
        RequesterFactory $requesterFactory,
        JsonFactory $resultJsonFactory,
        Requester $requesterResourceModel,
        RequestInterface $request
    ) {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->requesterResourceModel = $requesterResourceModel;
        $this->requesterFactory = $requesterFactory;
        $this->request = $request;
    }

    /**
     * @return Json
     */
    public function execute()
    {
        $name = $this->request->getParam('name');
        $email = $this->request->getParam('email');
        $phone = $this->request->getParam('phone');
        $productId =$this->request->getParam('product_id');
        $model = $this->requesterFactory->create();
        $model->setData([
            "name" => $name,
            "email" => $email,
            "phone" => $phone,
            "product_id" => $productId
        ]);
        $this->requesterResourceModel->save($model);
        $resultJson = $this->resultJsonFactory->create();
        $response = ['success' => 'true'];
        return $resultJson->setData($response);
    }
}
