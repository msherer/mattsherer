<?php

namespace App\Http\Controllers\Admin;

use App\Invoice;
use App\InvoiceItem;
use Auth;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use thiagoalessio\TesseractOCR\TesseractOCR;
use App\VideoGameEntity;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'isAdmin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::all();

        return view('admin.invoice.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.invoice.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'subtotal' => 'required',
            'grand_total' => 'required',
            'discount' => 'required',
            'company_name' => 'required',
            'company_address' => 'required',
            'company_email' => 'required',
            'company_phone' => 'required'
        ]);

        dd($request);

        Invoice::create(
            $request->only(
                'subtotal',
                'grand_total',
                'discount',
                'company_name',
                'company_address',
                'company_email',
                'company_phone'
            )
        );

        return redirect('/admin/invoice');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        $invoiceItems = InvoiceItem::where('invoice_id', '=', $invoice->id)->get();

        return view('admin.invoice.show', compact(['invoice', 'invoiceItems']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        $invoiceItems = InvoiceItem::where('invoice_id', '=', $invoice->id)->get();

        return view('admin.invoice.edit', compact(['invoice', 'invoiceItems']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        $this->validate($request, [
            'subtotal' => 'required',
            'grand_total' => 'required',
            'discount' => 'required',
            'company_name' => 'required',
            'company_address' => 'required',
            'company_email' => 'required',
            'company_phone' => 'required',
            'invoice_item.*.item' => 'required',
            'invoice_item.*.hours' => 'required',
            'invoice_item.*.rate' => 'required',
            'invoice_item.*.total' => 'required',
        ]);

        $invoice->update(
            $request->only(
                'subtotal',
                'grand_total',
                'discount',
                'company_name',
                'company_address',
                'company_email',
                'company_phone'
            )
        );

        $invoiceItems = request('invoice_item');
        foreach ($invoiceItems as $invoiceItem) {
            $invoice->prepareInvoiceItem($invoiceItem, $invoice->id);
        }

        return redirect('/admin/invoice');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }

    public function test(Request $request)
    {
        return response()
            ->json(['response' => 'This worked!'])
            ->withHeaders([
                "Content-type" => "application/vnd.ms-word",
                "Content-Disposition" => "attachment;Filename=YOUR_DOC_NAME.doc"
        ]);
    }

    public function nes()
    {
        $nesListFile = public_path('docs/mail_bag_loot2.csv');
        $collectionListFile = public_path('docs/collection_updated.csv');
        $file = file_get_contents($nesListFile);
        $collectionFile = file_get_contents($collectionListFile);
        $lines = explode(PHP_EOL, $file);
        $collectionLines = explode(PHP_EOL, $collectionFile);
        array_shift($collectionLines);
        array_shift($collectionLines);
        $collectionListNames = [];
        $grandTotal = 0;
        $missingNames = [];
        $pricingList = [];
        $listBySku = [];
        $missingBySku = [];

        foreach ($collectionLines as $collectionLine) {
            $collectionLine = str_getcsv($collectionLine);
            if ($collectionLine[0] != '' && $collectionLine[1] != 'x') {
                $nameParts = explode('(', $collectionLine[0]);
                $collectionListNames[] = [
                    'name' => rtrim($nameParts[0]),
                    'cart' => $collectionLine[1],
                    'instructions' => $collectionLine[2],
                    'box' => $collectionLine[3]
                ];
            }
        }

        foreach ($lines as $key => $line) {
            $line = str_getcsv($line);
            $price = ltrim($line[6], '$');
            $price = str_replace(',', '', $price);

            if (!isset($listBySku[$line[2]])) {
                $listBySku[$line[2]] = [
                    'name' => $line[2],
                    'cart' => $line[3],
                    'instructions' => $line[4],
                    'box' => $line[5],
                ];
            }

            if ($line[1] != 'United States (usa)' || !is_numeric($price)) {
                continue;
            }

            foreach ($collectionListNames as $listName) {
                $nameParts = explode('(', $line[2]);
                $nameParts[0] = rtrim($nameParts[0]);

                if ($listName['name'] != $nameParts[0] && (strpos($listName['name'], $nameParts[0]) === false || strpos($nameParts[0], $listName['name']) === false) && !in_array($nameParts[0], $missingNames) && $price >= 100 && $price <= 400) {
                    $pricingList[$nameParts[0]] = $price;
                    $missingNames[] = $nameParts[0];
                    $missingBySku[$nameParts[0]] = $listName;
                }
            }
        }

        $duplicatesLog = [];
        foreach ($missingNames as $key => $missingName) {
            foreach ($collectionListNames as $collectionName) {
                if (strpos($missingName, $collectionName['name']) !== false) {
                    $duplicatesLog[] = 'duplicate found: ' . $missingName . ' / ' . $collectionName['name'];
                    unset($missingNames[$key]);
                    unset($missingBySku[$missingName]);
                }
            }
        }

        $mNames = [];
        foreach ($missingNames as $missingName) {
            if (isset($pricingList[$missingName])) {
                $mNames[] = [
                    'name' => $missingName,
                    'cart' => isset($listBySku[$missingName]) ? $listBySku[$missingName]['cart'] : '',
                    'instructions' => isset($listBySku[$missingName]) ? $listBySku[$missingName]['instructions'] : '',
                    'box' => isset($listBySku[$missingName]) ? $listBySku[$missingName]['box'] : '',
                    'price' => $pricingList[$missingName],
                    'hasAttribute' => [
                        'cart' => isset($missingBySku[$missingName]) && $missingBySku[$missingName]['cart'] != '' ? true : false,
                        'instructions' => isset($missingBySku[$missingName]) && $missingBySku[$missingName]['instructions'] != '' ? true : false,
                        'box' => isset($missingBySku[$missingName]) && $missingBySku[$missingName]['box'] != '' ? true : false,
                    ]
                ];
                $grandTotal += $pricingList[$missingName];
            }
        }

        $listCount = count($mNames);

        return view('admin.invoice.nes', compact(['mNames', 'grandTotal', 'listCount']));
    }

    public function nes2()
    {
        $nesListFile = public_path('docs/nes_list.csv');
        $collectionLines = VideoGameEntity::all()->toArray();
        $file = file_get_contents($nesListFile);
        $lines = explode(PHP_EOL, $file);
        $collectionListNames = [];
        $grandTotal = 0;
        $missingNames = [];
        $pricingList = [];

        foreach ($collectionLines as $collectionLine) {
            $collectionListNames[] = ucwords(str_replace('-', ' ', $collectionLine['sku']));
        }

        foreach ($lines as $line) {
            $line = str_getcsv($line);
            $price = ltrim($line[6], '$');
            $price = str_replace(',', '', $price);

            if ($line[1] != 'United States (usa)' || !is_numeric($price)) {
                continue;
            }

            foreach ($collectionListNames as $listName) {
                $nameParts = explode('(', $line[2]);
                $nameParts[0] = rtrim($nameParts[0]);

                if ($listName != $nameParts[0] && (strpos($listName, $nameParts[0]) === false || strpos($nameParts[0], $listName) === false) && !in_array($nameParts[0], $missingNames) && $price < 400) {
                    $pricingList[$nameParts[0]] = $price;
                    $missingNames[] = $nameParts[0];
                }
            }
        }

        $duplicatesLog = [];
        foreach ($missingNames as $key => $missingName) {
            foreach ($collectionListNames as $collectionName) {
                $collName = preg_replace("/[^A-Za-z0-9 ]/", ' ', $collectionName);
                $missName = preg_replace("/[^A-Za-z0-9 ]/", ' ', $missingName);

                if (strpos($missName, $collName) !== false) {
                    $duplicatesLog[] = 'duplicate found: ' . $missingName . ' / ' . $collectionName;
                    unset($missingNames[$key]);
                }
            }
        }

        $mNames = [];
        foreach ($missingNames as $missingName) {
            if (isset($pricingList[$missingName])) {
                $mNames[] = ['name' => $missingName, 'price' => $pricingList[$missingName]];
                $grandTotal += $pricingList[$missingName];
            }
        }

        $listCount = count($mNames);

        return view('admin.invoice.nes', compact(['mNames', 'grandTotal', 'listCount']));

    }

    public function nes1()
    {
        //$image = public_path('images/ducktales.jpg');
        //$tesseract = new TesseractOCR($image);
        //$imageToText = $tesseract->run();
        //dd($imageToText);
        //return view('admin.invoice.nes', compact('imageToText'));

        $nesListFile = public_path('docs/nes_list.csv');
        $collectionListFile = public_path('docs/collection.csv');
        $file = file_get_contents($nesListFile);
        $collectionFile = file_get_contents($collectionListFile);
        $lines = explode(PHP_EOL, $file);
        $collectionLines = explode(PHP_EOL, $collectionFile);
        array_shift($collectionLines);
        $collectionListNames = [];
        $grandTotal = 0;
        $missingNames = [];
        $pricingList = [];

        foreach ($collectionLines as $collectionLine) {
            $collectionLine = str_getcsv($collectionLine);
            if ($collectionLine[0] != '') {
                $nameParts = explode('(', $collectionLine[0]);
                $collectionListNames[] = rtrim($nameParts[0]);
            }
        }

        foreach ($lines as $line) {
            $line = str_getcsv($line);
            $price = ltrim($line[6], '$');
            $price = str_replace(',', '', $price);

            if ($line[1] != 'United States (usa)' || !is_numeric($price)) {
                continue;
            }

            foreach ($collectionListNames as $listName) {
                $nameParts = explode('(', $line[2]);
                $nameParts[0] = rtrim($nameParts[0]);

                if ($listName != $nameParts[0] && (strpos($listName, $nameParts[0]) === false || strpos($nameParts[0], $listName) === false) && !in_array($nameParts[0], $missingNames) && $price <= 25) {
                    $pricingList[$nameParts[0]] = $price;
                    $missingNames[] = $nameParts[0];
                }
            }
        }

        $duplicatesLog = [];
        foreach ($missingNames as $key => $missingName) {
            foreach ($collectionListNames as $collectionName) {
                if (strpos($missingName, $collectionName) !== false) {
                    $duplicatesLog[] = 'duplicate found: ' . $missingName . ' / ' . $collectionName;
                    unset($missingNames[$key]);
                }
            }
        }

        $mNames = [];
        foreach ($missingNames as $missingName) {
            if (isset($pricingList[$missingName])) {
                $mNames[] = ['name' => $missingName, 'price' => $pricingList[$missingName]];
                $grandTotal += $pricingList[$missingName];
            }
        }

        $listCount = count($mNames);

        return view('admin.invoice.nes', compact(['mNames', 'grandTotal', 'listCount']));

        //dd(['collection_names' => $collectionListNames, 'missing_names' => $mNames, 'duplicates_log' => $duplicatesLog, 'grand_total' => $grandTotal]);
    }
}
