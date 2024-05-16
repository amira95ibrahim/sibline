<?php

namespace App\Exports\Project\Sheet;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\ProjectAccounts;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;

class AccountsSheet implements FromQuery, WithTitle , WithHeadings
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
        return ProjectAccounts::query()->select(['account_name','account_number','currency','debit','credit','balance','authorization_time'])
            ->where('authorization_status' , 0)
            ->where('project_id', $this->project_id);
    }


    /**
     * @return string
     */
    public function title(): string
    {
        return 'Accounts Without Status '.$this->project_id;
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
            'Send Authorization Request Time',
        ];
    }

    public function prepareRows($rows)
    {
        return $rows->transform(function ($account) {
            $account->authorization_time ?? null;

            return $account;
        });
    }
}
