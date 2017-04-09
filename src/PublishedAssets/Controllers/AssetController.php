<?php

namespace App\Http\Controllers; 

use App;
use Image;
use sitec;
use Exception;
use SplFileInfo;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Crypto;

class AssetController extends Controller
{
    protected $mimeTypes;

    public function __construct()
    {
        $this->mimeTypes = require __DIR__.'/Config/Mime.php';
    }

    /**
     * Provide the File as a Public Asset.
     *
     * @param string $encFileName
     *
     * @return Download
     */
    public function asPublic($encFileName)
    {
        try {
            $fileName = Crypto::decrypt($encFileName);
            if (Config::get('sitec.storage-location') === 'local' || Config::get('sitec.storage-location') === null) {
                $filePath = storage_path('app/'.$fileName);
            } else {
                $filePath = Storage::disk(Config::get('sitec.storage-location', 'local'))->url($fileName);
            }

            $fileTool = new SplFileInfo($filePath);
            $ext = $fileTool->getExtension();
            $contentType = $this->getMimeType($ext);

            $headers = ['Content-Type' => $contentType];

            if (Config::get('sitec.storage-location') === 'local' || Config::get('sitec.storage-location') === null) {
                return response()->download($filePath, basename($filePath), $headers);
            } else {
                $fileContent = Storage::disk(Config::get('sitec.storage-location', 'local'))->get($fileName);

                return Response::make($fileContent, 200, [
                    'Content-Type' => $contentType,
                    'Content-Disposition' => 'attachment; filename="'.$fileName.'"',
                ]);
            }
        } catch (Exception $e) {
            return Response::make('file not found');
        }
    }

    /**
     * Provide the File as a Public Preview.
     *
     * @param string $encFileName
     *
     * @return Download
     */
    public function asPreview($encFileName, Filesystem $fileSystem)
    {
        try {
            $fileName = Crypto::decrypt($encFileName);

            if (Config::get('sitec.storage-location') === 'local' || Config::get('sitec.storage-location') === null) {
                $filePath = storage_path('app/'.$fileName);
                $contentType = $fileSystem->mimeType($filePath);
                $ext = '.'.strtoupper($fileSystem->extension($filePath));
            } else {
                $filePath = Storage::disk(Config::get('sitec.storage-location', 'local'))->url($fileName);
                $fileTool = new SplFileInfo($filePath);
                $ext = $fileTool->getExtension();
                $contentType = $this->getMimeType($ext);
            }

            if (stristr($contentType, 'image')) {
                $headers = ['Content-Type' => $contentType];
                if (Config::get('sitec.storage-location') === 'local' || Config::get('sitec.storage-location') === null) {
                    return response()->download($filePath, basename($filePath), $headers);
                } else {
                    $fileContent = Storage::disk(Config::get('sitec.storage-location', 'local'))->get($fileName);

                    return Response::make($fileContent, 200, [
                        'Content-Type' => $contentType,
                        'Content-Disposition' => 'attachment; filename="'.$fileName.'"',
                    ]);
                }
            } else {
                $color = '#'.str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
                $img = Image::make(__DIR__.'/../../../resources/assets/Images/blank.jpg');
                $img->fill($color);
                $img->text($ext, 145, 145, function ($font) {
                    $font->file(__DIR__.'/../../../resources/assets/Fonts/SourceSansPro-Semibold.otf');
                    $font->size(36);
                    $font->color('#111111');
                    $font->align('center');
                    $font->valign('center');
                    $font->angle(45);
                });

                return $img->response('jpg');
            }
        } catch (Exception $e) {
            return Response::make('file not found');
        }
    }

    /**
     * Provide file as download.
     *
     * @param string $encFileName
     * @param string $encRealFileName
     *
     * @return Downlaod
     */
    public function asDownload($encFileName, $encRealFileName)
    {
        try {
            $fileName = Crypto::decrypt($encFileName);
            $realFileName = Crypto::decrypt($encRealFileName);

            if (Config::get('sitec.storage-location') === 'local' || Config::get('sitec.storage-location') === null) {
                $filePath = storage_path('app/'.$realFileName);
            } else {
                $filePath = Storage::disk(Config::get('sitec.storage-location', 'local'))->url($realFileName);
            }

            $fileTool = new SplFileInfo($filePath);
            $ext = $fileTool->getExtension();
            $contentType = $this->getMimeType($ext);

            $headers = ['Content-Type' => $contentType];

            if (Config::get('sitec.storage-location') === 'local' || Config::get('sitec.storage-location') === null) {
                return response()->download($filePath, basename($filePath), $headers);
            } else {
                $fileContent = Storage::disk(Config::get('sitec.storage-location', 'local'))->get($realFileName);

                return Response::make($fileContent, 200, [
                    'Content-Type' => $contentType,
                    'Content-Disposition' => 'attachment; filename="'.$fileName.'"',
                ]);
            }
        } catch (Exception $e) {
            sitec::notification('We encountered an error with that file', 'danger');

            return redirect('errors/general');
        }
    }

    /**
     * Gets an asset.
     *
     * @param string $encPath
     * @param string $contentType
     *
     * @return Provides the valid
     */
    public function asset($encPath, $contentType, Filesystem $fileSystem)
    {
        try {
            $path = Crypto::decrypt($encPath);

            if (Request::get('isModule') === 'true') {
                $filePath = $path;
            } else {
                $filePath = __DIR__.'/../../../resources/assets/'.$path;
            }

            $fileName = basename($filePath);

            if (!is_null($contentType)) {
                $contentType = Crypto::decrypt($contentType);
            } else {
                $contentType = $fileSystem->mimeType($fileName);
            }

            $headers = ['Content-Type' => $contentType];

            return response()->download($filePath, $fileName, $headers);
        } catch (Exception $e) {
            return Response::make('file not found');
        }
    }

    /**
     * Get the mime type.
     *
     * @param string $extension
     *
     * @return string
     */
    public function getMimeType($extension)
    {
        if (isset($this->mimeTypes['.'.strtolower($extension)])) {
            return $this->mimeTypes['.'.strtolower($extension)];
        }

        return 'text/plain';
    }
}
