<?php

namespace Snono\ReportBuilder\Builder\Classes;

use Carbon\Carbon;
use Snono\ReportBuilder\Builder\Classes\Setters;
use Snono\ReportBuilder\Builder\Classes\Getters;
use Illuminate\Support\Collection;
use Storage;

/**
 * This is the report-builder class.
 *
 * @author Yaser Ghanawi
 */
class ReportBuilder
{
    use Setters, Getters;

    /**
     * report-builder name.
     *
     * @var string
     */
    public $name;

    /**
     * report-builder template.
     *
     * @var string
     */
    public $template;

    /**
     * report-builder language.
     *
     * @var string language en|ar
     */
    public $language;

    /**
     * report-builder orientation.
     *
     * @var string $orientation portrait|landscape
     */
    public $orientation;

    /**
     * report-builder is_rtl.
     *
     * @var boolean
     */
    public $is_rtl = false;

    /**
     * report-builder item collection.
     *
     * @var Illuminate\Support\Collection
     */
    public $items;

    /**
     * report-builder currency.
     *
     * @var string
     */
    public $currency;

    /**
     * report-builder tax.
     *
     * @var int
     */
    public $tax;

    /**
     * report-builder tax type.
     *
     * @var string
     */
    public $tax_type;

    /**
     * report-builder number.
     *
     * @var int
     */
    public $number = null;

    /**
     * report-builder decimal precision.
     *
     * @var int
     */
    public $decimals;

    /**
     * report-builder logo.
     *
     * @var string
     */
    public $logo;

    /**
     * report-builder Logo Height.
     *
     * @var int
     */
    public $logo_height;

    /**
     * report-builder Date.
     *
     * @var Carbon\Carbon
     */
    public $date;

    /**
     * report-builder Notes.
     *
     * @var string
     */
    public $notes;

    /**
     * report-builder Business Details.
     *
     * @var array
     */
    public $business_details;

    /**
     * report-builder Customer Details.
     *
     * @var array
     */
    public $customer_details;

    /**
     * report-builder Footnote.
     *
     * @var array
     */
    public $footer_note;

    /**
     * Stores the PDF object.
     *
     * @var Dompdf\Dompdf
     */
    private $pdf;

    /**
     * Create a new report instance.
     *
     * @method __construct
     *
     * @param string $name
     */
    public function __construct($name = 'report-builder')
    {
        $this->name = $name;
        $this->language = 'en';
        $this->template = 'invoice';
        $this->orientation = 'portrait';
        $this->items = Collection::make([]);
        $this->currency = config('report-builder.currency');
        $this->tax = config('report-builder.tax');
        $this->tax_type = config('report-builder.tax_type');
        $this->decimals = config('report-builder.decimals');
        $this->logo = config('report-builder.logo');
        $this->logo_height = config('report-builder.logo_height');
        $this->date = Carbon::now();
        $this->business_details = Collection::make(config('report-builder.business_details'));
        $this->customer_details = Collection::make([]);
        $this->footnote = config('report-builder.footer_note');
    }

    /**
     * Return a new instance of report-builder.
     *
     * @method make
     *
     * @param string $name
     *
     * @return Snono\ReportBuilder\Classes\ReportBuilder
     */
    public static function make($name = 'report-builder')
    {
        return new self($name);
    }

    /**
     * Adds an item to the invoice.
     *
     * @method addItem
     *
     * @param string $name
     * @param int    $price
     * @param int    $ammount
     * @param string $id
     *
     * @return self
     */
    public function addItem($name, $price, $ammount = 1, $id = '-')
    {
        $this->items->push(Collection::make([
            'name'       => $name,
            'price'      => $price,
            'ammount'    => $ammount,
            'totalPrice' => number_format(bcmul($price, $ammount, $this->decimals), $this->decimals),
            'id'         => $id,
        ]));

        return $this;
    }

    /**
     * Pop the last invoice item.
     *
     * @method popItem
     *
     * @return self
     */
    public function popItem()
    {
        $this->items->pop();

        return $this;
    }

    /**
     * Return the currency object.
     *
     * @method formatCurrency
     *
     * @return stdClass
     */
    public function formatCurrency()
    {
        $currencies = json_decode(file_get_contents(__DIR__.'/../Currencies.json'));
        $currency = $this->currency;

        return $currencies->$currency;
    }

    /**
     * Return the subtotal invoice price.
     *
     * @method subTotalPrice
     *
     * @return int
     */
    private function subTotalPrice()
    {
        return $this->items->sum(function ($item) {
            return bcmul($item['price'], $item['ammount'], $this->decimals);
        });
    }

    /**
     * Return formatted sub total price.
     *
     * @method subTotalPriceFormatted
     *
     * @return int
     */
    public function subTotalPriceFormatted()
    {
        return number_format($this->subTotalPrice(), $this->decimals);
    }

    /**
     * Return the total invoce price after aplying the tax.
     *
     * @method totalPrice
     *
     * @return int
     */
    private function totalPrice()
    {
        return bcadd($this->subTotalPrice(), $this->taxPrice(), $this->decimals);
    }

    /**
     * Return formatted total price.
     *
     * @method totalPriceFormatted
     *
     * @return int
     */
    public function totalPriceFormatted()
    {
        return number_format($this->totalPrice(), $this->decimals);
    }

    /**
     * taxPrice.
     *
     * @method taxPrice
     *
     * @return float
     */
    private function taxPrice()
    {
        if ($this->tax_type == 'percentage') {
            return bcdiv(bcmul($this->tax, $this->subTotalPrice(), $this->decimals), 100, $this->decimals);
        }

        return $this->tax;
    }

    /**
     * Return formatted tax.
     *
     * @method taxPriceFormatted
     *
     * @return int
     */
    public function taxPriceFormatted()
    {
        return number_format($this->taxPrice(), $this->decimals);
    }

    /**
     * Generate the PDF.
     *
     * @method generate
     *
     * @return self
     */
    private function generate()
    {
        $this->pdf = PDF::generate($this, $this->template);

        return $this;
    }

    /**
     * Downloads the generated PDF.
     *
     * @method download
     *
     * @param string $name
     *
     * @return response
     */
    public function download($name = 'invoice')
    {
        $this->generate();

        return $this->pdf->stream($name);
    }

    /**
     * Save the generated PDF.
     *
     * @method save
     *
     * @param string $name
     *
     */
    public function save($name = 'invoice.pdf')
    {
        $invoice = $this->generate();

        Storage::put($name, $invoice->pdf->output());
    }

    /**
     * Show the PDF in the browser.
     *
     * @method show
     *
     * @param string $name
     *
     * @return response
     */
    public function show($name = 'invoice')
    {
        $this->generate();

        return $this->pdf->stream($name, ['Attachment' => false]);
    }
}
