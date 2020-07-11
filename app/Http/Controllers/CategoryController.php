<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use DB;

class CategoryController extends Controller
{


    public function treeview()
    {
        $categories = Category::get()->toTree();

        return view('welcome', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::latest()->get();

        return view('category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $nodes = Category::all()->pluck( 'name');
            $namesInArray = $nodes->toArray();

            if (in_array($request->category, $namesInArray )){
                return redirect()->route('category.create')
                    ->with('error','This name exist in tree');
            }

            $category = Category::create([
                'name' => $request->category
            ]);

            if($request->parent && $request->parent !== 'none') {

                $node = Category::find($request->parent);

                $node->appendNode($category);
            }

            return redirect()->route('category.create')
                ->with('success','Category Created Successfully');

        } catch (\Throwable $th){
            return redirect()->route('category.create')
                ->with('error','Something wrong');
        }


    }

    public function updateName()
    {
        $categories = Category::latest()->get();

        return view('category.updateName', compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function updateNameStore(Request $request)
    {
        try {

        $nodes = Category::all()->pluck( 'name');
        $namesInArray = $nodes->toArray();

        if (in_array($request->category, $namesInArray )){
            return redirect()->route('category.updateName')
                ->with('error','This name exist in tree');
        }

        if ($request->category){
            $data = array();
            $data['name'] = $request->category;

            $category = DB::table('categories')->where('id',$request->parent)->update($data);
        }


        return redirect()->route('category.updateName')
            ->with('success','Category Name Updated  Successfully');

        } catch (\Throwable $th){
            return redirect()->route('category.updateName')
                ->with('error','Something wrong');
        }
    }

    public function moveNode()
    {
        $categories = Category::latest()->get();

        return view('category.moveNode', compact('categories'));
    }


    public function moveNodeStorage(Request $request)
    {
        try {

            $movedNodeId = $request->movedNode;
            $newParentId = $request->destinationPlace;

            // check the same node
            if (($movedNodeId) === ($newParentId)) {
                return redirect()->route('category.moveNode')
                    ->with('error', 'Nie możesz przenieść do tego samego miejsca');
            }

            // Checking if he does not transfer to his ancestor
            $selectToMoveNode = Category::find($movedNodeId);
            $descendants = $selectToMoveNode->descendants()->pluck('id');
            $descendantsIdArray = $descendants->toArray();

            if (in_array($newParentId, $descendantsIdArray)) {
                return redirect()->route('category.moveNode')
                    ->with('error', 'Miejsce docelowe jest przodkiem zaznaczonego');
            }

            // moving
            $selectedNode = Category::find($movedNodeId);
            $destNode = Category::find($newParentId);

            $selectedNode->parent_id = $destNode->id;

            // checking if he save and moved
            if ($selectedNode->save()) {
                $moved = $selectedNode->hasMoved();
                if ($moved === true) {
                    return redirect()->route('category.moveNode')
                        ->with('success', 'Category Moved Successfully');
                } else {
                    return redirect()->route('category.moveNode')
                        ->with('error', 'Something wrong');
                }
            }


        } catch (\Throwable $th){
            return redirect()->route('category.moveNode')
                ->with('error','Something wrong');
        }


    }


    public function delete()
    {
        $categories = Category::latest()->get();

        return view('category.delete', compact('categories'));
    }

    public function deleteNode(Request $request)
    {

        try {


            if ($request->parent && $request->parent !== 'none') {

                $node = Category::find($request->parent);

                $node->delete();

                // fix values left right
                Category::fixTree();
            }

            return redirect()->route('category.delete')
                ->with('success', 'Category with all Node Delete Successfully');

        } catch (\Throwable $th){
            return redirect()->route('category.delete')
                ->with('error','Something wrong');
        }

    }

}
