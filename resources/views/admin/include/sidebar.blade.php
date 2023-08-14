@php
    $roles = App\Models\Role::pluck('display_name');
    $segment1 = request()->segment(1);
    $segment2 = request()->segment(2);
    $segment3 = request()->segment(3);
    $segment4 = request()->segment(4);
@endphp
<div class="app-sidebar colored">
    <div class="sidebar-header">
        <a class="header-brand" href="{{route('admin.dashboard.index')}}">
            <div class="logo-img">
               <img height="35px" src="{{ getBackendLogo(getSetting('app_logo'))}}" class="header-brand-img" title="App Logo"> 
            </div>
        </a>
        <div class="sidebar-action"><i class="ik ik-arrow-left-circle"></i></div>
        <button id="sidebarClose" class="nav-close"></button>
    </div>
    <div class="sidebar-content">
        <div class="nav-container">
            <div class="px-20px mt-3 mb-3">
                <input class="form-control bg-soft-secondary border-0 form-control-sm text-white" style="background-color: #131923;border-color: #131923;" type="text" name="" placeholder="{{ __('Search in menu') }}" id="menu-search" onkeyup="menuSearch()">
            </div>
            <nav id="search-menu-navigation" class="navigation-main">

            </nav>
            <nav id="main-menu-navigation" class="navigation-main">

                <div class="nav-item {{ ($segment2 == 'dashboard') ? 'active' : '' }}">
                    <a href="{{route('admin.dashboard.index')}}" class="a-item" ><i class="ik ik-bar-chart-2"></i><span>{{ __('Dashboard')}}</span></a>
                </div> 
                    @if (auth()->user()->isAbleTo('view_orders') &&  getSetting('subscribers_activation') == 1 && getSetting('payout_activation') == 1)
                        <div class="nav-item {{ activeClassIfRoutes(['admin.orders.index','admin.orders.show','admin.orders.invoice','admin.user-subscriptions.index','admin.user-subscriptions.create','admin.user-subscriptions.edit', 'admin.payouts.index','admin.payouts.show','admin.orders.invoice','admin.orders.create' ], 'active open')  }} has-sub">
                            @if(auth()->user()->isAbleTo('view_orders') || (auth()->user()->isAbleTo('view_payouts')))
                            <a href="#"><i class="ik ik-shopping-bag"></i><span>{{ __('Sales & Payments')}}</span></a>
                                <div class="submenu-content">
                                    @if(getSetting('order_activation') == 1)
                                            @if(auth()->user()->isAbleTo('view_orders'))
                                                <a href="{{route('admin.orders.index')}}" class="menu-item a-item {{ activeClassIfRoutes(['admin.orders.index', 'admin.payouts.edit'], 'active')  }}">{{ __('Manage Orders')}}</a>
                                            @endif
                                        @endif

                                    @if(getSetting('subscribers_activation') == 1)
                                        <a href="{{ route('admin.user-subscriptions.index')}}" class="menu-item a-item {{ activeClassIfRoutes(['admin.user-subscriptions.index', 'admin.user-subscriptions.edit'], 'active')  }}" ><span>Subscribers</span></a>
                                    @endif
                                    @if(getSetting('payout_activation') == 1)
                                        @if(auth()->user()->isAbleTo('view_payouts'))
                                        <a href="{{route('admin.payouts.index')}}" class="menu-item a-item {{ activeClassIfRoutes(['admin.payouts.index', 'admin.payouts.edit'], 'active')  }}">{{ __('Control Payouts')}}</a>
                                        @endif
                                @endif
                                </div>
                            @endif
                        </div>
                    @endif
                    @if(auth()->user()->isAbleTo('view_items'))
                        @if(getSetting('item_activation') == 1)
                            <div class="nav-item {{ activeClassIfRoutes(['admin.items.index','admin.items.create','admin.items.edit' ], 'active open')  }} has-sub">
                                <a href="#"><i class="ik ik-layers"></i><span>{{ __('Control Products')}}</span></a>
                                <div class="submenu-content">
                                    @if(getSetting('item_activation') == 1)
                                    <a href="{{ route('admin.items.index')}}" class="menu-item a-item">{{ __('Manage Items')}}</a>
                                    @endif
                                </div>
                            </div>
                        @endif    
                    @endif
                    <div class="nav-item {{ activeClassIfRoutes(['admin.mail-sms-templates.index','admin.website-pages.index','admin.faqs.index','admin.faqs.create','admin.faqs.edit','admin.mail-sms-templates.create','admin.mail-sms-templates.edit','admin.mail-sms-templates.show','admin.category-types.index','admin.category-types.create','admin.category-types.edit','admin.categories.index','admin.categories.create','admin.categories.edit', 'admin.paragraph-contents.index','admin.paragraph-contents.create','admin.paragraph-contents.edit','admin.slider-types.index','admin.slider-types.create','admin.slider-types.edit','admin.blogs.index','admin.blogs.create','admin.blogs.edit','admin.blogs.show','admin.sliders.edit','admin.sliders.index','admin.sliders.create','admin.locations.country','admin.locations.country.create','admin.locations.state','admin.locations.state.create','admin.locations.city','admin.locations.city.create','admin.subscriptions.index','admin.subscriptions.create','admin.subscriptions.edit','admin.seo-tags.index','admin.website-pages.appearance','admin.website-pages.create'], 'active open')  }} has-sub">
                        <a href="#"><i class="ik ik-hard-drive"></i><span>{{ __('Content Management')}}</span></a>
                        <div class="submenu-content">
                            @if(getSetting('faq_activation') == 1)
                                @if(auth()->user()->isAbleTo('view_faqs'))
                                    <a href="{{ route('admin.faqs.index') }}" class="menu-item {{ activeClassIfRoutes(['admin.faqs.index','admin.faqs.create','admin.faqs.edit',], 'active')  }}">{{ __('Questions')}}</a>
                                @endif
                            @endif
                            @if(getSetting('article_activation') == 1)
                                @if(auth()->user()->isAbleTo('view_blogs'))
                                <a href="{{route('admin.blogs.index')}}" class="menu-item {{ activeClassIfRoutes(['admin.blogs.index','admin.blogs.create','admin.blogs.edit','admin.blogs.show'], 'active')  }}">{{ __('Blogs')}}</a>
                                @endif
                            @endif
                            @if(getSetting('mail_sms_activation') == 1)
                                @if(auth()->user()->isAbleTo('view_mail_templates'))
                                <a href="{{route('admin.mail-sms-templates.index')}}" class="menu-item a-item {{ activeClassIfRoutes(['admin.mail-sms-templates.index','admin.mail-sms-templates.create','admin.mail-sms-templates.edit','admin.mail-sms-templates.show'], 'active')  }}">{{ __('Mail/Text Templates')}}</a>
                                @endif
                            @endif
                            @if(getSetting('category_management_activation') == 1)
                            @if(auth()->user()->isAbleTo('view_categories'))
                            <a href="{{route('admin.category-types.index')}}" class="menu-item a-item {{ activeClassIfRoutes(['admin.category-types.index','admin.category-types.create','admin.category-types.edit','admin.category.index','admin.category.create','admin.category.edit',], 'active')  }}">{{ __('Categories')}}</a>
                            @endif
                            @endif
                            @if(getSetting('slider_activation') == 1)
                                @if(auth()->user()->isAbleTo('view_sliders'))
                                    <a href="{{ route('admin.slider-types.index')}}" class="menu-item a-item {{ activeClassIfRoutes(['admin.slider-types.index','admin.slider-types.create','admin.slider-types.edit'], 'active')  }}" ><span>Slider Group</span></a>
                                @endif
                            @endif
                            @if(getSetting('paragraph_content_activation') == 1)
                                @if(auth()->user()->isAbleTo('view_paragraph_contents'))
                                    <a href="{{ route('admin.paragraph-contents.index')}}" class="menu-item {{ activeClassIfRoutes(['admin.paragraph-contents.index','admin.paragraph-contents.create','admin.paragraph-contents.edit',], 'active')  }}">{{ __('Paragraph Content')}}</a>
                                @endif
                            @endif
                            @if(getSetting('location_activation') == 1)
                            @if(auth()->user()->isAbleTo('view_locations'))
                            <a href="{{ route('admin.locations.country')}}" class="menu-item {{ activeClassIfRoutes(['admin.locations.country','admin.locations.country.create','admin.locations.state.create','admin.locations.city.create','admin.locations.city','admin.locations.state'], 'active')  }}">{{ __('Locations')}}</a>
                                @endif
                            @endif
                            @if(getSetting('subscription_plans_activation') == 1)
                                @if(auth()->user()->isAbleTo('view_subscription_plans'))
                                <a href="{{ route('admin.subscriptions.index')}}" class="menu-item {{ activeClassIfRoutes(['admin.subscriptions.index','admin.subscriptions.create','admin.subscriptions.edit'], 'active')  }}"><span>Subscription Plans</span></a>
                                @endif
                            @endif
                            @if(getSetting('seo_tags_activation') == 1)
                                @if(auth()->user()->isAbleTo('view_seo_tags')) 
                                    <a href="{{route('admin.seo-tags.index')}}" class="menu-item a-item {{ activeClassIfRoute('admin.seo-tags.index',  'active')  }}">{{ __('Control SEO')}}</a>   
                                @endif 
                            @endif 
                            @if(getSetting('pages_activation') == 1)
                                @if(auth()->user()->isAbleTo('view_pages'))
                                    <a href="{{route('admin.website-pages.index')}}" class="menu-item a-item {{ activeClassIfRoutes(['admin.website-pages.index','admin.website-pages.create','admin.website-pages.edit'], 'active')  }}">{{ __('Pages')}}</a>
                                @endif
                            @endif
                        </div>
                        <div class="nav-item {{ activeClassIfRoutes(['admin.users.index','admin.users.show', 'admin.users.create', 'admin.user_log.index','admin.roles.index','admin.permissions.index','admin.roles.edit','admin.users.edit'], 'active open') }} has-sub">
                            <a href="#"><i class="ik ik-users"></i><span>{{ __('Administrator')}}</span></a>
                            <div class="submenu-content">
                                <!-- only those have manage_user permission will get access -->
                                @foreach ($roles as $role)
                                    @if(getSetting('user_management_activation') == 1)
                                        <a href="{{route('admin.users.index')}}?role={{$role}}" class="menu-item a-item @if(request()->has('role') && request()->get('role') == $role) active @endif">{{ $role }} Management</a>
                                    @endif
                                @endforeach
                                @if(auth()->user()->isAbleTo('add_user'))
                                    @if(getSetting('add_user_activation') == 1)
                                    <a href="{{route('admin.users.create')}}" class="menu-item a-item {{ activeClassIfRoute('admin.users.create', 'active')  }}">{{ __('Add User')}}</a>
                                    @endif
                                @endif
                                <!-- only those have manage_role permission will get access -->
                                @if(getSetting('roles_and_permission_activation') == 1)
                                    @if(auth()->user()->isAbleTo('view_roles'))
                                        <a href="{{route('admin.roles.index')}}" class="menu-item a-item {{ activeClassIfRoute('admin.roles.index' ,'active')  }}">{{ __('Roles')}}</a>
                                    @endif
                                    <!-- only those have manage_permission permission will get access -->
                                    @if(auth()->user()->isAbleTo('view_permissions'))
                                        <a href="{{route('admin.permissions.index')}}" class="menu-item a-item {{ activeClassIfRoute('admin.permissions.index', 'active')  }}">{{ __('Permissions')}}</a>
                                    @endif
                                @endif
                            </div>
                        </div>
                        @if(getSetting('website_enquiry_activation') == 1 || getSetting('ticket_activation') == 1)
                            <div class="nav-item {{ activeClassIfRoutes(['admin.leads.index','admin.leads.create','admin.leads.edit','admin.leads.show','admin.website-enquiries.index','admin.website-enquiries.create','admin.website-enquiries.edit','admin.support-tickets.index','admin.support-tickets.show','admin.support-tickets.show','admin.news-letters.index', 'admin.news-letters.create','admin.news-letters.edit'], 'active open')  }} has-sub">
                                    <a href="#"><i class="ik ik-mail"></i><span>{{ __('Contacts / Enquiry')}}</span></a>
                                    <div class="submenu-content">
                                        @if(getSetting('website_enquiry_activation') == 1)
                                            @if(auth()->user()->isAbleTo('view_enquiries'))
                                                <a href="{{route('admin.website-enquiries.index')}}" class="menu-item a-item {{ activeClassIfRoutes(['admin.website-enquiries.index', 'admin.website-enquiries.create','admin.website-enquiries.edit'], 'active')  }}">{{ __('Website Enquiry')}}</a>
                                            @endif
                                        @endif
                                        @if(getSetting('ticket_activation') == 1)
                                            @if(auth()->user()->isAbleTo('view_tickets'))
                                                <a href="{{route('admin.support-tickets.index')}}" class="menu-item a-item {{ activeClassIfRoutes(['admin.support-tickets.index', 'admin.support-tickets.show'], 'active')  }}">{{ __('Support Tickets')}}</a>
                                            @endif
                                        @endif
                                            @if(getSetting('newsletter_activation') == 1)
                                            @if(auth()->user()->isAbleTo('view_newletters'))
                                                <a href="{{ route('admin.news-letters.index')}}" class="menu-item a-item {{ activeClassIfRoutes(['admin.news-letters.index', 'admin.news-letters.create','admin.news-letters.edit'], 'active')  }}">{{ __('Newsletter')}}</a>
                                            @endif
                                        @endif
                                        @if(getSetting('lead_activation') == 1)
                                            @if(auth()->user()->isAbleTo('view_leads'))
                                                <a href="{{route('admin.leads.index')}}" class="menu-item a-item {{ activeClassIfRoutes(['admin.leads.index', 'admin.leads.create','admin.leads.edit','admin.leads.show'], 'active')  }}">{{ __('Leads')}}</a>
                                            @endif
                                        @endif
                                    </div>
                            </div>
                        @endif 
                    </div>
                        <div class="nav-item {{ activeClassIfRoutes(['admin.setting.index','admin.social-login','admin.website-pages.social-login','admin.general.index','admin.setting.payment','admin.mail-sms-configuration.index','admin.setting.payment','admin.setting.features-activation'], 'active open')  }} has-sub">
                            <a href="#"><i class="ik ik-settings"></i><span>{{ __('Setup & Configurations')}}</span></a>
                            <div class="submenu-content">
                                
                                @if(getSetting('basic_details_activation') == 1)
                                @if(auth()->user()->isAbleTo('control_basic_details'))
                                <a href="{{route('admin.setting.index')}}" class="menu-item a-item {{ activeClassIfRoute('admin.setting.index', 'active')  }}">{{ __('Basic Details')}}</a>
                                @endif
                                @endif
                
                                @if(getSetting('manage_general_configuration_activation') == 1)
                                    @if(auth()->user()->isAbleTo('access_general_setting') || auth()->user()->isAbleTo('access_currency_setting') || auth()->user()->isAbleTo('access_date_time_setting') || auth()->user()->isAbleTo('access_notification_setting') || auth()->user()->isAbleTo('access_troubleshoot_setting'))
                                    <a href="{{route('admin.general.index')}}" class="menu-item a-item {{ activeClassIfRoute('admin.general.index', 'active')  }}">{{ __('General Configuration')}}</a>
                                    @endif
                                @endif
                                @if(getSetting('mail_sms_configuration_activation') == 1)
                                    @if(auth()->user()->isAbleTo('access_email_setting') || auth()->user()->isAbleTo('access_sms_setting') || auth()->user()->isAbleTo('access_fcm_setting'))
                                        <a href="{{route('admin.mail-sms-configuration.index')}}" class="menu-item a-item {{ activeClassIfRoute('admin.mail-sms-configuration.index', 'active')  }}">{{ __('Mail/SMS Configuration')}}</a>
                                    @endif
                                @endif
                               
                                {{-- @if(auth()->user()->isAbleTo('features_activation') && env('DEV_MODE') == 1) --}}
                                    <a href="{{route('admin.setting.features-activation')}}" class="menu-item a-item {{ activeClassIfRoute('admin.setting.features-activation', 'active')  }}">{{ __('Features Activation')}}</a>
                                {{-- @endif --}}
                            </div>
                        </div>
                
                @if(env('DEV_MODE') == 1)
                    <div class="nav-item {{ ($segment2 == 'crudgen') ? 'active' : '' }}">
                        <a href="{{route('crudgen.index')}}" class="a-item" ><i class="ik ik-grid"></i><span>{{ __('Crudgen')}}</span></a>
                    </div>
                @endif 
                
                 @include('admin.include.crud_sidebar')
            </nav>
        </div>
    </div>
</div>