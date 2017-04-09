<?php

namespace Sitec\Siravel\Controllers;

use Siravel;
use Config;
use Storage;
use Redirect;
use Response;
use Exception;
use CryptoService;
use Sitec\Siravel\Models\File;
use Illuminate\Http\Request;
use Sitec\Siravel\Requests\FileRequest;
use Sitec\Siravel\Services\FileService;
use Sitec\Siravel\Services\ValidationService;
use Sitec\Siravel\Repositories\FileRepository;
use Sitec\Siravel\Services\SiravelResponseService;

class FilesController extends SiravelController
{
    /** @var FilesRepository */
    private $fileRepository;

    public function __construct(FileRepository $fileRepo)
    {
        $this->fileRepository = $fileRepo;
    }

    /**
     * Display a listing of the Files.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index()
    {
        $result = $this->fileRepository->paginated();

        return view('siravel::modules.files.index')
            ->with('files', $result)
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

        $result = $this->fileRepository->search($input);

        return view('siravel::modules.files.index')
            ->with('files', $result[0]->get())
            ->with('pagination', $result[2])
            ->with('term', $result[1]);
    }

    /**
     * Show the form for creating a new Files.
     *
     * @return Response
     */
    public function create()
    {
        return view('siravel::modules.files.create');
    }

    /**
     * Store a newly created Files in storage.
     *
     * @param FileRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $validation = ValidationService::check(File::$rules);

        if (!$validation['errors']) {
            $file = $this->fileRepository->store($request->all());
        } else {
            return $validation['redirect'];
        }

        Siravel::notification('File saved successfully.', 'success');

        return redirect(route('siravel.files.index'));
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
            'location' => [],
        ]);

        if (!$validation['errors']) {
            $file = $request->file('location');
            $fileSaved = FileService::saveFile($file, 'files/');
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
     * Remove a file.
     *
     * @param string $id
     *
     * @return Response
     */
    public function remove($id)
    {
        try {
            Storage::delete($id);

            $response = SiravelResponseService::apiResponse('success', 'success!');
        } catch (Exception $e) {
            $response = SiravelResponseService::apiResponse('error', $e->getMessage());
        }

        return $response;
    }

    /**
     * Show the form for editing the specified Files.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $files = $this->fileRepository->findFilesById($id);

        if (empty($files)) {
            Siravel::notification('File not found', 'warning');

            return redirect(route('siravel.files.index'));
        }

        return view('siravel::modules.files.edit')->with('files', $files);
    }

    /**
     * Update the specified Files in storage.
     *
     * @param int         $id
     * @param FileRequest $request
     *
     * @return Response
     */
    public function update($id, FileRequest $request)
    {
        $files = $this->fileRepository->findFilesById($id);

        if (empty($files)) {
            Siravel::notification('File not found', 'warning');

            return redirect(route('siravel.files.index'));
        }

        $files = $this->fileRepository->update($files, $request->all());

        Siravel::notification('File updated successfully.', 'success');

        return Redirect::back();
    }

    /**
     * Remove the specified Files from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $files = $this->fileRepository->findFilesById($id);

        if (empty($files)) {
            Siravel::notification('File not found', 'warning');

            return redirect(route('siravel.files.index'));
        }

        Storage::delete($files->location);
        $files->delete();

        Siravel::notification('File deleted successfully.', 'success');

        return redirect(route('siravel.files.index'));
    }

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

        $files = $this->fileRepository->apiPrepared();

        return SiravelResponseService::apiResponse('success', $files);
    }
}
