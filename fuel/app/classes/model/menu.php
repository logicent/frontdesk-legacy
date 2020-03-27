<?php

class Model_Menu extends \Orm\Model
{
    public const MENU_TOP_NAV = 'top';
    public const MENU_SIDE_NAV = 'side';

    public static function menu_list_items($ugroup)
    {
        return array(
            // Wait(ing) List
            'registers' => array(
                'name' => 'Registers',
                'icon' => 'fa-book',
                'column' => self::MENU_SIDE_NAV,
                'visible' => true,
                'items' => array(
                    array(
                        'id'     => 'reservation',
                        'label'  => 'Reservation',
                        'route'  => 'registers/reservation',
                        'icon' => 'fa-book',
                        'description' => 'Track reservation data records',
                        'visible' => true,
                    ),
                    array(
                        'id'     => 'booking',
                        'label'  => 'Booking',
                        'route'  => 'registers/booking',
                        'icon' => 'fa-book',
                        'description' => 'Track booking data records',
                        'visible' => true,
                    ),
                    array(
                        'id'     => 'lease',
                        'label'  => 'Lease',
                        'route'  => 'registers/lease',
                        'icon' => 'fa-book',
                        'description' => 'Track lease data records',
                        'visible' => true,
                    ),
                    array(
                        'id'     => 'customer',
                        'label'  => 'Customer',
                        'route'  => 'registers/customer',
                        'icon' => 'fa-book',
                        'description' => 'Track customer data records',
                        'visible' => true,
                    ),
                    array(
                        'id'     => 'partner',
                        'label'  => 'Partner',
                        'route'  => 'registers/partner',
                        'icon' => 'fa-book',
                        'description' => 'Track partner data records',
                        'visible' => true,
                    ),
                ),
            ),
            'billing' => array(
                'name' => 'Billing &amp; Payments',
                'icon' => 'fa-money',
                'column' => self::MENU_SIDE_NAV,
                'visible' => true,
                'items' => array(
                    array(
                        'id'     => 'sales-invoice',
                        'label'  => 'Sales Invoice',
                        'route'  => 'accounts/sales-invoice',
                        'icon' => 'fa-money',
                        'description' => 'Track sales invoice data records',
                        'visible' => true,
                    ),
                    array(
                        'id'     => 'sales-receipt',
                        'label'  => 'Sales Receipt',
                        'route'  => 'accounts/sales-receipt',
                        'icon' => 'fa-money',
                        'description' => 'Track sales receipt data records',
                        'visible' => true,
                    ),
                    array(
                        'id'     => 'expenses',
                        'label'  => 'Expenses',
                        'route'  => 'accounts/expenses',
                        'icon' => 'fa-book',
                        'description' => 'Track expenses data',
                        'visible' => true,
                    ),
                    array(
                        'id'     => 'deposits',
                        'label'  => 'Bank Deposits',
                        'route'  => 'accounts/bank-deposit',
                        'icon' => 'fa-book',
                        'description' => 'Track bank deposits data',
                        'visible' => true,
                    ),
                ),
            ),
            'payroll' => array(
                'name' => 'Payroll',
                'icon' => 'fa-users',
                'column' => self::MENU_SIDE_NAV,
                'visible' => $ugroup->id == 5 || $ugroup->id == 6, // Admin group
                'items' => array(
                    array(
                        'id'     => 'payslip',
                        'label'  => 'Payslip',
                        'route'  => 'hr/payslip',
                        // 'icon' => 'fa-users',
                        'description' => 'Track employee salary payments data',
                        'visible' => true,
                    ),
                    array(
                        'id'     => 'employee_attendance',
                        'label'  => 'Employee Attendance',
                        'route'  => 'hr/employee-attendance',
                        // 'icon' => 'fa-users',
                        'description' => 'Track employee attendance data',
                        'visible' => false,
                    ),                    
                    array(
                        'id'     => 'employee',
                        'label'  => 'Employee',
                        'route'  => 'hr/employee',
                        // 'icon' => 'fa-users',
                        'description' => 'Track employee master data',
                        'visible' => true,
                    ),
                    array(
                        'id'     => 'salary_structure',
                        'label'  => 'Salary Structure',
                        'route'  => 'hr/salary-structure',
                        // 'icon' => 'fa-users',
                        'description' => 'Create/update salary structures master data',
                        'visible' => false,
                    ),
                    array(
                        'id'     => 'salary_component',
                        'label'  => 'Salary Component',
                        'route'  => 'hr/salary-component',
                        // 'icon' => 'fa-users',
                        'description' => 'Create/update salary components master data',
                        'visible' => true,
                    ),
                )
            ),
            'facilities' => array(
                'name' => 'Facilities',
                'icon' => 'fa-building',
                'column' => self::MENU_SIDE_NAV,
                'visible' => $ugroup->id == 5 || $ugroup->id == 6, // Admin group
                'items' => array(
                    array(
                        'id'     => 'rate',
                        'label'  => 'Rates',
                        'route'  => 'facilities/rates',
                        // 'icon' => 'fa-users',
                        'description' => 'Create property rates master data',
                        'visible' => true,
                    ),
                    array(
                        'id'     => 'rate_type',
                        'label'  => 'Rate Type',
                        'route'  => 'facilities/rate-type',
                        // 'icon' => 'fa-users',
                        'description' => 'Create property rate type master data',
                        'visible' => true,
                    ),
                    array(
                        'id'     => 'unit',
                        'label'  => 'Units',
                        'route'  => 'facilities/units',
                        // 'icon' => 'fa-users',
                        'description' => 'Create property units master data',
                        'visible' => true,
                    ),
                    array(
                        'id'     => 'unit_type',
                        'label'  => 'Unit Type',
                        'route'  => 'facilities/unit-type',
                        // 'icon' => 'fa-users',
                        'description' => 'Create property unit type master data',
                        'visible' => true,
                    ), 
                    array(
                        'id'     => 'property',
                        'label'  => 'Property',
                        'route'  => 'facilities/property',
                        // 'icon' => 'fa-users',
                        'description' => 'Track property master data',
                        'visible' => true,
                    ),
                    array(
                        'id'     => 'services',
                        'label'  => 'Services',
                        'route'  => 'facilities/services',
                        // 'icon' => 'fa-users',
                        'description' => 'Track services master data',
                        'visible' => true,
                    ),                    
                )
            ),
            'users' => array(
                'name' => 'Users',
                'icon' => 'fa-money',
                'column' => self::MENU_SIDE_NAV,
                'visible' => $ugroup->id == 5 || $ugroup->id == 6, // Admin group
                'items' => array(
                    array(
                        'id'    => 'users',
                        'label' => 'Users',
                        'route' => 'users',
                        'description' => 'Create/update and remove system users',
                        'visible' => true,
                    ),
                ),
            ),
            'settings' => array(
                'name' => 'Settings',
                'icon' => 'fa-cog',
                'column' => self::MENU_SIDE_NAV,
                'visible' => $ugroup->id == 5 || $ugroup->id == 6, // Admin group
                'items' => array(
                    array(
                        'id'    => 'settings',
                        'label' => 'Settings',
                        'route' => 'settings',
                        'description' => 'Change predefined settings values',
                        'visible' => true,
                    ),
                ),
            ),
        );
    }
}
