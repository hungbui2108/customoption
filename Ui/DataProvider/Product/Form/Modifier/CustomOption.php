<?php

namespace Hungbd\CustomOptionImage\Ui\DataProvider\Product\Form\Modifier;

use Magento\Catalog\Model\Config\Source\Product\Options\Price as ProductOptionsPrice;
use Magento\Catalog\Model\Locator\LocatorInterface;
use Magento\Catalog\Model\ProductOptions\ConfigInterface;
use Magento\Framework\Stdlib\ArrayManager;
use Magento\Framework\UrlInterface;
use Magento\Ui\Component\Container;
use Magento\Ui\Component\DynamicRows;
use Magento\Ui\Component\Form\Field;
use Magento\Ui\Component\Form\Element\Input;
use Magento\Ui\Component\Form\Element\Select;
use Magento\Ui\Component\Form\Element\DataType\Text;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Created by PhpStorm.
 * User: hungbd
 * Date: 31/01/2018
 * Time: 10:22
 */
class CustomOption
    extends \Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\CustomOptions
{

    protected function getSelectTypeGridConfig($sortOrder)
    {
        $options = [
            'arguments' => [
                'data' => [
                    'config' => [
                        'imports' => [
                            'optionId'     => '${ $.provider }:${ $.parentScope }.option_id',
                            'optionTypeId' => '${ $.provider }:${ $.parentScope }.option_type_id',
                            'isUseDefault' => '${ $.provider }:${ $.parentScope }.is_use_default'
                        ],
                        'service' => [
                            'template' => 'Magento_Catalog/form/element/helper/custom-option-type-service',
                        ],
                    ],
                ],
            ],
        ];

        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'addButtonLabel'      => __('Add Value'),
                        'componentType'       => DynamicRows::NAME,
                        'component'           => 'Magento_Ui/js/dynamic-rows/dynamic-rows',
                        'additionalClasses'   => 'admin__field-wide',
                        'deleteProperty'      => static::FIELD_IS_DELETE,
                        'deleteValue'         => '1',
                        'renderDefaultRecord' => false,
                        'sortOrder'           => $sortOrder,
                    ],
                ],
            ],
            'children'  => [
                'record' => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'componentType'    => Container::NAME,
                                'component'        => 'Magento_Ui/js/dynamic-rows/record',
                                'positionProvider' => static::FIELD_SORT_ORDER_NAME,
                                'isTemplate'       => true,
                                'is_collection'    => true,
                            ],
                        ],
                    ],
                    'children'  => [
                        static::FIELD_TITLE_NAME      => $this->getTitleFieldConfig(
                            10,
                            $this->locator->getProduct()->getStoreId() ? $options : []
                        ),
                        static::FIELD_PRICE_NAME      => $this->getPriceFieldConfigForSelectType(20),
                        static::FIELD_PRICE_TYPE_NAME => $this->getPriceTypeFieldConfig(30, ['fit' => true]),
                        static::FIELD_SKU_NAME        => $this->getSkuFieldConfig(40),
                        'image_link'                  => [
                            'arguments' => [
                                'data' => [
                                    'config' => [
                                        'label'         => 'image',
                                        'component'     => 'Hungbd_CustomOptionImage/js/form/element/preview-option-image',
                                        'elementTmpl'   => 'Hungbd_CustomOptionImage/form/element/preview-option-image',
                                        'componentType' => Field::NAME,
                                        'formElement'   => Input::NAME,
                                        'dataType'      => Text::NAME,
                                        'sortOrder'     => '50',
//                                        'visible'     => false,
                                        'imports'       => [
                                            'base_url' => $this->storeManager->getStore()->getBaseUrl(),
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        'uploader'  => [
                            'arguments' => [
                                'data' => [
                                    'config' => [
                                        'component'     => 'Hungbd_CustomOptionImage/js/form/element/file-upload',
                                        'componentType' => Field::NAME,
                                        'template'   => 'Hungbd_CustomOptionImage/form/element/uploader',
                                        'formElement'   => 'fileUploader',
                                        'dataType'      => Text::NAME,
                                        'sortOrder'     => '60',
                                        'uploaderConfig'     => [
                                            'url' => 'option/option/upload'
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        'color'                       => [
                            'arguments' => [
                                'data' => [
                                    'config' => [
                                        'label'         => 'Color',
                                        'component'     => 'Hungbd_CustomOptionImage/js/form/element/color-select',
                                        'elementTmpl'   => 'Hungbd_CustomOptionImage/form/element/color-select',
                                        'componentType' => Field::NAME,
                                        'formElement'   => Input::NAME,
                                        'dataScope'     => 'color',
                                        'dataType'      => Text::NAME,
                                        'sortOrder'     => '70',
                                    ],
                                ],
                            ],
                        ],
                        'display_mode'                => [
                            'arguments' => [
                                'data' => [
                                    'config' => [
                                        'label'         => __('Display mode'),
                                        'componentType' => Field::NAME,
                                        'formElement'   => Select::NAME,
                                        'dataScope'     => 'display_mode',
                                        'dataType'      => Text::NAME,
                                        'sortOrder'     => '80',
                                        'options'       => [
                                            ['value' => 'image', 'label' => __('Image')],
                                            ['value' => 'color', 'label' => __('Color')],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        static::FIELD_SORT_ORDER_NAME => $this->getPositionFieldConfig(80),
                        static::FIELD_IS_DELETE       => $this->getIsDeleteFieldConfig(90)
                    ]
                ]
            ]
        ];
    }

    private function getPriceFieldConfigForSelectType(int $sortOrder)
    {
        $priceFieldConfig = $this->getPriceFieldConfig($sortOrder);
        $priceFieldConfig['arguments']['data']['config']['template'] = 'Magento_Catalog/form/field';

        return $priceFieldConfig;
    }

    protected function getTypeFieldConfig($sortOrder)
    {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'label' => __('Option Type'),
                        'componentType' => Field::NAME,
                        'formElement' => Select::NAME,
                        'component' => 'Magento_Catalog/js/custom-options-type',
                        'elementTmpl' => 'ui/grid/filters/elements/ui-select',
                        'selectType' => 'optgroup',
                        'dataScope' => static::FIELD_TYPE_NAME,
                        'dataType' => Text::NAME,
                        'sortOrder' => $sortOrder,
                        'options' => $this->getProductOptionTypes(),
                        'disableLabel' => true,
                        'multiple' => false,
                        'selectedPlaceholders' => [
                            'defaultPlaceholder' => __('-- Please select --'),
                        ],
                        'validation' => [
                            'required-entry' => true
                        ],
                        'groupsConfig' => [
                            'text' => [
                                'values' => ['field', 'area'],
                                'indexes' => [
                                    static::CONTAINER_TYPE_STATIC_NAME,
                                    static::FIELD_PRICE_NAME,
                                    static::FIELD_PRICE_TYPE_NAME,
                                    static::FIELD_SKU_NAME,
                                    static::FIELD_MAX_CHARACTERS_NAME
                                ]
                            ],
                            'file' => [
                                'values' => ['file'],
                                'indexes' => [
                                    static::CONTAINER_TYPE_STATIC_NAME,
                                    static::FIELD_PRICE_NAME,
                                    static::FIELD_PRICE_TYPE_NAME,
                                    static::FIELD_SKU_NAME,
                                    static::FIELD_FILE_EXTENSION_NAME,
                                    static::FIELD_IMAGE_SIZE_X_NAME,
                                    static::FIELD_IMAGE_SIZE_Y_NAME
                                ]
                            ],
                            'select' => [
                                'values' => ['drop_down', 'radio', 'checkbox', 'multiple','thumb_gallery','thumb_gallery_popup','thumb_gallery_mutil',],
                                'indexes' => [
                                    static::GRID_TYPE_SELECT_NAME
                                ]
                            ],
                            'data' => [
                                'values' => ['date', 'date_time', 'time'],
                                'indexes' => [
                                    static::CONTAINER_TYPE_STATIC_NAME,
                                    static::FIELD_PRICE_NAME,
                                    static::FIELD_PRICE_TYPE_NAME,
                                    static::FIELD_SKU_NAME
                                ]
                            ]
                        ],
                    ],
                ],
            ],
        ];
    }
}