<div class="card">
    <div class="card-body">
        <h2 class="card-title">Vote Casting Live Overview</h2>
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">User</th>
                    <th scope="col">Value</th>
                    <th scope="col">Voting Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($allVotes as $vote)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{ $vote->user->fname }} {{ $vote->user->ahmad }}</td>
                    <td>{{ $vote->value }}</td>
                    <td>{{ $vote->created_at }}</td>
                </tr>
                    
                @empty
                    <h2>No Record Found</h2>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
