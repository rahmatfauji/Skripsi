<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "Admin";
$route['404_override'] = '';

//setting route untuk tabel karyawan
$route['data-karyawan-aktif.html']="Karyawan/index/y";
$route['data-karyawan-nonaktif.html']="Karyawan/index/n";

//setting route untuk tabel jabatan
$route['data-jabatan-aktif.html']="Jabatan/index/y";
$route['data-jabatan-nonaktif.html']="Jabatan/index/n";

//setting route untuk tabel penilaian
$route['data-penilaian-aktif.html']="Penilaian/index/y";
$route['data-penilaian-nonaktif.html']="Penilaian/index/n";

//setting route untuk detail
$route['data-detail-penilaian-(:any).html']="Detail_nilai/index/$1";
$route['data-normalisasi-penilaian-(:any).html']="Detail_nilai/normalisasi/$1";
$route['data-ranking-penilaian-(:any).html']="Detail_nilai/ranking/$1";

$route['home.html']="Admin/home";
$route['laporan-penilaian-(:any).html']="Laporan/detail/$1";
/* End of file routes.php */
/* Location: ./application/config/routes.php */