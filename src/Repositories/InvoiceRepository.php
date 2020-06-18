<?php

namespace Iugu\Repositories;

use Iugu\Models\Invoice;

class InvoiceRepository extends BaseRepository
{

    public function model()
    {
        return Invoice::class;
    }
}
