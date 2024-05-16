<?php

namespace App\Exports\Project\Sheet;

use App\Models\ProjectAccounts;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class ProjectPendingAccountsSheet implements FromQuery, WithTitle , WithHeadings
{
    private $project_id;


    public function __construct(int $project_id)
    {
        $this->project_id = $project_id;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return ProjectAccounts
            ::query()
            ->select(['account_name','account_number','currency','debit','credit','balance','authorization_status'])
            ->where('authorization_status',1)
            ->where('project_id', $this->project_id);
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Accounts Pending ' . $this->project_id;
    }
    public function headings(): array
    {
        return [
            'Account Name',
            'Account Number',
            'Currency',
            'Debit',
            'Credit',
            'Balance',
            'Status',
        ];
    }
    public function prepareRows($rows)
    {
        return $rows->transform(function ($account) {
            $account->authorization_status = 1 ? 'Pending' : null;

            return $account;
        });
    }
}
