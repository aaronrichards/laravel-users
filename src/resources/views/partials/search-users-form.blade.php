<div class="row">
    <div class="col-sm-8 offset-sm-4 col-md-6 offset-md-6 col-lg-5 offset-lg-7 col-xl-4 offset-xl-8">

        <form id="search_users" method="POST" action="{{ route('search-users') }}" class="needs-validation">

            @csrf
            <div class="input-group mb-3">

                <label for="user_search_box">Email address</label>
                <input type="text" class="form-control" id="user_search_box" placeholder="forms.search-users-ph" aria-label="search-users-ph">

                <div class="input-group-append">
                    <a href="#" class="btn btn-warning clear-search" data-toggle="tooltip" title="clear-search">
                        clear-search
                    </a>
                    
                    <button id="confirm" type="submit" class="btn btn-secondary">submit-search</button>
                </div>
            </div>
        </form>
    </div>
</div>

