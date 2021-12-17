<li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('landing.index') }}"
    aria-expanded="false"><i class="fas fa-fw fa-home"></i><span
        class="hide-menu">Home</span></a></li>
<li class="list-divider"></li>
<li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('landing.product.index') }}"
    aria-expanded="false"><i class="fas fa-fw fa-box"></i><span
        class="hide-menu">Product</span></a></li>
<li class="list-divider"></li>
<li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('landing.checkout.index') }}"
    aria-expanded="false"><i class="fas fa-fw fa-cash-register"></i><span
        class="hide-menu">Transaction</span></a></li>
<li class="list-divider"></li>
<li class="sidebar-item"> 
    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
        <i class="fas fa-fw fa-comments"></i>
        <span class="hide-menu">Chats </span>
    </a>
    <ul aria-expanded="false" class="collapse  first-level base-level-line">
        <li class="sidebar-item">
            <a href="{{ route('chat.admin.index') }}" class="sidebar-link">
                <span class="hide-menu"> 
                    Admin
                </span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('chat.seller.index') }}" class="sidebar-link">
                <span class="hide-menu"> 
                    Seller
                </span>
            </a>
        </li>
    </ul>
</li>
{{--  <li class="nav-small-cap"><span class="hide-menu">Seller</span></li>  --}}

{{--  <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
    aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span
        class="hide-menu">Forms </span></a>
<ul aria-expanded="false" class="collapse  first-level base-level-line">
    <li class="sidebar-item"><a href="form-inputs.html" class="sidebar-link"><span
                class="hide-menu"> Form Inputs
            </span></a>
    </li>
    <li class="sidebar-item"><a href="form-input-grid.html" class="sidebar-link"><span
                class="hide-menu"> Form Grids
            </span></a>
    </li>
    <li class="sidebar-item"><a href="form-checkbox-radio.html" class="sidebar-link"><span
                class="hide-menu"> Checkboxes &
                Radios
            </span></a>
    </li>
</ul>
</li>  --}}

{{--  <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="/#"
    aria-expanded="false"><i data-feather="sidebar" class="feather-icon"></i><span
        class="hide-menu">Data Seller
    </span></a>
</li>
<li class="list-divider"></li>  --}}
