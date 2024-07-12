<?php

namespace App\Observers;

use App\Models\Ekstrakurikuler;

class EkstrakurikulerObserver
{
    public function creating(Ekstrakurikuler $ekstrakurikuler)
    {
        $lastEkstrakurikuler = Ekstrakurikuler::orderBy('id_ekstrakurikuler', 'desc')->first();

        if ($lastEkstrakurikuler) {
            $lastId = $lastEkstrakurikuler->id_ekstrakurikuler;
            $newId = 'E' . str_pad((int) substr($lastId, 1) + 1, 2, '0', STR_PAD_LEFT);
        } else {
            $newId = 'E01';
        }

        $ekstrakurikuler->id_ekstrakurikuler = $newId;
    }
}

