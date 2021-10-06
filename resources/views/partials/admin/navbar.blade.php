<nav class="navbar navbar-expand-lg bg-primary">
              <div class="container">
                <div class="navbar-translate">
                  <a class="navbar-brand" href="#">{{ trans('panel.site_title') }}</a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#example-navbar-danger" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                  </button>
                </div>
                <div class="collapse navbar-collapse" id="example-navbar-danger">
                  <ul class="navbar-nav ml-auto">
                  @if(request()->is('email/verify'))

                  @else
                    @if (Auth::user())
                      <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/home') || request()->is('admin/home/*') ? 'active' : '' }}" href="/admin/home">
                          <p>Home</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/recipient') || request()->is('admin/recipient/*') ? 'active' : '' }}" href="/admin/recipient">
                          <p>Recipient</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/history') || request()->is('admin/history/*') ? 'active' : '' }}" href="/admin/history">
                          <p>History</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/ledger') || request()->is('admin/ledger/*') ? 'active' : '' }}" href="/admin/ledger">
                          <p>Ledger</p>
                        </a>
                      </li>
                    @else
                      <li class="nav-item">
                        <a class="nav-link {{ request()->is('login') || request()->is('login/*') ? 'active' : '' }}" href="/login">
                          <p>Login</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{ request()->is('register') || request()->is('register/*') ? 'active' : '' }}" href="/register">
                          <p>Register</p>
                        </a>
                      </li>
                    @endif
                      <li class="nav-item">
                        <a class="nav-link {{ request()->is('tracker') || request()->is('tracker/*') ? 'active' : '' }}" href="/tracker">
                          <p>Tracker</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{ request()->is('branch_locator') || request()->is('branch_locator/*') ? 'active' : '' }}" href="/branch_locator">
                          <p>Branch Locatior</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{ request()->is('contactus') || request()->is('contactus/*') ? 'active' : '' }}" href="/contactus">
                          <p>Contact Us</p>
                        </a>
                      </li>
                      @if (Auth::user())
                        <li class="nav-item dropdown">
                          <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown">
                            <i class="now-ui-icons ui-1_settings-gear-63" aria-hidden="true"></i>
                          </a>
                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#">My Account</a>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">Logout</a>
                            @if(Auth::user()->roles()->pluck('title')->implode(', ') == 'Admin')
                              <a class="dropdown-item" href="#">Admin Page</a>
                            @endif
                          </div>
                        </li>
                      @endif
                  @endif   
                  </ul>
                </div>
              </div>
            </nav>