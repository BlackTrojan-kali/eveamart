<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers as controllers;;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[controllers\homepage_controller::class,"index"])->name('homePage');
Route::get('/login',[controllers\authRegisterController::class,"login"])->name("login");
Route::get("/loginAdmin",[controllers\adminPanelController::class,"login"])->name("loginAdmin")->middleware("guest");
Route::post("/adminAuth",[controllers\adminPanelController::class,"AdminAuth"])->name("adminAuth");
//admins actions
Route::group(["middleware"=>"admin"],function(){
    Route::get('/admin/dashboard',[controllers\adminPanelController::class,"dashboardAdmin"])->name("dashboard");
    Route::post('/admin/logoutAdmin',[controllers\adminPanelController::class,"logout"])->name("adminlogout");
    Route::get('/admin/blogs',[controllers\BlogController::class,"index"])->name("AdminBlogs");
    Route::get('/admin/blogs/{id}',[controllers\BlogController::class,"UpdateBlog"])->name("UpdateBlog");
    Route::get('/admin/createBlogs',[controllers\BlogController::class,"create"])->name("CreateBlogs");
    Route::post('/admin/blogs/{id}',[controllers\BlogController::class,"Update"])->name("UpdateTheBlog");
    Route::post('/admin/createB',[controllers\BlogController::class,"createBlog"])->name("PostBlog");
    Route::delete('/admin/DeleteB/{id}',[controllers\BlogController::class,"Delete"])->name("DeleteBlog");
    Route::get("/admin/specificInvoices/",[controllers\InvoiceController::class,"specificIncoices"])->name("showSpecificIvoices");
    Route::get("/admin/specificInvoice/{id}",[controllers\InvoiceController::class,"showOne"])->name("oneInvoice");
    Route::get("/admin/downloadInvoic/{id}",[controllers\InvoiceController::class,"download"])->name("downloadInvoicePdf");
    //super admin actions
    Route::group(["middleware"=>"superAdmin"],function(){

        Route::get("/admin/allInvoices",[controllers\InvoiceController::class,"show"])->name("ShowInvoices");
        Route::get('/admin/orderDetails/{id}',[controllers\OrderController::class,"showDetail"])->name("orderDetails");
        Route::get("/admin/downloadPdf/{id}",[controllers\OrderController::class,"download"])->name("downlaodPdf");
        Route::get('/admin/orders',[controllers\OrderController::class,"show"])->name("showOrders");
        Route::get('/admin/updateOrder/{id}',[controllers\OrderController::class,"changeStatus"])->name("changeStatus");
        Route::get('/admin/marts',[controllers\MartController::class,"index"])->name("AdminMart");
        Route::get('/admin/createMarts',[controllers\MartController::class,"createMart"])->name("CreateMarts");
        Route::post('/admin/createM',[controllers\MartController::class,"create"])->name("PostMart");
        Route::get('/admin/mart/{id}',[controllers\MartController::class,"UpdateMart"])->name("UpdateMart");
        Route::get('/admin/martManage/{id}',[controllers\MartController::class,"show"])->name("ManageMart");
        Route::get('/admin/martManageAssign/{id}',[controllers\MartController::class,"assign"])->name("AssignMart");
        Route::post('/admin/martManageAssign/{id}/{idMart}',[controllers\MartController::class,"AssignAdmin"])->name("AssignAdmin");
        Route::delete('/admin/martManageDelAssign/{id}/{idMart}',[controllers\MartController::class,"deleteAssignAdmin"])->name("UnAssignAdmin");
        Route::post('/admin/martU/{id}',[controllers\MartController::class,"Update"])->name("UpdateTheMart");
        Route::delete('/admin/delMart/{id}',[controllers\MartController::class,"destroy"])->name("deleteeMart");
        Route::get('/admin/Categories',[controllers\CategoryController::class,"index"])->name("ManageCategory");
        Route::post('/admin/Categories',[controllers\CategoryController::class,"createCategory"])->name("AddCategory");
        Route::get('/admin/Categories/{id}',[controllers\CategoryController::class,"update"])->name("UpdateCategory");
        Route::delete('/admin/delCategories/{id}',[controllers\CategoryController::class,"destroy"])->name("deleteCategory");
        Route::post('/admin/UCategories/{id}',[controllers\CategoryController::class,"updateCategory"])->name("UpCategory");
        Route::get('/admin/CreateProduct/{id}',[controllers\ProductController::class,"createProducts"])->name("CreateProduct");
        Route::get('/admin/UpdateProduct/{id}/{idMart}/{idCat}',[controllers\ProductController::class,"updateProduct"])->name("UpdateProduct");
        Route::post('/admin/CreateProducts',[controllers\ProductController::class,"create"])->name("PostProduct");
        Route::put('/admin/UpdateProduct/{id}',[controllers\ProductController::class,"update"])->name("UpProduct");
        Route::delete('/admin/deleteProduct/{id}',[controllers\ProductController::class,"destroy"])->name("DelProduct");
        Route::get('/admin/addAdmin',[controllers\adminPanelController::class,"addAdmin"])->name("addAdmin");
        Route::post('/admin/uploadAdmin',[controllers\adminPanelController::class,"registerAdmin"])->name("PostAdmin");
        Route::get('/admin/EditAdmin/{id}',[controllers\adminPanelController::class,"EditAdmin"])->name("EditAdmin");
        Route::delete('/admin/deleteAdmin/{id}',[controllers\adminPanelController::class,"destroy"])->name("deleteAdmin");
        Route::post('/admin/banUser/{id}',[controllers\UsersController::class,"ban"])->name("BanUser");
    });
    Route::get('/admin/GuestAdminMart/',[controllers\adminPanelController::class,"showMarts"])->name("ShowMarts");
    Route::get('/admin/Gmart/{id}',[controllers\MartController::class,"UpdateMart"])->name("UpdateGuestMart")->middleware("verifyOwner");
    Route::post('/admin/Gmart/{id}',[controllers\MartController::class,"Update"])->name("UpdateTheGMart")->middleware("verifyOwner");
    Route::get('/admin/marGtManage/{id}',[controllers\MartController::class,"show"])->name("ManageGuestMart")->middleware("verifyOwner");
    Route::get('/admin/CreateGProduct/{id}',[controllers\ProductController::class,"createProducts"])->name("CreateGProduct")->middleware("verifyOwner");
    Route::get('/admin/UpdateGProduct/{id}/{idMart}/{idCat}',[controllers\ProductController::class,"updateProduct"])->name("UpdateGProduct")->middleware("verifyOwnerProd");
    Route::post('/admin/CreateGProducts',[controllers\ProductController::class,"create"])->name("PostGProduct")->middleware("verifyOwnerProd");
    Route::put('/admin/UpGProduct/{id}',[controllers\ProductController::class,"update"])->name("UpGProduct")->middleware("verifyOwnerProd");
    Route::delete('/admin/deleteGProduct/{id}',[controllers\ProductController::class,"destroy"])->name("DelGProduct")->middleware("verifyOwnerProd");
    Route::get('/admin/profile',[controllers\adminPanelController::class,"profile"])->name("profile");
    Route::get('/admin/users',[controllers\UsersController::class,"index"])->name("users");
});
Route::get('/marts',[controllers\productListController::class,"martsList"])->name("marts");
Route::get("/mart/{id}",[controllers\DetailsController::class,"mart"])->name("martDetail");

//likez
Route::post("/prod/{idprod}/{iduser}",[controllers\ProductController::class,"like"])->name("liker");
Route::delete("/prod/{idprod}/{iduser}",[controllers\ProductController::class,"Unlike"])->name("unliker");
//commenter
Route::post("/prodcom/{idprod}/{userid}",[controllers\ProductController::class,"comment"])->name("commentProd");
Route::delete("/prodcomdel/{idprod}/{userid}",[controllers\ProductController::class,"uncomment"])->name("uncomment");
//follow
Route::post("martfol/{idmart}/{userid}",[controllers\MartController::class,"follow"])->name("followMart");
Route::delete("martunfol/{idmart}/{userid}",[controllers\MartController::class,"unfollow"])->name("unfollowMart");
//userprofile
Route::group(["middleware"=>"isMyProfile"],function(){
Route::get("/userprofile/{id}",[controllers\UsersController::class,"showprofile"])->name("userprofile");
Route::get("/userprofileUp/{id}",[controllers\UsersController::class,"showprofileup"])->name("userprofileUpdate");
Route::post("/userprofileUp/{id}",[controllers\UsersController::class,"updateprofile"])->name("postUpPro");
Route::get("/userlikes/{id}",[controllers\UsersController::class,"mylikes"])->name("myLikes");
Route::get("/userfollows/{id}",[controllers\UsersController::class,"abonnements"])->name("myfollows");
});
//cartfunctions
Route::get("/cart",[controllers\CartController::class,"showCart"])->name("cart");
Route::get("/addprod/{id}/{qty}",[controllers\CartController::class,"addtoCart"])->name("addstuff");
Route::get("/emptyCart",[controllers\CartController::class,"emptyCart"])->name("emptyCart");
Route::get("/delCart/{rowId}",[controllers\CartController::class,"delcart"])->name("delCart");
Route::get("/createOrder/{Delivery}/{weight}",[Controllers\CartController::class,"createOrder"])->name("createOrder");
Route::post("/storeAutheOrder/{Delivery}/{weight}",[Controllers\CartController::class,"storeAuthOrder"])->name("storeAuthOrder")->middleware("auth");
Route::post("/storeOrder/{Delivery}/{weight}",[Controllers\CartController::class,"storeOrder"])->name("storeOrder");

Route::get('/boutiques',[controllers\productListController::class,"showAllProds"])->name("boutique");
Route::get("/perCat/{id}",[controllers\productListController::class,"catProds"])->name("perCats");
Route::get('/product-detail/{id}',[controllers\DetailsController::class,"product"])->name("prodDetails");
Route::get("/blogs",[controllers\blogController::class,"showBlogs"])->name("blogList");
Route::get("/blogs/{id}",[controllers\blogController::class,"detail"])->name("blogDetails");
Route::get('/signup',[controllers\authRegisterController::class,"register"]);
Route::post('/store',[controllers\authRegisterController::class,"store"])->name('register_store');
Route::post('/authenticate',[controllers\authRegisterController::class,"authenticate"])->name('authenticate');
Route::post('/logout',[controllers\authRegisterController::class,"logout"])->name('logout');
