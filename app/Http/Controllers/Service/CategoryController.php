<?php

namespace App\Http\Controllers\Service;

use App\Entity\Category;
use App\Entity\Member;
use App\Entity\Product;
use App\Entity\TempEmail;
use App\Entity\TempPhone;
use App\Models\M3Email;
use App\Models\M3Result;
use App\Http\Controllers\Controller;
use App\Tool\UUID;
use App\Tool\Validate\MyValidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function getSubCate($pid)
    {
        $categories = Category::where('parent_id', $pid)->get();
        return $categories;
    }


}
