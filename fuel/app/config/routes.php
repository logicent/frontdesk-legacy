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

	'login'     => 'login/login',
	'logout'    => 'login/logout',

	'registers/reservations' => 'facility/reservation',
	'registers/bookings'     => 'facility/booking',
	// 'registers/folios'     => 'sales/invoice',
	'registers/stayover/:date'   => 'facility/stayover/$1',
    'registers/nightaudit/:date' => 'facility/nightaudit/$1',

	'accounts/bank-accounts'    => 'accounts/bank/account',
	'accounts/bank-deposits'    => 'accounts/bank/deposit',
	'accounts/invoices'         => 'accounts/salesinvoice',
	'accounts/receipts'         => 'accounts/payment/receipt',
	'accounts/expenses'         => 'accounts/payment/expense',
	'accounts/taxes'            => 'accounts/tax',
	'accounts/payment-methods'  => 'accounts/payment/method',

    'accounts/payment/receipt/to-print/:id' => 'accounts/payment/receipt/to_print/$1',

	'facilities/rooms'      => 'room',
	'facilities/room-types' => 'room/type',
	// 'facilities/unit'       => 'facility/facility',
	// 'facilities/types'      => 'facility/type',
	'facilities/rates'      => 'rate',
	'facilities/rate-types' => 'rate/type',
	'facilities/amenities'  => 'facility/amenity',
	'facilities/services'   => 'service/item',
    
	'settings/business-detail'  => 'business',
	'settings/email-settings'   => 'email/settings',
	// 'settings/email-settings/edit/:id' => 'email/settings/edit/$1',
	'settings/email-templates'  => 'email/template',
	'settings/bank-accounts'    => 'bank/account',
	'settings/admin-policies'   => 'admin_policy',
	'settings/admin-checklists' => 'admin_checklist',
	'settings/admin-templates'  => 'admin_template',
	'settings/permissions'      => 'permission',
	'settings/roles'            => 'role',

    'calendar/show-bookings'    => 'calendar/show_bookings',
    'calendar/show-reservations'    => 'calendar/show_reservations',

    'report-builder' => 'report/builder',

	//'reports/:slug' => 'reports/$1',
	'reports/show-daily-report' => 'reports/show_daily',
	'reports/show-monthly-report' => 'reports/show_monthly',
);
