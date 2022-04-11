<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;
use App\Models\Price_ceasa_bh;
use App\Models\Ceasa_product;

class HomeController extends Controller
{
    /*
     * Dashboard Pages Routs
     */
   
     public function index(Request $request)
    {
       
        $last_date = DB::table('price_ceasa_bhs')->max('date');
        // $last_cotacao= Price_ceasa_bh::where('date', '=', $last_date)->get();
        $last_cotacoes= DB::table('price_ceasa_bhs')->where('date', '=', $last_date)->where('product', 'LIKE', 'PIMENTAO AMARELO')->get();
      dd($last_cotacoes);

        return view('dashboards.dashboard',compact('last_cotacoes'));
    }

    /*
     * Menu Style Routs
     */
    public function horizontal(Request $request)
    {
        return view('MenuStyle.horizontal');
    }
    public function dualhorizontal(Request $request)
    {
        return view('MenuStyle.dualhorizontal');
    }
    public function dualcompact(Request $request)
    {
        return view('MenuStyle.dualcompact');
    }
    public function boxed(Request $request)
    {
        return view('MenuStyle.boxed');
    }
    public function boxedfancy(Request $request)
    {
        return view('MenuStyle.boxedfancy');
    }

    /*
     * Pages Routs
     */
    public function billing(Request $request)
    {
        return view('special-pages.billing');
    }

    public function calender(Request $request)
    {
        return view('special-pages.calender');
    }

    public function kanban(Request $request)
    {
        return view('special-pages.kanban');
    }

    public function pricing(Request $request)
    {
        return view('special-pages.pricing');
    }

    public function rtlsupport(Request $request)
    {
        return view('special-pages.rtlsupport');
    }

    public function timeline(Request $request)
    {
        return view('special-pages.timeline');
    }


    /*
     * Widget Routs
     */
    public function widgetbasic(Request $request)
    {
        return view('Widget.widgetbasic');
    }
    public function widgetchart(Request $request)
    {
        return view('Widget.widgetchart');
    }
    public function widgetcard(Request $request)
    {
        return view('Widget.widgetcard');
    }

    /*
     * Maps Routs
     */
    public function google(Request $request)
    {
        return view('Maps.google');
    }
    public function vector(Request $request)
    {
        return view('Maps.vector');
    }

    /*
     * Auth Routs
     */
    public function signin(Request $request)
    {   
        // dd('HomeController/signin');
        return view('auth.login');
    }
    public function signup(Request $request)
    {
        return view('auth.register');
    }
    public function confirmmail(Request $request)
    {
        return view('auth.confirmmail');
    }
    public function lockscreen(Request $request)
    {
        return view('auth.lockscreen');
    }
    public function recoverpw(Request $request)
    {
        return view('auth.recoverpw');
    }
    public function userprivacysetting(Request $request)
    {
        return view('auth.userprivacysetting');
    }

    /*
     * App Page Routs
     */

    public function userprofile(Request $request)
    {
        return view('Users.userprofile');
    }

    public function useradd(Request $request)
    {
        
        $user = auth()->user();

       // dd($user);

        return view('Users.useradd',compact('user'));
    }

    public function userlist(Request $request)
    {
       $users = User::all();

      //  dd($users);

        return view('Users.userlist',compact('users'));
    }

    /*
     * Error Page Routs
     */

    public function error404(Request $request)
    {
        return view('errors.error404');
    }

    public function error500(Request $request)
    {
        return view('errors.error500');
    }
    public function maintenance(Request $request)
    {
        return view('errors.maintenance');
    }
    
    /*
     * uisheet Page Routs
     */
    public function uisheet(Request $request)
    {
       // return view('uisheet');
       return view('dashboards.dashboard');
    }

    /*
     * Form Page Routs
     */
    public function element(Request $request)
    {
        return view('forms.element');
    }

    public function wizard(Request $request)
    {
        return view('forms.wizard');
    }

    public function validation(Request $request)
    {
        return view('forms.validation');
    }

     /*
     * Table Page Routs
     */
    public function bootstraptable(Request $request)
    {
        return view('table.bootstraptable');
    }

    public function datatable(Request $request)
    {
        return view('table.datatable');
    }

    /*
     * Icons Page Routs
     */

    public function solid(Request $request)
    {
        return view('Icons.solid');
    }

    public function outline(Request $request)
    {
        return view('Icons.outline');
    }

    public function dualtone(Request $request)
    {
        return view('Icons.dualtone');
    }

    public function colored(Request $request)
    {
        return view('Icons.colored');
    }

    /*
     * Extra Page Routs
     */
    public function PrivacyPolicy(Request $request)
    {
        return view('PrivacyPolicy');
    }
    public function TermsofUse(Request $request)
    {
        return view('TermsofUse');
    }
}
