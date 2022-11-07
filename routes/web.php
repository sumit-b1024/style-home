<?php
use Illuminate\Support\Facades\Route;
use App\Models\Page;
use App\Models\City;
use Illuminate\Support\Facades\Artisan;

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | contains the "web" middleware group. Now create something great!
 * |
 */

Route::middleware("frontend_basic")->group(function (){

    Route::any('/get-chats',"AjaxController@get_admin_chat")->name('frontend.admin.chat.get');
    Route::any('/getcustomers',"AjaxController@getcustomers")->name('frontend.get.customers');
    Route::get('/',"HomeController@index")->name('frontend.home');
	Route::get('/designer',"HomeController@designer")->name('frontend.designer');
    Route::get('/designer-reset-password',"HomeController@designer_reset_password")->name('frontend.designer.reset.password');
    Route::post('/designer-reset-password',"HomeController@designer_reset_password_post")->name('frontend.designer.reset.password.post');
    Route::get('/designer-reset-password-new/{token}',"HomeController@designer_reset_password_new")->name('frontend.designer.reset.new.password');
	Route::post('/designer-reset-password-new',"HomeController@designer_reset_password_new_post")->name('frontend.designer.reset.password.new.post');
	Route::get('/project',"HomeController@project")->name('frontend.project');
	Route::get('/career',"HomeController@career")->name('frontend.career');
	Route::get('/contact',"HomeController@contact")->name('frontend.contact');
	Route::get('/faq',"HomeController@faq")->name('frontend.faq');
	//Route::get('/privacy-policy',"HomeController@privacy_policy")->name('frontend.privacy.policy');
	//Route::get('/term-condition',"HomeController@term_condition")->name('frontend.term.condition');
	Route::get('/detail-form',"HomeController@detail_form")->name('frontend.detail.form');
    Route::get('/project-detail',"HomeController@project_detail")->name('frontend.project.detail');
    Route::get('/login',"HomeController@login")->name('frontend.login');
    Route::get('/signup',"HomeController@signup")->name('frontend.signup');
    Route::get('/design-career',"HomeController@design_career")->name('frontend.design.career');
    Route::get('/our-book',"HomeController@our_book")->name('frontend.our.book');
    Route::get('/financing',"HomeController@financing")->name('frontend.financing');
    Route::get('/stories',"HomeController@stories")->name('frontend.stories');
    Route::get('/gift-card',"HomeController@gift_card")->name('frontend.gift.card');
    Route::get('/refer-earn',"HomeController@refer_earn")->name('frontend.refer.earn');
    Route::get('/help-center',"HomeController@help_center")->name('frontend.help.center');
    Route::get('/current-promotion',"HomeController@current_promotion")->name('frontend.current.promotion');
    Route::get('/review',"HomeController@review")->name('frontend.review');
    Route::post('/contact',"HomeController@storeEnquiry")->name('frontend.contactUs.post');
    Route::post('/register',"UserController@registerPost")->name('frontend.register.post');
    Route::post('/user/login',"UserController@login")->name('frontend.login.post');
     Route::post('/designer/login',"UserController@designer_login")->name('frontend.designer.login.post');
	Route::get('/apply-job/{slug}',"HomeController@apply_job")->name('frontend.apply.job');
	Route::post('/apply-job',"HomeController@apply_job_post")->name('frontend.apply.job.post');
	Route::get('/designer-login',"HomeController@designer_login")->name('frontend.designer.login');

	Route::post('/detail-form',"UserController@detail_form_post")->name('frontend.detail.form.post');
	Route::post('/project-detail',"UserController@project_detail_post")->name('frontend.project.detail.post');

	Route::any('/preferred-bedroom',"UserController@preferred_bedroom")->name('frontend.preferred.bedroom');
	Route::post('/dining-room',"UserController@dining_room")->name('frontend.diningroom');
	Route::post('/coffee-table',"UserController@coffee_table")->name('frontend.coffee.table');
	Route::post('/home-feel',"UserController@home_feel")->name('frontend.home.feel');
	Route::post('/home-area',"UserController@home_area")->name('frontend.home.area');
	Route::post('/start-project',"UserController@start_project")->name('frontend.start.project');

	Route::get('/designer/chat/{model}', 'UserController@designer_chat')->name('frontend.designer.chat');

	Route::post('/chat/upload/{user_id?}',"ChatController@upload")->name('frontend.chat.upload');
	Route::post('/send-message',"ChatController@sendMessage")->name('frontend.sendMessage');
	Route::get('/get-chat',"ChatController@getMessages")->name('frontend.chat.get');

	//Route::get('/how-it-work',"HomeController@how_it_work")->name('frontend.how.it.work');
	Route::any('/reset-password',"HomeController@reset_password")->name('frontend.reset.password');
	Route::post('/reset-password',"HomeController@reset_password_post")->name('frontend.reset.password.post');
	Route::any('/reset-password-new/{token}',"HomeController@reset_password_new")->name('frontend.reset.new.password');
	Route::post('/reset-password-new',"HomeController@reset_password_new_post")->name('frontend.reset.password.new.post');
	Route::get('/explore',"HomeController@explore")->name('frontend.explore');
    Route::get('/designer-bio/{model}',"HomeController@designer_bio")->name('frontend.designer.bio');
	Route::get('/project-view/{model}',"HomeController@project_view")->name('frontend.project.view');
	Route::get('/project-updates/{model}',"HomeController@project_updates")->name('frontend.project.updates');
	Route::get('/footer-menu/{slug}', 'HomeController@footer_menu')->name('frontend.footer.menu');
	Route::get('/checkout',"UserController@checkout")->name('frontend.subscription.checkout');
	Route::get('/product-checkout',"UserController@productCheckout")->name('frontend.product.checkout');

	Route::get('/payment-product',"UserController@paymentProduct")->name('frontend.product.payment-product');
	Route::post('/payment',"UserController@payment")->name('frontend.product.payment');
Route::post('/purchase', 'PaypalController@postPaymentWithStripe')->name('frontend.purchase');
Route::post('/purchase-product', 'PaypalController@postPaymentWithStripeProduct')->name('frontend.purchase-product');


	Route::post('/check_promocode',"UserController@checkPromocode")->name('frontend.subscription.check_promocode');

	Route::get('/products',"ProductController@index")->name('frontend.product.index');
	Route::get('/products/{id}/details',"ProductController@productDetail")->name('frontend.product.product_details');
	Route::post('/products/add_to_cart',"ProductController@addToCart")->name('frontend.product.addtocart');
	Route::post('/products/remove_to_cart',"ProductController@removeToCart")->name('frontend.product.removetocart');
	Route::post('/products/productlist',"ProductController@productList")->name('frontend.product.productlist');
	Route::post('/products/product-style',"ProductController@productwithstyletype")->name('frontend.product.prdwithstyletype');
    Route::post('/products/product-room-type',"ProductController@productwithroomtype")->name('frontend.product.prdwithroomtype');
    Route::post('/products/product-room-layout',"ProductController@productwithroomlayout")->name('frontend.product.prdwithroomlayout');
    Route::post('/products/product-country',"ProductController@productwithcountry")->name('frontend.product.prdwithcountry');
    Route::post('/products/allproducts',"ProductController@allProducts")->name('frontend.product.allproducts');
    Route::get('/products/downloads',"ProductController@designDownload")->name('frontend.product.downloads');



});
Route::post('paypal', array('as' => 'paypal','uses' => 'PaypalController@postPaymentWithpaypal',));
Route::post('stripe', array('as' => 'stripe','uses' => 'PaypalController@postPaymentWithstripe',));
Route::post('product-paypal', array('as' => 'product.paypal','uses' => 'PaypalController@postPaymentWithpaypalProduct'));
Route::get('paypal', array('as' => 'status','uses' => 'PaypalController@getPaymentStatus',))->name('paypal');
// routing for designer
Route::namespace('Designer')->prefix("designer")->group(function () {
	// Controllers Within The "App\Http\Controllers\Designer" Namespace
	Route::middleware("is_designer_admin")->group(function () {

	Route::get('designer-dashboard', function () {
            return view('admin.main.designer_dashboard');
        })->name('admin.designer.dashboard');

    Route::get('bio', 'BioController@morder')->name('admin.designer.bio');

    Route::get('project-list', 'BioController@project_list')->name('admin.designer.project.list');
    Route::get('payment-list', 'BioController@payment_list')->name('admin.designer.payment.list');
    Route::get('term-condition', 'BioController@term_condition')->name('admin.designer.term.condition');
    Route::get('profile', 'BioController@profile')->name('admin.designer.profile');
    Route::get('support-email', 'BioController@support_email')->name('admin.designer.support.email');
    Route::post('support-email', 'BioController@support_email_post')->name('admin.designer.support.email.post');
    Route::get('designer-faq', 'BioController@faq')->name('admin.designer.faq');
    Route::post('/bio',"BioController@bio_post")->name('admin.designer.bio.post');
    Route::post('/profile',"BioController@profile_post")->name('admin.designer.profile.post');
    Route::get('project-view/{project_id}', 'BioController@project_view')->name('admin.designer.project.view');

    //payment Request
	Route::get('/payment-request', 'PaymentRequestController@index')->name('designer.payment.request');
	Route::get('payment-request/add', 'PaymentRequestController@add')->name('designer.payment.request.add');
	Route::post('payment-request/add', 'PaymentRequestController@store')->name('designer.payment.request.add.post');
	Route::get('payment-request/update/{model}', 'PaymentRequestController@update')->name('designer.payment.request.update');
	Route::post('payment-request/update/{model}', 'PaymentRequestController@doUpdate')->name('designer.payment.request.update.post');
	//Route::get('payment-request/delete/{model}', 'PaymentRequestController@delete')->name('designer.payment.request.delete');
	//payment Request
    //Designer Project Update
		Route::get('project-update/{project_id}', 'ProjectController@index')->name('admin.designer.project.update');
		Route::get('project-update/add/{project_id}', 'ProjectController@add')->name('admin.designer.project.update.add');
		Route::post('project-update/add/{project_id}', 'ProjectController@store')->name('admin.designer.project.update.add.post');
		Route::get('project-update/update/{model}', 'ProjectController@update')->name('admin.designer.project.update.view');
		Route::post('project-update/update/{model}', 'ProjectController@doUpdate')->name('admin.designer.project.update.post');
		Route::get('project-update/delete/{model}', 'ProjectController@delete')->name('admin.designer.project.update.delete');
		//Designer Project Update
	Route::get('customer', 'BioController@customer')->name('admin.designer.customer');
	Route::get('designer-imaage/delete/{model}', 'BioController@delete_designer_image')->name('admin.designer.image.delete');
	//Test
	//Route::get('/customer', 'UserController@customer')->name('admin.designer.customer');
	Route::get('/customer/chat/{model}', 'UserController@customer_chat')->name('admin.designer.customer.chat');
	Route::post('/chat/upload/{user_id?}',"ChatController@upload")->name('designer.chat.upload');
	Route::post('/send-message',"ChatController@sendMessage")->name('designer.sendMessage');
	Route::get('/get-messages',"ChatController@getMessages")->name('designer.chat.get');
	//Test
	});

	});
// routing for admin
Route::namespace('Admin')->prefix("admin")->group(function () {
    // Controllers Within The "App\Http\Controllers\Admin" Namespace

    Route::get('login', function () {
        return view('admin.login');
    })->name('admin.login');

    Route::post('login', 'AuthController@login')->name('admin.login.post');
	Route::get('logout', 'AuthController@logout')->name('admin.logout');
	Route::get('designer-logout', 'AuthController@designer_logout')->name('admin.designer.logout');
	Route::get('customer-logout', 'AuthController@customer_logout')->name('admin.customer.logout');


    Route::middleware("is_admin")->group(function () {

        Route::get('dashboard', function () {
            return view('admin.main.dashboard');
        })->name('admin.dashboard');
        Route::get('banner', 'BannerController@banner')->name('admin.banner');
        Route::get('banner/add', function () {
            return view('admin.banner.add');
        })->name('admin.banner.add');
        Route::post('banner/add', 'BannerController@storeBanner')->name('admin.banner.add.post');
        Route::get('banner/update/{model}', 'BannerController@updateBanner')->name('admin.banner.update');
        Route::post('banner/update/{model}', 'BannerController@doUpdateBanner')->name('admin.banner.update.post');
        //Page Title
		Route::get('page-title', 'PageTitleController@index')->name('admin.page.title');
        Route::get('page-title/add', function () {
            return view('admin.page-title.add');
        })->name('admin.page.title.add');
        Route::post('page-title/add', 'PageTitleController@storeBanner')->name('admin.page.title.add.post');
        Route::get('page-title/update/{model}', 'PageTitleController@updateBanner')->name('admin.page.title.update');
        Route::post('page-title/update/{model}', 'PageTitleController@doUpdateBanner')->name('admin.page.title.update.post');
		//Page Title
        //Meta Tags
		Route::get('meta-tag/list', 'MetaTagController@metaTag')->name('admin.metaTag');
		Route::get('meta-tag/add', function () {
            return view('admin.meta-tag.add');
        })->name('admin.metaTag.add');
		Route::post('meta-tag/add', 'MetaTagController@storeMetaTag')->name('admin.metaTag.add.post');
		Route::get('meta-tag/update/{model}', 'MetaTagController@updateMetaTag')->name('admin.metaTag.update');
		Route::post('meta-tag/update/{model}', 'MetaTagController@doUpdateMetaTag')->name('admin.metaTag.update.post');
        //Meta Tags

        Route::post('homepage/section/{section_index}', 'PageController@storeHomepageSection')->where(['section_index' => '[1-4]',])->name('admin.homepage.section.post');

        Route::get('homepage/section/{section_index}', 'PageController@HomepageSection')->where(['section_index' => '[1-4]',])->name('admin.homepage.section');

		Route::post('other/other-information', 'PageController@storeOtherInformation')->name('admin.other.otherInformation.post');

        Route::get('other/other-information', 'PageController@otherInformation')->name('admin.other.otherInformation');

        Route::get('/enquiry', 'EnquiryController@index')->name('admin.enquiry');
        Route::get('/chat-communication', 'UserController@chat_communication')->name('admin.chat.communication');

        Route::get('/user', 'UserController@index')->name('admin.user');

        Route::get('/user/chat/{model}', 'UserController@chat')->name('admin.user.chat');

        //Jobs
		Route::get('/job', 'JobController@index')->name('admin.job');
		Route::get('job/add', 'JobController@add')->name('admin.job.add');
		Route::post('job/add', 'JobController@store')->name('admin.job.add.post');
		Route::get('job/update/{model}', 'JobController@update')->name('admin.job.update');
		Route::post('job/update/{model}', 'JobController@doUpdate')->name('admin.job.update.post');
		Route::get('job/delete/{model}', 'JobController@delete')->name('admin.job.delete');

		//Jobs
		//Designer Faq
		Route::get('/faq-designer', 'FaqController@designer_index')->name('admin.faq.designer');

		Route::get('faq-designer/add', 'FaqController@designer_add')->name('admin.faq.designer.add');

		Route::post('faq-designer/add', 'FaqController@designer_store')->name('admin.faq.designer.add.post');

		Route::get('faq-designer/update/{model}', 'FaqController@designer_update')->name('admin.faq.designer.update');

		Route::post('faq-designer/update/{model}', 'FaqController@designer_doUpdate')->name('admin.faq.designer.update.post');

		Route::get('faq-designer/delete/{model}', 'FaqController@designer_delete')->name('admin.faq.designer.delete');
		//Designer Faq
		//Quiz Answer Category
		Route::get('/quiz-category', 'QuizCategoryController@index')->name('admin.quiz.category');
		Route::get('quiz-category/add', 'QuizCategoryController@add')->name('admin.quiz.category.add');
		Route::post('quiz-category/add', 'QuizCategoryController@store')->name('admin.quiz.category.add.post');
		Route::get('quiz-category/update/{model}', 'QuizCategoryController@update')->name('admin.quiz.category.update');
		Route::post('quiz-category/update/{model}', 'QuizCategoryController@doUpdate')->name('admin.quiz.category.update.post');
        Route::get('quiz-category/delete/{model}', 'QuizCategoryController@delete')->name('admin.quiz.category.delete');
		//Quiz Answer Category
		//Faq
		Route::get('/faq', 'FaqController@index')->name('admin.faq');

		Route::get('faq/add', 'FaqController@add')->name('admin.faq.add');

		Route::post('faq/add', 'FaqController@store')->name('admin.faq.add.post');

		Route::get('faq/update/{model}', 'FaqController@update')->name('admin.faq.update');

		Route::post('faq/update/{model}', 'FaqController@doUpdate')->name('admin.faq.update.post');

		Route::get('faq/delete/{model}', 'FaqController@delete')->name('admin.faq.delete');
		//Faq
		//Privacy Policy
		Route::post('privacy-policy/section/{section_index}', 'PageController@storePrivacyPolicySection')->where([
            'section_index' => '[1-10]',])->name('admin.privacy.policy.section.post');

        Route::get('privacy-policy/section/{section_index}', 'PageController@privacyPolicySection')->where([
            'section_index' => '[1-10]',])->name('admin.privacyPolicy.section');
		//Privacy Policy
		//Terms Conditions
		Route::post('terms.conditions/section/{section_index}', 'PageController@storeTermsConditionsSection')->where([
            'section_index' => '[1-4]',])->name('admin.terms.conditions.section.post');

        Route::get('terms-conditions/section/{section_index}', 'PageController@TermsConditionsSection')->where([
            'section_index' => '[1-4]',])->name('admin.terms.conditions.section');
		//Terms Conditions
		//How it works
		Route::post('how-it-works/section/{section_index}', 'PageController@storeHowItWorkSection')->where([
            'section_index' => '[1-10]',])->name('admin.how.it.work.section.post');

        Route::get('how-it-works/section/{section_index}', 'PageController@howItWorkSection')->where([
            'section_index' => '[1-10]',])->name('admin.how.it.work.section');
		//How it works
		//Career
		Route::post('career/section/{section_index}', 'PageController@storeCareerSection')->where([
            'section_index' => '[1-10]',])->name('admin.career.section.post');

        Route::get('career/section/{section_index}', 'PageController@careerSection')->where([
            'section_index' => '[1-10]',])->name('admin.career.section');
		//Career
		//Design Career
		Route::post('design-career/section/{section_index}', 'PageController@storeDesignCareerSection')->where([
            'section_index' => '[1-10]',])->name('admin.design.career.section.post');

        Route::get('design-career/section/{section_index}', 'PageController@designCareerSection')->where([
            'section_index' => '[1-10]',])->name('admin.design.career.section');
		//Design Career
		//Our Book
		Route::post('our-book/section/{section_index}', 'PageController@storeOurBookSection')->where([
            'section_index' => '[1-10]',])->name('admin.our.book.section.post');

        Route::get('our-book/section/{section_index}', 'PageController@ourBookSection')->where([
            'section_index' => '[1-10]',])->name('admin.our.book.section');
		//Our Book
		//Financing
		Route::post('financing/section/{section_index}', 'PageController@storeFinancingSection')->where([
            'section_index' => '[1-10]',])->name('admin.financing.section.post');

        Route::get('financing/section/{section_index}', 'PageController@financingSection')->where([
            'section_index' => '[1-10]',])->name('admin.financing.section');
		//Financing
		//Stories
		Route::post('stories/section/{section_index}', 'PageController@storeStoriesSection')->where([
            'section_index' => '[1-10]',])->name('admin.stories.section.post');

        Route::get('stories/section/{section_index}', 'PageController@storiesSection')->where([
            'section_index' => '[1-10]',])->name('admin.stories.section');
		//Stories
		//Gift Cards
		Route::post('gift-card/section/{section_index}', 'PageController@storeGiftCardSection')->where([
            'section_index' => '[1-10]',])->name('admin.gift.card.section.post');

        Route::get('gift-card/section/{section_index}', 'PageController@giftCardSection')->where([
            'section_index' => '[1-10]',])->name('admin.gift.card.section');
		//Gift Cards
		//Refer Earn
		Route::post('refer-earn/section/{section_index}', 'PageController@storeReferEarnSection')->where([
            'section_index' => '[1-10]',])->name('admin.refer.earn.section.post');

        Route::get('refer-earn/section/{section_index}', 'PageController@referEarnSection')->where([
            'section_index' => '[1-10]',])->name('admin.refer.earn.section');
		//Refer Earn
		//Help Center
		Route::post('help-center/section/{section_index}', 'PageController@storeHelpCenterSection')->where([
            'section_index' => '[1-10]',])->name('admin.help.center.section.post');

        Route::get('help-center/section/{section_index}', 'PageController@helpCenterSection')->where([
            'section_index' => '[1-10]',])->name('admin.help.center.section');
		//Help Center
		//Current Promotion
		Route::post('current-promotion/section/{section_index}', 'PageController@storeCurrentPromotionSection')->where([
            'section_index' => '[1-10]',])->name('admin.current.promotion.section.post');

        Route::get('current-promotion/section/{section_index}', 'PageController@currentPromotionSection')->where([
            'section_index' => '[1-10]',])->name('admin.current.promotion.section');
		//Current Promotion
		//Review
		Route::post('review/section/{section_index}', 'PageController@storeReviewSection')->where([
            'section_index' => '[1-10]',])->name('admin.review.section.post');

        Route::get('review/section/{section_index}', 'PageController@reviewSection')->where([
            'section_index' => '[1-10]',])->name('admin.review.section');
		//Review
		//Quiz Question
		Route::get('/quiz-question', 'QuizQuestionController@index')->name('admin.quiz.question');
		Route::get('quiz-question/add', 'QuizQuestionController@add')->name('admin.quiz.question.add');
		Route::post('quiz-question/add', 'QuizQuestionController@store')->name('admin.quiz.question.add.post');
		Route::get('quiz-question/update/{model}', 'QuizQuestionController@update')->name('admin.quiz.question.update');
		Route::post('quiz-question/update/{model}', 'QuizQuestionController@doUpdate')->name('admin.quiz.question.update.post');
		Route::get('quiz-question/delete/{model}', 'QuizQuestionController@delete')->name('admin.quiz.question.delete');
		//Quiz Question
		//Quiz Answer
		Route::get('quiz/question.answer/{question_id}', 'QuizAnswerController@index')->name('admin.quiz.answer');
		Route::get('quiz/question.answer/add/{question_id}', 'QuizAnswerController@add')->name('admin.quiz.answer.add');
		Route::post('quiz/question.answer/add/{question_id}', 'QuizAnswerController@store')->name('admin.quiz.answer.add.post');
		Route::get('quiz/question.answer/update/{model}', 'QuizAnswerController@update')->name('admin.quiz.answer.update');
		Route::post('quiz/question.answer/update/{model}', 'QuizAnswerController@doUpdate')->name('admin.quiz.answer.update.post');
		Route::get('quiz/question.answer/delete/{model}', 'QuizAnswerController@delete')->name('admin.quiz.answer.delete');
		//Quiz Answer
		//Form Question
		Route::get('/form-question', 'FormQuestionController@index')->name('admin.form.question');
		//Route::get('form-question/add', 'FormQuestionController@add')->name('admin.form.question.add');
		//Route::post('form-question/add', 'FormQuestionController@store')->name('admin.form.question.add.post');
		Route::get('form-question/update/{model}', 'FormQuestionController@update')->name('admin.form.question.update');
		Route::post('form-question/update/{model}', 'FormQuestionController@doUpdate')->name('admin.form.question.update.post');
		//Form Question
		//Form Answer
		Route::get('form/question.answer/{question_id}', 'FormAnswerController@index')->name('admin.form.answer');
		Route::get('form/question.answer/add/{question_id}', 'FormAnswerController@add')->name('admin.form.answer.add');
		Route::post('form/question.answer/add/{question_id}', 'FormAnswerController@store')->name('admin.form.answer.add.post');
		Route::get('form/question.answer/update/{model}', 'FormAnswerController@update')->name('admin.form.answer.update');
		Route::post('form/question.answer/update/{model}', 'FormAnswerController@doUpdate')->name('admin.form.answer.update.post');
		Route::get('form/question.answer/delete/{model}', 'FormAnswerController@delete')->name('admin.form.answer.delete');
		//Form Answer

			Route::get('/customer-project', 'ProjectController@customer_project')->name('admin.customer.project');
			Route::get('customer-project/view/{project}', 'ProjectController@customer_project_view')->name('admin.customer.project.view');
			Route::get('customer-project/updates/{project}', 'ProjectController@customer_project_update')->name('admin.customer.project.update');


			Route::get('customer-project/reassign/{projectDetail}', 'ProjectController@reassign')->name('admin.customer.project.reassign');


			Route::get('customer-project/reassign/{projectDetail}/{user}', 'ProjectController@reassignConfirm')->name('admin.customer.project.update.reassign');

		//Testimonial
		Route::get('/testimonial', 'TestimonialController@index')->name('admin.testimonial');
		Route::get('testimonial/add', 'TestimonialController@add')->name('admin.testimonial.add');
		Route::post('testimonial/add', 'TestimonialController@store')->name('admin.testimonial.add.post');
		Route::get('testimonial/update/{model}', 'TestimonialController@update')->name('admin.testimonial.update');
        Route::post('testimonial/update/{model}', 'TestimonialController@doUpdate')->name('admin.testimonial.update.post');
        Route::get('testimonial/delete/{model}', 'TestimonialController@delete')->name('admin.testimonial.delete');
		//Testomonial

		//Coupon
		Route::get('/coupon', 'CouponController@index')->name('admin.coupon');
		Route::get('coupon/add', 'CouponController@add')->name('admin.coupon.add');
		Route::post('coupon/add', 'CouponController@store')->name('admin.coupon.add.post');
		Route::get('coupon/update/{model}', 'CouponController@update')->name('admin.coupon.update');
        Route::post('coupon/update/{model}', 'CouponController@doUpdate')->name('admin.coupon.update.post');
        Route::get('coupon/delete/{model}', 'CouponController@delete')->name('admin.coupon.delete');
		//Coupon

		//Products
		Route::get('/products', 'ProductAdminController@index')->name('admin.products');
		Route::get('products/add', 'ProductAdminController@add')->name('admin.products.add');
		Route::post('products/add', 'ProductAdminController@store')->name('admin.products.add.post');
		Route::get('products/update/{product}', 'ProductAdminController@update')->name('admin.products.update');
        Route::post('products/update/{product}', 'ProductAdminController@doUpdate')->name('admin.products.update.post');
        Route::get('products/delete/{product}', 'ProductAdminController@delete')->name('admin.products.delete');
        Route::post('products/getgroupitems',"ProductAdminController@getGroupItems")->name('admin.products.getgroupitems');
		//Products

		//Product filters
		Route::get('/filters', 'ProductFilterAdminController@index')->name('admin.filters');
		Route::get('filters/add', 'ProductFilterAdminController@add')->name('admin.filters.add');
		Route::post('filters/add', 'ProductFilterAdminController@store')->name('admin.filters.add.post');
		Route::get('filters/update/{group}', 'ProductFilterAdminController@update')->name('admin.filters.update');
        Route::post('filters/update/{group}', 'ProductFilterAdminController@doUpdate')->name('admin.filters.update.post');
        Route::get('filters/delete/{group}', 'ProductFilterAdminController@delete')->name('admin.filters.delete');
		//Product filters

        // Survey
        Route::get('/survey', 'SurveyAdminController@index')->name('admin.survey');
        // Survey

		//Subscription
		Route::get('/subscription', 'SubscriptionController@index')->name('admin.subscription');

		Route::get('subscription/add', 'SubscriptionController@add')->name('admin.subscription.add');

		Route::post('subscription/add', 'SubscriptionController@store')->name('admin.subscription.add.post');

		Route::get('subscription/update/{model}', 'SubscriptionController@update')->name('admin.subscription.update');

		Route::post('subscription/update/{model}', 'SubscriptionController@doUpdate')->name('admin.subscription.update.post');

		Route::get('subscription/delete/{model}', 'SubscriptionController@delete')->name('admin.subscription.delete');

		Route::get('subscription/addons/{subscription_id}', 'SubscriptionController@addons')->name('admin.subscription.addons');
		Route::get('subscription/addons/add/{subscription_id}', 'SubscriptionController@addons_add')->name('admin.subscription.addons.add');
		Route::post('subscription/addons/add/{subscription_id}', 'SubscriptionController@addons_store')->name('admin.subscription.addons.add.post');
		Route::get('subscription/addons/update/{model}', 'SubscriptionController@addons_update')->name('admin.subscription.addons.update');
		Route::post('subscription/addons/update/{model}', 'SubscriptionController@addons_doUpdate')->name('admin.subscription.addons.update.post');
		Route::get('subscription/addons/delete/{model}', 'SubscriptionController@addons_delete')->name('admin.subscription.answer.delete');
		//Subscription
		Route::get('/customer', 'UserController@index')->name('admin.user.customer');
        Route::get('/designer', 'UserController@designer_user')->name('admin.user.designer');
        Route::get('/designer-payment', 'UserController@designer_payment')->name('admin.designer.payment');
		Route::post('/designer-payment/{model}', 'UserController@designer_payment_post')->name('admin.designer.payment.request.post');
        Route::get('/user/inactive/{model}', 'UserController@user_inactive')->name('admin.user.inactive');
		Route::get('/user/active/{model}', 'UserController@user_active')->name('admin.user.active');

        Route::get('/enquiry', 'EnquiryController@index')->name('admin.enquiry');
        Route::post('/designer-registration', 'UserController@designer_registration')->name('admin.designer.registration');
		Route::get('/applied-designer', 'EnquiryController@applied_designer')->name('admin.applied.designer');
		Route::get('/view-applied-designer/{model}', 'EnquiryController@view_applied_designer')->name('admin.view.applied.designer');

		//Apply job form
		Route::get('/apply-job-form', 'ApplyFormController@index')->name('admin.apply.job.form');

		Route::get('apply-job-form/add', 'ApplyFormController@add')->name('admin.apply.job.form.add');

		Route::post('apply-job-form/add', 'ApplyFormController@store')->name('admin.apply.job.form.add.post');

		Route::get('apply-job-form/update/{model}', 'ApplyFormController@update')->name('admin.apply.job.form.update');

		Route::post('apply-job-form/update/{model}', 'ApplyFormController@doUpdate')->name('admin.apply.job.form.update.post');

		Route::get('apply-job-form/delete/{model}', 'ApplyFormController@delete')->name('admin.apply.job.form.delete');
		Route::get('apply-job-form/delete-option/{model}', 'ApplyFormController@delete_option')->name('admin.apply.job.form.delete.option');
		//Apply job form
		Route::get('/header-menu', 'MenuController@header_menu')->name('admin.header.menu');
		Route::get('/header-menu/inactive/{model}', 'MenuController@menu_inactive')->name('admin.header.menu.inactive');
		Route::get('/header-menu/active/{model}', 'MenuController@menu_active')->name('admin.header.menu.active');
		//Footer Menu
		Route::get('/footer-menu', 'MenuController@index')->name('admin.footer.menu');
		Route::get('footer-menu/add', 'MenuController@add')->name('admin.footer.menu.add');
		Route::post('footer-menu/add', 'MenuController@store')->name('admin.footer.menu.add.post');
		Route::get('footer-menu/update/{model}', 'MenuController@update')->name('admin.footer.menu.update');
		Route::post('footer-menu/update/{model}', 'MenuController@doUpdate')->name('admin.footer.menu.update.post');
		Route::get('footer-menu/delete/{model}', 'MenuController@delete')->name('admin.footer.menu.delete');
		//Footer Menu
		//Footer Menu Description
		Route::get('footer-menu/description/{menu_id}', 'MenuController@menu_description')->name('admin.footer.menu.description');
		Route::post('footer-menu/description/{menu_id}', 'MenuController@store_menu_description')->name('admin.footer.menu.description.post');
        //Footer Menu Description
        //Email Template
		Route::get('/email-template', 'EmailTemplateController@index')->name('admin.email.template');
		//Route::get('email-template/add', 'EmailTemplateController@add')->name('admin.email.template.add');
		//Route::post('email-template/add', 'EmailTemplateController@store')->name('admin.email.template.add.post');
		Route::get('email-template/update/{model}', 'EmailTemplateController@update')->name('admin.email.template.update');
		Route::post('email-template/update/{model}', 'EmailTemplateController@doUpdate')->name('admin.email.template.update.post');
		//Email Template
        //Quiz Result
		Route::get('/quiz-result', 'QuizQuestionController@quiz_result')->name('admin.quiz.result');
		Route::post('quiz-result/update', 'QuizQuestionController@quiz_result_update')->name('admin.quiz.result.update.post');
		//Quiz Result
        Route::post('ckeditor/upload', 'CkeditorController@upload')->name('ckeditor.upload');
    });

    Route::get('/clear', function () {
        Artisan::call('optimize:clear');
        return 'Config cache cleared';
    });
});

