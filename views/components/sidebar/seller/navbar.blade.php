<li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('seller_product.index') }}" aria-expanded="false"><i class="fas fa-fw fa-box"></i><span class="hide-menu">Product</span></a></li>
<li class="list-divider"></li>
<li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('checkout.index') }}" aria-expanded="false"><i class="fas fa-fw fa-cash-register"></i><span class="hide-menu">Transaction</span></a></li>
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
            <a href="{{ route('chat.buyer.index') }}" class="sidebar-link">
                <span class="hide-menu"> 
                    Buyer
                </span>
            </a>
        </li>
    </ul>
</li>