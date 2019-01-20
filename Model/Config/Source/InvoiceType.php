<?php

namespace Mugar\Afip\Model\Config\Source;

class InvoiceType implements \Mugar\InvoiceType\Model\Config\Source\InvoiceType, TypeInterface
{
    const INVOICETYPE_FACTURA = 'fc';
    const INVOICETYPE_NOTA_CREDITO = 'nc';
    const INVOICETYPE_NOTA_DEBITO = 'nd';
    const INVOICETYPE_RECIBO = 'rc';

    protected $_invoiceTypesName = [
        'fc' => 'Factura',
        'nc' => 'Nota de credito',
        'nd' => 'Nota de debito',
        'rc' => 'Recibo',
    ];

    public function toOptionArray()
    {
        $options = [];
        foreach ($this->toArray() as $value => $item) {
            $options[] = ['value' => $value, 'label' => $item];
        }

        return $options;
    }

    public function toArray()
    {
        $letters = ['a', 'b', 'c', 'e', 'm'];
        $options = [];

        foreach ($this->_invoiceTypesName as $invoiceType => $name) {
            foreach ($letters as $letter) {
                $invoiceCode = $this->getInvoiceCode($invoiceType, $letter);
                $code = $this->getAfipCode($invoiceCode);
                if ($code == null)
                    continue;

                $options[$invoiceCode] = sprintf('%s %s', __($name), strtoupper($letter));
            }
        }

        return $options;
    }

    public function getInvoiceCode($invoiceType, $invoceLetter)
    {
        return sprintf('%s-%s', $invoiceType, $invoceLetter);
    }

    public function getAfipCode($invoiceCode)
    {
        $invoicesTypes = [
            self::INVOICETYPE_FACTURA . '-a' => 1,
            self::INVOICETYPE_FACTURA . '-b' => 6,
            self::INVOICETYPE_FACTURA . '-c' => 11,
            self::INVOICETYPE_FACTURA . '-e' => 19,
            self::INVOICETYPE_FACTURA . '-m' => 51,
            self::INVOICETYPE_NOTA_CREDITO . '-a' => 3,
            self::INVOICETYPE_NOTA_CREDITO . '-b' => 8,
            self::INVOICETYPE_NOTA_CREDITO . '-c' => 13,
            self::INVOICETYPE_NOTA_CREDITO . '-e' => 21,
            self::INVOICETYPE_NOTA_CREDITO . '-m' => 53,
            self::INVOICETYPE_NOTA_DEBITO . '-a' => 2,
            self::INVOICETYPE_NOTA_DEBITO . '-b' => 7,
            self::INVOICETYPE_NOTA_DEBITO . '-c' => 12,
            self::INVOICETYPE_NOTA_DEBITO . '-e' => 20,
            self::INVOICETYPE_NOTA_DEBITO . '-m' => 52,
            self::INVOICETYPE_RECIBO . '-a' => 4,
            self::INVOICETYPE_RECIBO . '-b' => 9,
            self::INVOICETYPE_RECIBO . '-c' => 15,
            self::INVOICETYPE_RECIBO . '-m' => 54,
        ];

        return isset($invoicesTypes[$invoiceCode]) ? $invoicesTypes[$invoiceCode] : null;
    }
}