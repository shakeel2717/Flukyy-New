<div class="row gx-2 gx-lg-3">
    <div class="col-md-5 mx-auto">
        <div class="card bg-dark mb-3">
            <div class="card-body">
                <h2 class="card-title text-light">Fluke Hash File</h2>
                <h3 class="text-white">Your Password is:</h3>
                <div class="form-group">
                    <input type="text" name="password" id="password" class="form-control bg-dark text-white"
                        value=" {{ (isset($participate[0]->password)) ? $participate[0]->password : '***************' }} ">
                </div>
                <?php $username = session('user')[0]->username ?>
                <a href="{{ asset('flukehashe/'.$username . $Activecontest->contest.'.zip') }}" class="btn btn-primary">Download your File</a>
            </div>
        </div>
    </div>
</div>
