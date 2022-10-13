<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Auth;


class PageController extends Controller
{


    public function storeServicesSection(Request $request, $section_index)
    {
        $model = Page::where([
            'type_id' => Page::TYPE_SERVICES
        ])->where([
            'section_index' => $section_index
        ])->first();

        if(empty($model))
        {
            $model = new Page();
            $model->type_id = Page::TYPE_SERVICES;

        }


        $model->section_index = $section_index;
        $model->html=$request->get("html");
        $model->created_by = Auth::user()->id;

        $model->save();

        return redirect()->back()->withSuccess("Section $section_index Updated Successfuly!!!");
    }

    public function servicesSection($section_index)
    {
        $page=Page::where(['section_index'=>$section_index])->where(['type_id'=>Page::TYPE_SERVICES])->first();
        return view('admin.services.section')->with(compact('section_index','page'));
    }

    public function storeHomepageSection(Request $request, $section_index)
    {
        $model = Page::where([
            'type_id' => Page::TYPE_HOMEPAGE
        ])->where([
            'section_index' => $section_index
        ])->first();

        if(empty($model))
        {
            $model = new Page();
            $model->type_id = Page::TYPE_HOMEPAGE;

        }


        $model->section_index = $section_index;
        $model->html=$request->get("html");
        $model->created_by = Auth::user()->id;

        $model->save();

        return redirect()->back()->withSuccess("Section $section_index Updated Successfuly!!!");
    }

    public function homepageSection($section_index)
    {
        $page=Page::where(['section_index'=>$section_index])->where(['type_id'=>Page::TYPE_HOMEPAGE])->first();
        return view('admin.homepage.section')->with(compact('section_index','page'));
    }

    //Privacy Policy
	public function storePrivacyPolicySection(Request $request, $section_index)
    {
        $model = Page::where([
            'type_id' => Page::TYPE_PRIVACY_POLICY
        ])->where([
            'section_index' => $section_index
        ])->first();

        if(empty($model))
        {
            $model = new Page();
            $model->type_id = Page::TYPE_PRIVACY_POLICY;

        }


        $model->section_index = $section_index;
        $model->html=$request->get("html");
        $model->created_by = Auth::user()->id;

        $model->save();

        return redirect()->back()->withSuccess("Section $section_index Updated Successfuly!!!");
    }

    public function PrivacyPolicySection($section_index)
    {
        $page=Page::where(['section_index'=>$section_index])->where(['type_id'=>Page::TYPE_PRIVACY_POLICY])->first();
        return view('admin.privacy-policy.section')->with(compact('section_index','page'));
    }
	//Privacy Policy
	//How it work
	public function storeHowItWorkSection(Request $request, $section_index)
    {
        $model = Page::where([
            'type_id' => Page::TYPE_HOW_IT_WORK
        ])->where([
            'section_index' => $section_index
        ])->first();

        if(empty($model))
        {
            $model = new Page();
            $model->type_id = Page::TYPE_HOW_IT_WORK;

        }


        $model->section_index = $section_index;
        $model->html=$request->get("html");
        $model->created_by = Auth::user()->id;

        $model->save();

        return redirect()->back()->withSuccess("Section $section_index Updated Successfuly!!!");
    }

    public function howItWorkSection($section_index)
    {
        $page=Page::where(['section_index'=>$section_index])->where(['type_id'=>Page::TYPE_HOW_IT_WORK])->first();
        return view('admin.how-it-work.section')->with(compact('section_index','page'));
    }
	//How it work

    //Terms Conditions
	public function storeTermsConditionsSection(Request $request, $section_index)
    {
        $model = Page::where([
            'type_id' => Page::TYPE_TERMS_CONDITIONS
        ])->where([
            'section_index' => $section_index
        ])->first();

        if(empty($model))
        {
            $model = new Page();
            $model->type_id = Page::TYPE_TERMS_CONDITIONS;

        }


        $model->section_index = $section_index;
        $model->html=$request->get("html");
        $model->created_by = Auth::user()->id;

        $model->save();

        return redirect()->back()->withSuccess("Section $section_index Updated Successfuly!!!");
    }

    public function TermsConditionsSection($section_index)
    {
        $page=Page::where(['section_index'=>$section_index])->where(['type_id'=>Page::TYPE_TERMS_CONDITIONS])->first();
        return view('admin.terms-conditions.section')->with(compact('section_index','page'));
    }
	//Terms Conditions

    //Career
	public function storeCareerSection(Request $request, $section_index)
    {
        $model = Page::where([
            'type_id' => Page::TYPE_CAREER
        ])->where([
            'section_index' => $section_index
        ])->first();

        if(empty($model))
        {
            $model = new Page();
            $model->type_id = Page::TYPE_CAREER;

        }
        $model->section_index = $section_index;
        $model->html=$request->get("html");
        $model->created_by = Auth::user()->id;
        $model->save();
        return redirect()->back()->withSuccess("Section $section_index Updated Successfuly!!!");
    }

    public function careerSection($section_index)
    {
        $page=Page::where(['section_index'=>$section_index])->where(['type_id'=>Page::TYPE_CAREER])->first();
        return view('admin.career.section')->with(compact('section_index','page'));
    }
	//Career

	//Design Career
	public function storeDesignCareerSection(Request $request, $section_index)
    {
        $model = Page::where([
            'type_id' => Page::TYPE_DESIGN_CAREER
        ])->where([
            'section_index' => $section_index
        ])->first();

        if(empty($model))
        {
            $model = new Page();
            $model->type_id = Page::TYPE_DESIGN_CAREER;

        }
        $model->section_index = $section_index;
        $model->html=$request->get("html");
        $model->created_by = Auth::user()->id;
        $model->save();
        return redirect()->back()->withSuccess("Section $section_index Updated Successfuly!!!");
    }

    public function designCareerSection($section_index)
    {
        $page=Page::where(['section_index'=>$section_index])->where(['type_id'=>Page::TYPE_DESIGN_CAREER])->first();
        return view('admin.design-career.section')->with(compact('section_index','page'));
    }
	//Design Career

	//Our Book
	public function storeOurBookSection(Request $request, $section_index)
    {
        $model = Page::where([
            'type_id' => Page::TYPE_OUR_BOOK
        ])->where([
            'section_index' => $section_index
        ])->first();

        if(empty($model))
        {
            $model = new Page();
            $model->type_id = Page::TYPE_OUR_BOOK;

        }
        $model->section_index = $section_index;
        $model->html=$request->get("html");
        $model->created_by = Auth::user()->id;
        $model->save();
        return redirect()->back()->withSuccess("Section $section_index Updated Successfuly!!!");
    }

    public function ourBookSection($section_index)
    {
        $page=Page::where(['section_index'=>$section_index])->where(['type_id'=>Page::TYPE_OUR_BOOK])->first();
        return view('admin.our-book.section')->with(compact('section_index','page'));
    }
	//Our Book

	//Financing
	public function storeFinancingSection(Request $request, $section_index)
    {
        $model = Page::where([
            'type_id' => Page::TYPE_FINANCING
        ])->where([
            'section_index' => $section_index
        ])->first();

        if(empty($model))
        {
            $model = new Page();
            $model->type_id = Page::TYPE_FINANCING;

        }
        $model->section_index = $section_index;
        $model->html=$request->get("html");
        $model->created_by = Auth::user()->id;
        $model->save();
        return redirect()->back()->withSuccess("Section $section_index Updated Successfuly!!!");
    }

    public function financingSection($section_index)
    {
        $page=Page::where(['section_index'=>$section_index])->where(['type_id'=>Page::TYPE_FINANCING])->first();
        return view('admin.financing.section')->with(compact('section_index','page'));
    }
	//Financing

	//Stories
	public function storeStoriesSection(Request $request, $section_index)
    {
        $model = Page::where([
            'type_id' => Page::TYPE_STORIES
        ])->where([
            'section_index' => $section_index
        ])->first();

        if(empty($model))
        {
            $model = new Page();
            $model->type_id = Page::TYPE_STORIES;

        }
        $model->section_index = $section_index;
        $model->html=$request->get("html");
        $model->created_by = Auth::user()->id;
        $model->save();
        return redirect()->back()->withSuccess("Section $section_index Updated Successfuly!!!");
    }

    public function storiesSection($section_index)
    {
        $page=Page::where(['section_index'=>$section_index])->where(['type_id'=>Page::TYPE_STORIES])->first();
        return view('admin.stories.section')->with(compact('section_index','page'));
    }
	//Stories

	//Gift Card
	public function storeGiftCardSection(Request $request, $section_index)
    {
        $model = Page::where([
            'type_id' => Page::TYPE_GIFT_CARD
        ])->where([
            'section_index' => $section_index
        ])->first();

        if(empty($model))
        {
            $model = new Page();
            $model->type_id = Page::TYPE_GIFT_CARD;

        }
        $model->section_index = $section_index;
        $model->html=$request->get("html");
        $model->created_by = Auth::user()->id;
        $model->save();
        return redirect()->back()->withSuccess("Section $section_index Updated Successfuly!!!");
    }

    public function giftCardSection($section_index)
    {
        $page=Page::where(['section_index'=>$section_index])->where(['type_id'=>Page::TYPE_GIFT_CARD])->first();
        return view('admin.gift-card.section')->with(compact('section_index','page'));
    }
	//Gift Card

	//Refer Earn
	public function storeReferEarnSection(Request $request, $section_index)
    {
        $model = Page::where([
            'type_id' => Page::TYPE_REFER_EARN
        ])->where([
            'section_index' => $section_index
        ])->first();

        if(empty($model))
        {
            $model = new Page();
            $model->type_id = Page::TYPE_REFER_EARN;

        }
        $model->section_index = $section_index;
        $model->html=$request->get("html");
        $model->created_by = Auth::user()->id;
        $model->save();
        return redirect()->back()->withSuccess("Section $section_index Updated Successfuly!!!");
    }

    public function referEarnSection($section_index)
    {
        $page=Page::where(['section_index'=>$section_index])->where(['type_id'=>Page::TYPE_REFER_EARN])->first();
        return view('admin.refer-earn.section')->with(compact('section_index','page'));
    }
	//Refer Earn

	//Help Center
	public function storeHelpCenterSection(Request $request, $section_index)
    {
        $model = Page::where([
            'type_id' => Page::TYPE_HELP_CENTER
        ])->where([
            'section_index' => $section_index
        ])->first();

        if(empty($model))
        {
            $model = new Page();
            $model->type_id = Page::TYPE_HELP_CENTER;

        }
        $model->section_index = $section_index;
        $model->html=$request->get("html");
        $model->created_by = Auth::user()->id;
        $model->save();
        return redirect()->back()->withSuccess("Section $section_index Updated Successfuly!!!");
    }

    public function helpCenterSection($section_index)
    {
        $page=Page::where(['section_index'=>$section_index])->where(['type_id'=>Page::TYPE_HELP_CENTER])->first();
        return view('admin.help-center.section')->with(compact('section_index','page'));
    }
	//Help Center

	//Current Promotion
	public function storeCurrentPromotionSection(Request $request, $section_index)
    {
        $model = Page::where([
            'type_id' => Page::TYPE_CURRENT_PROMOTION
        ])->where([
            'section_index' => $section_index
        ])->first();

        if(empty($model))
        {
            $model = new Page();
            $model->type_id = Page::TYPE_CURRENT_PROMOTION;

        }
        $model->section_index = $section_index;
        $model->html=$request->get("html");
        $model->created_by = Auth::user()->id;
        $model->save();
        return redirect()->back()->withSuccess("Section $section_index Updated Successfuly!!!");
    }

    public function currentPromotionSection($section_index)
    {
        $page=Page::where(['section_index'=>$section_index])->where(['type_id'=>Page::TYPE_CURRENT_PROMOTION])->first();
        return view('admin.current-promotion.section')->with(compact('section_index','page'));
    }
	//Current Promotion

	//Review
	public function storeReviewSection(Request $request, $section_index)
    {
        $model = Page::where([
            'type_id' => Page::TYPE_REVIEW
        ])->where([
            'section_index' => $section_index
        ])->first();

        if(empty($model))
        {
            $model = new Page();
            $model->type_id = Page::TYPE_REVIEW;

        }
        $model->section_index = $section_index;
        $model->html=$request->get("html");
        $model->created_by = Auth::user()->id;
        $model->save();
        return redirect()->back()->withSuccess("Section $section_index Updated Successfuly!!!");
    }

    public function reviewSection($section_index)
    {
        $page=Page::where(['section_index'=>$section_index])->where(['type_id'=>Page::TYPE_REVIEW])->first();
        return view('admin.review.section')->with(compact('section_index','page'));
    }
	//Review

    public function storeOtherInformation (Request $request)
    {
        $model= Setting::first();
        if(empty($model))
        {
            $model= new Setting();
        }
        $request->validate([
            'office_address' => 'required',
            'contact_number' => 'sometimes|nullable',
            'tax' => 'nullable|numeric',
            'contact_email' => 'required|email',
            'admin_email' => 'required|email',
            'facebook_page_link'=>'sometimes|nullable|url',
            'instagram_page_link'=>'sometimes|nullable|url',
            'pinterest_page_link'=>'sometimes|nullable|url',
            'footer_copyright_text'  => 'sometimes|nullable'

        ]);
        $data1=$request->except('_token');

        if ($request->hasFile('site_logo')) {
            $filenamewithextension = $request->file('site_logo')->getClientOriginalName();
			$filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
			$extension = $request->file('site_logo')->getClientOriginalExtension();
			$imageName = $filename.'_'.time().'.'.$extension;
			$request->site_logo->move(public_path('uploads/site'), $imageName);

            $data1['site_logo']=$imageName;
        }

        if ($request->hasFile('site_footer_logo')) {
            $filenamewithextension = $request->file('site_footer_logo')->getClientOriginalName();
			$filename1 = pathinfo($filenamewithextension, PATHINFO_FILENAME);
			$extension1 = $request->file('site_footer_logo')->getClientOriginalExtension();
			$site_footer_logo = $filename1.'_'.time().'.'.$extension1;
			$request->site_footer_logo->move(public_path('uploads/site'), $site_footer_logo);
            $data1['site_footer_logo']=$site_footer_logo;
        }

        $model->fill($data1);
        $model->save();


        return redirect()->back()->withSuccess(__('Website Settings changed Successfully'));




    }

    public function otherInformation()
    {
        $model=Setting::first();
        return view('admin.other.otherInformation')->with(['model'=>$model]);
    }


}
