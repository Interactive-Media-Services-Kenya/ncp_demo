<?php

namespace App\Observers;

use App\Models\Activity;
use App\Models\Batch;
use Illuminate\Support\Facades\Auth;

class BatchObserver
{
    /**
     * Handle the Batch "created" event.
     *
     * @param  \App\Models\Batch  $batch
     * @return void
     */
    public function created(Batch $batch)
    {
        Activity::create([
            'description' => 'Batch: '.$batch->batch_code.' Created for ' . $batch->company->name,
            'user_id' => Auth::id(),
        ]);
    }

    /**
     * Handle the Batch "updated" event.
     *
     * @param  \App\Models\Batch  $batch
     * @return void
     */
    public function updated(Batch $batch)
    {
        Activity::create([
            'description' => 'Batch: '.$batch->batch_code.' Updated for ' . $batch->company->name,
            'user_id' => Auth::id(),
        ]);
    }

    /**
     * Handle the Batch "deleted" event.
     *
     * @param  \App\Models\Batch  $batch
     * @return void
     */
    public function deleted(Batch $batch)
    {
        //
    }

    /**
     * Handle the Batch "restored" event.
     *
     * @param  \App\Models\Batch  $batch
     * @return void
     */
    public function restored(Batch $batch)
    {
        //
    }

    /**
     * Handle the Batch "force deleted" event.
     *
     * @param  \App\Models\Batch  $batch
     * @return void
     */
    public function forceDeleted(Batch $batch)
    {
        //
    }
}
