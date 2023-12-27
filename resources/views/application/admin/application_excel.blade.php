<h1>All Applications List</h1>
<table>
    <tr>
        <td style="background-color: #CCCCCC; border:2px solid #000000; width: 30px;">#</td>
        <td style="background-color: #CCCCCC; border:2px solid #000000; width: 100px;">Staff Name</td>
        <td style="background-color: #CCCCCC; border:2px solid #000000; width: 50px;">Leave Type</td>
        <td style="background-color: #CCCCCC; border:2px solid #000000; width: 50px;">Date From</td>
        <td style="background-color: #CCCCCC; border:2px solid #000000; width: 50px;">Date To</td>
        <td style="background-color: #CCCCCC; border:2px solid #000000; width: 200px; text-align: right;">Remark</td>
        <td style="background-color: #CCCCCC; border:2px solid #000000; width: 50px;">Status</td>
    </tr>
    @php($i = 0)
    @foreach($applications as $application)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $application->user->name }}</td>
        <td>{{ $application->leave->name }}</td>
        <td>{{ $application->date_from }}</td>
        <td>{{ $application->date_to }}</td>
        <td>{{ $application->remark }}</td>
        <td style="color:red;">
            @if($application->status == 0)
                Pending
            @elseif($application->status == 1)
                Approved
            @else
                Rejected
            @endif
        </td>
    </tr>
    @endforeach
</table>
