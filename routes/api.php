<?php

use Dingo\Api\Routing\Router;

/** @var Router $api */
$api = app(Router::class);

$api->version('v1', function (Router $api) {
    $api->group(['prefix' => 'auth', 'middleware' => 'cors'], function(Router $api) {
        $api->post('signup', 'App\\Api\\V1\Controllers\\SignUpController@signUp');
        $api->post('login', 'App\\Api\\V1\\Controllers\\LoginController@login');
        $api->post('recovery', 'App\\Api\\V1\\Controllers\\ForgotPasswordController@sendResetEmail');
        // $api->post('reset', 'App\\Api\\V1\\Controllers\\ResetPasswordController@resetPassword');
        $api->post('forgot', 'App\\Api\\V1\\Controllers\\UserController@forgot');
        $api->post('reset','App\\Api\\V1\\Controllers\\UserController@resetForm');
        $api->post('timeout', 'App\\Api\\V1\\Controllers\\UserController@timeout');
        $api->post('doReset','App\\Api\\V1\\Controllers\\UserController@doReset');
    });

    $api->group(['middleware' => ['jwt.auth', 'cors']], function(Router $api) {
        $api->get('protected', function() {
            return response()->json([
                'message' => 'Access to this item is only for authenticated user. Provide a token in your request!'
            ]);
        });

        $api->get('refresh', [
            'middleware' => 'jwt.refresh',
            function() {
                return response()->json([
                    'message' => 'By accessing this endpoint, you can refresh your access token at each request. Check out this response headers!'
                ]);
            }
        ]);



        //User API
        $api->get('user', 'App\\Api\\V1\\Controllers\\UserController@getCurrentUser'); //get current logged in user
        $api->post('editprofile','App\\Api\\V1\\Controllers\\UserController@editUser');

        //UKM
        $api->get('ukmlist', 'App\\Api\\V1\\Controllers\\UserController@getListUkm');

        //Komunitas
        $api->get('komunitas', 'App\\Api\\V1\\Controllers\\UserController@getKomunitas');

        //Training
        $api->get('list', 'App\\Api\\V1\\Controllers\\TrainingController@getList');
        $api->get('register/{id}', 'App\\Api\\V1\\Controllers\\TrainingController@register');
        $api->get('riwayat', 'App\\Api\\V1\\Controllers\\TrainingController@getRiwayat');

        //Forum
        $api->get('forumscc', 'App\\Api\\V1\\Controllers\\ForumController@threadsScc');
        $api->get('forumscc/{idthread}', 'App\\Api\\V1\\Controllers\\ForumController@getThreadScc');
        $api->get('forumukm', 'App\\Api\\V1\\Controllers\\ForumController@threadsUkm');
        $api->get('forumukm/{idthread}', 'App\\Api\\V1\\Controllers\\ForumController@getThreadUkm');
        $api->post('threadscc', 'App\\Api\\V1\\Controllers\\ForumController@postThreadScc');
        $api->post('threadukm', 'App\\Api\\V1\\Controllers\\ForumController@postThreadUkm');
        $api->post('comment/{idthread}', 'App\\Api\\V1\\Controllers\\ForumController@postComment');
    });

    $api->get('hello', function() {
        return response()->json([
            'message' => 'Hi there!'
        ]);
    });

    $api->group(['middleware' => 'cors'], function(Router $api) {
        //Public accessible

        //Recipe API
        $api->get('recipe', 'App\\Api\\V1\\Controllers\\RecipeController@getRecipeList');
        $api->get('recipe/category/{id_category}', 'App\\Api\\V1\\Controllers\\RecipeController@getRecipeByCategory');
        $api->get('recipe/{id_recipe}', 'App\\Api\\V1\\Controllers\\RecipeController@getRecipeById');

        //Info & About API
        $api->get('about', 'App\\Api\\V1\\Controllers\\InfoController@about');
        $api->get('faq', 'App\\Api\\V1\\Controllers\\InfoController@faq');
        $api->get('faqs', 'App\\Api\\V1\\Controllers\\InfoController@faqCategories');
        $api->get('faqs/{idcategory}', 'App\\Api\\V1\\Controllers\\InfoController@faqQuestions');
        $api->get('faqs/{idcategory}/{idquestion}', 'App\\Api\\V1\\Controllers\\InfoController@faqAnswers');

        $api->get('productcat', 'App\\Api\\V1\\Controllers\\InfoController@getProductCategory');
        $api->get('product', 'App\\Api\\V1\\Controllers\\InfoController@getProductList');
        $api->get('product/{id_product}', 'App\\Api\\V1\\Controllers\\InfoController@getProductById');
        $api->get('location', 'App\\Api\\V1\\Controllers\\InfoController@getLocationList');
        $api->get('location/{kota}', 'App\\Api\\V1\\Controllers\\InfoController@getLocationByKota');
        $api->get('location/{kota}/{idlokasi}', 'App\\Api\\V1\\Controllers\\InfoController@getLocationById');

        //Galeri API
        $api->get('album', 'App\\Api\\V1\\Controllers\\GalleryController@getAlbum');
        $api->get('album/{idgallery}', 'App\\Api\\V1\\Controllers\\GalleryController@getGallery');
        $api->get('album/{idgallery}/{idphoto}', 'App\\Api\\V1\\Controllers\\GalleryController@getPhoto');

        $api->get('slider', 'App\\Api\\V1\\Controllers\\InfoController@slider');

        //Alamat API
        $api->get('alamat', 'App\\Api\\V1\\Controllers\\AlamatController@getAlamat');

        //Dropdown user regist API
        $api->get('dropdown', 'App\\Api\\V1\\Controllers\\UserController@getDropDown');

        //Image upload
        $api->post('upload', 'App\\Api\\V1\\Controllers\\ImageController@uploadImage' );

        //News
        $api->get('news', 'App\\Api\\V1\\Controllers\\NewsController@getNews');
        $api->get('news/{id}', 'App\\Api\\V1\\Controllers\\NewsController@getNewsById');

    });
});
