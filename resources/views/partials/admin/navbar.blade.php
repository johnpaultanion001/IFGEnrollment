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
                      @can('user_access')
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
                        <!-- <li class="nav-item">
                          <a class="nav-link {{ request()->is('admin/ledger') || request()->is('admin/ledger/*') ? 'active' : '' }}" href="/admin/ledger">
                            <p>Ledger</p>
                          </a>
                        </li> -->
                      @endcan
                      @can('staff_access')
                        <li class="nav-item">
                          <a class="nav-link {{ request()->is('admin/transaction') || request()->is('admin/transaction/*') ? 'active' : '' }}" href="/admin/transaction">
                            <p>Transaction</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link {{ request()->is('admin/exchange_rate') || request()->is('admin/exchange_rate/*') ? 'active' : '' }}" href="/admin/exchange_rate">
                            <p>Exchange Rate</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link {{ request()->is('admin/customer') || request()->is('admin/customer/*') ? 'active' : '' }}" href="/admin/customer">
                            <p>Customer</p>
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
                      <li class="nav-item">
                        <a class="nav-link {{ request()->is('calculator') || request()->is('calculator/*') ? 'active' : '' }}" href="/calculator">
                          <p>Calculator</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{ request()->is('tracker') || request()->is('tracker/*') ? 'active' : '' }}" href="/tracker">
                          <p>Tracker</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{ request()->is('branch_locator') || request()->is('branch_locator/*') ? 'active' : '' }}" href="/branch_locator/BANK">
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
                          @if (Auth::user()->roles()->pluck('id')->implode(', ') == 1)
                           <a class="dropdown-item" href="/admin/accounts">Accounts</a>
                           <a class="dropdown-item" href="/admin/branch_bank_setting">Branch / Bank Setting</a>
                          @elseif (Auth::user()->roles()->pluck('id')->implode(', ') == 3)
                            <a class="dropdown-item" href="/admin/fullregistration">My Account</a>
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