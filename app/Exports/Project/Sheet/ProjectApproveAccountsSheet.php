<?php

namespace App\Exports\Project\Sheet;

use App\Models\ProjectAccounts;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class ProjectApproveAccountsSheet implements FromQuery, WithTitle , WithHeadings
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
            ->select(['account_name','account_number','currency','debit','credit','balance','authorization_status'
            ,'ac_name' ,'ac_phone','ac_email','ac_address','type_replay','is_replay'
                      ,'c_first_name' , 'c_last_name','c_email' , 'c_position', 'comment' ,'attachement'  ])
            ->where('authorization_status',3)
            ->where('project_id', $this->project_id);
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Accounts Accepted' . $this->project_id;
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
            'Contact Name',
            'Contact Number',
            'Contact Email',
            'Contact Address',
            'Type Reply',
            'Status Reply',
            'Customer First Name',
            'Customer Last Name',
            'Customer Email',
            'Customer Position',
            'Comment',
            'Attachements',
        ];
    }

    public function prepareRows($rows)
    {
        return $rows->transform(function ($account) {
            $account->authorization_status = 3 ? 'Accepted' : null;
            $account->type_replay = 1  ? 'Reply' : 'More info need';
            $account->type_replay = 2  ? 'Reply' : 'Decline';
            $account->is_replay = 1  ? 'Agree' : 'Disagree';
            return $account;
        });
    }
}
