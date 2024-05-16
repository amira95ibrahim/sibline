<?php

namespace App\Imports;

use App\Models\ProjectAccounts;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Excel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Storage;
class ProjectAccountsImport implements ToCollection
{
   
   
    public function collection(Collection $rows)
    {   
        Storage::disk('local')->put($rows , 'Contents');
    }
   
}
