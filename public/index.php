<?
include('../app/Core/Route.php');
include('../app/Core/Helper.php');
include('../app/Controllers/MainController.php');
include('../app/Controllers/LoginController.php');

session_start();

// login

Route::add('/login',function (){
    (new LoginController())->showLoginForm();
},'get');
Route::add('/login',function (){
    (new LoginController())->login();
},'post');


// logout

Route::add('/logout',function (){
     (new LoginController())->logout();
},'get');


// create new job

Route::add('/job/create',function (){
     (new MainController())->create();
},'post');


// edit job

Route::add('/job/([0-9]*)/edit',function ($id){
    if (Helper::isAdmin()){
        (new MainController())->edit($id);
    } else {
        (new LoginController())->permError();
    }
},'get');

Route::add('/job/([0-9]*)/edit',function ($id){
    if (Helper::isAdmin()){
        (new MainController())->update($id);
    } else {
        (new LoginController())->permError();
    }
},'post');


// index page

Route::add('/',function (){
    (new MainController())->index();
},'get');

Route::run('/');