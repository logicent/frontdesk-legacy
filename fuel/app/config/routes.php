<?php
/**
 * Fuel is a fast, lightweight, community driven PHP 5.4+ framework.
 *
 * @package    Fuel
 * @version    1.8.2
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2019 Fuel Development Team
 * @link       https://fuelphp.com
 */

return array(
	'_root_'  => 'dashboard/index',  // The default route
	'_404_'   => 'dashboard/404',    // The main 404 route

	'login' => 'login/login',
	'logout' => 'login/logout',

	'front-desk/reservations' => 'fd/reservation',
	'front-desk/bookings' => 'fd/booking',
	'front-desk/bookings/stayover/:date' => 'fd/booking/stayover/$1',
	'front-desk/bookings/nightaudit/:date' => 'fd/booking/nightaudit/$1',
	'front-desk/invoices' => 'sales/invoice',
	'front-desk/receipts/to-print/:id' => 'cash/receipt/to_print/$1',

	'cash-control/receipts' => 'cash/receipt',
	'cash-control/expenses' => 'cash/payment',
	'cash-control/expenses/claims' => 'expense/claim',

	'accommodation/rooms' => 'room',
	'accommodation/room-types' => 'room/type',
	'accommodation/rates' => 'rate',
	'accommodation/rate-types' => 'rate/type',

	'banking/bank-deposits' => 'bank/receipt',
	'banking/bank-accounts' => 'bank/account',

	//'reports/:slug' => 'reports/$1',
	'reports/show-daily-report' => 'reports/show_daily',
	'reports/show-monthly-report' => 'reports/show_monthly',
);
