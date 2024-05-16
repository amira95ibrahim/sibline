<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageStoreRequest;
use App\Http\Requests\PageUpdateRequest;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pages = Page::all();

        return view('admin.page.create', compact('pages'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $pages = Page::whereNull('parent_id')->get();

        return view('admin.page.create', compact('pages'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Page $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Page $page)
    {
        $pages = Page::whereNull('parent_id')->get();
        return view('admin.page.create', compact('page','pages'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Page $page
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Page $page)
    {
        return view('admin.page.create', compact('show'));
    }

    /**
     * @param \App\Http\Requests\PageStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageStoreRequest $request)
    {
        $page = $request->validated();
        // save image
        
        if($request->file('image')){
            $imageName = 'page_im_'.time().'.'.$request->image->extension();  
        
            $request->image->move(public_path('images'), $imageName);

            $page['image'] = $imageName;
        }
        // save icon
        
        if($request->file('icon')){
            $iconName = 'page_i_'.time().'.'.$request->icon->extension();  
        
            $request->icon->move(public_path('images'), $iconName);

            $page['icon'] = $iconName;
        }

        
        $page = Page::create($page);

        return redirect()->route('admin.page.create');
    }

    /**
     * @param \App\Http\Requests\PageUpdateRequest $request
     * @param \App\Models\Page $page
     * @return \Illuminate\Http\Response
     */
    public function update(PageUpdateRequest $request, Page $page)
    {
        $new_page = $request->validated();

        if($request->file('image')){

            $imageName = 'page_im_'.time().'.'.$request->image->extension();  
     
            $request->image->move(public_path('images'), $imageName);
    
            $new_page['image'] = $imageName;
        }

        if($request->file('icon')){

            $iconName = 'page_icon_'.time().'.'.$request->icon->extension();  
     
            $request->icon->move(public_path('images'), $iconName);
    
            $new_page['icon'] = $iconName;
        }

        $page->update($new_page);

        return redirect()->route('admin.page.create');
    }
}
