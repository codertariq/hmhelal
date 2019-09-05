<?php $index = 1;?>
<div class="card card-sidebar-mobile  noprint">
	<ul class="nav nav-sidebar" data-nav-type="accordion">
		{{-- @if(Request::segment($index + 1) == 'configuration')
		@include('_partials.admin.configuration', compact('index'))
		@else --}}
		<li class="nav-item">
			<a href="{{route('home')}}" class="nav-link{{ Request::is('home') ? ' active' : '' }}">
				<i class="icon-home4"></i>
				<span>
					{{_lang('dashboard')}}
				</span>
			</a>
		</li>
		@if (auth()->user()->can(['case_stage.view', 'case_stage.create', 'act.view', 'act.create','court.view', 'court.create', 'location.view', 'location.create' ]))
		<li class="nav-item nav-item-submenu{{Request::segment($index + 2) == 'master' ? ' nav-item-expanded nav-item-open' : ''}}">
			<a href="#" class="nav-link"><i class="icon-gallery"></i> <span>{{ _lang('master') }}</span></a>
			<ul class="nav nav-group-sub" data-submenu-title="{{ _lang('master') }}">
				@if (auth()->user()->can(['case_stage.view', 'case_stage.create' ]))
				<li class="nav-item"><a href="{{ route('admin.configuration.master.case_stage.index') }}" class="nav-link{{ Request::is('admin/configuration/master/case_stage') ? ' active' : '' }}"><i class="icon-ampersand"></i> {{ _lang('case_stage') }}</a></li>
				@endif
				@if (auth()->user()->can(['act.view', 'act.create' ]))
				<li class="nav-item"><a href="{{ route('admin.configuration.master.act.index') }}" class="nav-link{{ Request::is('admin/configuration/master/act') ? ' active' : '' }}"><i class="icon-ampersand"></i> {{ _lang('act') }}</a></li>
				@endif
				@if (auth()->user()->can(['court.view', 'court.create']))
				<li class="nav-item"><a href="{{ route('admin.configuration.master.court.index') }}" class="nav-link{{ Request::is('admin/configuration/master/court') ? ' active' : '' }}"><i class="icon-ampersand"></i> {{_lang('court')}}</a></li>
				@endif
				@if (auth()->user()->can('location.view'))
				<li class="nav-item"><a href="{{ route('admin.configuration.master.union.index') }}" class="nav-link{{ Request::is('admin/configuration/master/union') ? ' active' : '' }}"><i class="icon-ampersand"></i> {{ _lang('union') }}</a></li>
				<li class="nav-item"><a href="{{ route('admin.configuration.master.upozila.index') }}" class="nav-link{{ Request::is('admin/configuration/master/upozila') ? ' active' : '' }}"><i class="icon-ampersand"></i> {{ _lang('upozila') }}</a></li>
				<li class="nav-item"><a href="{{ route('admin.configuration.master.district.index') }}" class="nav-link{{ Request::is('admin/configuration/master/district') ? ' active' : '' }}"><i class="icon-ampersand"></i> {{ _lang('district') }}</a></li>
				<li class="nav-item"><a href="{{ route('admin.configuration.master.division.index') }}" class="nav-link{{ Request::is('admin/configuration/master/division') ? ' active' : '' }}"><i class="icon-ampersand"></i> {{ _lang('division') }}</a></li>
				@endif
			</ul>
		</li>
		@endif
		@if (auth()->user()->can(['case_category.view', 'case_category.create', 'court_category.view', 'court_category.create','client_category.view', 'client_category.create' ]))
		<li class="nav-item nav-item-submenu{{Request::segment($index + 2) == 'category' ? ' nav-item-expanded nav-item-open' : ''}}">
			<a href="#" class="nav-link"><i class="icon-gallery"></i> <span>{{ _lang('category') }}</span></a>
			<ul class="nav nav-group-sub" data-submenu-title="{{ _lang('category') }}">
				@if (auth()->user()->can(['case_category.view', 'case_category.create' ]))
				<li class="nav-item"><a href="{{ route('admin.configuration.category.case.index') }}" class="nav-link{{ Request::is('admin/configuration/category/case') ? ' active' : '' }}"><i class="icon-ampersand"></i> {{ _lang('case') }}</a></li>
				@endif
				@if (auth()->user()->can(['court_category.create','client_category.view', ]))
				<li class="nav-item"><a href="{{ route('admin.configuration.category.court.index') }}" class="nav-link{{ Request::is('admin/configuration/category/court') ? ' active' : '' }}"><i class="icon-ampersand"></i> {{ _lang('court') }}</a></li>
				@endif
				@if (auth()->user()->can(['client_category.view', 'client_category.create']))
				<li class="nav-item"><a href="{{ route('admin.configuration.category.client.index') }}" class="nav-link{{ Request::is('admin/configuration/category/client') ? ' active' : '' }}"><i class="icon-ampersand"></i> {{ _lang('client') }}</a></li>
				@endif
			</ul>
		</li>
		@endif
		@if(auth()->user()->can('configuration.create'))
		<li class="nav-item">
			<a href="{{ route('admin.configuration') }}" class="nav-link{{ Request::is('admin/configuration') ? ' active' : '' }}">
				<i class="icon-cog spinner"></i>
				<span>
					{{_lang('setting')}}
				</span>
			</a>
		</li>
		@endif
		@if(auth()->user()->can('language.view'))
		<li class="nav-item">
			<a href="{{ route('admin.language') }}" class="nav-link{{ Request::is('admin/language*') ? ' active' : '' }}">
				<i class="icon-stack-text"></i>
				<span>
					{{_lang('language')}}
				</span>
			</a>
		</li>
		@endif
		@if(auth()->user()->can('user.view') || auth()->user()->can('role.view') )
		<li class="nav-item nav-item-submenu {{Request::is('admin/user*') ?'nav-item-expanded nav-item-open':''}}">
			<a href="#" class="nav-link"><i class="icon-user-plus"></i> <span>{{_lang('user_management')}}</span></a>
			<ul class="nav nav-group-sub" data-submenu-title="{{_lang('user_management')}}">
				@can('role.view')
				<li class="nav-item "><a href="{{ route('admin.user.role') }}" class="nav-link {{Request::is('admin/user/role*') ? 'active':''}}"><i class="icon-ampersand"></i>{{_lang('role_permission')}}</a></li>
				@endcan
				@can('user.view')
				<li class="nav-item "><a href="{{ route('admin.user.index') }}" class="nav-link {{(Request::is('admin/user*') And !Request::is('admin/user/role*'))  ?'active':''}}"><i class="icon-ampersand"></i>{{_lang('user_manage')}}</a></li>
				@endcan
			</ul>
		</li>
		@endif
		@if (auth()->user()->can(['client.view', 'client.create']))
		<li class="nav-item">
			<a href="{{ route('admin.client.index') }}" class="nav-link{{ Request::is('admin/client') ? ' active' : '' }}">
				<i class="icon-people"></i>
				<span>
					{{_lang('client')}}
				</span>
			</a>
		</li>

		@endif
		@if (auth()->user()->can(['case.view', 'case.create' ]))
		<li class="nav-item nav-item-submenu {{Request::is('admin/cases*') ?'nav-item-expanded nav-item-open':''}}">
			<a href="#" class="nav-link"><i class="icon-briefcase3"></i> <span>{{_lang('cases')}}</span></a>
			<ul class="nav nav-group-sub" data-submenu-title="Layouts">
				<li class="nav-item "><a href="{{ route('admin.cases.index') }}" class="nav-link {{Request::is('admin/cases/index') ? 'active':''}}"><i class="icon-ampersand"></i>{{_lang('all_cases')}}</a></li>
				<li class="nav-item "><a href="{{ route('admin.cases.archived.postindex') }}" class="nav-link {{(Request::is('admin/cases/archived'))  ?'active':''}}"><i class="icon-ampersand"></i>{{_lang('archived')}}</a></li>
				</ul>
			  </li>
	  		@endauth
  @if (auth()->user()->can(['bank.view', 'bank.create' ]))
		 <li class="nav-item">
			<a href="{{ route('admin.account.index') }}" class="nav-link{{ Request::is('admin/account') ? ' active' : '' }}">
				<i class="icon-piggy-bank"></i>
				<span>
					{{_lang('bank/cash_account')}}
				</span>
			</a>
		</li>
 @endauth		
  @if (auth()->user()->can(['chartAccount.view', 'chartAccount.create','payePayer.view','payePayer.create','income.view','income.create','expense.view','expense.create' ]))
		<li class="nav-item nav-item-submenu {{Request::is('admin/transaction*') ?'nav-item-expanded nav-item-open':''}}">
			<a href="#" class="nav-link">
			<i class="icon-tab"></i> <span>{{_lang('transaction')}}</span></a>
			<ul class="nav nav-group-sub" data-submenu-title="Layouts">
				@if (auth()->user()->can(['income.view', 'income.create' ]))
				<li class="nav-item "><a href="{{ route('admin.transaction.income.index') }}" class="nav-link {{Request::is('admin/transaction/income*') ? 'active':''}}">
				<i class="icon-ampersand"></i>{{_lang('income')}}</a></li>
				@endif
				
				@if (auth()->user()->can(['expense.view', 'expense.create' ]))
				<li class="nav-item "><a href="{{ route('admin.transaction.expense.index') }}" class="nav-link {{Request::is('admin/transaction/expense*') ?'active':''}}"><i class="icon-ampersand"></i>{{_lang('expense')}}</a></li>
				@endif
				@if (auth()->user()->can(['chartAccount.view', 'chartAccount.create' ]))
				<li class="nav-item "><a href="{{ route('admin.transaction.chart-account.index') }}" class="nav-link {{Request::is('admin/transaction/chart-account*')  ?'active':''}}"><i class="icon-ampersand"></i>{{_lang('chart_of_account')}}</a></li>
				@endif
				@if (auth()->user()->can(['payePayer.view', 'payePayer.create' ]))
				<li class="nav-item "><a href="{{ route('admin.transaction.payee-payers.index') }}" class="nav-link {{Request::is('admin/transaction/payee-payers*')  ?'active':''}}"><i class="icon-ampersand"></i>{{_lang('pay_and_payers')}}</a></li>
				@endif

			</ul>
		</li>
		@endauth
   @if (auth()->user()->can(['report.view' ]))
		<li class="nav-item nav-item-submenu {{Request::is('admin/report*') ?'nav-item-expanded nav-item-open':''}}">
			<a href="#" class="nav-link">
			<i class="icon-inbox"></i> <span>{{_lang('report')}}</span></a>
			<ul class="nav nav-group-sub" data-submenu-title="Layouts">
				<li class="nav-item "><a href="{{ route('admin.report.income') }}" class="nav-link {{Request::is('admin/report/income*') ? 'active':''}}"><i class="icon-ampersand"></i>{{_lang('income_report')}}</a></li>

				<li class="nav-item "><a href="{{ route('admin.report.expense') }}" class="nav-link {{Request::is('admin/report/expense*') ?'active':''}}"><i class="icon-ampersand"></i>{{_lang('expense_report')}}</a></li>


				<li class="nav-item "><a href="{{ route('admin.report.balance') }}" class="nav-link {{Request::is('admin/report/balance*') ?'active':''}}"><i class="icon-ampersand"></i>{{_lang('financial_balance')}}</a></li>


				<li class="nav-item "><a href="{{ route('admin.report.case') }}" class="nav-link {{Request::is('admin/report/case*') ?'active':''}}"><i class="icon-ampersand"></i>{{_lang('case_report')}}</a></li>


			</ul>
		</li>
		@endauth
	</ul>
</div>