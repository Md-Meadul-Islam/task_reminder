<div class="row g-0 d-flex bg-white my-1 mx-2">
    <div class="col-12">
        <h4 class="text-secondary text-center py-2">Your All Days</h4>
        <table class="table table-bordered table-striped">
            <thead>
                <th>Day Name</th>
                <th>Week Days</th>
                <th>Repeat</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach ($allDays as $day)
                <?php
                $weekdays = json_decode($day['weekdays'], true);
                ?>
                <tr>
                    <td>{{$day['day_name']}}</td>
<td>
    @if ($day['weekdays'])
    @foreach ($weekdays as $key=>$wd)
    <span class="btn btn-sm btn-success">{{$wd}}</span>
    @endforeach
    @endif
</td>
<td class="text-capitalize">{{$day['repeat']}}</td>
<td> <a href="javascript:void(0)" id="editday" data-id="{{$day['id']}}" 
    <?php if ($day['status'] == 'paused') {
        echo 'class="rounded-pill text-decoration-none p-1 bg-warning" title="Paused"';
     }else{ 
        echo 'class="rounded-pill text-decoration-none p-1 bg-success" title="Active"'; 
     } ?>>🖊</a>
<a href="javascript:void(0)" id="deleteday" data-id="{{$day['id']}}" data-name="{{$day['day_name']}}" class="rounded-pill text-decoration-none p-1 bg-danger" title="Delete">🗑</a>
</td>
</tr>
@endforeach
<tr>
    <td colspan="4" class="text-center">
        <a href="javascript:void(0)" class="btn btn-success addday">➕</a>
    </td>
</tr>
</tbody>
</table>
</div>
</div>