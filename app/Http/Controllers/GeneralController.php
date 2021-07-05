<?php

namespace App\Http\Controllers;

use App\Models\MetaBanner;
use App\Models\Setting;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class GeneralController extends Controller
{

    public $model;
    protected $view = 'dashboard.';
    protected $url = 'dashboard/';
    protected $frontView = 'front.';
    protected $pathImages = 'images/';
    protected $paginate = 15;
    protected $quality = 80;
    protected $encode = 'jpg';

    public function __construct(Model $model)
    {
        $this->model = $model;
    }



    /*************************************
    Start Path's
     ************************************/
    /**
     * Get View Path
     * @param $view
     * @return string
     */
    public function viewPath($view)
    {
        return $this->view . $view;
    }

    /**
     * Get View Front Path
     * @param $frontView
     * @return string
     */
    public function frontView($frontView)
    {
        return $this->frontView . $frontView;
    }

    /**
     * Get URL Path
     * @param $url
     * @return string
     */
    public function urlPath($url)
    {
        return $this->url . $url;
    }

    /*************************************
    End Path's
     ************************************/



    /*************************************
    Start Quires Get Data
     ************************************/
    /**
     * Get data from Specific Model
     * @return mixed
     */
    public function getData()
    {
        return $this->model->orderBy('id', 'DESC');
    }


    /**
     * Get Specific Item By ID
     * @param $id
     * @return mixed
     */
    public function GetItem($id)
    {
        return $this->validateModel($id);
    }

    /**
     * Get Data WithOut Hidden Items
     * @return mixed
     */
    public function withOutHide()
    {
        return $this->model->where('hide', 0);
    }


    /**
     * Replace spaced between words
     * @param $string
     * @param $separator
     * @return mixed
     */
    public function slug($string, $separator = '-')
    {
        $string = trim($string);
        $string = mb_strtolower($string, 'UTF-8');
        $string = preg_replace("/[^a-z0-9_\-\sءاآؤئبپتثجچحخدذرزژسشصضطظعغفقكکگلمنوهيیةى]/u", '', $string);
        $string = preg_replace("/[\s\-_]+/", ' ', $string);
        $string = preg_replace("/[\s_]/", $separator, $string);
        return $string;
    }


    public function slugItem($slug)
    {
        return $this->model->where('hide', 0)->where('slug', $slug);
    }


    /**
     * Update Meta in DB
     * @param $page
     * @return mixed
     */
    public function GetMeta($page)
    {
        // Get and Check Data
        $data = MetaBanner::where('page', $page)->first();
        // Check Get Data
        if(!$data) abort(404);
        // Return Data
        return $data;
    }


    /**
     * Update Meta in DB
     * @param $request
     * @param $page
     */
    public function UpdateMeta($request, $page)
    {
        // Get and Check Data
        $data = MetaBanner::where('page', $page)->first();
        // Check Get Data
        if(!$data) abort(404);
        // Get Inputs Request
        $inputs = $request->validated();
        // Check If Inputs Has File
        if($request->hasFile('image')) {
            // Set Image in inputs data
            $inputs['image'] = $this->uploadImage($request->file('image'), 'banner', $data->image, 1920, 385);
        }
        // Update Data in DB
        $data->update($inputs);
    }


    /**
     * Get Setting Data
     * @return mixed
     */
    public function setting()
    {
        return Setting::get();
    }
    /*************************************
    End Quires Get Data
     ************************************/


    /*************************************
    Start Uploading Files
     ************************************/
    /**
     * Uploading Image
     * @param $file
     * @param $path
     * @param null $oldFile
     * @param int|null $width
     * @param int|null $height
     * @param int|null $thumbnailWidth
     * @param int|null $thumbnailHeight
     * @param bool $watermark
     * @return |null
     */
    public function uploadImage($file, $path, $oldFile = null, int $width = null, int $height = null, int $thumbnailWidth = null, int $thumbnailHeight = null, bool $watermark = false)
    {
        if($file) {
            // Rename File
            $rename = date('Ymdgis') . mt_rand(100, 1000000) . '.' .$file->getClientOriginalExtension();
            // Path File
            $fullPath = $file->storeAs($this->pathImages . $path, $rename, 'public_images');
            // Generate Image
            $image = Image::make($file);
            // If Watermark Equal True
            if($watermark === true) {
                $this->watermark($image);
            }
            // If Width and Height not Null
            if($width && $height) {
                // Resize image as specific width and height
                $image->resize($width, $height);
            } else if($width || $height) {
                // If need specific width and auto height
                $image->resize($width, $height, function ($aspect) {
                    $aspect->aspectRatio();
                });
            }
            // Save Image in the Full Path
            $image->save($fullPath, $this->quality ?? $this->quality, $this->encode);
            // Check If Exist thumbnail Image
            if($thumbnailWidth || $thumbnailHeight) {
                $this->thumbnailImage($file, $rename, $path, $thumbnailWidth, $thumbnailHeight, $watermark);
            }
            // Delete Old Files
            if($oldFile) {
                $this->deleteImage($oldFile);
            }
            return $fullPath;
        }
        return $oldFile;
    }

    // Generate Water Mark Inside Main Image
    private function watermark($image = null, $thumbnailImage = null)
    {
        $watermark = public_path('images/watermarks/logo.png');
        if($image)
            $image->insert($watermark, 'center');
        if($thumbnailImage)
            $thumbnailImage->insert($watermark, 'center');
    }

    // Generate Thumbnail Image
    private function thumbnailImage($file, $rename, $path, $width, $height, $watermark) {
        // Generate Thumbnail Image
        $thumbnailImage = Image::make($file);
        // If Watermark Equal True
        if($watermark === true) {
            $this->watermark(null, $thumbnailImage);
        }
        $fullThumbnailPath = $file->storeAs($this->pathImages . 'thumbnail/' . $path, $rename, 'public_images');
        // If Thumbnail Width and Height not Null
        if($width && $height) {
            // Resize Thumbnail image as specific width and height
            $thumbnailImage->resize($width, $height);
        } else if($width || $height) {
            // If need specific width and auto height
            $thumbnailImage->resize($width, $height, function ($ratio) {
                $ratio->aspectRatio();
            });
        }
        // Save Thumbnail Image in Path Thumbnail
        $thumbnailImage->save($fullThumbnailPath, $this->quality, $this->encode);
    }
    /*************************************
    End Uploading Files
     ************************************/



    /*************************************
    Start Validation
     ************************************/
    /**
     * Validation $id in Model
     * @param $id
     * @return mixed
     */
    public function validateModel($id)
    {
        // Get data Category
        $data = $this->model->findOrFail($id);
        return $data;
    }
    /*************************************
    End Validation
     ************************************/


    /*************************************
    Start Get User Login Guards
     ************************************/

    /**
     * Get Admin Logged
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function admin()
    {
        return auth('admin')->user();
    }

    /**
     * Get Company Logged
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user()
    {
        return auth()->user();
    }

    /*************************************
    Start Get User Login Guards
     ************************************/



    /*************************************
    Start General Functions
     ************************************/
    /**
     * Code Generate
     * @return string
     */
    public function code()
    {
        return sha1(uniqid('_m') . md5(date('Ymdhis'))) . md5(uniqid('_m') . sha1(date('Ymdhis')));
    }


    /**
     * Generate Code
     * @param $count
     * @return string
     */
    public function codeGenerate($count)
    {
        return Str::random($count);
    }


    /**
     * Check Key Generated
     * @param $countKey
     * @param $field
     * @return string
     */
    public function keyUser($countKey, $field)
    {
        do {
            $key = $this->codeGenerate($countKey);
            $user = $this->model->where($field, $key)->first();
        } while($user);

        return $key;
    }


    /**
     * Delete Images from folders
     * @param $image
     * @return bool
     */
    public function deleteImage($image)
    {
        if($image) {
            if(is_array($image)) {
                foreach ($image as $img) {
                    if(!is_null($img)) {
                        // Delete Image from images folder
                        File::delete($image);
                        // Delete Thumbnail Image from Thumbnail folder
                        File::delete($this->pathImages . 'thumbnail' . substr($img, strpos($img, '/', 6)));
                    }
                }
            } else {
                // Delete Image from images folder
                File::delete($image);
                // Delete Thumbnail Image from Thumbnail folder
                File::delete($this->pathImages . 'thumbnail' . substr($image, strpos($image, '/', 6)));
            }
        }

        return true;
    }


    /**
     * Show Flash Message
     * @param $name
     * @param $msg
     */
    public function flash($name, $msg)
    {
        Session::flash($name, $msg);
    }

    /**
     * @param $meta
     * @param null $image
     * @param null $title
     * @param string $type
     */
    public function metaGenerate($meta, $title = null, $image = null, $type = "web page")
    {
        // Get Setting
        $setting = Setting::without('translations')->whereIn('key', ['site_name', 'logo'])->get();
        // Check Data Meta
        if($meta->meta) {
            $meta = $meta->meta->toArray();
        }
        if(is_object($meta)) {
            $meta = $meta->toArray();
            if(array_key_exists('meta_keywords', $meta)) {
                $meta['keywords'] = $meta['meta_keywords'];
                $meta['description'] = $meta['meta_description'];
            }
        }
        // Set Title If Title Arg Not Null
        $title = $title != null ? $meta['title'] = $title : $meta['title'];
        SEOMeta::setTitle($title);
        SEOMeta::setDescription($meta['description']);
        SEOMeta::addKeyword($meta['keywords']);
        SEOMeta::setCanonical(request()->fullUrl());

        OpenGraph::setTitle($title);
        OpenGraph::setDescription($meta['description']);
        OpenGraph::setSiteName($setting->where('key', 'site_name')->first()->value);
        OpenGraph::setUrl(request()->fullUrl());
        OpenGraph::addProperty('locale', app()->getLocale());
        OpenGraph::addProperty('type', $type);
        OpenGraph::addImage(asset($image == null ? $setting->where('key', 'logo')->first()->val : $image));

        JsonLd::setTitle($title);
        JsonLd::setDescription($meta['description']);
        JsonLd::setSite($setting->where('key', 'site_name')->first()->value);
        JsonLd::setType($type);
        JsonLd::setUrl(request()->fullUrl());
        JsonLd::addImage(asset($image == null ? $setting->where('key', 'logo')->first()->val : $image));
    }
    /*************************************
    End General Functions
     ************************************/

}
