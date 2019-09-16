<?php
namespace app\admin\model;
use think\Db;
use think\Model;
use think\Loader;
use Env;
/**
 * 订单业务处理类
 */
class Orders extends Model{
	protected $pk = 'orderId';
	/**
	 * 获取用户订单列表
	 */
	public function pageQuery($orderStatus = 10000,$isAppraise = -1){
		$where = [];
		$where[] = ['o.dataFlag','=',1];
		if($orderStatus!=10000){
			$where[] = ['orderStatus','=',$orderStatus];
		}
		$startDate = input('startDate');
		$endDate = input('endDate');
		$orderNo = input('orderNo');
		$orderCode = input('orderCode');
		$userId = (int)input('userId');
		$payType = (int)input('payType',-1);
		$sort = input('sort');
		if($orderNo!='')$where[] = ['orderNo','like','%'.$orderNo.'%'];
		if($userId>0)$where[] = ['o.userId','=',$userId];
		if($orderCode!='')$where[] = ['orderCode','=',$orderCode];
		if($payType!=-1)$where[] = ['o.payType','=',$payType];
		$order = 'o.createTime desc';
		if($sort){
			$sort =  str_replace('.',' ',$sort);
			$order = $sort;
		}
		$page = $this->alias('o')->join('__USERS__ u','o.userId=u.userId','left')->where($where)
		     ->field('o.orderId,o.orderNo,u.loginName,o.totalMoney,
		              o.orderStatus,o.userName,payType,o.orderStatus,o.createTime')
			 ->order($order)
			 ->paginate(input('limit/d'))->toArray();
	    if(count($page['data'])>0){
	    	 foreach ($page['data'] as $key => $v){
	    	 	 $page['data'][$key]['userName'] = "【".$v['loginName']."】".$v['userName'];
	    	 	 $page['data'][$key]['payType'] = PYGLangPayType($v['payType']);
	    	 	
	    	 	 $page['data'][$key]['status'] = PYGLangOrderStatus($v['orderStatus']);
	    	 	 
	    	 }
	    }
	    return $page;
	}
	

	
	/**
	 * 获取订单详情
	 */
	public function getByView($orderId){
		$orders = $this->alias('o')
		               
		               ->join('__USERS__ u','o.userId=u.userId','left')
		               ->where('o.dataFlag=1 and o.orderId='.$orderId)
		               ->field('o.*,u.loginName')->find();
		if(empty($orders))return PYGReturn("无效的订单信息");
		//获取订单信息
		$log = Db::name('log_orders')->where('orderId',$orderId)->order('logId asc')->select();
		$orders['log'] = [];
		$logs = [];
		$logFilter = [];
		foreach ($log as $key => $v) {
			if(in_array($orders['orderStatus'],[-2,0,1,2]) && in_array($v['orderStatus'],$logFilter))continue;
			$logs[] = $v; 
			$logFilter[] = $v['orderStatus'];
		}
		$orders['log'] = $logs;
		//获取订单商品
		$orders['goods'] = Db::name('order_goods')->where('orderId',$orderId)->order('id asc')->select();
		return $orders;
	}
	
	/**
	 * 导出订单
	 */
	public function toExport(){
		$name='order';
		$where = [];
		$where[] = ['o.dataFlag','=',1];
		$orderStatus = (int)input('orderStatus',0);
		if($orderStatus==0){
			$name='PendingDelOrder';
		}else if($orderStatus==-2){
			$name='PendingPayorder';
		}else if($orderStatus==1){
			$name='DistributionOrder';
		}else if($orderStatus==10000){
			$name='order';
		}else if($orderStatus==-1){
			$name='CancelOrder';
		}else if($orderStatus==-3){
			$name='RejectionOrder';
		}else if($orderStatus==2){
			$name='ReceivedOrder';
		}
		$name = $name.date('Ymd');
		if($orderStatus!=10000){
			$where[] = ['o.orderStatus','=',$orderStatus];
		}
		$orderNo = input('orderNo');
		$shopName = input('shopName');
		$userId = (int)input('userId');
		$payType = (int)input('payType',-1);
		$deliverType = (int)input('deliverType',-1);
		$payFrom = input('payFrom');
		$isInvoice = input('isInvoice/d',-1);
		$isRefund = input('isRefund/d',-1);
		$startDate = input('startDate');
		$endDate = input('endDate');
		if($startDate!='')$where[] = ['o.createTime','>=',$startDate.' 00:00:00'];
		if($endDate!='')$where[] = ['o.createTime','<=',$endDate.' 23:59:59'];
		if(in_array($isInvoice,[0,1]))$where[] = ['o.isInvoice','=',$isInvoice];
		if(in_array($isRefund,[0,1]))$where[] = ['o.isRefund','=',$isRefund];
		if($payFrom!='')$where[] = ['payFrom','=',$payFrom];
		if($orderNo!='')$where[] = ['orderNo','like','%'.$orderNo.'%'];
		if($shopName!='')$where[] = ['shopName|shopSn','like','%'.$shopName.'%'];
		if($userId>0){
			$where[] = ['o.userId','=',$userId];
			$user = Db::name('users')->where('userId',$userId)->field('loginName')->find();
			$name = $user['loginName'].'Order';
		}
		$areaId1 = (int)input('areaId1');
		if($areaId1>0){
			$where[] = ['s.areaIdPath','like',"$areaId1%"];
			$areaId2 = (int)input("areaId1_".$areaId1);
			if($areaId2>0)$where[] = ['s.areaIdPath','like',$areaId1."_"."$areaId2%"];
			$areaId3 = (int)input("areaId1_".$areaId1."_".$areaId2);
			if($areaId3>0)$where[] = ['s.areaId','=',$areaId3];
		}
		
		if($deliverType!=-1)$where[] = ['o.deliverType','=',$deliverType];
		if($payType!=-1)$where[] = ['o.payType','=',$payType];
		$page = $this->alias('o')->where($where)
		->join('__USERS__ u','o.userId=u.userId','left')
		->join('__SHOPS__ s','o.shopId=s.shopId','left')
		->join('__LOG_ORDERS__ lo','lo.orderId=o.orderId and lo.orderStatus in (-1,-3) ','left')
		->field('o.orderId,o.orderNo,u.loginName,s.shopName,s.shopId,s.shopQQ,s.shopWangWang,u.loginName,o.goodsMoney,o.totalMoney,o.realTotalMoney,o.deliverMoney,lo.logContent,o.orderunique,o.payTime,o.payFrom,o.tradeNo
		,o.invoiceJson,o.isInvoice,o.isRefund,o.orderStatus,o.userName,o.userAddress,o.userPhone,o.orderRemarks,o.invoiceClient,o.receiveTime,o.deliveryTime,o.deliverType,payType,payFrom,o.orderStatus,orderSrc,o.createTime')
		->order('o.createTime', 'desc')
		->select();
		if(count($page)>0){
			foreach ($page as $v){
				$orderIds[] = $v['orderId'];
			}
			$goods = Db::name('order_goods')->where([['orderId','in',$orderIds]])->select();
			$goodsMap = [];
			foreach ($goods as $v){
				$v['goodsSpecNames'] = str_replace('@@_@@','、',$v['goodsSpecNames']);
				$goodsMap[$v['orderId']][] = $v;
			}
			foreach ($page as $key => $v){
				$page[$key]['invoiceArr'] = '';
				if($v['isInvoice']==1){
					$invoiceArr = json_decode($v['invoiceJson'],true);
					$page[$key]['invoiceArr'] = " ".$invoiceArr['invoiceHead'];
					if(isset($invoiceArr['invoiceCode'])){
						$page[$key]['invoiceArr'] = " ".$invoiceArr['invoiceHead'].'|'.$invoiceArr['invoiceCode'];
					}
				}
				$page[$key]['payTypeName'] = WSTLangPayType($v['payType']);
				$page[$key]['deliverType'] = WSTLangDeliverType($v['deliverType']==1);
				$page[$key]['status'] = WSTLangOrderStatus($v['orderStatus']);
				$page[$key]['goods'] = $goodsMap[$v['orderId']];
			}
		}
		require Env::get('root_path') . 'extend/phpexcel/PHPExcel/IOFactory.php';
		$objPHPExcel = new \PHPExcel();
		// 设置excel文档的属性
		$objPHPExcel->getProperties()->setCreator("WSTMart")//创建人
		->setLastModifiedBy("WSTMart")//最后修改人
		->setTitle($name)//标题
		->setSubject($name)//题目
		->setDescription($name)//描述
		->setKeywords("订单")//关键字
		->setCategory("Test result file");//种类
	
		// 开始操作excel表
		$objPHPExcel->setActiveSheetIndex(0);
		// 设置工作薄名称
		$objPHPExcel->getActiveSheet()->setTitle(iconv('gbk', 'utf-8', 'Sheet'));
		// 设置默认字体和大小
		$objPHPExcel->getDefaultStyle()->getFont()->setName(iconv('gbk', 'utf-8', ''));
		$objPHPExcel->getDefaultStyle()->getFont()->setSize(11);
		$styleArray = array(
				'font' => array(
						'bold' => true,
						'color'=>array(
								'argb' => 'ffffffff',
						)
				),
				'borders' => array (
						'outline' => array (
								'style' => \PHPExcel_Style_Border::BORDER_THIN,  //设置border样式
								'color' => array ('argb' => 'FF000000'),     //设置border颜色
						)
				)
		);
		//设置宽
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(12);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(16);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(16);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(16);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(12);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(12);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(12);
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(32);
		$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(12);
		$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(50);
		$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(50);
		$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getStyle('A1:Y1')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle('A1:Y1')->getFill()->getStartColor()->setARGB('333399');
		$objPHPExcel->getDefaultStyle()->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getDefaultStyle()->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
		
		$objPHPExcel->getActiveSheet()->setCellValue('A1', '订单编号')->setCellValue('B1', '订单状态')->setCellValue('C1', '商家')->setCellValue('D1', '会员')->setCellValue('E1', '收货人')
		->setCellValue('F1', '收货地址')->setCellValue('G1', '联系方式')->setCellValue('H1', '支付方式')->setCellValue('I1', '支付来源')->setCellValue('J1', '外部流水号')
		->setCellValue('K1', '配送方式')->setCellValue('L1', '买家留言')->setCellValue('M1', '发票信息')->setCellValue('N1', '订单商品')->setCellValue('O1', '商品价格')->setCellValue('P1', '数量')
		->setCellValue('Q1', '订单总金额')->setCellValue('R1', '运费')->setCellValue('S1', '实付金额')->setCellValue('T1', '下单时间')->setCellValue('U1', '付款时间')->setCellValue('V1', '发货时间')
		->setCellValue('W1', '收货时间')->setCellValue('X1', '取消/拒收原因')->setCellValue('Y1', '是否退款');
		$objPHPExcel->getActiveSheet()->getStyle('A1:Y1')->applyFromArray($styleArray);
	
		$i = 1;
		for ($row = 0; $row < count($page); $row++){
			$goodsn = count($page[$row]['goods']);
			$i = $i+1;
			$i2 = $i3 = $i;
			$i = $i+(1*$goodsn)-1;
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$i2.':A'.$i)->mergeCells('B'.$i2.':B'.$i)->mergeCells('C'.$i2.':C'.$i)->mergeCells('D'.$i2.':D'.$i)->mergeCells('E'.$i2.':E'.$i)->mergeCells('F'.$i2.':F'.$i)
			->mergeCells('G'.$i2.':G'.$i)->mergeCells('H'.$i2.':H'.$i)->mergeCells('I'.$i2.':I'.$i)->mergeCells('J'.$i2.':J'.$i)->mergeCells('K'.$i2.':K'.$i)->mergeCells('L'.$i2.':L'.$i)->mergeCells('M'.$i2.':M'.$i)
			->mergeCells('Q'.$i2.':Q'.$i)->mergeCells('R'.$i2.':R'.$i)->mergeCells('S'.$i2.':S'.$i)->mergeCells('T'.$i2.':T'.$i)->mergeCells('U'.$i2.':U'.$i)->mergeCells('V'.$i2.':V'.$i)->mergeCells('W'.$i2.':W'.$i)
			->mergeCells('X'.$i2.':X'.$i)->mergeCells('Y'.$i2.':Y'.$i);
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$i2, $page[$row]['orderNo'])->setCellValue('B'.$i2, $page[$row]['status'])->setCellValue('C'.$i2, $page[$row]['shopName'])->setCellValue('D'.$i2, $page[$row]['loginName'])
			->setCellValue('E'.$i2, $page[$row]['userName'])->setCellValue('F'.$i2, $page[$row]['userAddress'])->setCellValue('G'.$i2, $page[$row]['userPhone'])->setCellValue('H'.$i2, $page[$row]['payTypeName'])
			->setCellValue('I'.$i2, ($page[$row]['payFrom'])?WSTLangPayFrom($page[$row]['payFrom']):'')->setCellValue('J'.$i2, " ".$page[$row]['tradeNo'])->setCellValue('K'.$i2, $page[$row]['deliverType'])->setCellValue('L'.$i2, $page[$row]['orderRemarks'])
			->setCellValue('M'.$i2, $page[$row]['invoiceArr'])->setCellValue('Q'.$i2, $page[$row]['totalMoney'])->setCellValue('R'.$i2, $page[$row]['deliverMoney'])->setCellValue('S'.$i2, $page[$row]['realTotalMoney'])
			->setCellValue('T'.$i2, $page[$row]['createTime'])->setCellValue('U'.$i2, $page[$row]['payTime'])->setCellValue('V'.$i2, $page[$row]['deliveryTime']) 
			->setCellValue('W'.$i2, $page[$row]['receiveTime'])->setCellValue('X'.$i2, $page[$row]['logContent'])->setCellValue('Y'.$i2, ($page[$row]['isRefund']==1)?'是':'');
			$objPHPExcel->getActiveSheet()->getStyle('F'.$i2)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			$objPHPExcel->getActiveSheet()->getStyle('X'.$i2)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			for ($row2 = 0; $row2 < $goodsn; $row2++){
				$objPHPExcel->getActiveSheet()->setCellValue('N'.$i3, (($page[$row]['goods'][$row2]['goodsCode']=='gift')?'【赠品】':'').$page[$row]['goods'][$row2]['goodsName'].(($page[$row]['goods'][$row2]['goodsSpecNames']!='')?"【".$page[$row]['goods'][$row2]['goodsSpecNames']."】":''))->setCellValue('O'.$i3, $page[$row]['goods'][$row2]['goodsPrice'])->setCellValue('P'.$i3, $page[$row]['goods'][$row2]['goodsNum']);
				$objPHPExcel->getActiveSheet()->getStyle('N'.$i2)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				$i3 = $i3 + 1;
			}
		}
	
		//输出EXCEL格式
		$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		// 从浏览器直接输出$filename
		header('Content-Type:application/csv;charset=UTF-8');
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
		header("Content-Type:application/force-download");
		header("Content-Type:application/vnd.ms-excel;");
		header("Content-Type:application/octet-stream");
		header("Content-Type:application/download");
		header('Content-Disposition: attachment;filename="'.$name.'.xls"');
		header("Content-Transfer-Encoding:binary");
		$objWriter->save('php://output');
	}

    /**
	 * 编辑-确认发货
	 */
	public function editExpress1(){
			$data = input('post.');
			$data['orderStatus'] = 1;//状态改为待收货
			$data['receiveTime'] = date('Y-m-d H:i:s');
		    $result = $this->save($data,['orderId'=>(int)$data['orderId']]);
	        if(false !== $result){
	        	return PYGReturn("发货成功", 1);
	        }else{
        		return PYGReturn($this->getError(),-1); 
        	}
		
    }
}