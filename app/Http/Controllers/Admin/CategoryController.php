<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Traits\ImageUploadTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Admin\CategoryRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
  use ImageUploadTrait;

  private $module, $module_name, $group, $folder, $icon, $key, $help_key;

  function __construct()
  {
    $this->group = 'Produk';
    $this->module = 'kategori';
    $this->module_name = 'Kategori';
    $this->folder = 'admin.categories';
    $this->help_key = 'admin.categories';
    $this->key = 'kategori';
    $this->icon = 'fas fa-list';
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $group = $this->group;
    $module = $this->module;
    $module_name = $this->module_name;
    $folder = $this->folder;
    $help_key = $this->help_key;

    return view($folder . '.index', compact(['group', 'module', 'module_name', 'help_key']));
  }

  public function datatable(Request $request)
  {
    if ($request->ajax()) {
      $categories = Category::with('parent')->withCount('products')->latest()->get();

      $datatable = DataTables::of($categories)
        ->addIndexColumn()
        ->addColumn('parent', function ($row) {
          return $row->parent->name ?? '-';
        })
        ->addColumn('action', function ($row) {
          $btn = ' <button type="button" name="delete" id="' . $row->id . '" class="delete btn btn-primary btn-sm"><i class="fas fa-trash"></i></button>';
          $btn .= ' <a href="' . route($this->folder . '.edit', $row->id) . '" class="edit btn btn-primary btn-sm"><i class="fas fa-pen"></i></a>';
          $btn .= '<a href="' . route($this->folder . '.show', $row->id) . '" class="edit btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>';
          return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);

      return $datatable;
    }
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $module = $this->module;
    $module_name = $this->module_name;
    $folder = $this->folder;
    $help_key = $this->help_key;

    $parent_categories = Category::whereNull('category_id')->get(['id', 'name']);

    return view('admin.categories.create', compact(['parent_categories', 'module', 'module_name', 'folder', 'help_key']));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(CategoryRequest $request)
  {
    // abort_if(Gate::denies('category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    $image = NULL;
    if ($request->hasFile('cover')) {
      $image = $this->uploadImage($request->name, $request->cover, 'categories', 268, 268);
    }

    Category::create([
      'name' => $request->name,
      'category_id' => $request->category_id,
      'cover' => $image,
    ]);

    return redirect()->route('admin.categories.index')->with([
      'message' => 'success created !',
      'alert-type' => 'success'
    ]);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Category $category)
  {
    // abort_if(Gate::denies('category_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    return view('admin.categories.show', compact('category'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Category $category)
  {
    $module = $this->module;
    $module_name = $this->module_name;
    $folder = $this->folder;
    $help_key = $this->help_key;

    $parent_categories = Category::whereNull('category_id')->get(['id', 'name']);

    return view('admin.categories.edit', compact('parent_categories', 'category', 'module', 'module_name', 'folder', 'help_key'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(CategoryRequest $request, Category $category)
  {
    // abort_if(Gate::denies('category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    $image = $category->cover;
    if ($request->has('cover')) {
      if ($category->cover != null && File::exists('storage/images/categories/' . $category->cover)) {
        unlink('storage/images/categories/' . $category->cover);
      }
      $image = $this->uploadImage($request->name, $request->cover, 'categories', 268, 268);
    }

    $category->update([
      'name' => $request->name,
      'category_id' => $request->category_id,
      'cover' => $image,
    ]);

    return redirect()->route('admin.categories.index')->with([
      'message' => 'success updated !',
      'alert-type' => 'info'
    ]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Category $category)
  {
    // abort_if(Gate::denies('category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    if ($category->category_id == null) {
      foreach ($category->children as $child) {
        if (File::exists('storage/images/categories/' . $child->cover)) {
          unlink('storage/images/categories/' . $child->cover);
        }
      }
    }

    if ($category->cover) {
      if (File::exists('storage/images/categories/' . $category->cover)) {
        unlink('storage/images/categories/' . $category->cover);
      }
    }

    $category->delete();

    return redirect()->route('admin.categories.index')->with([
      'message' => 'Berhasil Dihapus!',
      'alert-type' => 'danger',
    ]);
  }
}
