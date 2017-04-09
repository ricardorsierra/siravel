<?php

namespace Sitec\Siravel\Controllers;

use Config;
use CryptoService;
use FileService;
use Illuminate\Http\Request;
use Siravel;
use Storage;
use Sitec\Siravel\Models\Image;
use Sitec\Siravel\Repositories\ImageRepository;
use Sitec\Siravel\Requests\ImagesRequest;
use Sitec\Siravel\Services\SiravelResponseService;
use Sitec\Siravel\Services\ValidationService;

class ImagesController extends SiravelController
{
    /** @var ImageRepository */
    private $imagesRepository;

    public function __construct(ImageRepository $imagesRepo)
    {
        $this->imagesRepository = $imagesRepo;
    }

    /**
     * Display a listing of the Images.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $input = $request->all();

        $result = $this->imagesRepository->paginated();

        return view('siravel::modules.images.index')
            ->with('images', $result)
            ->with('pagination', $result->render());
    }

    /**
     * Search.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function search(Request $request)
    {
        $input = $request->all();

        $result = $this->imagesRepository->search($input);

        return view('siravel::modules.images.index')
            ->with('images', $result[0]->get())
            ->with('pagination', $result[2])
            ->with('term', $result[1]);
    }

    /**
     * Show the form for creating a new Images.
     *
     * @return Response
     */
    public function create()
    {
        return view('siravel::modules.images.create');
    }

    /**
     * Store a newly created Images in storage.
     *
     * @param ImagesRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        try {
            $validation = ValidationService::check(['location' => 'required']);
            if (!$validation['errors']) {
                foreach ($request->input('location') as $image) {
                    $imageSaved = $this->imagesRepository->store([
                        'location' => $image,
                        'is_published' => $request->input('is_published'),
                        'tags' => $request->input('tags'),
                    ]);
                }

                Siravel::notification('Image saved successfully.', 'success');

                if (!$imageSaved) {
                    Siravel::notification('Image was not saved.', 'danger');
                }
            } else {
                Siravel::notification('Image could not be saved', 'danger');

                return $validation['redirect'];
            }
        } catch (Exception $e) {
            Siravel::notification($e->getMessage() ?: 'Image could not be saved.', 'danger');
        }

        return redirect(route('siravel.images.index'));
    }

    /**
     * Store a newly created Files in storage.
     *
     * @param FileRequest $request
     *
     * @return Response
     */
    public function upload(Request $request)
    {
        $validation = ValidationService::check([
            'location' => ['required'],
        ]);

        if (!$validation['errors']) {
            $file = $request->file('location');
            $fileSaved = FileService::saveFile($file, 'public/images');
            $fileSaved['name'] = CryptoService::encrypt($fileSaved['name']);
            $fileSaved['mime'] = $file->getClientMimeType();
            $fileSaved['size'] = $file->getClientSize();
            $response = SiravelResponseService::apiResponse('success', $fileSaved);
        } else {
            $response = SiravelResponseService::apiErrorResponse($validation['errors'], $validation['inputs']);
        }

        return $response;
    }

    /**
     * Show the form for editing the specified Images.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $images = $this->imagesRepository->findImagesById($id);

        if (empty($images)) {
            Siravel::notification('Image not found', 'warning');

            return redirect(route('siravel.images.index'));
        }

        return view('siravel::modules.images.edit')->with('images', $images);
    }

    /**
     * Update the specified Images in storage.
     *
     * @param int           $id
     * @param ImagesRequest $request
     *
     * @return Response
     */
    public function update($id, ImagesRequest $request)
    {
        try {
            $images = $this->imagesRepository->findImagesById($id);

            Siravel::notification('Image updated successfully.', 'success');

            if (empty($images)) {
                Siravel::notification('Image not found', 'warning');

                return redirect(route('siravel.images.index'));
            }

            $images = $this->imagesRepository->update($images, $request->all());

            if (!$images) {
                Siravel::notification('Image could not be updated', 'danger');
            }
        } catch (Exception $e) {
            Siravel::notification($e->getMessage() ?: 'Image could not be saved.', 'danger');
        }

        return redirect(route('siravel.images.edit', $id));
    }

    /**
     * Remove the specified Images from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $image = $this->imagesRepository->findImagesById($id);

        if (is_file(storage_path($image->location))) {
            @Storage::delete($image->location);
        }

        if (empty($image)) {
            Siravel::notification('Image not found', 'warning');

            return redirect(route('siravel.images.index'));
        }

        $image->delete();

        Siravel::notification('Image deleted successfully.', 'success');

        return redirect(route('siravel.images.index'));
    }

    /*
    |--------------------------------------------------------------------------
    | Api
    |--------------------------------------------------------------------------
    */

    /**
     * Display the specified Images.
     *
     * @return Response
     */
    public function apiList(Request $request)
    {
        if (Config::get('siravel.api-key') != $request->header('siravel')) {
            return SiravelResponseService::apiResponse('error', []);
        }

        return $this->imagesRepository->apiPrepared();

        return SiravelResponseService::apiResponse('success', $images);
    }

    /**
     * Store a newly created Images in storage.
     *
     * @param ImagesRequest $request
     *
     * @return Response
     */
    public function apiStore(Request $request)
    {
        $image = $this->imagesRepository->apiStore($request->all());

        return SiravelResponseService::apiResponse('success', $image);
    }
}
