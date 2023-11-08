<?php
/**
 * @category    M2Commerce Enterprise
 * @package     M2Commerce_CallForPrice
 * @copyright   Copyright (c) 2023 M2Commerce Enterprise
 * @author      dawoodgondaldev@gmail.com
 */

namespace M2Commerce\CallForPrice\Model;

use Magento\Framework\Session\SessionManager;

class DataStorage
{
    /**
     * @var SessionManager
     */
    private $session;

    /**
     * @param SessionManager $session
     */
    public function __construct(
        SessionManager $session
    ) {
        $this->session = $session;
    }

    /**
     * @param string $name
     * @param $value
     * @return void
     */
    public function setValue(string $name, $value): void
    {
        $this->session->setData($name, $value);
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function getValue(string $name): mixed
    {
        return $this->session->getData($name);
    }
}
