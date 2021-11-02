<div class="card">
    <div class="card-body">
        <h2 class="card-title">Vote Casting Live Overview</h2>
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Fluke ID</th>
                    <th scope="col">Vote #</th>
                    <th scope="col">Total Vote</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($allVotes as $vote)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{ $Activecontest->contest }}</td>
                    <td>{{ $vote->value }}</td>
                    <td>{{ $vote->count }}</td>
                </tr>
                    
                @empty
                    <h2>No Record Found</h2>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
