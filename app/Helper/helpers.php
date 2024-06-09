<?php
use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

    function getCategoriesNav()
    {
        $categories = Category::orderBy('title', 'asc')->get();

        return $categories;
    }

    function getCategoriesFooter()
    {
        $categories = Category::orderBy('title', 'asc')->paginate(5);

        return $categories;
    }

    
?>