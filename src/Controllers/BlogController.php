<?php

namespace Sitec\Siravel\Controllers;

use URL;
use Siravel;
use Sitec\Siravel\Models\Blog;
use Illuminate\Http\Request;
use Sitec\Siravel\Requests\BlogRequest;
use Sitec\Siravel\Services\ValidationService;
use Sitec\Siravel\Repositories\BlogRepository;

class BlogController extends SiravelController
{
    /** @var BlogRepository */
    private $blogRepository;

    public function __construct(BlogRepository $blogRepo)
    {
        $this->blogRepository = $blogRepo;
    }

    /**
     * Display a listing of the Blog.
     *
     * @return Response
     */
    public function index()
    {
        $blogs = $this->blogRepository->paginated();

        return view('siravel::modules.blogs.index')
            ->with('blogs', $blogs)
            ->with('pagination', $blogs->render());
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

        $result = $this->blogRepository->search($input);

        return view('siravel::modules.blogs.index')
            ->with('blogs', $result[0]->get())
            ->with('pagination', $result[2])
            ->with('term', $result[1]);
    }

    /**
     * Show the form for creating a new Blog.
     *
     * @return Response
     */
    public function create()
    {
        return view('siravel::modules.blogs.create');
    }

    /**
     * Store a newly created Blog in storage.
     *
     * @param BlogRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $validation = ValidationService::check(Blog::$rules);

        if (!$validation['errors']) {
            $blog = $this->blogRepository->store($request->all());
            Siravel::notification('Blog saved successfully.', 'success');
        } else {
            return $validation['redirect'];
        }

        if (!$blog) {
            Siravel::notification('Blog could not be saved.', 'warning');
        }

        return redirect(route('siravel.blog.edit', [$blog->id]));
    }

    /**
     * Show the form for editing the specified Blog.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $blog = $this->blogRepository->findBlogById($id);

        if (empty($blog)) {
            Siravel::notification('Blog not found', 'warning');

            return redirect(route('siravel.blog.index'));
        }

        return view('siravel::modules.blogs.edit')->with('blog', $blog);
    }

    /**
     * Update the specified Blog in storage.
     *
     * @param int         $id
     * @param BlogRequest $request
     *
     * @return Response
     */
    public function update($id, BlogRequest $request)
    {
        $blog = $this->blogRepository->findBlogById($id);

        if (empty($blog)) {
            Siravel::notification('Blog not found', 'warning');

            return redirect(route('siravel.blog.index'));
        }

        $blog = $this->blogRepository->update($blog, $request->all());
        Siravel::notification('Blog updated successfully.', 'success');

        if (!$blog) {
            Siravel::notification('Blog could not be saved.', 'warning');
        }

        return redirect(URL::previous());
    }

    /**
     * Remove the specified Blog from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $blog = $this->blogRepository->findBlogById($id);

        if (empty($blog)) {
            Siravel::notification('Blog not found', 'warning');

            return redirect(route('siravel.blog.index'));
        }

        $blog->delete();

        Siravel::notification('Blog deleted successfully.', 'success');

        return redirect(route('siravel.blog.index'));
    }

    /**
     * Blog history.
     *
     * @param int $id
     *
     * @return Response
     */
    public function history($id)
    {
        $blog = $this->blogRepository->findBlogById($id);

        return view('siravel::modules.blogs.history')
            ->with('blog', $blog);
    }
}
