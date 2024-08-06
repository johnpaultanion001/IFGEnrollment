<nav class="navbar navbar-expand-lg bg-primary">
              <div class="container">
                <div class="navbar-translate">
                
                  <img src="{{ asset('images/vclogo/vc_logo.png') }}" alt="" width="200" hieght="200" />
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
                      @can('user_access')
                        <li class="nav-item">
                          <a class="nav-link {{ request()->is('admin/membership') || request()->is('admin/membership/*') ? 'active' : '' }}" href="/admin/membership/principal/{{ Auth::user()->referral_code ?? "" }}">
                            <p>Membership</p>
                          </a>
                        </li>
                        
                     
                        <!-- <li class="nav-item">
                          <a class="nav-link {{ request()->is('admin/ledger') || request()->is('admin/ledger/*') ? 'active' : '' }}" href="/admin/ledger">
                            <p>Ledger</p>
                          </a>
                        </li> -->
                      @endcan
                   

                      @can('sales_access')
                        <li class="nav-item">
                          <a class="nav-link {{ request()->is('admin/admin_sales') || request()->is('admin/admin_sales/*') ? 'active' : '' }}" href="/admin/admin_sales">
                            <p>Admin Sales</p>
                          </a>
                        </li>
                     
                        <li class="nav-item">
                          <a class="nav-link {{ request()->is('admin/referral_code') || request()->is('admin/referral_code/*') ? 'active' : '' }}" href="/admin/referral_code">
                            <p>Referral Code</p>
                          </a>
                        </li>
                      @endcan
                    
                      @can('billing_access')
                       <li class="nav-item">
                          <a class="nav-link {{ request()->is('admin/admin_billing') || request()->is('admin/admin_billing/*') ? 'active' : '' }}" href="/admin/admin_billing">
                            <p>Admin Billing</p>
                          </a>
                        </li>
                     
                      @endcan
                      @can('accounting_access')
                        <li class="nav-item">
                          <a class="nav-link {{ request()->is('admin/admin_accounting') || request()->is('admin/admin_accounting/*') ? 'active' : '' }}" href="/admin/admin_accounting">
                            <p>Admin Accounting</p>
                          </a>
                        </li>
                     
                      @endcan

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
                    
                      @if (Auth::user())
                        <li class="nav-item dropdown">
                          <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown">
                            <i class="now-ui-icons ui-1_settings-gear-63" aria-hidden="true"></i>
                          </a>
                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                          @if (Auth::user()->roles()->pluck('id')->implode(', ') == 1 || Auth::user()->roles()->pluck('id')->implode(', ') == 2)
                           <a class="dropdown-item" href="/admin/accounts">Accounts</a>
                          @endif
                            <a class="dropdown-item" href="/admin/change_password">Change Password?</a>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">Logout</a>
                          </div>
                        </li>
                      @endif
                  @endif   
                  </ul>
                </div>
              </div>
            </nav>