<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subtotal',
        'grand_total',
        'discount',
        'company_name',
        'company_address',
        'company_email',
        'company_phone'
    ];

    public function invoiceItems()
    {
        return $this->hasMany('App\InvoiceItem');
    }

    public function prepareInvoiceItem($invoiceItem, $invoiceId)
    {
        if (isset($invoiceItem['id'])) {
            $this->updateInvoiceItem($invoiceItem, $invoiceId);
        } else {
            $this->addInvoiceItem($invoiceItem, $invoiceId);
        }
    }

    public function addInvoiceItem($invoiceItem, $invoiceId)
    {
        $invoice_id = $invoiceId;
        $item = $invoiceItem['item'];
        $hours = $invoiceItem['hours'];
        $rate = $invoiceItem['rate'];
        $total = $invoiceItem['total'];

        $this->invoiceItems()->create(compact(['invoice_id', 'item', 'hours', 'rate', 'total']));
    }

    public function updateInvoiceItem($invoiceItem, $invoiceId)
    {
        $invoice_id = $invoiceId;
        $item = $invoiceItem['item'];
        $hours = $invoiceItem['hours'];
        $rate = $invoiceItem['rate'];
        $total = $invoiceItem['total'];

        $this->invoiceItems()->update(compact(['invoice_id', 'item', 'hours', 'rate', 'total']));
    }
}
