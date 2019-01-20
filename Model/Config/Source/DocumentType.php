<?php

namespace Mugar\Afip\Model\Config\Source;

class DocumentType extends \Mugar\InvoiceType\Model\Config\Source\DocumentType implements TypeInterface
{
    const DOCUMENTTYPE_CUIT = 'cuit';
    const DOCUMENTTYPE_CUIL = 'cuil';
    const DOCUMENTTYPE_DNI = 'dni';

    public function getAfipCode($documentType)
    {
        $documentTypes = [
            self::DOCUMENTTYPE_CUIT => 80,
            self::DOCUMENTTYPE_CUIL => 86,
            self::DOCUMENTTYPE_DNI => 96,
        ];
        return isset($documentTypes[$documentType]) ? $documentTypes[$documentType] : null;
    }
}