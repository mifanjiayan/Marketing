<?php
/**
 * Created by IntelliJ IDEA.
 * User: lidc
 * Date: 17-8-14
 * Time: 下午5:35
 */
class Controller_Customer extends Front{

    protected $layout = 'base';
    private $customer;

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        $this->customer = new Model_Customer();
    }

    /**
     * 用户信息
     * */
    public function infoAction()
    {
        $data = $this->_session->get('customer_info');
        $info = $this->customer->getInfo(['id'=>$data['id']]);
        $this->assign('info',$info);
        $this->display();
    }

    /**
     * 信息编辑
     * */
    public function editAction()
    {
        $data = $this->_request->getPost();
        $where['id'] =$data['id'] ;
        unset($data['id']);
        $re = $this->customer->editInfo($data,$where);
        if($re) fn_ajax_return(1,'编辑成功',$re);
        fn_ajax_return(0,'编辑失败');
    }

}