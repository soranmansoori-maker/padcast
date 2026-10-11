<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use function PHPUnit\Framework\directoryExists;

class PanelController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
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
