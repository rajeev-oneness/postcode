    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6">
                <h3 class="newswrap_title">Subscribe For a Newsletter</h3>
                <p class="newswrap_content">Whant to be notified about new locations ? Just sign up.</p>
            </div>
            <div class="col-12 col-md-6">
                @if (Session::has('newsletter'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{session('newsletter')}}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <form method="post" action="{{route('newsletter')}}" class="newsletter_form">
                    @csrf
                    <input type="email" name="email" value="{{old('email')}}" placeholder="Enter your email" required>
                    <input type="submit" class="submt_form" value="Send">
                    @error('email')
                    <div class="alert alert-danger alert-dismissible fade show mt-1" role="alert">
                        <strong>{{$message}}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @enderror
                </form>
            </div>
        </div>
    </div>