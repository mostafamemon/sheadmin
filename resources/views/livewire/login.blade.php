<div class="card" style="padding:3px">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <div class="field-error mg-b-10">
        @error('login-failed')
          <span class="error">{{ $message }}</span>
        @enderror

        @if(Session::has('status'))
          <p class="alert alert-success">{{ Session::get('status') }}</p>
        @endif
      </div>

      <form wire:submit.prevent="submit">
        <div class="input-group mb-3">
          <input type="email" wire:model.lazy="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        @error('email') 
        <div class="field-error">
            <span class="error">{{ $message }}</span>
        </div>
        @enderror

        <div class="input-group mb-3">
          <input type="password" wire:model.lazy="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        @error('password') 
        <div class="field-error">
            <span class="error">{{ $message }}</span>
        </div>
        @enderror

        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
                <a href="{{url('forgot-password')}}" class="forget-password-link">I forgot my password</a>
            </div>
          </div>
          <div class="col-4">
            <input type="submit" class="btn btn-info btn-block" value="Sign In"/>
          </div>
        </div>
      </form>
      
    </div>
</div>