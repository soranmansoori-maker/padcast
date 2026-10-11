<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Podcast;
use App\Models\User;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function dashboard()
    {
        $podcastCount = Podcast::where('status', '=', '1')->count();
        $categoryCount = Category::count();
        $albumCount = Album::count();
        $albumView = DB::table('albums')->select('view_count')->sum('view_count');
        $podcastDownload = DB::table('podcasts')->select('download_count')->sum('download_count');
        $commentsCount = DB::table('comments')->where('status', '1')->count();
        $usersCount = User::where('status', '=', '1')->count();
        $disabled = DB::table('podcasts')->where('status', '=', '0')->get()->count();
        $podcasts = Podcast::with('user', 'album')->orderBy('created_at', 'desc')->take(6)->get();
        $comments = Comment::with('user', 'album')->orderBy('created_at', 'desc')->take(6)->get();
        $lastMonth = Carbon::now()->firstOfMonth()->toDateTimeString();
        $pastMonthStart = $now = Carbon::now()->firstOfMonth()->subMonth(1)->toDateTimeString();
        $pastMonthEnd = $now = Carbon::now()->endOfMonth()->subMonth(1)->toDateTimeString();
        $past2MonthStart = $now = Carbon::now()->firstOfMonth()->subMonth(2)->toDateTimeString();
        $past2MonthEnd = $now = Carbon::now()->endOfMonth()->subMonth(2)->toDateTimeString();
        $past3MonthStart = $now = Carbon::now()->firstOfMonth()->subMonth(3)->toDateTimeString();
        $past3MonthEnd = $now = Carbon::now()->endOfMonth()->subMonth(3)->toDateTimeString();
        $userGrow_array = [
            '1' => User::where('created_at','>=', $lastMonth)->get()->count(),
            '2' => User::whereBetween('created_at',[$pastMonthStart,$pastMonthEnd])->get()->count(),
            '3' => User::whereBetween('created_at',[$past2MonthStart,$past2MonthEnd])->get()->count(),
            '4' => User::whereBetween('created_at',[$past3MonthStart,$past3MonthEnd])->get()->count(),
        ];
        $albumGrow_array = [
            '1' => Album::where('created_at','>=', $lastMonth)->get()->count(),
            '2' => Album::whereBetween('created_at',[$pastMonthStart,$pastMonthEnd])->get()->count(),
            '3' => Album::whereBetween('created_at',[$past2MonthStart,$past2MonthEnd])->get()->count(),
            '4' => Album::whereBetween('created_at',[$past3MonthStart,$past3MonthEnd])->get()->count(),
        ];
        $podcastGrow_array = [
            '1' => Podcast::where('created_at','>=', $lastMonth)->get()->count(),
            '2' => Podcast::whereBetween('created_at',[$pastMonthStart,$pastMonthEnd])->get()->count(),
            '3' => Podcast::whereBetween('created_at',[$past2MonthStart,$past2MonthEnd])->get()->count(),
            '4' => Podcast::whereBetween('created_at',[$past3MonthStart,$past3MonthEnd])->get()->count(),
        ];
        return view('administrator', compact('podcastCount', 'albumCount', 'usersCount', 'disabled', 'podcasts', 'comments',
            'categoryCount', 'userGrow_array', 'albumGrow_array', 'podcastGrow_array', 'albumView','podcastDownload', 'commentsCount'));
    }

    public function UploadCover($file)
    {
        $uniqueid = uniqid() . time();
        $extension = $file->getClientOriginalExtension();
        $path = public_path('/uploads/cover/podcast/');
        $img = Image::make($file->getRealPath());
        $img->resize(310, 310);
        $img->save($path . $uniqueid . "." . $extension);
        return "/uploads/cover/podcast/" . $uniqueid . "." . $extension;
    }

    public function UploadPodcast($file, $userID)
    {
        $uniqueid = uniqid() . time();
        $extension = $file->getClientOriginalExtension();
        $podcastName = time() . $uniqueid . "." . $extension;
        $path = public_path('/uploads/podcast/' . $userID . "/");
        $file->move($path, $podcastName);
        return "/uploads/podcast/" . $userID . "/" . $podcastName;
    }

    public function UploadCategoryCover($file)
    {
        $uniqueid = uniqid() . time();
        $extension = $file->getClientOriginalExtension();
        $path = public_path('/uploads/cover/category/');
        $img = Image::make($file->getRealPath());
        $img->resize(310, 310);
        $img->save($path . $uniqueid . "." . $extension);
        return "/uploads/cover/category/" . $uniqueid . "." . $extension;
    }

    public function UploadAlbumCover($file)
    {
        $uniqueid = uniqid() . time();
        $extension = $file->getClientOriginalExtension();
        $path = public_path('/uploads/cover/album/');
        $img = Image::make($file->getRealPath());
        $img->resize(310, 310);
        $img->save($path . $uniqueid . "." . $extension);
        return "/uploads/cover/album/" . $uniqueid . "." . $extension;
    }

    public function UploadUserImage($file)
    {
        $uniqueid = uniqid() . time();
        $extension = $file->getClientOriginalExtension();
        $path = public_path('/uploads/profile/');
        $img = Image::make($file->getRealPath());
        $img->resize(112, 112);
        $img->save($path . $uniqueid . "." . $extension);
        return "/uploads/profile/" . $uniqueid . "." . $extension;
    }

    public function formatSize($bytes)
    {
        $kb = 1024;
        $mb = $kb * 1024;
        $gb = $mb * 1024;
        $tb = $gb * 1024;
        if (($bytes >= 0) && ($bytes < $kb)) {
            return $bytes . ' بایت';
        } elseif (($bytes >= $kb) && ($bytes < $mb)) {
            return ceil($bytes / $kb) . ' کیلوبایت';
        } elseif (($bytes >= $mb) && ($bytes < $gb)) {
            return ceil($bytes / $mb) . ' مگابایت';
        } elseif (($bytes >= $gb) && ($bytes < $tb)) {
            return ceil($bytes / $gb) . ' گیگابایت';
        } elseif ($bytes >= $tb) {
            return ceil($bytes / $tb) . ' ترابایت';
        } else {
            return $bytes . ' بایت';
        }
    }

    public function folderSize($dir)
    {
        $total_size = 0;
        $count = 0;
        if (file_exists($dir)):
            $dir_array = scandir($dir);
            foreach ($dir_array as $key => $filename) {
                if ($filename != ".." && $filename != ".") {
                    if (is_dir($dir . "/" . $filename)) {
                        $new_foldersize = $this->foldersize($dir . "/" . $filename);
                        $total_size = $total_size + $new_foldersize;
                    } else if (is_file($dir . "/" . $filename)) {
                        $total_size = $total_size + filesize($dir . "/" . $filename);
                        $count++;
                    }
                }
            }
            return $total_size;
        else:
            return 0;
        endif;
    }
}
