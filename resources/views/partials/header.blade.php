<header id="m_header" class="m-grid__item m-header" m-minimize="minimize" m-minimize-mobile="minimize" m-minimize-offset="10" m-minimize-mobile-offset="10">
    <div class="m-header__top">
        <div class="m-container m-container--fluid m-container--full-height m-page__container">
            <div class="m-stack m-stack--ver m-stack--desktop">
                <!-- begin::Brand -->
                <div class="m-stack__item m-brand m-stack__item--left">
                    <div class="m-stack m-stack--ver m-stack--general m-stack--inline">
                        <div class="m-stack__item m-stack__item--middle m-brand__logo">
                            <a href="/" class="m-brand__logo-wrapper">
                                <img alt="" src="{{asset('assets/demo/demo8/media/img/logo/logo.png')}}" class="m-brand__logo-default"/>
                                <img alt="" src="{{asset('assets/demo/demo8/media/img/logo/logo_inverse.png')}}" class="m-brand__logo-inverse"/>
                            </a>
                        </div>
                        <div class="m-stack__item m-stack__item--middle m-brand__tools">
                            <!-- begin::Responsive Header Menu Toggler-->
                            <a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
                                <span></span>
                            </a>
                            <!-- end::Responsive Header Menu Toggler-->
                            <!-- begin::Topbar Toggler-->
                            <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                                <i class="flaticon-more"></i>
                            </a>
                            <!--end::Topbar Toggler-->
                        </div>
                    </div>
                </div>
                <!-- end::Brand -->
                <!--begin::Search-->
                <div class="m-stack__item m-stack__item--middle m-dropdown m-dropdown--arrow m-dropdown--large m-dropdown--mobile-full-width m-dropdown--align-right m-dropdown--skin-light m-header-search m-header-search--expandable- m-header-search--skin-" id="m_quicksearch" m-quicksearch-mode="default">
                    <!--begin::Search Form -->
                    <form class="m-header-search__form">
                        <div class="m-header-search__wrapper">
										<span class="m-header-search__icon-search" id="m_quicksearch_search">
											<i class="la la-search"></i>
										</span>
                            <span class="m-header-search__input-wrapper">
											<input autocomplete="off" type="text" name="q" class="m-header-search__input" value="" placeholder="Search..." id="m_quicksearch_input">
										</span>
                            <span class="m-header-search__icon-close" id="m_quicksearch_close">
											<i class="la la-remove"></i>
										</span>
                            <span class="m-header-search__icon-cancel" id="m_quicksearch_cancel">
											<i class="la la-remove"></i>
										</span>
                        </div>
                    </form>
                    <!--end::Search Form -->
                    <!--begin::Search Results -->
                    <div class="m-dropdown__wrapper">
                        <div class="m-dropdown__arrow m-dropdown__arrow--center"></div>
                        <div class="m-dropdown__inner">
                            <div class="m-dropdown__body">
                                <div class="m-dropdown__scrollable m-scrollable" data-scrollable="true" data-height="300" data-mobile-height="200">
                                    <div class="m-dropdown__content m-list-search m-list-search--skin-light"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Search Results -->
                </div>
                <!--end::Search-->
                <!-- begin::Top bar -->
                <div class="m-stack__item m-stack__item--right m-header-head" id="m_header_nav">
                    <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
                        <div class="m-stack__item m-topbar__nav-wrapper">
                            <ul class="m-topbar__nav m-nav m-nav--inline">
                                <li class="m-nav__item m-topbar__user-profile  m-dropdown m-dropdown--medium m-dropdown--arrow  m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light"
                                    m-dropdown-toggle="click">
                                    <a href="" class="m-nav__link m-dropdown__toggle">
                      <span class="m-topbar__userpic">
														<img src="" class="m--img-rounded m--marginless m--img-centered" alt=""/>
													</span>
                                        <span class="m-nav__link-icon m-topbar__usericon  m--hide">
														<span class="m-nav__link-icon-wrapper">
															<i class="flaticon-user-ok"></i>
														</span>
                      </span>
                                        <span class="m-topbar__username m--hide">
														Nick
													</span>
                                    </a>
                                    <div class="m-dropdown__wrapper">
                                        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                        <div class="m-dropdown__inner">
                                            <div class="m-dropdown__header m--align-center">
                                                <div class="m-card-user m-card-user--skin-light">
                                                    <div class="m-card-user__pic">
                                                        <img src="" class="m--img-rounded m--marginless" alt="" />
                                                    </div>
                                                    <div class="m-card-user__details">
                              <span class="m-card-user__name m--font-weight-500">
																		Mark Andre
																	</span>
                                                        <a href="" class="m-card-user__email m--font-weight-300 m-link">
                                                            mark.andre@gmail.com
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="m-dropdown__body">
                                                <div class="m-dropdown__content">
                                                    <ul class="m-nav m-nav--skin-light">
                                                        <li class="m-nav__section m--hide">
                                <span class="m-nav__section-text">
																			Section
																		</span>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="{{route('profile',['id'=>auth()->user()])}}" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-profile-1"></i>
                                                                <span class="m-nav__link-title">
																				<span class="m-nav__link-wrap">
																					<span class="m-nav__link-text">
																						My Profile
																					</span>
                                  <span class="m-nav__link-badge">
																						<span class="m-badge m-badge--success">
																							2
																						</span>
                                  </span>
                                  </span>
                                  </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="{{route('career',['id'=>auth()->user()])}}" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-share"></i>
                                                                <span class="m-nav__link-text">
																				Personal career
																			</span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                                <span class="m-nav__link-text">
																				Messages
																			</span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__separator m-nav__separator--fit"></li>
                                                        <li class="m-nav__item">
                                                            <a href="profile.html" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-info"></i>
                                                                <span class="m-nav__link-text">
																				FAQ
																			</span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="profile.html" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                                                <span class="m-nav__link-text">
																				Support
																			</span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__separator m-nav__separator--fit"></li>
                                                        <li class="m-nav__item">
                                                            <a href="https://login.microsoftonline.com/logout.srf" class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">
                                                                Logout
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li id="m_quick_sidebar_toggle" class="m-nav__item m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light"
                                    m-dropdown-toggle="click">
                                    <a href="#" class="m-nav__link m-dropdown__toggle">
                        <span class="m-nav__link-icon m-nav__link-icon-alt">
														<span class="m-nav__link-icon-wrapper">
															<i class="flaticon-grid-menu"></i>
														</span>
                        </span>
                                    </a>
                                    <div class="m-dropdown__wrapper">
                                        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                        <div class="m-dropdown__inner">
                                            <div class="m-dropdown__body">
                                                <div class="m-dropdown__content">
                                                    <ul class="m-nav m-nav--icons">
                                                        <li class="m-nav__item">
                                                            <a href="{{route('career',['id'=>auth()->user()])}}" class="m-nav__link">
                                                                <i class="m-nav__link-icon la la-dashboard"></i>
                                                                <span class="m-nav__link-text">
																				Statistics
																			</span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="profile.html" class="m-nav__link">
                                                                <i class="m-nav__link-icon la la-users"></i>
                                                                <span class="m-nav__link-text">
																				Team builder
																			</span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="profile.html" class="m-nav__link">
                                                                <i class="m-nav__link-icon la la-tasks"></i>
                                                                <span class="m-nav__link-text">
																				Strengths
																			</span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="profile.html" class="m-nav__link">
                                                                <i class="m-nav__link-icon la la-map"></i>
                                                                <span class="m-nav__link-text">
																				Lorem
																			</span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="profile.html" class="m-nav__link">
                                                                <i class="m-nav__link-icon la la-map"></i>
                                                                <span class="m-nav__link-text">
																				Lorem
																			</span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="profile.html" class="m-nav__link">
                                                                <i class="m-nav__link-icon la la-map"></i>
                                                                <span class="m-nav__link-text">
																				Lorem
																			</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- end::Topbar -->
            </div>
        </div>
    </div>
    <div class="m-header__bottom">

        <div class="m-container m-container--fluid m-container--full-height m-page__container">
            <div class="m-stack m-stack--ver m-stack--desktop">
                <div class="m-stack__item m-stack__item--fluid m-header-menu-wrapper">
                    <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-light " id="m_aside_header_menu_mobile_close_btn">
                        <i class="la la-close"></i>
                    </button>
                    <div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-dark m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-light m-aside-header-menu-mobile--submenu-skin-light ">
                        <ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
                            <li class="m-menu__item m-menu__item--submenu m-menu__item--tabs m-menu__item--open-dropdown m-menu__item--hover" m-menu-submenu-toggle="tab" aria-haspopup="true">

                                <a href="/" class="m-menu__link m-menu__toggle">
												<span class="m-menu__link-text">
													Dashboard
												</span>
                                    <i class="m-menu__hor-arrow la la-angle-down"></i>
                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                </a>
                                <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
                                    <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                    <ul class="m-menu__subnav">
                                        <li class="m-menu__item " aria-haspopup="true">
                                            <a href="{{route('profile',['id' => auth()->user()])}}" class="m-menu__link ">
                                                <i class="m-menu__link-icon flaticon-file"></i>
                                                <span class="m-menu__link-text">My Profile</span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item " aria-haspopup="true">
                                            <a href="{{route('career',['id' => auth()->user()])}}" class="m-menu__link ">
                                                <i class="m-menu__link-icon flaticon-file"></i>
                                                <span class="m-menu__link-text">Development</span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item " aria-haspopup="true">
                                            <a href="{{route('departmentStrengths')}}" class="m-menu__link ">
                                                <i class="m-menu__link-icon flaticon-file"></i>
                                                <span class="m-menu__link-text">Departments strengths</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            @hasanyrole('Admin')
                            <li class="m-menu__item m-menu__item--submenu m-menu__item--tabs m-menu__item--open-dropdown"
                                m-menu-submenu-toggle="tab"
                                aria-haspopup="true"><a href="javascript:;" class="m-menu__link m-menu__toggle"
                                                        title="Non functional dummy link"><span
                                            class="m-menu__link-text">Admin</span><i
                                            class="m-menu__hor-arrow la la-angle-down"></i><i
                                            class="m-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
                                    <span class="m-menu__arrow m-menu__arrow--adjust" style="left: 54.5px;"></span>
                                    <ul class="m-menu__subnav">
                                        <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a
                                                    href="{{route('addCareer')}}" class="m-menu__link "><i
                                                        class="m-menu__link-icon flaticon-graphic-2"></i><span
                                                        class="m-menu__link-text">Add Career template</span></a></li>
                                        <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a
                                                    href="{{route('adminDepartmentView')}}" class="m-menu__link "><i
                                                        class="m-menu__link-icon flaticon-analytics"></i><span
                                                        class="m-menu__link-text">Department List</span></a></li>

                                        <li
                                                class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a
                                                    href="{{route('returnView')}}" class="m-menu__link "><i
                                                        class="m-menu__link-icon flaticon-clipboard"></i><span
                                                        class="m-menu__link-text">Add moderator to team</span></a></li>
                                        <li
                                                class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a
                                                    href="{{route('returnCategoryStrengthView')}}" class="m-menu__link "><i
                                                        class="m-menu__link-icon flaticon-alarm-1"></i><span
                                                        class="m-menu__link-text">Strength & Category</span></a></li>
                                        <li
                                                class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a
                                                    href="{{route('returnAdminUserList')}}" class="m-menu__link "><i
                                                        class="m-menu__link-icon flaticon-alarm-1"></i><span
                                                        class="m-menu__link-text">User list</span></a></li>
                                        <li
                                                class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a
                                                    href="{{route('viewAdminTeam')}}" class="m-menu__link "><i
                                                        class="m-menu__link-icon flaticon-alarm-1"></i><span
                                                        class="m-menu__link-text">Team List</span></a></li>

                                    </ul>
                                </div>
                            </li>
                            @endhasanyrole
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
</header>