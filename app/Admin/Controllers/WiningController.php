<?php

namespace App\Admin\Controllers;

use App\Models\WiningLv1Question;
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

class WiningController extends AdminController
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
            ->header('待ち牌当て')
            ->description('初級')
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
        $grid = new Grid(new WiningLv1Question());

        $grid->column('id', __('ID'))->sortable();
        $grid->question('配牌（問題）')->display(function ($question) {
            $tiles_str = explode('.', $question);
            $tiles_img = '';
            foreach ($tiles_str as $tile_str) {
                $tiles_img .= '<img src="' . config('const.TILES_IMG_PATH') . $tile_str . '.png" width="30px">';
            }
            return $tiles_img;
        })->expand(function ($model) {
            $answers = $model->wining_lv1_answers->map(function ($answer) {
                $tiles_str = explode('.', $answer->answer);
                $tiles_img = '';
                foreach ($tiles_str as $tile_str) {
                    $tiles_img .= '<img src="' . config('const.TILES_IMG_PATH') . $tile_str . '.png" width="30px">';
                }
                $correct = '';
                if ($answer->correct) $correct = '○';
                return [$answer->id, $tiles_img,$correct, $answer->created_at];
            });
            return new Table(['id', '解答','正解', 'created_at'], $answers->toArray());
        });
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
        $show = new Show(WiningLv1Question::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('question', __('問題'));
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
        $form = new Form(new WiningLv1Question);

        $form->display('id', __('ID'));
        $form->text('question', '問題');

        $TileSetBox = new Box(
            '問題雀牌セット',
            view('admin.tile_set')
        );

        $form->html($TileSetBox);

        $form->hasMany('wining_lv1_answers', function (Form\NestedForm $form) {
            $form->text('answer', '選択答え');
            $form->radio('correct', '正誤')->options(['0' => '不正解', '1'=> '正解'])->default('0')->stacked();
        });


        $form->display('created_at', __('Created At'));
        $form->display('updated_at', __('Updated At'));

        return $form;
    }
}
