<?php

namespace Hungbd\CustomOptionImage\Model\Source;

use Magento\Store\Model\StoreManagerInterface;

class CustomUrl Extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    protected $_optionsData;
    protected $_storeManager;

    public function __construct(array $options, StoreManagerInterface $storeManager)
    {
        $this->_optionsData = $options;
        $this->_storeManager = $storeManager;
    }

    public function getAllOptions()
    {
        if ($this->_options === null) {
            $this->_options = [
                ['value' => '1', 'label' => __('science')]
            ];
        }
        return $this->_options;
    }
}