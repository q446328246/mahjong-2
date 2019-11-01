<?php

namespace App\Admin\Controllers;

use App\Models\SelectTileQuestionsList;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Callout;
use Encore\Admin\Widgets\Table;
use Illuminate\Http\Request;

class SelectController extends AdminController
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('どれ切る？')
            ->description('')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
//    public function show(Request $request, $id, Content $content)
//    {
//        return Admin::content(function (Content $content) use ($id) {
//            $content->header('Detail');
//            $content->description('description');
//            $content->body($this->detail($id));
//
//        });
//    }


    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('新規作成')
            ->body($this->form());
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('クライアント情報変更')
            ->body($this->form()->edit($id));
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SelectTileQuestionsList());

        $grid->column('id', __('ID'))->sortable();


        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed   $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(SelectTileQuestionsList::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('title', __('問題名'));
        $show->field('introduction', __('紹介文'));
        $show->select_tile_question_detail('詳細情報', function ($question_detail) {
            $question_detail->field('stations', '局.本場');
            $question_detail->field('place', '場所');
            $question_detail->field('dora', 'ドラ');
            $question_detail->field('me_score', '自家スコア');
            $question_detail->field('place', '場所');
            $question_detail->field('place', '場所');
            $question_detail->field('place', '場所');
            $question_detail->field('place', '場所');
        });
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new SelectTileQuestionsList);

        $form->display('id', __('ID'));
        $form->text('title', '問題名');
        $form->text('introduction', '紹介文');


        $form->display('created_at', __('Created At'));
        $form->display('updated_at', __('Updated At'));

        return $form;
    }
}
