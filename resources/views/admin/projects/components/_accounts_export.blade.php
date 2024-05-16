<table>
    <thead>
    <tr>
        <th align="center" width="30">Account Name</th>
        <th align="center" width="30">Account Number</th>
        <th align="center" width="20">Currency</th>
        <th align="center" width="20">OB Debit</th>
        <th align="center" width="20">OB Credit</th>
        <th align="center" width="20">M Debit</th>
        <th align="center" width="20">M Credit</th>
        <th align="center" width="20">Balance</th>
        <th align="center" width="20">Time Send Authorization</th>
    </tr>
    </thead>
    <tbody>
    @foreach($accounts_without_status as $item)
        <tr>
            <td align="center">{{ $item['account_name'] }}</td>
            <td align="center">{{ $item['account_number'] }}</td>
            <td align="center">{{ $item['currency'] }}</td>
             <td align="center">{{ $item['ob_debit'] }}</td>
            <td align="center">{{ $item['ob_credit'] }}</td>
            <td align="center">{{ $item['m_debit'] }}</td>
            <td align="center">{{ $item['m_credit'] }}</td>
            <td align="center">{{ $item['balance'] }}</td>
            <td align="center">{{ $item['authorization_time'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<table>
    <thead>
    <tr>
        <th align="center" width="30">Account Name</th>
        <th align="center" width="30">Account Number</th>
        <th align="center" width="20">Currency</th>
        <th align="center" width="20">OB Debit</th>
        <th align="center" width="20">OB Credit</th>
        <th align="center" width="20">M Debit</th>
        <th align="center" width="20">M Credit</th>
        <th align="center" width="20">Balance</th>
        <th align="center" width="20">Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($accounts_pending as $item)
        <tr>
            <td align="center">{{ $item['account_name'] }}</td>
            <td align="center">{{ $item['account_number'] }}</td>
            <td align="center">{{ $item['currency'] }}</td>
            <td align="center">{{ $item['ob_debit'] }}</td>
            <td align="center">{{ $item['ob_credit'] }}</td>
            <td align="center">{{ $item['m_debit'] }}</td>
            <td align="center">{{ $item['m_credit'] }}</td>
            <td align="center">{{ $item['balance'] }}</td>
            <td align="center">Pending</td>
        </tr>
    @endforeach
    </tbody>
</table>
