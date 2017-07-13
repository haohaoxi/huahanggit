<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
$this->title = '新闻管理';
$this->params['breadcrumbs'][] = $this->title;
?>
  <section id="layout" ng-app="doc.ui-layout">
    <div ui-layout class="layout-mock"> 
      <ui-layout options="{ flow : 'column' }">

        <!---rightcontent---->    
        <div class="center-back right-back">
        <div class="container-fluid">
          <div class="info-center">
                    <div class="page-header">
                      <div class="pull-left">
						<h4>新闻中心</h4>      
					</div>
                    <div class="pull-right">
                        <button type="button" class="btn btn-mystyle btn-sm">搜索</button>
                         <button type="button" class="btn btn-mystyle btn-sm">返回</button>
                    </div>
                    </div>
				    <div class="search-box row">
                       <div class="col-md-8">
                        <div class="form-group">
                          <span class="pull-left form-span">电子邮件:</span>
                           <input type="email" class="form-control" placeholder="请输入您的电子邮件">
                           </div>
                            <div class="form-group">
                              <input type="email" class="form-control" placeholder="请输件"> 
                           </div>
                           <div class="form-group">
                              <span class="pull-left form-span">状态:</span>
                              <select class="form-control">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                              </select>
                           </div>
                        <div class="form-group">
                          <input type="email" class="form-control" placeholder="请输件">                    
                       </div>
                       
                       
                       <div class="form-group btn-search">
                            <button class="btn btn-default" ><span class="glyphicon glyphicon-search"></span> 搜索</button>
                        </div>
                        </div>
                        <div class="col-md-4">
                         <div class="btn-group pull-right" role="group" aria-label="...">
                          <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> 新增</button>
                           <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="glyphicon glyphicon-edit"></span> 审核
                              <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                              <li><a href="#">通过</a></li>
                              <li><a href="#">不通过</a></li>
                            </ul>
                          </div>
                          <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span> 编辑</button>
                         <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-trash"></span> 删除</button>
                        </div>
                        </div>
                        
                    </div>
                    <div class="clearfix"></div>
                      <div class="table-margin">
                      <table class="table table-bordered table-header">
                      <thead>
                         <tr>
                           <td><input type="checkbox" /></td>
                           <td class="w70">标题内容</td>
                           <td class="w15">提交时间</td>
                           <td class="w15">类型</td>
                         </tr>
                         </thead>
                         <tbody>
                         <tr>
                          <td><input type="checkbox" /></td>
                          <td>2</td>
                          <td>2</td>
                          <td>2</td>
                         </tr>
                         <tr>
                          <td><input type="checkbox" /></td>
                          <td>2</td>
                          <td>2</td>
                          <td>2</td>
                         </tr>
                         </tbody>
                         <tfoot>
                          <tr>
                            <td colspan="4">
                              <div class="pull-right">
                                  <nav>
                                      <ul class="pagination">
                                        <li>
                                          <a href="#" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                          </a>
                                        </li>
                                        <li><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">4</a></li>
                                        <li><a href="#">5</a></li>
                                        <li>
                                          <a href="#" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                          </a>
                                        </li>
                                      </ul>
                                    </nav>
                              </div>
                            </td>
                          </tr>
                         </tfoot>
                      </table>
                    </div>
                    </div>
          </div>
        </div>
      </ui-layout>
   </div>
  </section>   