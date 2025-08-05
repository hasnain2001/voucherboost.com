<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Categories;
use App\Models\DeleteBlogs;
use App\Models\Language;
use App\Models\Stores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\ImageOptimizer\OptimizerChainFactory;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

class BlogController extends Controller
{

      public function blogs_show() {
        $blogs = Blog::with('category','store','language')->select('id','title','image','category_id','store_id','language_id')->orderby('created_at','desc')->get();
        return view('employee.Blog.show', compact('blogs'));
    }


    public function create() {
        $categories = Categories::orderBy('created_at','desc')->get();
        $stores = Stores::orderBy('created_at','desc')->get();
        $langs = Language::orderBy('created_at','desc')->get();
        return view('employee.Blog.create',compact('categories','stores','langs'));
    }


    public function store(Request $request)
    {
       $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blogs,slug',
            'content' => 'required|string',
            'category_id' => 'required|string',
            'store_id' => 'required|string',
             'language_id' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'meta_keyword' => 'nullable|string',
            'top' => 'nullable|string',
        ]);

        // Handle category image upload with title-based filename
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $imageName = Str::slug($request->input('title')) . '.' . $extension;
            $imagePath = 'uploads/blog/' . $imageName;
            $image->move(public_path('uploads/blog'), $imageName);

            if (file_exists(public_path($imagePath))) {
                $optimizer = OptimizerChainFactory::create();
                $optimizer->optimize(public_path($imagePath));
            }
        }

        // Process content images
        $content = $request->input('content');
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML('<?xml encoding="UTF-8">' . $content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();

        foreach ($dom->getElementsByTagName('img') as $img) {
            $src = $img->getAttribute('src');
            if (strpos($src, 'data:image/') === 0) {
                $parts = explode(';', $src);
                $typeParts = explode('/', $parts[0]);
                $extension = $typeParts[1];
                $imageData = base64_decode(explode(',', $parts[1])[1]);

                $imageName = Str::slug($request->input('title')) . '-content-' . Str::random(5) . '.' . $extension;
                $path = public_path('uploads/blog/') . $imageName;
                file_put_contents($path, $imageData);

                $img->setAttribute('src', asset('uploads/blog/' . $imageName));
            }
        }

        // Create and save blog
        $blog = Blog::create([
            'title' => $request->input('title'),
            'slug' => $request->input('slug'),
            'top' => $request->input('top', 'none'),
            'image' => $imagePath,
            'category_id' => $request->input('category_id'),
            'store_id' => $request->input('store_id'),
            'language_id' => $request->input('language_id'),
            'meta_title' => $request->input('meta_title'),
            'meta_description' => $request->input('meta_description'),
            'meta_keyword' => $request->input('meta_keyword'),
            'user_id' => Auth::id(),
            'content' => $dom->saveHTML(),
        ]);

        return redirect()->route('employee.blog.index')->with('success', 'Blog created successfully.');
    }


    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $categories = Categories::orderBy('created_at','desc')->get();
        $stores = Stores::orderBy('created_at','desc')->get();
        $langs = Language::orderBy('created_at','desc')->get();
        return view('employee.Blog.edit', compact('blog','categories','stores','langs'));
    }

    public function update(Request $request, $id)
    {
         // Validate request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blogs,slug,' . $id,
            'content' => 'required|string',
            'category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'category_id' => 'required|exists:categories,id',
            'store_id' => 'required|exists:stores,id',
            'language_id' => 'required|exists:language,id',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keyword' => 'nullable|string|max:255',
            'top' => 'nullable|string|in:top,none',
        ]);

        // Find the blog by ID
        $blog = Blog::findOrFail($id);

        // Handle image upload if provided
        if ($request->hasFile('category_image')) {
            // Delete the old image if it exists
            if ($blog->category_image && file_exists(public_path($blog->category_image))) {
                unlink(public_path($blog->category_image));
            }

            // Save the new image with title-based filename
            $image = $request->file('category_image');
            $extension = $image->getClientOriginalExtension();
            $imageName = Str::slug($request->input('title')) . '-' . time() . '.' . $extension;
            $imagePath = 'uploads/blog/' . $imageName;
            $image->move(public_path('uploads/blog'), $imageName);

            // Optimize the image if it was successfully saved
            if (file_exists(public_path($imagePath))) {
                $optimizer = OptimizerChainFactory::create();
                $optimizer->optimize(public_path($imagePath));
                $blog->category_image = $imagePath;
            }
        }

        // Process content images
        $content = $request->input('content');
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML('<?xml encoding="UTF-8">' . $content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();

        foreach ($dom->getElementsByTagName('img') as $img) {
            $src = $img->getAttribute('src');
            if (strpos($src, 'data:image/') === 0) {
                $parts = explode(';', $src);
                $typeParts = explode('/', $parts[0]);
                $extension = $typeParts[1];
                $imageData = base64_decode(explode(',', $parts[1])[1]);

                $imageName = Str::slug($request->input('title')) . '-content-' . Str::random(5) . '.' . $extension;
                $path = public_path('uploads/blog/') . $imageName;
                file_put_contents($path, $imageData);

                $img->setAttribute('src', asset('uploads/blog/' . $imageName));
            }
        }

            // Update blog fields with fallback to existing values
            $blog->update([
                'title' => $request->input('title', $blog->title),
                'slug' => $request->input('slug', $blog->slug),
                'top' => $request->input('top', $blog->top ?? 'none'),
                'category_id' => $request->input('category_id', $blog->category_id),
                'store_id' => $request->input('store_id', $blog->store_id),
                'language_id' => $request->input('language_id', $blog->language_id),
                'meta_title' => $request->input('meta_title', $blog->meta_title),
                'meta_description' => $request->input('meta_description', $blog->meta_description),
                'meta_keyword' => $request->input('meta_keyword', $blog->meta_keyword),
                'content' => $dom->saveHTML() ?: $blog->content,
            ]);

        return redirect()->route('employee.blog.index')->with('success', 'Blog updated successfully.');
    }


    public function destroy($id)
    {

        $blog = Blog::findOrFail($id);
       if ($blog) {
           // Log the deletion in the delete_coupons table
            DeleteBlogs::create([
                'blog_id' => $blog->id,
                'blog_title' => $blog->title,
                'deleted_by' => Auth::id(),
            ]);

            // Delete the coupon
            $blog->delete();
        }

        return redirect()->back()->with('success', 'Blog deleted successfully.');
    }


        public function deleteSelected(Request $request)
        {
            $selectedIds = $request->input('selected_blogs');

            if ($selectedIds) {
                $blogs = Blog::whereIn('id', $selectedIds)->get();

                foreach ($blogs as $blog) {
                    DeleteBlogs::create([
                        'blog_id' => $blog->id,
                        'blog_title' => $blog->title,
                        'deleted_by' => Auth::id(),
                    ]);
                }

                Blog::whereIn('id', $selectedIds)->delete();

                return redirect()->back()->with('success', 'Selected blog entries deleted successfully.');
            } else {
                return redirect()->back()->with('error', 'No blog entries selected for deletion.');
            }
        }



public function bulkDelete(Request $request)
    {
        $selectedBlogs = $request->input('selected_blogs');

        if ($selectedBlogs) {
            Blog::whereIn('id', $selectedBlogs)->delete();
            return redirect()->back()->with('success', 'Selected blog entries deleted successfully.');
        }

       return redirect()->back()->with('error', 'No blog entries selected for deletion.');
    }
}
