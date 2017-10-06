<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('reset_password/{token}', ['as' => 'password.reset', function($token)
{
    // implement your reset password route here!
}]);

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();



// get data
Route::get('home', 'HomeController@index');
Route::get('user', 'UserController@index');

Route::get('general/trainingloc', 'TrainingController@lokasitraining');
Route::get('general/trainingloc/delete/{id}', 'TrainingController@deletelokasi');
Route::get('general/trainingloc/formlokasi', 'TrainingController@formlokasi');
Route::get('general/trainingloc/editlokasi/{id}', 'TrainingController@editlokasi');

Route::get('general/usaha', 'GeneralController@usaha');
Route::get('general/usaha/delete/{id}', 'GeneralController@deleteusaha');
Route::get('general/usaha/form', 'GeneralController@formusaha');
Route::get('general/usaha/edit/{id}', 'GeneralController@editusaha');

Route::get('general/industri', 'GeneralController@industri');
Route::get('general/industri/delete/{id}', 'GeneralController@deleteindustri');
Route::get('general/industri/form', 'GeneralController@formindustri');
Route::get('general/industri/edit/{id}', 'GeneralController@editindustri');

Route::get('general/kapasitas', 'GeneralController@kapasitas');
Route::get('general/kapasitas/delete/{id}', 'GeneralController@deletekapasitas');
Route::get('general/kapasitas/form', 'GeneralController@formkapasitas');
Route::get('general/kapasitas/edit/{id}', 'GeneralController@editkapasitas');

Route::get('general/katresep', 'GeneralController@katresep');
Route::get('general/katresep/delete/{id}', 'GeneralController@deletekatresep');
Route::get('general/katresep/form', 'GeneralController@formkatresep');
Route::get('general/katresep/edit/{id}', 'GeneralController@editkatresep');

Route::get('general/katfaq', 'GeneralController@katfaq');
Route::get('general/katfaq/delete/{id}', 'GeneralController@deletekatfaq');
Route::get('general/katfaq/form', 'GeneralController@formkatfaq');
Route::get('general/katfaq/edit/{id}', 'GeneralController@editkatfaq');

Route::get('general/kotabuy', 'GeneralController@kotabuy');
Route::get('general/kotabuy/delete/{id}', 'GeneralController@deletekotabuy');
Route::get('general/kotabuy/form', 'GeneralController@formkotabuy');
Route::get('general/kotabuy/edit/{id}', 'GeneralController@editkotabuy');

Route::get('general/kotauser', 'GeneralController@kotauser');
Route::get('general/kotauser/delete/{id}', 'GeneralController@deletekotauser');
Route::get('general/kotauser/form', 'GeneralController@formkotauser');
Route::get('general/kotauser/edit/{id}', 'GeneralController@editkotauser');
///////////////////////////////////////

Route::get('approval/user', 'ApprovalController@user');
Route::get('approval/recipe', 'ApprovalController@recipe');
Route::get('approval/product', 'ApprovalController@product');
Route::get('approval/training', 'ApprovalController@training');
Route::get('approval/album', 'ApprovalController@album');
Route::get('approval/registran', 'ApprovalController@registran');

Route::get('approval/recipe/detail/{id}', 'ApprovalController@detailresep');
Route::get('approval/product/detail/{id}', 'ApprovalController@detailproduk');

Route::get('user/form', 'UserController@form');
Route::get('user/edit/{id}', 'UserController@edit');
Route::get('user/delete/{id}', 'UserController@delete');
Route::get('user/changepass/{id}', 'UserController@changepass');

Route::get('profile/', 'UserController@profile');
Route::get('profile/changepass', 'UserController@changeuserpass');

Route::get('user/community', 'UserController@community');
Route::get('user/community/form', 'UserController@formCommunity');
Route::get('user/community/edit/{id}', 'UserController@editCommunity');
Route::get('user/community/delete/{id}', 'UserController@deletecomm');

Route::get('recipe', 'RecipeController@index');
Route::get('recipe/form', 'RecipeController@form');
Route::get('recipe/edit/{id}', 'RecipeController@edit');
Route::get('recipe/delete/{id}', 'RecipeController@delete');

Route::get('product', 'ProductController@index');
Route::get('product/form', 'ProductController@form');
Route::get('product/edit/{id}', 'ProductController@edit');
Route::get('product/delete/{id}', 'ProductController@delete');
Route::get('product/category', 'ProductController@category');
Route::get('product/category/form', 'ProductController@productForm');
Route::get('product/category/edit/{id}', 'ProductController@editCategory');
Route::get('product/category/delete/{id}', 'ProductController@deleteCategory');

Route::get('training', 'TrainingController@index');
Route::get('training/form', 'TrainingController@form');
Route::get('training/edit/{id}', 'TrainingController@edit');
Route::get('training/delete/{id}', 'TrainingController@delete');

Route::get('training/registrant/{id}', 'TrainingController@registrant');

Route::get('gallery', 'GalleryController@index');
Route::get('gallery/form', 'GalleryController@form');
Route::get('gallery/{id}', 'GalleryController@album');
Route::get('gallery/edit/{id}', 'GalleryController@edit');
Route::get('gallery/delete/{id}', 'GalleryController@delete');

Route::get('album/edit/{id}', 'GalleryController@editalbum');
Route::get('album/delete/{id}', 'GalleryController@deletealbum');
Route::get('album/insert/{id}', 'GalleryController@insert');

Route::get('about/form', 'InfoController@form');

Route::get('faq', 'InfoController@faq');
Route::get('faq/form', 'InfoController@formpertanyaan');
Route::get('faq/pertanyaan/{id}', 'InfoController@pertanyaan');
Route::get('faq/delete/{id}', 'InfoController@deletefaq');
Route::get('faq/edit/{id}', 'InfoController@editfaq');

Route::get('faq/form/{id}', 'InfoController@formjawaban');
Route::get('faq/deletejwb/{id}', 'InfoController@deletejwb');

// add data
Route::post('user/add', 'UserController@add');
Route::post('user/community/add', 'UserController@addCommunity');
Route::post('recipe/add', 'RecipeController@add');
Route::post('training/add', 'TrainingController@add');
Route::post('product/add', 'ProductController@addProduct');
Route::post('product/addcategory', 'ProductController@addCategory');
Route::post('gallery/add', 'GalleryController@addGallery');
Route::post('album/insertphoto', 'GalleryController@insertPhoto');
Route::post('about/update', 'InfoController@update');

Route::post('faq/add', 'InfoController@addfaq');
Route::post('faq/addjwb', 'InfoController@addjawaban');

Route::post('general/trainingloc/add', 'TrainingController@addlokasi');
Route::post('general/usaha/add', 'GeneralController@addusaha');
Route::post('general/industri/add', 'GeneralController@addindustri');
Route::post('general/kapasitas/add', 'GeneralController@addkapasitas');
Route::post('general/katresep/add', 'GeneralController@addkatresep');
Route::post('general/katfaq/add', 'GeneralController@addkatfaq');
Route::post('general/kotabuy/add', 'GeneralController@addkotabuy');
Route::post('general/kotauser/add', 'GeneralController@addkotauser');

// berita
Route::get('berita', 'BeritaController@index');

// update data
Route::post('user/update', 'UserController@update');
Route::post('user/updatepass', 'UserController@updatepass');
Route::post('user/community/update', 'UserController@updateCommunity');
Route::post('recipe/update', 'RecipeController@update');
Route::post('product/update', 'ProductController@update');
Route::post('product/updatecategory', 'ProductController@updateCategory');
Route::post('training/update', 'TrainingController@update');
Route::post('gallery/update', 'GalleryController@update');
Route::post('album/update', 'GalleryController@updatealbum');

Route::post('faq/update', 'InfoController@updatefaq');

Route::post('general/trainingloc/updatelokasi', 'TrainingController@updatelokasi');
Route::post('general/usaha/update', 'GeneralController@updateusaha');
Route::post('general/industri/update', 'GeneralController@updateindustri');
Route::post('general/kapasitas/update', 'GeneralController@updatekapasitas');
Route::post('general/katresep/update', 'GeneralController@updatekatresep');
Route::post('general/katfaq/update', 'GeneralController@updatekatfaq');
Route::post('general/kotabuy/update', 'GeneralController@updatekotabuy');
Route::post('general/kotauser/update', 'GeneralController@updatekotauser');

//approve
Route::get('approve/user/{id}', 'ApprovalController@appUser');
Route::get('approve/recipe/{id}', 'ApprovalController@appResep');
Route::get('approve/product/{id}', 'ApprovalController@appProduk');
Route::get('approve/album/{id}', 'ApprovalController@appAlbum');
Route::get('approve/training/{id}', 'ApprovalController@appPelatihan');
Route::get('approve/registration/{id}', 'ApprovalController@appRegist');

//disapprove
Route::get('disapprove/user/{id}', 'ApprovalController@disappUser');
Route::get('disapprove/recipe/{id}', 'ApprovalController@disappResep');
Route::get('disapprove/product/{id}', 'ApprovalController@disappProduk');
Route::get('disapprove/album/{id}', 'ApprovalController@disappAlbum');
Route::get('disapprove/training/{id}', 'ApprovalController@disappPelatihan');
Route::get('disapprove/registration/{id}', 'ApprovalController@disappRegist');

// berita
Route::get('berita', 'BeritaController@index');
Route::get('berita/form', 'BeritaController@form');
Route::get('berita/edit/{id}', 'BeritaController@edit');
Route::get('berita/delete/{id}', 'BeritaController@delete');
Route::post('berita/add', 'BeritaController@add');
Route::post('berita/update', 'BeritaController@update');
Route::get('approval/berita', 'ApprovalController@berita');
Route::get('approve/berita/{id}', 'ApprovalController@appBerita');

//forum
Route::get('forumScc', 'ForumController@indexScc');
Route::get('forumUkm', 'ForumController@indexUkm');
Route::get('forum/scc/{id}', 'ForumController@viewCommentScc');
Route::get('forum/ukm/{id}', 'ForumController@viewCommentUkm');
Route::get('forumScc/delete/{id}', 'ForumController@deleteForumScc');
Route::get('forumUkm/delete/{id}', 'ForumController@deleteForumUkm');
Route::get('commentScc/delete/{idkomentar}/{idpost}', 'ForumController@deleteCommentScc');
Route::get('commentUkm/delete/{idkomentar}/{idpost}', 'ForumController@deleteCommentUkm');
Route::post('blockStickyScc/update', 'ForumController@blockStickyScc');
Route::post('blockStickyUkm/update', 'ForumController@blockStickyUkm');
Route::get('modalBlockSticky', 'ForumController@modalBlockSticky');

//email
Route::get('/sendEmailDone/{email}', 'Auth\RegisterController@sendEmailDone')->name('sendEmailDone');

Route::get('foo', function () {
   echo phpinfo();
});

//kontak
Route::get('kontak', 'AlamatController@index');
Route::get('kontak/form', 'AlamatController@form');
Route::post('kontak/add', 'AlamatController@add');
Route::get('kontak/delete/{id}', 'AlamatController@delete');
Route::get('kontak/edit/{id}', 'AlamatController@edit');
Route::post('kontak/update', 'AlamatController@update');