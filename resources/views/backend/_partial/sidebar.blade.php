<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <img class="app-sidebar__user-avatar" src="{!! asset('backend/user.png') !!}" alt="User Image" width="60px">
        <div>
{{--            <p class="app-sidebar__user-name">{{ Auth::user()->roles->name }}</p>--}}
            <p class="app-sidebar__user-designation">Welcome To,<br/>{{ Auth::User()->name }}</p>
        </div>
    </div>
    <ul class="app-menu ">
{{--        <li><a class="app-menu__item {{Request ::is('home') ? ' active ' : ''}}" href="{!! URL::to('/home') !!}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>--}}
        @php
            //if(Auth::User()->getRoleNames()[0] == "Admin"){
            //if(Auth::User()->role=='1'){
        @endphp
        <li><a class="app-menu__item" href="{{ route('home') }}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        <li class="treeview{{Request::is('customer*') ? ' is-expanded': ''}}"><a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Customer</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li style="background-color: gray"><a class="app-menu__item" href="{{ route('customer.index') }}"><span class="app-menu__label"> List</span></a></li>
                <li style="background-color: gray"><a class="app-menu__item" href="{{ route('customer.create') }}"><span class="app-menu__label">Create</span></a></li>
            </ul>
        </li>
        <li class="treeview{{Request::is('services*')||Request::is('services*') ||Request::is('serviceCategory')||Request::is('serviceSubCategory*') || Request::is('serviceUnit') || Request::is('service') ? ' is-expanded': ''}}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-arrow-down"></i><span class="app-menu__label">Services </span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li  style="background-color: gray"><a class="app-menu__item" href="{{ route('serviceCategory.index') }}"><span class="app-menu__label">Service Category</span></a></li>
                <li  style="background-color: gray"><a class="app-menu__item" href="{{ route('serviceSubCategory.index') }}"><span class="app-menu__label">Service Sub Category</span></a></li>
                <li  style="background-color: gray"><a class="app-menu__item" href="{{ route('serviceUnit.index') }}"><span class="app-menu__label"> Unit Measure</span></a></li>
                <li  style="background-color: gray"><a class="app-menu__item" href="{{ route('service.index') }}"><span class="app-menu__label">Service List</span></a></li>
            </ul>
        </li>
{{--        <li class="treeview{{Request::is('serviceProvider*') ? ' is-expanded': ''}}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Service Provider </span><i class="treeview-indicator fa fa-angle-right"></i></a>--}}
{{--            <ul class="treeview-menu">--}}
{{--                <li style="background-color: gray"><a class="app-menu__item" href="{{ route('serviceProvider.index') }}"><span class="app-menu__label"> List</span></a></li>--}}
{{--                <li style="background-color: gray"><a class="app-menu__item" href="{{ route('serviceProvider.create') }}"> <span class="app-menu__label">Create</span></a></li>--}}
{{--            </ul>--}}
{{--        </li>--}}
        <li class="treeview{{Request::is('serviceSale*') ||Request::is('dueList*') ? ' is-expanded': ''}}"><a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-arrow-up"></i><span class="app-menu__label">Service Sale </span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li style="background-color: gray"><a class="app-menu__item" href="{{ route('serviceSale.index') }}"> <span class="app-menu__label"> List</span></a></li>
                <li style="background-color: gray"><a class="app-menu__item" href="{{ route('serviceSale.create') }}"> <span class="app-menu__label"> Create</span></a></li>
                <li style="background-color: gray"><a class="app-menu__item" href="{{ route('dueList') }}"> <span class="app-menu__label"> Due List</span></a></li>
{{--                <li style="background-color: gray"><a class="app-menu__item" href="{{ route('serviceSaleDetails.index') }}"><i class="app-menu__icon fas fa-users"></i> <span class="app-menu__label">Service Sale Details List</span></a></li>--}}
{{--                <li style="background-color: gray"><a class="app-menu__item" href="{{ route('serviceSaleDetails.create') }}"><i class="app-menu__icon fas fa-users"></i> <span class="app-menu__label">Service Sale Details Create</span></a></li>--}}
            </ul>
        </li>
        <li class="treeview{{Request::is('employee/index*') || Request::is('employee/index*') ? ' is-expanded': ''}}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Employee </span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li  style="background-color: gray"><a class="app-menu__item" href="{{ route('employee.index') }}"><span class="app-menu__label"> List</span></a></li>
                <li  style="background-color: gray"><a class="app-menu__item" href="{{ route('employee.create') }}"><span class="app-menu__label"> Create</span></a></li>
            </ul>
        </li>
        <li class="treeview{{Request::is('employee-salary*') || Request::is('employee-salary*') ? ' is-expanded': ''}}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-money"></i><span class="app-menu__label">Employee Salary </span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li  style="background-color: gray"><a class="app-menu__item" href="{{ route('employee-salary.index') }}"><span class="app-menu__label"> List</span></a></li>
                <li  style="background-color: gray"><a class="app-menu__item" href="{{ route('employee-salary.create') }}"><span class="app-menu__label">Create</span></a></li>
            </ul>
        </li>
        <li class="treeview{{Request::is('expenseCategory*') || Request::is('expenses*') ? ' is-expanded': ''}}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-toggle-down"></i><span class="app-menu__label">Office Expenses </span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li  style="background-color: gray"><a class="app-menu__item" href="{{ route('expenseCategory.index') }}"><span class="app-menu__label">Expense Category</span></a></li>
                <li  style="background-color: gray"><a class="app-menu__item" href="{{ route('expenses.index') }}"><span class="app-menu__label">Expense</span></a></li>
            </ul>
        </li>
        <li class="treeview{{Request::is('voucherType*') || Request::is('voucherType*') ? ' is-expanded': ''}}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Voucher Types</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li  style="background-color: gray"><a class="app-menu__item"  href="{{ route('voucherType.index') }}"><span class="app-menu__label">List</span></a></li>
                <li  style="background-color: gray"><a class="app-menu__item"  href="{{ route('voucherType.create') }}"><span class="app-menu__label">Create</span></a></li>
            </ul>
        </li>
        <li class="treeview{{Request::is('account/coa_print*') || Request::is('account/coa_print*')|| Request::is('transaction*')|| Request::is('account/cashbook*')|| Request::is('account/trial-balance*')|| Request::is('account/credit-voucher*') || Request::is('account/debit-voucher*') || Request::is('account/generalledger*')  ? ' is-expanded': ''}}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-file-text-o"></i> <span class="app-menu__label">Accounts </span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li  style="background-color: gray"><a class="app-menu__item" href="{{ route('transaction.create') }}"><span class="app-menu__label">Posting</span></a></li>
                <li  style="background-color: gray"><a class="app-menu__item" href="{{ route('transaction.index') }}"><span class="app-menu__label">Posting List</span></a></li>
                <li  style="background-color: gray"><a class="app-menu__item" href="{!! URL::to('/account/cashbook') !!}"><span class="app-menu__label">Cash Book</span></a></li>
                <li  style="background-color: gray"><a class="app-menu__item" href="{{ route('account.generalledger') }}"><span class="app-menu__label">Ledger</span></a></li>
                <li  style="background-color: gray"><a class="app-menu__item" href="{{ route('account.debit.voucher') }}"><span class="app-menu__label">Debit Voucher</span></a></li>
                <li  style="background-color: gray"><a class="app-menu__item" href="{{ route('account.credit.voucher') }}"><span class="app-menu__label">Credit Voucher</span></a></li>
                <li  style="background-color: gray"><a class="app-menu__item" href="{!! URL::to('/account/trial-balance') !!}"><span class="app-menu__label">Trial Balance</span></a></li>
{{--                <li  style="background-color: gray"><a class="app-menu__item" href="{!! URL::to('/account/balance-sheet') !!}"><span class="app-menu__label">Balance Sheet</span></a></li>--}}
                <li><a class="treeview-item{{Request::is('accounts')||Request::is('accounts/*') ? ' active': ''}}" href="{!! route('accounts.index') !!}">Chart Of Accounts</a></li>
                <li  style="background-color: gray"><a class="app-menu__item" href="{{ route('account.coa_print') }}"><span class="app-menu__label">COA Prints</span></a></li>

            </ul>
        </li>
        <hr/>
        <li><a class="app-menu__item" {{Request ::is('/users')  ? ' active ' : ''}} href="{{ route('users.index') }}"><i class="app-menu__icon fas fa-users"></i><span class="app-menu__label">Users</span></a></li>
{{--        <li><a class="app-menu__item" href="{{ route('stores.index') }}"><i class="app-menu__icon fas fa-users"></i><span class="app-menu__label">Stores</span></a></li>--}}
        <li class="treeview{{Request::is('roles*') ? ' is-expanded': ''}}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Role Permissions </span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li style="background-color: gray"><a class="app-menu__item" href="{{ route('roles.index') }}"><i class="app-menu__icon fa fa-circle"></i><span class="app-menu__label">Role Permission List</span></a></li>
{{--                <li style="background-color: gray"><a class="app-menu__item" href="{{ route('roles.create') }}"><i class="app-menu__icon fas fa-users"></i><span class="app-menu__label">Create Role Permission</span></a></li>--}}
            </ul>
        </li>
        @php
            //}
        @endphp
    </ul>
</aside>
