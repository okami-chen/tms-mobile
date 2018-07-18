<?php

namespace OkamiChen\TmsMobile\Controller;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use OkamiChen\TmsMobile\Entity\Mobile;

class MobileController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('手机号');
            $content->description('');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('手机号');
            $content->description('');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('手机号');
            $content->description('');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Mobile::class, function (Grid $grid) {

            $grid->id('编号')->sortable();
            $grid->column('name', '姓名');
            $grid->column('mobile', '手机');
            $grid->column('provide','运营商');
            $grid->column('monthly', '月租');
            $grid->column('remark','备注');
            $grid->column('created_at', '创建时间');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Mobile::class, function (Form $form) {
            $form->display('id', '编号');
            $form->text('name','姓名');
            $form->text('mobile', '手机号');
            $form->text('provider','服务商');
            $form->text('monthly','月租');
            $form->text('remark','备注');
            $form->text('flag','标志');
            $form->display('created_at', '创建时间');
            $form->display('updated_at', '更新时间');
        });
    }
}
