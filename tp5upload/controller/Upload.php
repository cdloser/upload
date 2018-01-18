<?php
namespace app\index\controller;

use think\Controller; 

class Index extends Controller{

    public function index()
    {
	  return  $this->fetch();
   }
public function do_add()
	{
	
    $data=input('post.');
	$file=request()->file('photo');//获取值
	$fileinfo=$file->move(config('upload_path'));
    $data['photo']= $fileinfo->getsavename();//获取图片路径
	$data['inputtime']=time();    ，，，，，，，，，，，，，，当前时间
	$table=db('wangwang');
	$info=$table->insert($data);
	if($info)
		{
	return	$this->success('成功');
	    }else{
	return	$this->error('失败');
		}
    }
   public function userlist()
	   {
	   $table=db('wangwang');
	   $list=$table->paginate(config('paginate.list_rows'));
	   $this->assign('userlist',$list);
	   $this->assign('img_path',config('upload_path'));     ，，，，，，，，，，，，图片路径
	   $this->assign('page',$list->render());
       return $this->fetch();
       }
	   public function deluser()
		   {
		   $id=input('id');
		   $table=db('wangwang');
		   $info=$table->where('id='.$id)->delete();
		   if($info)
			   {
			  $this->success('删除成功');
		       }else{
			   $this->error('删除失败');
			   }

	       }
}
