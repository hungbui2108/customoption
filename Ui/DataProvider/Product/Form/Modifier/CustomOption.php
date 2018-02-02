<?php

namespace Hungbd\CustomOptionImage\Ui\DataProvider\Product\Form\Modifier;

use Magento\Ui\Component\Container;
use Magento\Ui\Component\DynamicRows;
use Magento\Ui\Component\Form\Field;
use Magento\Ui\Component\Form\Element\Input;
use Magento\Ui\Component\Form\Element\Select;
use Magento\Ui\Component\Form\Element\DataType\Text;

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
                                        'label'         => 'Image',
                                        'component'     => 'Hungbd_CustomOptionImage/js/form/element/preview-option-image',
                                        'elementTmpl'   => 'Hungbd_CustomOptionImage/form/element/preview-option-image',
                                        'componentType' => Field::NAME,
                                        'formElement'   => Input::NAME,
//                                        'dataScope'     => 'image_link',
                                        'dataType'      => Text::NAME,
                                        'sortOrder'     => '50',
//                                        'visible'     => false,
                                    ],
                                ],
                            ],
                        ],
                        'uploader'                    => [
                            'arguments' => [
                                'data' => [
                                    'config' => [
                                        'component'     => 'Hungbd_CustomOptionImage/js/form/element/file-upload',
                                        'componentType' => Field::NAME,
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
}