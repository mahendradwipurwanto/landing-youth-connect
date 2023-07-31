<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// HOME
$route['home'] = 'home';
$route['about'] = 'home/about';
$route['partnership-sponshorship'] = 'home/partnership_sponshorship';
$route['eligible-countries'] = 'home/eligible_countries';
$route['help-center'] = 'home/helpCenter';
$route['faq'] = 'home/faq';
$route['announcements'] = 'announcements';
$route['announcements/(:any)'] = 'announcements/detail/$1';

// AUTHENTICATION PROCESS
$route['sign-in'] = 'authentication';
$route['sign-up'] = 'authentication/signUp';
$route['sign-out'] = 'authentication/logout';
$route['offline'] = 'authentication/offline';
$route['verification-email'] = 'authentication/verificationEmail';
$route['forgot-password'] = 'authentication/forgotPassword';
$route['reset-password/(:any)'] = 'authentication/ubah_password/$1';

// USER
$route['user'] = 'user';
$route['user/overview'] = 'user';
$route['user/entry-paper'] = 'user/entryPaper';
$route['user/settings'] = 'user/settings';
$route['user/payments'] = 'user/payment';

// ADMIN
$route['admin'] = 'admin';
$route['admin/dashboard'] = 'admin';
$route['admin/statistics'] = 'admin/statistics';
$route['admin/participans'] = 'admin/participans';
$route['admin/payments'] = 'payments';
$route['admin/payment-settings'] = 'payments/settings';
$route['admin/participans/(:any)'] = 'admin/participans_detail/$1';
$route['master/announcements'] = 'master/manageList';
$route['master/faq'] = 'master/faq';
$route['master/master-faq'] = 'master/masterFaq';
$route['master/payment-batch'] = 'master/paymentBatch';
$route['master/entrant-form'] = 'master/entrantForm';
$route['admin/settings'] = 'admin/settings';
$route['admin/export-participants/(:num)'] = 'api/admin/export_participants/$1';
$route['admin/export-payments/(:num)'] = 'api/admin/export_payments/$1';

// PAYMENTS
$route['admin/payments-gateway-settings'] = 'Payments/paymentsGatewaySettings';

// DOCUMENTS
$route['document/generate-loa'] = 'api/user/generate_loa';
$route['document/generate-aggreement'] = 'api/user/generate_aggreement';

$route['default_controller'] = 'home';
$route['404_override'] = 'home/e_404';
$route['translate_uri_dashes'] = TRUE;
