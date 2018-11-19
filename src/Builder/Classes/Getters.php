<?php

namespace Snono\ReportBuilder\Builder\Classes;

use Carbon\Carbon;
use Illuminate\Support\Collection;

/**
 * This is the Setters trait.
 *
 * @author Yaser ghanawi
 */
trait Getters
{
    /**
     * Get the invoice name.
     *
     * @method name
     *
     * @return self
     */
    public function getName()
    {
        return $this->name ;
    }

    /**
     * Get the invoice lang.
     *
     * @method lang
     *
     * @return self
     */
    public function getLanguage()
    {
        return $this->language ;
    }



    /**
     * Get the invoice orientation.
     *
     * @method $orientation
     *
     * @return self
     */
    public function getOrientation()
    {

        return $this->orientation;
    }

    /**
     * Get the invoice isRTL.
     *
     * @method isRTL
     *
     * @param boolean $is_rtl
     *
     * @return self
     */

    public function getIsRTL()
    {
        return $this->is_rtl ;
    }

    /**
     * Get the invoice template.
     *
     * @method template
     *
     * @return self
     */
    public function getTemplate()
    {
        return $this->template ;
    }

    /**
     * Get the invoice number.
     *
     * @method number
     *
     * @return self
     */
    public function getNumber()
    {
        return $this->number ;
    }

    /**
     * Get the invoice decimal precision.
     *
     * @method decimals
     *
     * @return self
     */
    public function getDecimals()
    {
        return $this->decimals;
    }

    /**
     * Get the invoice tax.
     *
     * @method tax
     *
     * @return self
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * Get the invoice tax type.
     *
     * @method taxType
     *
     * @return self
     */
    public function getTaxType()
    {
        return $this->tax_type;
    }

    /**
     * Get the invoice logo URL.
     *
     * @method logo
     *
     * @return self
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Get the invoice date.
     *
     * @method date
     *
     * @return self
     */
    public function getDate()
    {
        return  $this->date;
    }

    /**
     * Get the invoice notes.
     *
     * @method notes
     *
     * @return self
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Get the invoice business details.
     *
     * @method businesss
     *
     * @return self
     */
    public function getBusiness()
    {
        return $this->business_details;
    }

    /**
     * Get the invoice customer details.
     *
     * @method customer
     *
     * @return self
     */
    public function getCustomer()
    {
        return $this->customer_details;
    }

    /**
     * Get the invoice currency.
     *
     * @method currency
     *
     * @return self
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Get the invoice footnote.
     *
     * @method footnote
     *
     * @return self
     */
    public function getFooterNote()
    {

        return  $this->footer_note;
    }
}
