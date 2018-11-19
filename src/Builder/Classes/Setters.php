<?php

namespace Snono\ReportBuilder\Builder\Classes;

use Carbon\Carbon;
use Illuminate\Support\Collection;

/**
 * This is the Setters trait.
 *
 * @author Yaser ghanawi
 */
trait Setters
{
    /**
     * Set the invoice name.
     *
     * @method name
     *
     * @param string $name
     *
     * @return self
     */
    public function name($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set the invoice lang.
     *
     * @method lang
     *
     * @param string $lang en| ar
     *
     * @return self
     */
    public function language($lang)
    {
        $this->language = $lang;

        return $this;
    }

    /**
     * Set the invoice orientation.
     *
     * @method $orientation
     *
     * @param string $orientation portrait|landscape
     *
     * @return self
     */
    public function orientation($orientation)
    {
        $this->orientation = $orientation;

        return $this;
    }

    /**
     * Set the invoice isRTL.
     *
     * @method isRTL
     *
     * @param boolean $is_rtl
     *
     * @return self
     */
    public function isRTL($is_rtl)
    {
        $this->is_rtl = $is_rtl;

        return $this;
    }

    /**
     * Set the invoice template.
     *
     * @method template
     *
     * @param string $template
     *
     * @return self
     */
    public function template($template)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * Set the invoice number.
     *
     * @method number
     *
     * @param int $number
     *
     * @return self
     */
    public function number($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Set the invoice decimal precision.
     *
     * @method decimals
     *
     * @param int $decimals
     *
     * @return self
     */
    public function decimals($decimals)
    {
        $this->decimals = $decimals;

        return $this;
    }

    /**
     * Set the invoice tax.
     *
     * @method tax
     *
     * @param float $tax
     *
     * @return self
     */
    public function tax($tax)
    {
        $this->tax = $tax;

        return $this;
    }

    /**
     * Set the invoice tax type.
     *
     * @method taxType
     *
     * @param string $tax_type
     *
     * @return self
     */
    public function taxType($tax_type)
    {
        $this->tax_type = $tax_type;

        return $this;
    }

    /**
     * Set the invoice logo URL.
     *
     * @method logo
     *
     * @param string $logo_url
     *
     * @return self
     */
    public function logo($logo_url)
    {
        $this->logo = $logo_url;

        return $this;
    }

    /**
     * Set the invoice date.
     *
     * @method date
     *
     * @param Carbon $date
     *
     * @return self
     */
    public function date(Carbon $date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Set the invoice notes.
     *
     * @method notes
     *
     * @param string $notes
     *
     * @return self
     */
    public function notes($notes)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Set the invoice business details.
     *
     * @method business
     *
     * @param array $details
     *
     * @return self
     */
    public function business($details)
    {
        $this->business_details = Collection::make($details);

        return $this;
    }

    /**
     * Set the invoice customer details.
     *
     * @method customer
     *
     * @param array $details
     *
     * @return self
     */
    public function customer($details)
    {
        $this->customer_details = Collection::make($details);

        return $this;
    }

    /**
     * Set the invoice currency.
     *
     * @method currency
     *
     * @param string $currency
     *
     * @return self
     */
    public function currency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Set the invoice footnote.
     *
     * @method footnote
     *
     * @param string $footnote
     *
     * @return self
     */
    public function footer_note($footnote)
    {
        $this->footer_note = $footnote;

        return $this;
    }
}
