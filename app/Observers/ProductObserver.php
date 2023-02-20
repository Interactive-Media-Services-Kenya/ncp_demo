<?php

namespace App\Observers;

use App\Models\Activity;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function created(Product $product)
    {
        Activity::create([
            'description' => 'Product: '.$product->serial.' Created for ' . $product->company->name,
            'user_id' => Auth::id(),
        ]);
    }

    /**
     * Handle the Product "updated" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        Activity::create([
            'description' => 'Product: '.$product->serial.' Issued out for ' . $product->company->name,
            'user_id' => Auth::id(),
        ]);
    }

    /**
     * Handle the Product "deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        Activity::create([
            'description' => 'Product: '.$product->serial.' Deleted for ' . $product->company->name,
            'user_id' => Auth::id(),
        ]);
    }

    /**
     * Handle the Product "restored" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function restored(Product $product)
    {
        Activity::create([
            'description' => 'Product: '.$product->serial.' Restored for ' . $product->company->name,
            'user_id' => Auth::id(),
        ]);
    }

    /**
     * Handle the Product "force deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        //
    }
}
