  <div class="col-md-2">
                <div class="sidebar" id="adm-sidebar">
                    <a class="{{ request()->is('status-application/pending') ? 'active' : '' }}" href="{{url('/status-application/pending')}}">Pending Applications</a>
                    <a class="{{ request()->is('status-application/approved') ? 'active' : '' }}" href="{{url('/status-application/approved')}}">Approved Applications</a>
                    <a class="{{ request()->is('status-application/delivered') ? 'active' : '' }}" href="{{url('/status-application/delivered')}}">Delivered Sticker List</a>
                    <a class="{{ request()->is('status-application/rejected') ? 'active' : '' }}" href="{{url('/status-application/rejected')}}">Rejected Applications</a>
                    <a class="{{ request()->is('sticker/expired') ? 'active' : '' }}" href="{{url('/sticker/expired')}}">Expired Stickers</a>
                    <a id="temp-pass" style="color: #fff;">Temporary Pass <i class="fas fa-chevron-down" style="font-size: 12px;"></i></a>
                    <ul class="temp-menu">
                        <li><a class="{{ request()->is('temporary-pass') ? 'active' : '' }}" href="{{url('/temporary-pass')}}">Pending </i></a></li>
                        <li><a class="{{ request()->is('temporary-pass/approved') ? 'active' : '' }}" href="{{url('/temporary-pass/approved')}}">Approved</i></a></li>
                        <li><a class="{{ request()->is('temporary-pass/rejected') ? 'active' : '' }}" href="{{url('/temporary-pass/rejected')}}">Rejected</i></a></li>
                        <li><a class="{{ request()->is('temporary-pass/expired') ? 'active' : '' }}" href="{{url('/temporary-pass/expired')}}">Expired</i></a></li>
                    </ul>
                    <a class="{{ request()->is('invoice-list') ? 'active' : '' }}" href="{{url('/invoice-list')}}">Invoice List</a>
                    <a class="{{ request()->is('invoice-report') ? 'active' : '' }}" href="{{url('/invoice-report')}}">Invoice Report</a>
                    <a class="{{ request()->is('sms-panel') ? 'active' : '' }}" href="{{url('/sms-panel')}}">SMS Panel</a>
                    <!--                
                    <a href="">Create Sticker</a>
                    <a href="">Vehicle Info</a>
                    <a href="">Customer Info</a>
                    <a href="">SMS</a>
                    -->
                </div>
            </div>

            <!-- 
            <style media="screen">
              a.active-menu {
                background-color: #eee;
              }
            </style>
            -->
