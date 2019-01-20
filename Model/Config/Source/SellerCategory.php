<?php

namespace Mugar\Afip\Model\Config\Source;

class SellerCategory extends \Mugar\InvoiceType\Model\Config\Source\SellerCategory implements TypeInterface
{
    const SELLERCATEGORY_RESPONSABLE_INSCRIPTO = 'resp';
    const SELLERCATEGORY_RESPONSABLE_NO_INSCRIPTO = 'respni';
    const SELLERCATEGORY_RESPONSABLE_EXENTO = 'exen';
    const SELLERCATEGORY_MONOTRIBUTO = 'mono';
    const SELLERCATEGORY_CONSUMIDOR_FINAL = 'cons';

    public function toOptionArray()
    {
        $options = parent::toOptionArray();
        $options[] = ['value' => self::SELLERCATEGORY_RESPONSABLE_NO_INSCRIPTO, 'label' => __('Responsable no inscripto')];
        $options[] = ['value' => self::SELLERCATEGORY_CONSUMIDOR_FINAL, 'label' => __('Consumidor final')];

        return $options;
    }

    public function getAfipCode($sellerCategory)
    {
        $sellerCategories = [
            self::SELLERCATEGORY_RESPONSABLE_INSCRIPTO => 1,
            self::SELLERCATEGORY_RESPONSABLE_NO_INSCRIPTO => 2,
            self::SELLERCATEGORY_RESPONSABLE_EXENTO => 4,
            self::SELLERCATEGORY_MONOTRIBUTO => 6,
            self::SELLERCATEGORY_CONSUMIDOR_FINAL => 5,
        ];
        return isset($sellerCategories[$sellerCategory]) ? $sellerCategories[$sellerCategory] : null;
    }
}