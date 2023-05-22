@extends('layouts.admin')
@section('content')
<main class="page-content">
    <div class="container">
        <div class="widgets">
            <div class="widgets__row row gutter-bottom-xl">
                <div class="col-12 col-md-6 col-xl-4 d-flex">
                    <div class="widget">
                        <div class="widget__wrapper">
                            <div class="widget__row">
                                <div class="widget__left">
                                    <h3 class="widget__title">Visits</h3>
                                    <div class="widget__status-title text-grey">Total visits today</div>
                                    <div class="widget__trade"><span class="widget__trade-count">4000</span><span class="trade-icon trade-icon--up">
                    <svg class="icon-icon-trade-up">
                        <use xlink:href="#icon-trade-up"></use>
                    </svg></span><span class="badge badge--sm badge--green">7%</span>
                                    </div>
                                    <div class="widget__details"><a class="link-under text-grey" href="#">Detail</a>
                                    </div>
                                </div>
                                <div class="widget__chart">
                                    <div class="widget__chart-inner">
                                        <div class="widget__chart-percentage">50<small>%</small>
                                        </div>
                                        <div class="widget__chart-caption">New Visits</div>
                                    </div>
                                    <div class="widget__chart-canvas js-progress-circle" data-value="0.5" data-color="#22CCE2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4 d-flex">
                    <div class="widget">
                        <div class="widget__wrapper">
                            <div class="widget__row">
                                <div class="widget__left">
                                    <h3 class="widget__title">Orders</h3>
                                    <div class="widget__status-title text-grey">Total visits today</div>
                                    <div class="widget__trade"><span class="widget__trade-count">1000</span><span class="trade-icon trade-icon--down">
                    <svg class="icon-icon-trade-down">
                        <use xlink:href="#icon-trade-down"></use>
                    </svg></span><span class="badge badge--sm badge--red">3%</span>
                                    </div>
                                    <div class="widget__details"><a class="link-under text-grey" href="#">Detail</a>
                                    </div>
                                </div>
                                <div class="widget__chart">
                                    <div class="widget__chart-inner">
                                        <div class="widget__chart-percentage">75<small>%</small>
                                        </div>
                                        <div class="widget__chart-caption">New Orders</div>
                                    </div>
                                    <div class="widget__chart-canvas js-progress-circle" data-value="0.75" data-color="#FDBF5E"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4 d-flex">
                    <div class="widget">
                        <div class="widget__wrapper">
                            <div class="widget__row">
                                <div class="widget__left">
                                    <h3 class="widget__title">Sales</h3>
                                    <div class="widget__status-title text-grey">Total visits today</div>
                                    <div class="widget__trade"><span class="widget__trade-count">$500</span><span class="trade-icon trade-icon--up">
                    <svg class="icon-icon-trade-up">
                        <use xlink:href="#icon-trade-up"></use>
                    </svg></span><span class="badge badge--sm badge--green">9%</span>
                                    </div>
                                    <div class="widget__details"><a class="link-under text-grey" href="#">Detail</a>
                                    </div>
                                </div>
                                <div class="widget__chart">
                                    <div class="widget__chart-inner">
                                        <div class="widget__chart-percentage">80<small>%</small>
                                        </div>
                                        <div class="widget__chart-caption">New Sales</div>
                                    </div>
                                    <div class="widget__chart-canvas js-progress-circle" data-value="0.8" data-color="#FF3D57"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="section__title d-none">
                <h2>Section</h2>
            </div>
            <div class="row justify-content-center gutter-bottom-xl">
                <div class="col-12 col-lg-7 col-xl-8 d-flex">
                    <div class="card">
                        <div class="card__wrapper">
                            <div class="card__container">
                                <div class="card__header">
                                    <div class="card__header-left">
                                        <h3 class="card__header-title">Revenue</h3>
                                    </div>
                                    <div class="card__tools">
                                        <div class="card__tools-row row row--xs gutter-bottom-xs">
                                            <div class="card__tools-calendar col-auto">
                                                <div class="input-group input-group--prepend input-group--append">
                                                    <div class="input-group__prepend">
                                                        <svg class="icon-icon-calendar">
                                                            <use xlink:href="#icon-calendar"></use>
                                                        </svg>
                                                    </div>
                                                    <input class="input input--select" type="text" value="01.12.18 / 07.12.18" readonly="readonly" /><span class="input-group__arrow">
                            <svg class="icon-icon-keyboard-down">
                            <use xlink:href="#icon-keyboard-down"></use>
                            </svg></span>
                                                </div>
                                            </div>
                                            <div class="card__tools-week col">
                                                <div class="input-group input-group--append">
                                                    <input class="input input--select" type="text" value="Week" data-toggle="dropdown" readonly="readonly" /><span class="input-group__arrow">
                            <svg class="icon-icon-keyboard-down">
                            <use xlink:href="#icon-keyboard-down"></use>
                            </svg></span>
                                                    <div class="dropdown-menu dropdown-menu--right dropdown-menu--fluid js-dropdown-select"><a class="dropdown-menu__item active" href="#" tabindex="0" data-value="Week">Week</a><a class="dropdown-menu__item" href="#" tabindex="0" data-value="Month">Month</a><a class="dropdown-menu__item"
                                                        href="#" tabindex="0" data-value="Quarter">Quarter</a><a class="dropdown-menu__item" href="#" tabindex="0" data-value="Year">Year</a><a class="dropdown-menu__item" href="#" tabindex="0" data-value="All Time">All Time</a>
                                                        <a
                                                        class="dropdown-menu__item" href="#" tabindex="0" data-value="Custom">Custom</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card__tools-more">
                                        <button class="items-more__button">
                                            <svg class="icon-icon-more">
                                                <use xlink:href="#icon-more"></use>
                                            </svg>
                                        </button>
                                        <div class="dropdown-items">
                                            <div class="dropdown-items__container">
                                                <ul class="dropdown-items__list">
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-refresh">
                                <use xlink:href="#icon-refresh"></use>
                                </svg></span>Refresh</a>
                                                    </li>
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-settings">
                                <use xlink:href="#icon-settings"></use>
                                </svg></span>Settings</a>
                                                    </li>
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-download">
                                <use xlink:href="#icon-download"></use>
                                </svg></span>Download</a>
                                                    </li>
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-action">
                                <use xlink:href="#icon-action"></use>
                                </svg></span>Action</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card__body">
                                    <div class="card__widgets">
                                        <div class="card__widgets-row gutter-bottom-sm">
                                            <div class="card-widget">
                                                <h4 class="card-widget__title">Current week</h4>
                                                <div class="card-widget__trade"><span class="card-widget__count text-red">$180</span><span class="trade-icon trade-icon--up">
                            <svg class="icon-icon-trade-up">
                            <use xlink:href="#icon-trade-up"></use>
                            </svg></span><span class="badge badge--green badge--sm">5%</span>
                                                </div>
                                            </div>
                                            <div class="card-widget">
                                                <h4 class="card-widget__title">Previous week</h4>
                                                <div class="card-widget__trade"><span class="card-widget__count text-grey">$52.30</span><span class="trade-icon trade-icon--down">
                            <svg class="icon-icon-trade-down">
                            <use xlink:href="#icon-trade-down"></use>
                            </svg></span><span class="badge badge--red badge--sm">2%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card__chart">
                                        <div class="card__container card__container--gutter-sm">
                                            <div class="card__chart-item chart-revenue" id="revenueChart" data-series="[[0, 10, 48, 9, 9, 53, 12], [0, 45, 9, 49, 53, 180, 70]]"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-5 col-xl-4 d-flex">
                    <div class="card">
                        <div class="card__wrapper">
                            <div class="card__container">
                                <div class="card__header mb-0">
                                    <div class="card__header-left">
                                        <h3 class="card__header-title">Profit</h3>
                                    </div>
                                    <div class="card__tools-more">
                                        <button class="items-more__button">
                                            <svg class="icon-icon-more">
                                                <use xlink:href="#icon-more"></use>
                                            </svg>
                                        </button>
                                        <div class="dropdown-items">
                                            <div class="dropdown-items__container">
                                                <ul class="dropdown-items__list">
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-refresh">
                                <use xlink:href="#icon-refresh"></use>
                                </svg></span>Refresh</a>
                                                    </li>
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-settings">
                                <use xlink:href="#icon-settings"></use>
                                </svg></span>Settings</a>
                                                    </li>
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-download">
                                <use xlink:href="#icon-download"></use>
                                </svg></span>Download</a>
                                                    </li>
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-action">
                                <use xlink:href="#icon-action"></use>
                                </svg></span>Action</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card__body">
                                    <div class="card__chart">
                                        <div class="card__chart-item chart-profit" id="profitPieChart" data-series="[200, 120, 180]"></div>
                                    </div>
                                </div>
                                <div class="card__footer">
                                    <div class="card__container">
                                        <table class="card__stat">
                                            <tbody>
                                                <tr>
                                                    <td><span class="signal" style="color: #FF3D57;"></span><span>Current</span>
                                                    </td>
                                                    <td><span>$500</span><span class="quotation quotation--up">
                            <svg class="icon-icon-arrow-down">
                                <use xlink:href="#icon-arrow-down"></use>
                            </svg></span>
                                                    </td>
                                                    <td><span class="text-grey">37%</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><span class="signal" style="color: #FDBF5E;"></span><span>Lost</span>
                                                    </td>
                                                    <td><span>$450</span><span class="quotation quotation--down">
                            <svg class="icon-icon-arrow-down">
                                <use xlink:href="#icon-arrow-down"></use>
                            </svg></span>
                                                    </td>
                                                    <td><span class="text-grey">35%</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><span class="signal" style="color: #22CCE2;"></span><span>Target</span>
                                                    </td>
                                                    <td><span>$300</span><span class="quotation quotation--down">
                            <svg class="icon-icon-arrow-down">
                                <use xlink:href="#icon-arrow-down"></use>
                            </svg></span>
                                                    </td>
                                                    <td><span class="text-grey">28%</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="section__title d-none">
                <h2>Section</h2>
            </div>
            <div class="row justify-content-center gutter-bottom-xl">
                <div class="col-12 col-lg-7 col-xl-8 d-flex">
                    <div class="card">
                        <div class="card__wrapper">
                            <div class="card__container">
                                <div class="card__header">
                                    <div class="card__header-left">
                                        <h3 class="card__header-title">Activity</h3>
                                    </div>
                                    <div class="card__tools">
                                        <div class="card__tools-row row row--xs gutter-bottom-xs">
                                            <div class="card__tools-calendar col-auto">
                                                <div class="input-group input-group--prepend input-group--append">
                                                    <div class="input-group__prepend">
                                                        <svg class="icon-icon-calendar">
                                                            <use xlink:href="#icon-calendar"></use>
                                                        </svg>
                                                    </div>
                                                    <input class="input input--select" type="text" value="01.12.18 / 07.12.18" readonly="readonly" /><span class="input-group__arrow">
                            <svg class="icon-icon-keyboard-down">
                            <use xlink:href="#icon-keyboard-down"></use>
                            </svg></span>
                                                </div>
                                            </div>
                                            <div class="card__tools-week col">
                                                <div class="input-group input-group--append">
                                                    <input class="input input--select" type="text" value="Week" data-toggle="dropdown" readonly="readonly" /><span class="input-group__arrow">
                            <svg class="icon-icon-keyboard-down">
                            <use xlink:href="#icon-keyboard-down"></use>
                            </svg></span>
                                                    <div class="dropdown-menu dropdown-menu--right dropdown-menu--fluid js-dropdown-select"><a class="dropdown-menu__item active" href="#" tabindex="0" data-value="Week">Week</a><a class="dropdown-menu__item" href="#" tabindex="0" data-value="Month">Month</a><a class="dropdown-menu__item"
                                                        href="#" tabindex="0" data-value="Quarter">Quarter</a><a class="dropdown-menu__item" href="#" tabindex="0" data-value="Year">Year</a><a class="dropdown-menu__item" href="#" tabindex="0" data-value="All Time">All Time</a>
                                                        <a
                                                        class="dropdown-menu__item" href="#" tabindex="0" data-value="Custom">Custom</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card__tools-more">
                                        <button class="items-more__button">
                                            <svg class="icon-icon-more">
                                                <use xlink:href="#icon-more"></use>
                                            </svg>
                                        </button>
                                        <div class="dropdown-items">
                                            <div class="dropdown-items__container">
                                                <ul class="dropdown-items__list">
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-refresh">
                                <use xlink:href="#icon-refresh"></use>
                                </svg></span>Refresh</a>
                                                    </li>
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-settings">
                                <use xlink:href="#icon-settings"></use>
                                </svg></span>Settings</a>
                                                    </li>
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-download">
                                <use xlink:href="#icon-download"></use>
                                </svg></span>Download</a>
                                                    </li>
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-action">
                                <use xlink:href="#icon-action"></use>
                                </svg></span>Action</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card__body">
                                    <div class="card__chart">
                                        <div class="card__container">
                                            <div class="card__chart-item chart-activity" id="activityChart" data-series="[[&quot;Mon&quot;, &quot;Tue&quot;, &quot;Wed&quot;, &quot;Thu&quot;, &quot;Fri&quot;, &quot;Sat&quot;, &quot;Sun&quot;], [170, 120, 200, 270, 220, 290, 320], [120, 90, 100, 240, 120, 200, 250]]"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-5 col-xl-4 d-flex">
                    <div class="card">
                        <div class="card__wrapper">
                            <div class="card__container">
                                <div class="card__header mb-0">
                                    <div class="card__header-left">
                                        <h3 class="card__header-title">Tasks</h3>
                                    </div>
                                    <div class="card__tools-more">
                                        <button class="items-more__button">
                                            <svg class="icon-icon-more">
                                                <use xlink:href="#icon-more"></use>
                                            </svg>
                                        </button>
                                        <div class="dropdown-items">
                                            <div class="dropdown-items__container">
                                                <ul class="dropdown-items__list">
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-refresh">
                                <use xlink:href="#icon-refresh"></use>
                                </svg></span>Refresh</a>
                                                    </li>
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-settings">
                                <use xlink:href="#icon-settings"></use>
                                </svg></span>Settings</a>
                                                    </li>
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-download">
                                <use xlink:href="#icon-download"></use>
                                </svg></span>Download</a>
                                                    </li>
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-action">
                                <use xlink:href="#icon-action"></use>
                                </svg></span>Action</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card__body">
                                    <div class="card__chart">
                                        <div class="card__chart-item chart-task" id="taskPieChart" data-series="[75, 25, 80]"></div>
                                    </div>
                                    <div class="card__chart-progress">
                                        <div class="card__chart-progress-item">
                                            <div class="card__progressbar">
                                                <div class="progressbar">
                                                    <div class="progressbar__legend"><span class="progressbar__legend-marker" style="color: #FF3D57"></span><span>Complete</span>
                                                    </div>
                                                    <div class="progressbar__items">
                                                        <div class="progressbar__bar" style="width: 75%; background-color: #FF3D57;"></div>
                                                    </div>
                                                    <div class="progressbar__append"><span class="progressbar__percentage">75%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card__chart-progress-item">
                                            <div class="card__progressbar">
                                                <div class="progressbar">
                                                    <div class="progressbar__legend"><span class="progressbar__legend-marker" style="color: #FDBF5E"></span><span>In Progress</span>
                                                    </div>
                                                    <div class="progressbar__items">
                                                        <div class="progressbar__bar" style="width: 25%; background-color: #FDBF5E;"></div>
                                                    </div>
                                                    <div class="progressbar__append"><span class="progressbar__percentage">25%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card__chart-progress-item">
                                            <div class="card__progressbar">
                                                <div class="progressbar">
                                                    <div class="progressbar__legend"><span class="progressbar__legend-marker" style="color: #22CCE2"></span><span>Started</span>
                                                    </div>
                                                    <div class="progressbar__items">
                                                        <div class="progressbar__bar" style="width: 80%; background-color: #22CCE2;"></div>
                                                    </div>
                                                    <div class="progressbar__append"><span class="progressbar__percentage">80%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="section__title d-none">
                <h2>Section</h2>
            </div>
            <div class="row justify-content-center gutter-bottom-xl">
                <div class="col-12 col-lg-7 col-xl-8 d-flex">
                    <div class="card card--overview">
                        <div class="card__wrapper">
                            <div class="card__container">
                                <div class="card__header">
                                    <div class="card__header-left">
                                        <h3 class="card__header-title">Overview</h3>
                                    </div>
                                    <div class="card__tools">
                                        <div class="card__tools-row row row--xs gutter-bottom-xs">
                                            <div class="card__tools-switcher col">
                                                <div class="switcher-button">
                                                    <div class="switcher-button__items">
                                                        <div class="switcher-button__float"></div>
                                                        <div class="switcher-button__item active">
                                                            <button class="switcher-button__btn">Weekly</button>
                                                        </div>
                                                        <div class="switcher-button__item">
                                                            <button class="switcher-button__btn">Monthly</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card__tools-more">
                                        <button class="items-more__button">
                                            <svg class="icon-icon-more">
                                                <use xlink:href="#icon-more"></use>
                                            </svg>
                                        </button>
                                        <div class="dropdown-items">
                                            <div class="dropdown-items__container">
                                                <ul class="dropdown-items__list">
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-refresh">
                                <use xlink:href="#icon-refresh"></use>
                                </svg></span>Refresh</a>
                                                    </li>
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-settings">
                                <use xlink:href="#icon-settings"></use>
                                </svg></span>Settings</a>
                                                    </li>
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-download">
                                <use xlink:href="#icon-download"></use>
                                </svg></span>Download</a>
                                                    </li>
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-action">
                                <use xlink:href="#icon-action"></use>
                                </svg></span>Action</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card__body">
                                    <div class="card__widgets">
                                        <div class="card__widgets-row gutter-bottom-sm">
                                            <div class="card-widget card-widget--sm">
                                                <h4 class="card-widget__title">Views</h4>
                                                <div class="card-widget__trade"><span class="card-widget__count">9,000</span><span class="trade-icon trade-icon--up">
                            <svg class="icon-icon-trade-up">
                            <use xlink:href="#icon-trade-up"></use>
                            </svg></span><span class="badge badge--green badge--sm">5%</span>
                                                </div>
                                            </div>
                                            <div class="card-widget card-widget--sm">
                                                <h4 class="card-widget__title">Visits</h4>
                                                <div class="card-widget__trade"><span class="card-widget__count">15,000</span><span class="trade-icon trade-icon--down">
                            <svg class="icon-icon-trade-down">
                            <use xlink:href="#icon-trade-down"></use>
                            </svg></span><span class="badge badge--red badge--sm">5%</span>
                                                </div>
                                            </div>
                                            <div class="card-widget card-widget--sm">
                                                <h4 class="card-widget__title">Orders</h4>
                                                <div class="card-widget__trade"><span class="card-widget__count">18,000</span><span class="trade-icon trade-icon--up">
                            <svg class="icon-icon-trade-up">
                            <use xlink:href="#icon-trade-up"></use>
                            </svg></span><span class="badge badge--green badge--sm">5%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card__chart">
                                        <div class="card__container card__container--gutter-sm">
                                            <div class="card__chart-item chart-overview" id="overviewLineChart" data-series="[20, 60, 30, 50, 120, 90, 200]"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-5 col-xl-4 d-flex">
                    <div class="card">
                        <div class="card__wrapper">
                            <div class="card__container">
                                <div class="card__header">
                                    <div class="card__header-left">
                                        <h3 class="card__header-title">Statistics</h3>
                                    </div>
                                    <div class="card__tools-more">
                                        <button class="items-more__button">
                                            <svg class="icon-icon-more">
                                                <use xlink:href="#icon-more"></use>
                                            </svg>
                                        </button>
                                        <div class="dropdown-items">
                                            <div class="dropdown-items__container">
                                                <ul class="dropdown-items__list">
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-refresh">
                                <use xlink:href="#icon-refresh"></use>
                                </svg></span>Refresh</a>
                                                    </li>
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-settings">
                                <use xlink:href="#icon-settings"></use>
                                </svg></span>Settings</a>
                                                    </li>
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-download">
                                <use xlink:href="#icon-download"></use>
                                </svg></span>Download</a>
                                                    </li>
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-action">
                                <use xlink:href="#icon-action"></use>
                                </svg></span>Action</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card__body">
                                    <div class="card__chart">
                                        <div class="card__container">
                                            <div class="card__chart-item chart-statistics" id="statisticsBarChart" data-series="[[&quot;Mon&quot;, &quot;Tue&quot;, &quot;Wed&quot;, &quot;Thu&quot;, &quot;Fri&quot;, &quot;Sat&quot;, &quot;Sun&quot;],[23000, 62000, 79000, 86000, 90500, 39500, 64000],[42000, 49000, 39000, 100000, 67000, 59000, 45000]]"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="section__title d-none">
                <h2>Section</h2>
            </div>
            <div class="row gutter-bottom-xl">
                <div class="col-12 col-md-6 col-lg-7 col-xl-4 d-flex">
                    <div class="card">
                        <div class="card__wrapper">
                            <div class="card__container">
                                <div class="card__header">
                                    <div class="card__header-left">
                                        <h3 class="card__header-title">Credit Card</h3>
                                    </div>
                                    <div class="card__tools-more">
                                        <button class="items-more__button">
                                            <svg class="icon-icon-more">
                                                <use xlink:href="#icon-more"></use>
                                            </svg>
                                        </button>
                                        <div class="dropdown-items">
                                            <div class="dropdown-items__container">
                                                <ul class="dropdown-items__list">
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-refresh">
                                <use xlink:href="#icon-refresh"></use>
                                </svg></span>Refresh</a>
                                                    </li>
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-settings">
                                <use xlink:href="#icon-settings"></use>
                                </svg></span>Settings</a>
                                                    </li>
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-download">
                                <use xlink:href="#icon-download"></use>
                                </svg></span>Download</a>
                                                    </li>
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-action">
                                <use xlink:href="#icon-action"></use>
                                </svg></span>Action</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card__body">
                                    <div class="card__credit-card">
                                        <div class="credit-card">
                                            <img class="credit-card__image" src="assets/img/content/credit-card@3x.png" alt="#" />
                                            <div class="credit-card__content">
                                                <input class="credit-card__number" type="text" value="0123   4567   8910   1112" readonly="readonly" />
                                                <div class="credit-card__name">Mark Anderson</div>
                                                <div class="credit-card__date">12/31</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card__footer">
                                    <div class="card__container">
                                        <div class="card__credit-list">
                                            <ul class="card-list">
                                                <li class="card-list__item">
                                                    <div class="card-list__title">Card Type</div>
                                                    <div class="card-list__value">VISA</div>
                                                </li>
                                                <li class="card-list__item">
                                                    <div class="card-list__title">Card Holder</div>
                                                    <div class="card-list__value">Mark Anderson</div>
                                                </li>
                                                <li class="card-list__item">
                                                    <div class="card-list__title">Expire</div>
                                                    <div class="card-list__value">12/31</div>
                                                </li>
                                                <li class="card-list__item">
                                                    <div class="card-list__title">Card Number</div>
                                                    <div class="card-list__value">0123 4567 8910 1112</div>
                                                </li>
                                                <li class="card-list__item">
                                                    <div class="card-list__title">Balance</div>
                                                    <div class="card-list__value">$1,000,000</div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-5 col-xl-4 d-flex">
                    <div class="card">
                        <div class="card__wrapper">
                            <div class="card__container">
                                <div class="card__header">
                                    <div class="card__header-left">
                                        <h3 class="card__header-title">Add New Card</h3>
                                    </div>
                                    <div class="card__tools-more">
                                        <button class="items-more__button">
                                            <svg class="icon-icon-more">
                                                <use xlink:href="#icon-more"></use>
                                            </svg>
                                        </button>
                                        <div class="dropdown-items">
                                            <div class="dropdown-items__container">
                                                <ul class="dropdown-items__list">
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-refresh">
                                <use xlink:href="#icon-refresh"></use>
                                </svg></span>Refresh</a>
                                                    </li>
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-settings">
                                <use xlink:href="#icon-settings"></use>
                                </svg></span>Settings</a>
                                                    </li>
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-download">
                                <use xlink:href="#icon-download"></use>
                                </svg></span>Download</a>
                                                    </li>
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-action">
                                <use xlink:href="#icon-action"></use>
                                </svg></span>Action</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card__body">
                                    <form class="add-card js-add-card-form" method="POST">
                                        <div class="form-group">
                                            <label class="form-label">Name on Card</label>
                                            <div class="input-group">
                                                <input class="input" type="text" placeholder="Mark Anderson" required="required" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Card Number</label>
                                            <div class="input-group input-group--append">
                                                <input class="input js-card-number" type="text" placeholder="****   ****   ****   1234" required="required" /><span class="input-group__append"><img class="add-card__input-number-logo" src="assets/img/content/visa-logo.png" alt="#"/></span>
                                            </div>
                                        </div>
                                        <div class="row row--sm">
                                            <div class="form-group col">
                                                <label class="form-label">Expire Date</label>
                                                <div class="input-group">
                                                    <input class="input js-card-date" type="text" placeholder="12/2020" required="required" />
                                                </div>
                                            </div>
                                            <div class="form-group col">
                                                <label class="form-label">CVV Code</label>
                                                <div class="input-group">
                                                    <input class="input js-card-cvv" type="text" placeholder="***" required="required" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="add-card__submit">
                                            <button class="button button--primary button--block" type="submit"><span class="button__icon button__icon--left">
                        <svg class="icon-icon-plus">
                            <use xlink:href="#icon-plus"></use>
                        </svg></span><span class="button__text">Add Card</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-12 col-xl-4 d-flex">
                    <div class="card">
                        <div class="card__wrapper">
                            <div class="card__container">
                                <div class="card__header">
                                    <div class="card__header-left">
                                        <h3 class="card__header-title">Saved Cards</h3>
                                    </div>
                                    <div class="card__tools-more">
                                        <button class="items-more__button">
                                            <svg class="icon-icon-more">
                                                <use xlink:href="#icon-more"></use>
                                            </svg>
                                        </button>
                                        <div class="dropdown-items">
                                            <div class="dropdown-items__container">
                                                <ul class="dropdown-items__list">
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-refresh">
                                <use xlink:href="#icon-refresh"></use>
                                </svg></span>Refresh</a>
                                                    </li>
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-settings">
                                <use xlink:href="#icon-settings"></use>
                                </svg></span>Settings</a>
                                                    </li>
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-download">
                                <use xlink:href="#icon-download"></use>
                                </svg></span>Download</a>
                                                    </li>
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-action">
                                <use xlink:href="#icon-action"></use>
                                </svg></span>Action</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card__body">
                                    <div class="card__new-credits card__scrollbar scrollbar-thin scrollbar-visible" data-simplebar="data-simplebar">
                                        <div class="card__container">
                                            <div class="card__credits-items row">
                                                <div class="card__credits-item col-auto">
                                                    <div class="credit-card credit-card--light">
                                                        <img class="credit-card__image" src="assets/img/content/credit-visa@3x.png" alt="#" />
                                                        <div class="credit-card__content">
                                                            <input class="credit-card__number" type="text" value="0123   4567   8910   1112" readonly="readonly" />
                                                            <div class="credit-card__name">Mark Anderson</div>
                                                            <div class="credit-card__date">12/31</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card__credits-item col-auto">
                                                    <div class="credit-card credit-card--light">
                                                        <img class="credit-card__image" src="assets/img/content/credit-mastercard@3x.png" alt="#" />
                                                        <div class="credit-card__content">
                                                            <input class="credit-card__number" type="text" value="0123   4567   8910   1112" readonly="readonly" />
                                                            <div class="credit-card__name">Mark Anderson</div>
                                                            <div class="credit-card__date">12/31</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card__footer card__footer--md">
                                    <div class="card__container">
                                        <div class="card__credit-button">
                                            <button class="button button--primary button--block" type="button"><span class="button__icon button__icon--left">
                        <svg class="icon-icon-plus">
                            <use xlink:href="#icon-plus"></use>
                        </svg></span><span class="button__text">Add New Card</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="section__title d-none">
                <h2>Section</h2>
            </div>
            <div class="row gutter-bottom-xl">
                <div class="col-12 col-lg-7 col-xl-8 d-flex">
                    <div class="card card--lg">
                        <div class="card__wrapper">
                            <div class="card__container">
                                <div class="card__header">
                                    <div class="card__header-left">
                                        <h3 class="card__header-title">Revenue By Country</h3>
                                    </div>
                                    <div class="card__tools">
                                        <div class="card__tools-row row row--xs gutter-bottom-xs">
                                            <div class="card__tools-switcher col">
                                                <div class="switcher-button">
                                                    <div class="switcher-button__items">
                                                        <div class="switcher-button__float"></div>
                                                        <div class="switcher-button__item">
                                                            <button class="switcher-button__btn">Daily</button>
                                                        </div>
                                                        <div class="switcher-button__item active">
                                                            <button class="switcher-button__btn">Weekly</button>
                                                        </div>
                                                        <div class="switcher-button__item">
                                                            <button class="switcher-button__btn">Monthly</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card__tools-more">
                                        <button class="items-more__button">
                                            <svg class="icon-icon-more">
                                                <use xlink:href="#icon-more"></use>
                                            </svg>
                                        </button>
                                        <div class="dropdown-items">
                                            <div class="dropdown-items__container">
                                                <ul class="dropdown-items__list">
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-refresh">
                                <use xlink:href="#icon-refresh"></use>
                                </svg></span>Refresh</a>
                                                    </li>
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-settings">
                                <use xlink:href="#icon-settings"></use>
                                </svg></span>Settings</a>
                                                    </li>
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-download">
                                <use xlink:href="#icon-download"></use>
                                </svg></span>Download</a>
                                                    </li>
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-action">
                                <use xlink:href="#icon-action"></use>
                                </svg></span>Action</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card__body">
                                    <div class="card__widgets">
                                        <div class="card__widgets-row gutter-bottom-sm">
                                            <div class="card-widget card-widget--xl">
                                                <h4 class="card-widget__title">Total Revenue</h4>
                                                <div class="card-widget__trade"><span class="card-widget__count">$210,000</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card__countries-progressbar">
                                        <div class="progressbar progressbar--stacked progressbar--axis-top progressbar--lg">
                                            <div class="progressbar__items">
                                                <div class="progressbar__bar progressbar__bar--green" style="width: 40%;"><span class="progressbar__bar-count">$70,000</span>
                                                </div>
                                                <div class="progressbar__bar progressbar__bar--orange" style="width: 20%;"><span class="progressbar__bar-count">$55,000</span>
                                                </div>
                                                <div class="progressbar__bar progressbar__bar--red" style="width: 20%;"><span class="progressbar__bar-count">$40,000</span>
                                                </div>
                                                <div class="progressbar__bar progressbar__bar--orange-dark" style="width: 10%;"><span class="progressbar__bar-count">$25,000</span>
                                                </div>
                                                <div class="progressbar__bar progressbar__bar--teal" style="width: 10%;"><span class="progressbar__bar-count">$20,000</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card__footer card__footer--lg">
                                    <div class="card__container">
                                        <div class="country-legend">
                                            <div class="country-legend__row">
                                                <div class="country-legend__item">
                                                    <div class="country-legend__left"><span class="country-legend__marker color-green"></span><span class="country-legend__name">Russia</span>
                                                    </div>
                                                    <div class="country-legend__trade"><span class="country-legend__quot quotation quotation--up">
                            <svg class="icon-icon-arrow-down">
                                <use xlink:href="#icon-arrow-down"></use>
                            </svg></span><span class="country-legend__percentage">40%</span>
                                                    </div>
                                                </div>
                                                <div class="country-legend__item">
                                                    <div class="country-legend__left"><span class="country-legend__marker color-orange"></span><span class="country-legend__name">Australia</span>
                                                    </div>
                                                    <div class="country-legend__trade"><span class="country-legend__quot quotation quotation--down">
                            <svg class="icon-icon-arrow-down">
                                <use xlink:href="#icon-arrow-down"></use>
                            </svg></span><span class="country-legend__percentage">20%</span>
                                                    </div>
                                                </div>
                                                <div class="country-legend__item">
                                                    <div class="country-legend__left"><span class="country-legend__marker color-red"></span><span class="country-legend__name">China</span>
                                                    </div>
                                                    <div class="country-legend__trade"><span class="country-legend__quot quotation quotation--up">
                            <svg class="icon-icon-arrow-down">
                                <use xlink:href="#icon-arrow-down"></use>
                            </svg></span><span class="country-legend__percentage">20%</span>
                                                    </div>
                                                </div>
                                                <div class="country-legend__item">
                                                    <div class="country-legend__left"><span class="country-legend__marker color-orange-dark"></span><span class="country-legend__name">France</span>
                                                    </div>
                                                    <div class="country-legend__trade"><span class="country-legend__quot quotation quotation--down">
                            <svg class="icon-icon-arrow-down">
                                <use xlink:href="#icon-arrow-down"></use>
                            </svg></span><span class="country-legend__percentage">10%</span>
                                                    </div>
                                                </div>
                                                <div class="country-legend__item">
                                                    <div class="country-legend__left"><span class="country-legend__marker color-teal"></span><span class="country-legend__name">USA</span>
                                                    </div>
                                                    <div class="country-legend__trade"><span class="country-legend__quot quotation quotation--up">
                            <svg class="icon-icon-arrow-down">
                                <use xlink:href="#icon-arrow-down"></use>
                            </svg></span><span class="country-legend__percentage">10%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-5 col-xl-4 d-flex">
                    <div class="card card--right pb-0">
                        <div class="card__wrapper">
                            <div class="card__container">
                                <div class="card__header">
                                    <div class="card__header-left">
                                        <h3 class="card__header-title">Transactions History</h3>
                                    </div>
                                    <div class="card__tools-more">
                                        <button class="items-more__button">
                                            <svg class="icon-icon-more">
                                                <use xlink:href="#icon-more"></use>
                                            </svg>
                                        </button>
                                        <div class="dropdown-items">
                                            <div class="dropdown-items__container">
                                                <ul class="dropdown-items__list">
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-refresh">
                                <use xlink:href="#icon-refresh"></use>
                                </svg></span>Refresh</a>
                                                    </li>
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-settings">
                                <use xlink:href="#icon-settings"></use>
                                </svg></span>Settings</a>
                                                    </li>
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-download">
                                <use xlink:href="#icon-download"></use>
                                </svg></span>Download</a>
                                                    </li>
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-action">
                                <use xlink:href="#icon-action"></use>
                                </svg></span>Action</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card__body">
                                    <div class="card__transactions card__scrollbar scrollbar-thin scrollbar-visible" data-simplebar="data-simplebar">
                                        <div class="card-transactions">
                                            <div class="card-transactions__item">
                                                <div class="card-transactions__left">
                                                    <div class="card-transactions__icon">
                                                        <svg class="icon-icon-bill">
                                                            <use xlink:href="#icon-bill"></use>
                                                        </svg>
                                                    </div>
                                                    <div class="card-transactions__right">
                                                        <h5 class="card-transactions__title">MacBook Pro</h5><span class="card-transactions__time">12:00 PM</span>
                                                    </div>
                                                </div>
                                                <div class="card-transactions__details">
                                                    <div class="card-transactions__cost">$2,500</div><a class="text-sm text-grey link-under" href="#">Detail</a>
                                                </div>
                                            </div>
                                            <div class="card-transactions__item">
                                                <div class="card-transactions__left">
                                                    <div class="card-transactions__icon">
                                                        <svg class="icon-icon-bill">
                                                            <use xlink:href="#icon-bill"></use>
                                                        </svg>
                                                    </div>
                                                    <div class="card-transactions__right">
                                                        <h5 class="card-transactions__title">Apple Watch</h5><span class="card-transactions__time">01:00 PM</span>
                                                    </div>
                                                </div>
                                                <div class="card-transactions__details">
                                                    <div class="card-transactions__cost">$1,500</div><a class="text-sm text-grey link-under" href="#">Detail</a>
                                                </div>
                                            </div>
                                            <div class="card-transactions__item">
                                                <div class="card-transactions__left">
                                                    <div class="card-transactions__icon">
                                                        <svg class="icon-icon-bill">
                                                            <use xlink:href="#icon-bill"></use>
                                                        </svg>
                                                    </div>
                                                    <div class="card-transactions__right">
                                                        <h5 class="card-transactions__title">AirPods</h5><span class="card-transactions__time">02:00 PM</span>
                                                    </div>
                                                </div>
                                                <div class="card-transactions__details">
                                                    <div class="card-transactions__cost">$500</div><a class="text-sm text-grey link-under" href="#">Detail</a>
                                                </div>
                                            </div>
                                            <div class="card-transactions__item">
                                                <div class="card-transactions__left">
                                                    <div class="card-transactions__icon">
                                                        <svg class="icon-icon-bill">
                                                            <use xlink:href="#icon-bill"></use>
                                                        </svg>
                                                    </div>
                                                    <div class="card-transactions__right">
                                                        <h5 class="card-transactions__title">iPhone Xs Max</h5><span class="card-transactions__time">03:00 PM</span>
                                                    </div>
                                                </div>
                                                <div class="card-transactions__details">
                                                    <div class="card-transactions__cost">$2,500</div><a class="text-sm text-grey link-under" href="#">Detail</a>
                                                </div>
                                            </div>
                                            <div class="card-transactions__item">
                                                <div class="card-transactions__left">
                                                    <div class="card-transactions__icon">
                                                        <svg class="icon-icon-bill">
                                                            <use xlink:href="#icon-bill"></use>
                                                        </svg>
                                                    </div>
                                                    <div class="card-transactions__right">
                                                        <h5 class="card-transactions__title">IPad Pro 10.5</h5><span class="card-transactions__time">04:00 PM</span>
                                                    </div>
                                                </div>
                                                <div class="card-transactions__details">
                                                    <div class="card-transactions__cost">$1,000</div><a class="text-sm text-grey link-under" href="#">Detail</a>
                                                </div>
                                            </div>
                                            <div class="card-transactions__item">
                                                <div class="card-transactions__left">
                                                    <div class="card-transactions__icon">
                                                        <svg class="icon-icon-bill">
                                                            <use xlink:href="#icon-bill"></use>
                                                        </svg>
                                                    </div>
                                                    <div class="card-transactions__right">
                                                        <h5 class="card-transactions__title">iMac Pro</h5><span class="card-transactions__time">05:00 PM</span>
                                                    </div>
                                                </div>
                                                <div class="card-transactions__details">
                                                    <div class="card-transactions__cost">$5,000</div><a class="text-sm text-grey link-under" href="#">Detail</a>
                                                </div>
                                            </div>
                                            <div class="card-transactions__item">
                                                <div class="card-transactions__left">
                                                    <div class="card-transactions__icon">
                                                        <svg class="icon-icon-bill">
                                                            <use xlink:href="#icon-bill"></use>
                                                        </svg>
                                                    </div>
                                                    <div class="card-transactions__right">
                                                        <h5 class="card-transactions__title">AirPods</h5><span class="card-transactions__time">02:00 PM</span>
                                                    </div>
                                                </div>
                                                <div class="card-transactions__details">
                                                    <div class="card-transactions__cost">$500</div><a class="text-sm text-grey link-under" href="#">Detail</a>
                                                </div>
                                            </div>
                                            <div class="card-transactions__item">
                                                <div class="card-transactions__left">
                                                    <div class="card-transactions__icon">
                                                        <svg class="icon-icon-bill">
                                                            <use xlink:href="#icon-bill"></use>
                                                        </svg>
                                                    </div>
                                                    <div class="card-transactions__right">
                                                        <h5 class="card-transactions__title">iPhone Xs Max</h5><span class="card-transactions__time">03:00 PM</span>
                                                    </div>
                                                </div>
                                                <div class="card-transactions__details">
                                                    <div class="card-transactions__cost">$2,500</div><a class="text-sm text-grey link-under" href="#">Detail</a>
                                                </div>
                                            </div>
                                            <div class="card-transactions__item">
                                                <div class="card-transactions__left">
                                                    <div class="card-transactions__icon">
                                                        <svg class="icon-icon-bill">
                                                            <use xlink:href="#icon-bill"></use>
                                                        </svg>
                                                    </div>
                                                    <div class="card-transactions__right">
                                                        <h5 class="card-transactions__title">IPad Pro 10.5</h5><span class="card-transactions__time">04:00 PM</span>
                                                    </div>
                                                </div>
                                                <div class="card-transactions__details">
                                                    <div class="card-transactions__cost">$1,000</div><a class="text-sm text-grey link-under" href="#">Detail</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="section__title d-none">
                <h2>Section</h2>
            </div>
            <div class="row gutter-bottom-xl">
                <div class="col-12 d-flex">
                    <div class="card pb-0">
                        <div class="card__wrapper">
                            <div class="card__container">
                                <div class="card__header">
                                    <div class="card__header-left">
                                        <h3 class="card__header-title">Transactions</h3>
                                    </div>
                                    <div class="card__tools-more">
                                        <button class="items-more__button">
                                            <svg class="icon-icon-more">
                                                <use xlink:href="#icon-more"></use>
                                            </svg>
                                        </button>
                                        <div class="dropdown-items">
                                            <div class="dropdown-items__container">
                                                <ul class="dropdown-items__list">
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-refresh">
                                <use xlink:href="#icon-refresh"></use>
                                </svg></span>Refresh</a>
                                                    </li>
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-settings">
                                <use xlink:href="#icon-settings"></use>
                                </svg></span>Settings</a>
                                                    </li>
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-download">
                                <use xlink:href="#icon-download"></use>
                                </svg></span>Download</a>
                                                    </li>
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-action">
                                <use xlink:href="#icon-action"></use>
                                </svg></span>Action</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card__body">
                                    <div class="card__scrollbar card__table">
                                        <div class="card__table-transactions scrollbar-thin scrollbar-visible" data-simplebar="data-simplebar">
                                            <table class="table table--lines table--striped">
                                                <colgroup>
                                                    <col class="colgroup-1" />
                                                    <col class="colgroup-2" />
                                                    <col class="colgroup-3" />
                                                    <col class="colgroup-4" />
                                                    <col class="colgroup-5" />
                                                    <col class="colgroup-6" />
                                                    <col/>
                                                </colgroup>
                                                <thead class="table__header table__header--sticky">
                                                    <tr>
                                                        <th><span class="text-nowrap">Order No.</span>
                                                        </th>
                                                        <th><span>Name</span>
                                                        </th>
                                                        <th><span>Date</span>
                                                        </th>
                                                        <th><span>Amount</span>
                                                        </th>
                                                        <th><span>Address</span>
                                                        </th>
                                                        <th><span>Status</span>
                                                        </th>
                                                        <th class="table__actions"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="table__row">
                                                        <td class="table__td"><span class="text-grey">#790841</span>
                                                        </td>
                                                        <td class="table__td">
                                                            <div class="media-item">
                                                                <div class="media-item__icon color-orange">
                                                                    <div class="media-item__icon-text">WS</div>
                                                                    <img class="media-item__thumb" src="assets/img/content/humans/item-4.jpg" alt="#" />
                                                                </div>
                                                                <div class="media-item__right">
                                                                    <h5 class="media-item__title">Walter Sanders</h5>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="table__td"><span class="text-grey">12.07.2018</span>
                                                        </td>
                                                        <td class="table__td"><span>$700</span>
                                                        </td>
                                                        <td class="table__td"><span class="text-grey">Winding Way West, RI 3261, US</span>
                                                        </td>
                                                        <td class="table__td">
                                                            <div class="table__status"><span class="table__status-icon color-green"></span> Paid</div>
                                                        </td>
                                                        <td class="table__td table__actions">
                                                            <div class="items-more">
                                                                <button class="items-more__button">
                                                                    <svg class="icon-icon-more">
                                                                        <use xlink:href="#icon-more"></use>
                                                                    </svg>
                                                                </button>
                                                                <div class="dropdown-items dropdown-items--right">
                                                                    <div class="dropdown-items__container">
                                                                        <ul class="dropdown-items__list">
                                                                            <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                            <svg class="icon-icon-view">
                                            <use xlink:href="#icon-view"></use>
                                            </svg></span>Details</a>
                                                                            </li>
                                                                            <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                            <svg class="icon-icon-duplicate">
                                            <use xlink:href="#icon-duplicate"></use>
                                            </svg></span>Duplicate</a>
                                                                            </li>
                                                                            <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                            <svg class="icon-icon-archive">
                                            <use xlink:href="#icon-archive"></use>
                                            </svg></span>Archive</a>
                                                                            </li>
                                                                            <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                            <svg class="icon-icon-trash">
                                            <use xlink:href="#icon-trash"></use>
                                            </svg></span>Delete</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="table__row">
                                                        <td class="table__td"><span class="text-grey">#781208</span>
                                                        </td>
                                                        <td class="table__td">
                                                            <div class="media-item">
                                                                <div class="media-item__icon color-blue">
                                                                    <div class="media-item__icon-text">MA</div>
                                                                    <img class="media-item__thumb" src="assets/img/content/humans/item-6.jpg" alt="#" />
                                                                </div>
                                                                <div class="media-item__right">
                                                                    <h5 class="media-item__title">Mark Anderson</h5>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="table__td"><span class="text-grey">15.07.2018</span>
                                                        </td>
                                                        <td class="table__td"><span>$500</span>
                                                        </td>
                                                        <td class="table__td"><span class="text-grey">Jarvis Street Portville, NY 2596, US</span>
                                                        </td>
                                                        <td class="table__td">
                                                            <div class="table__status"><span class="table__status-icon color-green"></span> Paid</div>
                                                        </td>
                                                        <td class="table__td table__actions">
                                                            <div class="items-more">
                                                                <button class="items-more__button">
                                                                    <svg class="icon-icon-more">
                                                                        <use xlink:href="#icon-more"></use>
                                                                    </svg>
                                                                </button>
                                                                <div class="dropdown-items dropdown-items--right">
                                                                    <div class="dropdown-items__container">
                                                                        <ul class="dropdown-items__list">
                                                                            <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                            <svg class="icon-icon-view">
                                            <use xlink:href="#icon-view"></use>
                                            </svg></span>Details</a>
                                                                            </li>
                                                                            <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                            <svg class="icon-icon-duplicate">
                                            <use xlink:href="#icon-duplicate"></use>
                                            </svg></span>Duplicate</a>
                                                                            </li>
                                                                            <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                            <svg class="icon-icon-archive">
                                            <use xlink:href="#icon-archive"></use>
                                            </svg></span>Archive</a>
                                                                            </li>
                                                                            <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                            <svg class="icon-icon-trash">
                                            <use xlink:href="#icon-trash"></use>
                                            </svg></span>Delete</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="table__row">
                                                        <td class="table__td"><span class="text-grey">#987120</span>
                                                        </td>
                                                        <td class="table__td">
                                                            <div class="media-item">
                                                                <div class="media-item__icon color-green">
                                                                    <div class="media-item__icon-text">PG</div>
                                                                    <img class="media-item__thumb" src="assets/img/content/humans/item-3.jpg" alt="#" />
                                                                </div>
                                                                <div class="media-item__right">
                                                                    <h5 class="media-item__title">Pamela Garza</h5>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="table__td"><span class="text-grey">17.07.2018</span>
                                                        </td>
                                                        <td class="table__td"><span>$800</span>
                                                        </td>
                                                        <td class="table__td"><span class="text-grey">Calico Drive Ellensburg, WA 5572, US</span>
                                                        </td>
                                                        <td class="table__td">
                                                            <div class="table__status"><span class="table__status-icon color-red"></span> Canceled</div>
                                                        </td>
                                                        <td class="table__td table__actions">
                                                            <div class="items-more">
                                                                <button class="items-more__button">
                                                                    <svg class="icon-icon-more">
                                                                        <use xlink:href="#icon-more"></use>
                                                                    </svg>
                                                                </button>
                                                                <div class="dropdown-items dropdown-items--right">
                                                                    <div class="dropdown-items__container">
                                                                        <ul class="dropdown-items__list">
                                                                            <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                            <svg class="icon-icon-view">
                                            <use xlink:href="#icon-view"></use>
                                            </svg></span>Details</a>
                                                                            </li>
                                                                            <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                            <svg class="icon-icon-duplicate">
                                            <use xlink:href="#icon-duplicate"></use>
                                            </svg></span>Duplicate</a>
                                                                            </li>
                                                                            <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                            <svg class="icon-icon-archive">
                                            <use xlink:href="#icon-archive"></use>
                                            </svg></span>Archive</a>
                                                                            </li>
                                                                            <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                            <svg class="icon-icon-trash">
                                            <use xlink:href="#icon-trash"></use>
                                            </svg></span>Delete</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="table__row">
                                                        <td class="table__td"><span class="text-grey">#871023</span>
                                                        </td>
                                                        <td class="table__td">
                                                            <div class="media-item">
                                                                <div class="media-item__icon color-red">
                                                                    <div class="media-item__icon-text">WS</div>
                                                                    <img class="media-item__thumb" src="assets/img/content/humans/item-9.jpg" alt="#" />
                                                                </div>
                                                                <div class="media-item__right">
                                                                    <h5 class="media-item__title">Walter Sanders</h5>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="table__td"><span class="text-grey">18.07.2018</span>
                                                        </td>
                                                        <td class="table__td"><span>$1,000</span>
                                                        </td>
                                                        <td class="table__td"><span class="text-grey">Randall Drive Pahala, HI 7289, US</span>
                                                        </td>
                                                        <td class="table__td">
                                                            <div class="table__status"><span class="table__status-icon color-green"></span> Paid</div>
                                                        </td>
                                                        <td class="table__td table__actions">
                                                            <div class="items-more">
                                                                <button class="items-more__button">
                                                                    <svg class="icon-icon-more">
                                                                        <use xlink:href="#icon-more"></use>
                                                                    </svg>
                                                                </button>
                                                                <div class="dropdown-items dropdown-items--right">
                                                                    <div class="dropdown-items__container">
                                                                        <ul class="dropdown-items__list">
                                                                            <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                            <svg class="icon-icon-view">
                                            <use xlink:href="#icon-view"></use>
                                            </svg></span>Details</a>
                                                                            </li>
                                                                            <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                            <svg class="icon-icon-duplicate">
                                            <use xlink:href="#icon-duplicate"></use>
                                            </svg></span>Duplicate</a>
                                                                            </li>
                                                                            <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                            <svg class="icon-icon-archive">
                                            <use xlink:href="#icon-archive"></use>
                                            </svg></span>Archive</a>
                                                                            </li>
                                                                            <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                            <svg class="icon-icon-trash">
                                            <use xlink:href="#icon-trash"></use>
                                            </svg></span>Delete</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="table__row">
                                                        <td class="table__td"><span class="text-grey">#902370</span>
                                                        </td>
                                                        <td class="table__td">
                                                            <div class="media-item">
                                                                <div class="media-item__icon color-orange">
                                                                    <div class="media-item__icon-text">RH</div>
                                                                    <img class="media-item__thumb" src="assets/img/content/humans/item-5.jpg" alt="#" />
                                                                </div>
                                                                <div class="media-item__right">
                                                                    <h5 class="media-item__title">Ryan Henderson</h5>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="table__td"><span class="text-grey">22.07.2018</span>
                                                        </td>
                                                        <td class="table__td"><span>$900</span>
                                                        </td>
                                                        <td class="table__td"><span class="text-grey">Archwood Newcastle, WY 1139, US</span>
                                                        </td>
                                                        <td class="table__td">
                                                            <div class="table__status"><span class="table__status-icon color-green"></span> Paid</div>
                                                        </td>
                                                        <td class="table__td table__actions">
                                                            <div class="items-more">
                                                                <button class="items-more__button">
                                                                    <svg class="icon-icon-more">
                                                                        <use xlink:href="#icon-more"></use>
                                                                    </svg>
                                                                </button>
                                                                <div class="dropdown-items dropdown-items--right">
                                                                    <div class="dropdown-items__container">
                                                                        <ul class="dropdown-items__list">
                                                                            <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                            <svg class="icon-icon-view">
                                            <use xlink:href="#icon-view"></use>
                                            </svg></span>Details</a>
                                                                            </li>
                                                                            <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                            <svg class="icon-icon-duplicate">
                                            <use xlink:href="#icon-duplicate"></use>
                                            </svg></span>Duplicate</a>
                                                                            </li>
                                                                            <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                            <svg class="icon-icon-archive">
                                            <use xlink:href="#icon-archive"></use>
                                            </svg></span>Archive</a>
                                                                            </li>
                                                                            <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                            <svg class="icon-icon-trash">
                                            <use xlink:href="#icon-trash"></use>
                                            </svg></span>Delete</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="table__row">
                                                        <td class="table__td"><span class="text-grey">#922309</span>
                                                        </td>
                                                        <td class="table__td">
                                                            <div class="media-item">
                                                                <div class="media-item__icon color-blue">
                                                                    <div class="media-item__icon-text">SA</div>
                                                                </div>
                                                                <div class="media-item__right">
                                                                    <h5 class="media-item__title">Stephen Allen</h5>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="table__td"><span class="text-grey">25.07.2018</span>
                                                        </td>
                                                        <td class="table__td"><span>$3,000</span>
                                                        </td>
                                                        <td class="table__td"><span class="text-grey">Park Boulevard Oskaloosa, IA 4814, US</span>
                                                        </td>
                                                        <td class="table__td">
                                                            <div class="table__status"><span class="table__status-icon color-blue"></span> Pending</div>
                                                        </td>
                                                        <td class="table__td table__actions">
                                                            <div class="items-more">
                                                                <button class="items-more__button">
                                                                    <svg class="icon-icon-more">
                                                                        <use xlink:href="#icon-more"></use>
                                                                    </svg>
                                                                </button>
                                                                <div class="dropdown-items dropdown-items--right dropdown-items--up">
                                                                    <div class="dropdown-items__container">
                                                                        <ul class="dropdown-items__list">
                                                                            <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                            <svg class="icon-icon-view">
                                            <use xlink:href="#icon-view"></use>
                                            </svg></span>Details</a>
                                                                            </li>
                                                                            <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                            <svg class="icon-icon-duplicate">
                                            <use xlink:href="#icon-duplicate"></use>
                                            </svg></span>Duplicate</a>
                                                                            </li>
                                                                            <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                            <svg class="icon-icon-archive">
                                            <use xlink:href="#icon-archive"></use>
                                            </svg></span>Archive</a>
                                                                            </li>
                                                                            <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                            <svg class="icon-icon-trash">
                                            <use xlink:href="#icon-trash"></use>
                                            </svg></span>Delete</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="table__row">
                                                        <td class="table__td"><span class="text-grey">#892107</span>
                                                        </td>
                                                        <td class="table__td">
                                                            <div class="media-item">
                                                                <div class="media-item__icon color-red">
                                                                    <div class="media-item__icon-text">JT</div>
                                                                    <img class="media-item__thumb" src="assets/img/content/humans/item-1.jpg" alt="#" />
                                                                </div>
                                                                <div class="media-item__right">
                                                                    <h5 class="media-item__title">Jennifer Tang</h5>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="table__td"><span class="text-grey">27.07.2018</span>
                                                        </td>
                                                        <td class="table__td"><span>$1,000</span>
                                                        </td>
                                                        <td class="table__td"><span class="text-grey">Harvest Lane Eagleville, MO 9818, US</span>
                                                        </td>
                                                        <td class="table__td">
                                                            <div class="table__status"><span class="table__status-icon color-green"></span> Paid</div>
                                                        </td>
                                                        <td class="table__td table__actions">
                                                            <div class="items-more">
                                                                <button class="items-more__button">
                                                                    <svg class="icon-icon-more">
                                                                        <use xlink:href="#icon-more"></use>
                                                                    </svg>
                                                                </button>
                                                                <div class="dropdown-items dropdown-items--right dropdown-items--up">
                                                                    <div class="dropdown-items__container">
                                                                        <ul class="dropdown-items__list">
                                                                            <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                            <svg class="icon-icon-view">
                                            <use xlink:href="#icon-view"></use>
                                            </svg></span>Details</a>
                                                                            </li>
                                                                            <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                            <svg class="icon-icon-duplicate">
                                            <use xlink:href="#icon-duplicate"></use>
                                            </svg></span>Duplicate</a>
                                                                            </li>
                                                                            <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                            <svg class="icon-icon-archive">
                                            <use xlink:href="#icon-archive"></use>
                                            </svg></span>Archive</a>
                                                                            </li>
                                                                            <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                            <svg class="icon-icon-trash">
                                            <use xlink:href="#icon-trash"></use>
                                            </svg></span>Delete</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="table__row">
                                                        <td class="table__td"><span class="text-grey">#902370</span>
                                                        </td>
                                                        <td class="table__td">
                                                            <div class="media-item">
                                                                <div class="media-item__icon color-green">
                                                                    <div class="media-item__icon-text">SH</div>
                                                                    <img class="media-item__thumb" src="assets/img/content/humans/item-2.jpg" alt="#" />
                                                                </div>
                                                                <div class="media-item__right">
                                                                    <h5 class="media-item__title">Sophia Hale</h5>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="table__td"><span class="text-grey">22.07.2018</span>
                                                        </td>
                                                        <td class="table__td"><span>$900</span>
                                                        </td>
                                                        <td class="table__td"><span class="text-grey">Archwood Newcastle, WY 1139, US</span>
                                                        </td>
                                                        <td class="table__td">
                                                            <div class="table__status"><span class="table__status-icon color-blue"></span> Pending</div>
                                                        </td>
                                                        <td class="table__td table__actions">
                                                            <div class="items-more">
                                                                <button class="items-more__button">
                                                                    <svg class="icon-icon-more">
                                                                        <use xlink:href="#icon-more"></use>
                                                                    </svg>
                                                                </button>
                                                                <div class="dropdown-items dropdown-items--right dropdown-items--up">
                                                                    <div class="dropdown-items__container">
                                                                        <ul class="dropdown-items__list">
                                                                            <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                            <svg class="icon-icon-view">
                                            <use xlink:href="#icon-view"></use>
                                            </svg></span>Details</a>
                                                                            </li>
                                                                            <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                            <svg class="icon-icon-duplicate">
                                            <use xlink:href="#icon-duplicate"></use>
                                            </svg></span>Duplicate</a>
                                                                            </li>
                                                                            <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                            <svg class="icon-icon-archive">
                                            <use xlink:href="#icon-archive"></use>
                                            </svg></span>Archive</a>
                                                                            </li>
                                                                            <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                            <svg class="icon-icon-trash">
                                            <use xlink:href="#icon-trash"></use>
                                            </svg></span>Delete</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="table__row">
                                                        <td class="table__td"><span class="text-grey">#781208</span>
                                                        </td>
                                                        <td class="table__td">
                                                            <div class="media-item">
                                                                <div class="media-item__icon color-blue">
                                                                    <div class="media-item__icon-text">MA</div>
                                                                    <img class="media-item__thumb" src="assets/img/content/humans/item-6.jpg" alt="#" />
                                                                </div>
                                                                <div class="media-item__right">
                                                                    <h5 class="media-item__title">Mark Anderson</h5>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="table__td"><span class="text-grey">24.07.2018</span>
                                                        </td>
                                                        <td class="table__td"><span>$800</span>
                                                        </td>
                                                        <td class="table__td"><span class="text-grey">Jarvis Street Portville, NY 2596, US</span>
                                                        </td>
                                                        <td class="table__td">
                                                            <div class="table__status"><span class="table__status-icon color-green"></span> Paid</div>
                                                        </td>
                                                        <td class="table__td table__actions">
                                                            <div class="items-more">
                                                                <button class="items-more__button">
                                                                    <svg class="icon-icon-more">
                                                                        <use xlink:href="#icon-more"></use>
                                                                    </svg>
                                                                </button>
                                                                <div class="dropdown-items dropdown-items--right dropdown-items--up">
                                                                    <div class="dropdown-items__container">
                                                                        <ul class="dropdown-items__list">
                                                                            <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                            <svg class="icon-icon-view">
                                            <use xlink:href="#icon-view"></use>
                                            </svg></span>Details</a>
                                                                            </li>
                                                                            <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                            <svg class="icon-icon-duplicate">
                                            <use xlink:href="#icon-duplicate"></use>
                                            </svg></span>Duplicate</a>
                                                                            </li>
                                                                            <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                            <svg class="icon-icon-archive">
                                            <use xlink:href="#icon-archive"></use>
                                            </svg></span>Archive</a>
                                                                            </li>
                                                                            <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                            <svg class="icon-icon-trash">
                                            <use xlink:href="#icon-trash"></use>
                                            </svg></span>Delete</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="section__title d-none">
                <h2>Section</h2>
            </div>
            <div class="row gutter-bottom-xl">
                <div class="col-12 col-lg-6 col-xl-8 d-flex">
                    <div class="card pb-0">
                        <div class="card__wrapper">
                            <div class="card__container">
                                <div class="card__header">
                                    <div class="card__header-left">
                                        <h3 class="card__header-title">Sales by country</h3>
                                    </div>
                                    <div class="card__tools-more">
                                        <button class="items-more__button">
                                            <svg class="icon-icon-more">
                                                <use xlink:href="#icon-more"></use>
                                            </svg>
                                        </button>
                                        <div class="dropdown-items">
                                            <div class="dropdown-items__container">
                                                <ul class="dropdown-items__list">
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-refresh">
                                <use xlink:href="#icon-refresh"></use>
                                </svg></span>Refresh</a>
                                                    </li>
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-settings">
                                <use xlink:href="#icon-settings"></use>
                                </svg></span>Settings</a>
                                                    </li>
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-download">
                                <use xlink:href="#icon-download"></use>
                                </svg></span>Download</a>
                                                    </li>
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-action">
                                <use xlink:href="#icon-action"></use>
                                </svg></span>Action</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card__body">
                                    <div class="card-country card__table card__scrollbar">
                                        <div class="card-country__map" id="mapCountry"></div>
                                        <div class="card-country__items scrollbar-thin scrollbar-visible" data-simplebar="data-simplebar">
                                            <table class="table table--lines">
                                                <colgroup>
                                                    <col class="colgroup-1" />
                                                    <col class="colgroup-2" />
                                                    <col/>
                                                </colgroup>
                                                <tbody>
                                                    <tr class="table__row">
                                                        <td class="table__td text-nowrap">
                                                            <img class="card-country__flag" src="assets/img/content/flags/au.svg" alt="#" /><span class="card-country__name">Australia</span>
                                                        </td>
                                                        <td class="table__td text-nowrap"><span class="card-country__sales">Sales: <span class="font-weight-medium">25,000</span></span><span class="quotation quotation--up">
                                <svg class="icon-icon-arrow-down">
                                <use xlink:href="#icon-arrow-down"></use>
                                </svg></span>
                                                        </td>
                                                        <td class="table__td"><span class="text-grey">40%</span>
                                                        </td>
                                                    </tr>
                                                    <tr class="table__row">
                                                        <td class="table__td text-nowrap">
                                                            <img class="card-country__flag" src="assets/img/content/flags/ru.svg" alt="#" /><span class="card-country__name">Russia</span>
                                                        </td>
                                                        <td class="table__td text-nowrap"><span class="card-country__sales">Sales: <span class="font-weight-medium">10,000</span></span><span class="quotation quotation--up">
                                <svg class="icon-icon-arrow-down">
                                <use xlink:href="#icon-arrow-down"></use>
                                </svg></span>
                                                        </td>
                                                        <td class="table__td"><span class="text-grey">20%</span>
                                                        </td>
                                                    </tr>
                                                    <tr class="table__row">
                                                        <td class="table__td text-nowrap">
                                                            <img class="card-country__flag" src="assets/img/content/flags/us.svg" alt="#" /><span class="card-country__name">United States</span>
                                                        </td>
                                                        <td class="table__td text-nowrap"><span class="card-country__sales">Sales: <span class="font-weight-medium">5,000</span></span><span class="quotation quotation--down">
                                <svg class="icon-icon-arrow-down">
                                <use xlink:href="#icon-arrow-down"></use>
                                </svg></span>
                                                        </td>
                                                        <td class="table__td"><span class="text-grey">15%</span>
                                                        </td>
                                                    </tr>
                                                    <tr class="table__row">
                                                        <td class="table__td text-nowrap">
                                                            <img class="card-country__flag" src="assets/img/content/flags/cn.svg" alt="#" /><span class="card-country__name">China</span>
                                                        </td>
                                                        <td class="table__td text-nowrap"><span class="card-country__sales">Sales: <span class="font-weight-medium">2,000</span></span><span class="quotation quotation--down">
                                <svg class="icon-icon-arrow-down">
                                <use xlink:href="#icon-arrow-down"></use>
                                </svg></span>
                                                        </td>
                                                        <td class="table__td"><span class="text-grey">10%</span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-4 d-flex">
                    <div class="card card--right pb-0">
                        <div class="card__wrapper">
                            <div class="card__container">
                                <div class="card__header">
                                    <div class="card__header-left">
                                        <h3 class="card__header-title">Reviews</h3>
                                    </div>
                                    <div class="card__tools-more">
                                        <button class="items-more__button">
                                            <svg class="icon-icon-more">
                                                <use xlink:href="#icon-more"></use>
                                            </svg>
                                        </button>
                                        <div class="dropdown-items">
                                            <div class="dropdown-items__container">
                                                <ul class="dropdown-items__list">
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-refresh">
                                <use xlink:href="#icon-refresh"></use>
                                </svg></span>Refresh</a>
                                                    </li>
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-settings">
                                <use xlink:href="#icon-settings"></use>
                                </svg></span>Settings</a>
                                                    </li>
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-download">
                                <use xlink:href="#icon-download"></use>
                                </svg></span>Download</a>
                                                    </li>
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-action">
                                <use xlink:href="#icon-action"></use>
                                </svg></span>Action</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card__body">
                                    <div class="card__review-list card__scrollbar scrollbar-thin scrollbar-visible" data-simplebar="data-simplebar">
                                        <div class="card__container">
                                            <div class="review-list">
                                                <div class="review-list__item">
                                                    <a class="review-list__avatar color-red" href="reviews.html">
                                                        <div class="review-list__avatar-text">KG</div>
                                                        <img src="assets/img/content/humans/item-1.jpg" alt="#" />
                                                    </a>
                                                    <div class="review-list__right">
                                                        <h5 class="review-list__name"><a href="reviews.html">Kathy Graham</a></h5><span class="review-list__time">3 hours ago</span>
                                                        <div class="rating js-rating-stars" data-rating="5" data-readonly="true"></div>
                                                        <div class="review-list__message">
                                                            <p class="review-list__text">Nemo enim ipsam voluptatem, qui in ea voluptate veting esse quam nihil molestiae consequatur, vels illum utasle etcos quam voluptates recusandae.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="review-list__item">
                                                    <a class="review-list__avatar color-orange" href="reviews.html">
                                                        <div class="review-list__avatar-text">DF</div>
                                                        <img src="assets/img/content/humans/item-4.jpg" alt="#" />
                                                    </a>
                                                    <div class="review-list__right">
                                                        <h5 class="review-list__name"><a href="reviews.html">Dale Fisher</a></h5><span class="review-list__time">5 hours ago</span>
                                                        <div class="rating js-rating-stars" data-rating="4" data-readonly="true"></div>
                                                        <div class="review-list__message">
                                                            <p class="review-list__text">At vero eos accusamus as iusto odio dignissimos provis ducimus, consectetur adipiscing elit, piscings obcaecati cupiditate nonpiscing provident fuga.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="review-list__item">
                                                    <a class="review-list__avatar color-teal" href="reviews.html">
                                                        <div class="review-list__avatar-text">BH</div>
                                                        <img src="assets/img/content/humans/item-5.jpg" alt="#" />
                                                    </a>
                                                    <div class="review-list__right">
                                                        <h5 class="review-list__name"><a href="reviews.html">Bruce Henderson</a></h5><span class="review-list__time">6 hours ago</span>
                                                        <div class="rating js-rating-stars" data-rating="3" data-readonly="true"></div>
                                                        <div class="review-list__message">
                                                            <p class="review-list__text">Et harum quidem rerum facilis esits expedita distinctios, quia voluptas sit, aspernatur aut odit aut fugit, seedrnat dolores consequuntur magni...</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="review-list__item">
                                                    <a class="review-list__avatar color-green" href="reviews.html">
                                                        <div class="review-list__avatar-text">JH</div>
                                                        <img src="assets/img/content/humans/item-6.jpg" alt="#" />
                                                    </a>
                                                    <div class="review-list__right">
                                                        <h5 class="review-list__name"><a href="reviews.html">John Hendrix</a></h5><span class="review-list__time">8 hours ago</span>
                                                        <div class="rating js-rating-stars" data-rating="5" data-readonly="true"></div>
                                                        <div class="review-list__message">
                                                            <p class="review-list__text">Nemo enim ipsam voluptatem, qui in ea voluptate veting esse quam nihil molestiae consequatur, vels illum utasle etcos quam voluptates recusandae.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="review-list__item">
                                                    <a class="review-list__avatar color-blue" href="reviews.html">
                                                        <div class="review-list__avatar-text">SA</div>
                                                    </a>
                                                    <div class="review-list__right">
                                                        <h5 class="review-list__name"><a href="reviews.html">Stephen Allen</a></h5><span class="review-list__time">9 hours ago</span>
                                                        <div class="rating js-rating-stars" data-rating="4" data-readonly="true"></div>
                                                        <div class="review-list__message">
                                                            <p class="review-list__text">At vero eos accusamus as iusto odio dignissimos provis ducimus, consectetur adipiscing elit, piscings obcaecati cupiditate nonpiscing provident fuga.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="section__title d-none">
                <h2>Section</h2>
            </div>
            <div class="row gutter-bottom-xl">
                <div class="col-12 col-md-6 col-xl-4 d-flex">
                    <div class="card pb-0">
                        <div class="card__wrapper">
                            <div class="card__container">
                                <div class="card__header">
                                    <div class="card__header-left">
                                        <h3 class="card__header-title">Calendar</h3>
                                    </div>
                                    <div class="card__tools-more">
                                        <button class="items-more__button">
                                            <svg class="icon-icon-more">
                                                <use xlink:href="#icon-more"></use>
                                            </svg>
                                        </button>
                                        <div class="dropdown-items">
                                            <div class="dropdown-items__container">
                                                <ul class="dropdown-items__list">
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-refresh">
                                <use xlink:href="#icon-refresh"></use>
                                </svg></span>Refresh</a>
                                                    </li>
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-settings">
                                <use xlink:href="#icon-settings"></use>
                                </svg></span>Settings</a>
                                                    </li>
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-download">
                                <use xlink:href="#icon-download"></use>
                                </svg></span>Download</a>
                                                    </li>
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                <svg class="icon-icon-action">
                                <use xlink:href="#icon-action"></use>
                                </svg></span>Action</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card__body">
                                    <div class="calendar-inline" id="calendarOne">
                                        <div class="js-calendar-inline"></div>
                                    </div>
                                </div>
                                <div class="card__footer card__footer--md">
                                    <div class="card__container">
                                        <div class="calendar-widget" data-calendar="#calendarOne">
                                            <div class="calendar-widget__row">
                                                <div class="calendar-widget__item calendar-widget__item--left">
                                                    <div class="calendar-widget__day"><span class="calendar-widget__dateday">13</span><sup class="calendar-widget__weekday text-grey">TH</sup>
                                                    </div>
                                                    <div class="calendar-widget__month text-grey">December</div>
                                                </div>
                                                <div class="calendar-widget__item">
                                                    <div class="calendar-widget__status"><span class="circle color-green"></span><span>Upcoming</span>
                                                    </div>
                                                    <div class="calendar-widget__order text-grey">
                                                        Order Delivery 04:30 PM
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
@endsection