<?php

namespace App\Exports\Project;

use App\Exports\Project\Sheet\AccountsSheet;
use App\Exports\Project\Sheet\ProjectApproveAccountsSheet;
use App\Exports\Project\Sheet\ProjectApproveMissingAccountsSheet;
use App\Exports\Project\Sheet\ProjectPendingAccountsSheet;
use App\Exports\Project\Sheet\ProjectRefusedAccountsSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ProjectAccountsExport implements WithMultipleSheets
{
    use Exportable;

    private $project_id;
    public function __construct($project_id)
    {
        $this->project_id = $project_id;
    }


    /**
     * @return array
     */
    public function sheets(): array
    {
        return [
            new AccountsSheet($this->project_id ),
            new ProjectPendingAccountsSheet($this->project_id ),
            new ProjectApproveMissingAccountsSheet($this->project_id ),
            new ProjectApproveAccountsSheet($this->project_id ),
            new ProjectRefusedAccountsSheet($this->project_id ),
            ];
    }
}
