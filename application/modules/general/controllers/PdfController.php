<?php
//updated in 22th Augest 2011 by lxj version 0.1
//numbers and page names
/*
1 => employee index 
2 => employee display
3 => employee ajaxdisplay
4.=> project index
5 => project/index/ajaxdisplay
6 => pment/cpp
7 => pment/cpp/ajaxdisplay
8 => pment/mstprg
9 => pment/mstprg/display

example of export a tag
<div><a target="_blank" href="/general/pdf/generate/page/1"><img src="/images/icons/functions/export.png"/><p>导出</p></a></div>
*/
class General_PdfController extends Zend_Controller_Action
{
	public function init()
	{
		/* Initialize action controller here */
	}

	public function generateAction()
	{
		$this->_helper->layout()->disableLayout();
	//	$this->_helper->viewRenderer->setNoRender(true);
		
		$pdf = new Zend_Pdf();
		$page = $pdf->newPage(Zend_Pdf_Page::SIZE_A4);
		$font = Zend_Pdf_Font::fontWithPath('font/simkai.ttf',(Zend_Pdf_Font::EMBED_SUPPRESS_EMBED_EXCEPTION |Zend_Pdf_Font::EMBED_DONT_COMPRESS));
		$target = $this->_getParam('page',0);
		if($target > 0)
		{
			$url = null;
			if($target == 1)
			{
				$url = $this->pageEmployeeIndex($pdf,$page,$font);
				}
				elseif($target == 2)
				{
					$url = $this->pageEmployeeDisplay($pdf,$page,$font);
					}
					elseif($target == 3)
					{
						$url = $this->pageEmployeeAjaxDisplay($pdf, $page, $font);
						}
						elseif($target == 4)
						{
							$url = $this->pageProjectIndex($pdf, $page, $font);
							}
							elseif($target == 5)
							{
								$url = $this->pageProjectAjaxDisplay($pdf, $page, $font);
								}
								elseif($target == 6)
								{
									$url = $this->pagePmentCpp($pdf, $page, $font);
									}
									elseif($target == 7)
									{
										$url = $this->pagePmentCppAjaxDisplay($pdf, $page, $font);
										}
										elseif($target == 8)
										{
											$url = $this->pagePmentMsprg($pdf, $page, $font);
											}
											elseif($target == 9)
											{
												$url = $this->pagePmentMsprgDisplay($pdf, $page, $font);
												
												}
												elseif($target == 10)
												{
													$url = $this->pagePmentPlogDisplay($pdf, $page, $font);
													}
													elseif($target == 11)
													{
														$url = $this->pagePmentTech($pdf, $page, $font);
														}
														elseif($target == 12)
														{
															$url = $this->pagePmentTechAjaxDisplay($pdf, $page, $font);
															}
															elseif($target == 13)
															{
																$url = $this->pagePmentTraining($pdf, $page, $font);
																}
																elseif($target == 14)
																{
																	$url = $this->pagePmentTrainingAjaxDisplay($pdf, $page, $font);
																	}
																	elseif($target == 15)
																	{
																		$url = $this->pagePmentMeasure($pdf, $page, $font);
																		}
																		elseif($target == 16)
																		{
																			$url = $this->pagePmentMeasureAjaxDisplay($pdf, $page,$font);
																			}
																			elseif($target == 17)
																			{
																				$url = $this->pagePmentRecord($pdf, $page, $font);
																				}
																				elseif($target == 18)
																				{
																					$url = $this->pagePmentRecordAjaxDisplay($pdf, $page, $font);
																					}
																					elseif($target == 19)
																					{
																						$url = $this->pagePmentSeal($pdf, $page, $font);
																						}
																						elseif($target == 20)
																						{
																							$url = $this->pagePmentSealAjaxDisplay($pdf, $page, $font);
																						}
			$base = General_Models_ServerInfo::$serverUrl;
			$murl = $base.'/'.$url;
			$this->view->murl = $murl;
			}
			else
			{
				$this->_redirect('/');
				}
		}
		
	protected function pageEmployeeIndex($pdf,$page,$font)
	{
		//put the personal information to the pdf
		$contacts = new Employee_Models_ContactMapper();
		$arrayContacts = $contacts->fetchAllJoin();
		$count = 1;//every page show approximately 20 pieces;
		//$arrayCount = count($arrayContacts);
		$totalItems = $arrayContacts->getTotalItemCount();
		$arrayContacts->setItemCountPerPage($totalItems);

		$pageNumber = ceil($totalItems / 25);
		$x = 0; $y = 750;
		$currentpage = 1;
		foreach($arrayContacts as $contact)
		{
			if($count == 1)
			{
				$page->setLineWidth(0.5);
				$page->drawLine(50, 770, 560, 770);
				$page->drawLine(50, 125, 560, 125);
				$page->setFont($font,13)
						->drawText("编号", 50, $y, 'UTF-8')
						->drawText("姓名", 100, $y, 'UTF-8')
						->drawText("性别", 145, $y, 'UTF-8')
						->drawText("生日", 195, $y, 'UTF-8')
						->drawText("部门", 275, $y, 'UTF-8')
						->drawText("职务", 335, $y, 'UTF-8')
						->drawText("入职时间", 415, $y, 'UTF-8')
						->drawText("手机号码", 495, $y, 'UTF-8');
				$time = Date("Y-m-d,H:i");
				$users = new System_Models_UserMapper();
				$contactId = $users->getContactId($this->getUserId());
				$contacts = new Employee_Models_ContactMapper();
				$contactName = $contacts->findContactName($contactId);
				$page->setFont($font,11)
						->drawText("公司员工信息总览", 250, 790, 'UTF-8')
						->drawText("导出人:".$contactName, 50, 100, 'UTF-8')
						->drawText("导出日期:".$time, 250, 100, 'UTF-8')
						->drawText("页数:".$currentpage."(".$pageNumber.")", 500, 100, 'UTF-8');
				}
				$y -= 25;$count++;
				$page->setFont($font, 11)
						->drawText($contact->contactId, $x+=50, $y, 'UTF-8')
						->drawText($contact->contactName, $x+=50, $y, 'UTF-8')
						->drawText($contact->gender, $x+=45, $y, 'UTF-8')
						->drawText($contact->birth, $x+=50, $y, 'UTF-8')
						->drawText($contact->deptName, $x+=80, $y, 'UTF-8')
						->drawText($contact->dutyName, $x+=60, $y, 'UTF-8')
						->drawText($contact->enroll, $x+=80, $y, 'UTF-8')
						->drawText($contact->phoneMob, $x+=80, $y, 'UTF-8');
			if($count >= 25)
			{
				$pdf->pages[] = $page;
				$page = $pdf->newPage(Zend_Pdf_Page::SIZE_A4);
				$count = 1;
				$y = 750;
				$currentpage++;
				}
			$x = 0;
			}
		$pdf->pages[] = $page;
		$name_string = "公司员工信息总览".time().".pdf";
		$name_stringEn = urlencode("公司员工信息总览".time()).".pdf";
		$url = 'tmp/'.$name_string;
		$urlEn='tmp/'.$name_stringEn;
		$pdf->save($url);
		return $urlEn;
	}
	
	protected function pageEmployeeDisplay($pdf,$page,$font)
	{
		//put the personal information to the pdf
		$contacts = new Employee_Models_ContactMapper();
		$contactId = $this->_getParam('id',0);
		$contact = new Employee_Models_Contact();
		$contacts->findComplete($contactId,$contact);
		//$this ->view->contact = $contact;
		//$arrayContacts = $contacts->fetchAllJoin();
		//$count = 1;
		//$totalItems = $arrayContacts->getTotalItemCount();
		//$arrayContacts->setItemCountPerPage($totalItems);

		$pageNumber = 1;
		$x = 0; $y = 750;
		$currentpage = 1;
		$page->setLineWidth(0.5);
		$page->drawLine(50, 770, 560, 770);
		$page->drawLine(50, 125, 560, 125);
		$page->setFont($font,13)
				->drawText("姓名:", 50, $y, 'UTF-8')
				->drawText($contact->getName(), 100, $y, 'UTF-8')
				->drawText("性别:", 350, $y, 'UTF-8')
				->drawText($contact->getGender(), 400, $y, 'UTF-8')
				
				->drawText("生日:", 50, $y-=20, 'UTF-8')
				->drawText($contact->getBirth(),100, $y, 'UTF-8')
				->drawText("年龄:", 350, $y, 'UTF-8')
				->drawText($contact->getAge(), 400, $y, 'UTF-8')
				
				->drawText("手机号:", 50, $y-=20, 'UTF-8')
				->drawText($contact->getPhoneMob(), 100, $y, 'UTF-8')
				->drawText("电话(家):", 350, $y, 'UTF-8')
				->drawText($contact->getPhoneHome(), 450, $y, 'UTF-8')
				
				->drawText("职称专业:", 50, $y-=20, 'UTF-8')
				->drawText($contact->getTitleSpec(), 110, $y, 'UTF-8')
				->drawText("职称:", 350, $y, 'UTF-8')
				->drawText($contact->getTitleName(), 400, $y, 'UTF-8')
				
				->drawText("入职时间:", 50, $y-=20, 'UTF-8')
				->drawText($contact->getEnroll(), 110, $y, 'UTF-8')
				->drawText("政治面貌:", 350, $y, 'UTF-8')
				->drawText($contact->getPolitical(), 410, $y, 'UTF-8')
				
				->drawText("部门:", 50, $y-=20, 'UTF-8')
				->drawText($contact->getDeptName(), 100, $y, 'UTF-8')
				->drawText("职务:", 350, $y, 'UTF-8')
				->drawText($contact->getDutyName(), 400, $y, 'UTF-8')
				
				->drawText("学历:", 50, $y-=20, 'UTF-8')
				->drawText($contact->getEdu(), 100, $y, 'UTF-8')
				->drawText("民族:", 350, $y, 'UTF-8')
				->drawText($contact->getEthnic(), 400, $y, 'UTF-8')
				
				->drawText("身份证:", 50, $y-=20, 'UTF-8')
				->drawText($contact->getIdCard(), 100, $y, 'UTF-8')
				->drawText("本市家庭住址:",50, $y-=20, 'UTF-8')
				->drawText($contact->getAddress(), 150, $y, 'UTF-8')
				
				->drawText("邮编:", 50, $y-=20, 'UTF-8')
				->drawText($contact->getZip(), 100, $y, 'UTF-8')
				->drawText("户口所在地:", 350, $y, 'UTF-8')
				->drawText($contact->getResidence(), 450, $y, 'UTF-8')
				
				->drawText("试用期起始日期:", 50, $y-=20, 'UTF-8')
				->drawText($contact->getProbStart(), 150, $y, 'UTF-8')
				->drawText("试用期结束日期:", 350, $y, 'UTF-8')
				->drawText($contact->getProbEnd(), 450, $y, 'UTF-8')
				
				->drawText("档案所在地:", 50, $y-=20, 'UTF-8')
				->drawText($contact->getProfile(), 150, $y, 'UTF-8')
				->drawText("社保现状: ", 350, $y-=20, 'UTF-8')
				->drawText($contact->getSecurity(), 450, $y, 'UTF-8')
				
				->drawText("社保是否迁入公司:", 50, $y-=20, 'UTF-8')
				->drawText($contact->getSecIn(), 200, $y, 'UTF-8')
				->drawText("社保何时迁入公司:", 350, $y, 'UTF-8')
				->drawText($contact->getSecDate(), 500, $y, 'UTF-8')
				
				->drawText("入职前体检结果:", 50, $y-=20, 'UTF-8')
				->drawText($contact->getMedical(), 150, $y, 'UTF-8')
				->drawText("第一联系人称呼:", 50, $y-=20, 'UTF-8')
				->drawText($contact->getRelation1(), 150, $y, 'UTF-8')
				
				->drawText("第一联系人姓名:", 350, $y, 'UTF-8')
				->drawText($contact->getName1(), 450, $y, 'UTF-8')
				->drawText("第一联系人工作单位:", 50, $y-=20, 'UTF-8')
				->drawText($contact->getCompany1(), 200, $y, 'UTF-8')
				
				->drawText("第一联系人居住地: ", 50, $y-=20, 'UTF-8')
				->drawText($contact->getAddress1(), 200, $y, 'UTF-8')
				->drawText("第一联系人联系电话:", 50, $y-=20, 'UTF-8')
				->drawText($contact->getPhone1(), 200, $y, 'UTF-8')
				
				->drawText("家庭主要成员一称呼:", 350, $y, 'UTF-8')
				->drawText($contact->getRelation2(), 500, $y, 'UTF-8')
				->drawText("家庭主要成员一姓名:", 50, $y-=20, 'UTF-8')
				->drawText($contact->getName2(), 200, $y, 'UTF-8')
				
				->drawText("家庭主要成员一工作单位:", 50, $y-=20, 'UTF-8')
				->drawText($contact->getCompany2(), 200, $y, 'UTF-8')
				->drawText("家庭主要成员二称呼: ", 50, $y-=20, 'UTF-8')
				->drawText($contact->getRelation3(), 200, $y, 'UTF-8')
				
				->drawText("家庭主要成员二姓名:", 350, $y, 'UTF-8')
				->drawText($contact->getName3(), 500, $y, 'UTF-8')
				->drawText("家庭主要成员二工作单位:", 50, $y-=20, 'UTF-8')
				->drawText($contact->getCompany3(), 200, $y, 'UTF-8')
				
				->drawText("家庭主要成员二居住地:", 50, $y-=20, 'UTF-8')
				->drawText($contact->getAddress3(),150, $y, 'UTF-8')
				->drawText("家庭主要成员二联系电话:", 350, $y, 'UTF-8')
				->drawText($contact->getPhone3(), 500, $y, 'UTF-8')
				
				->drawText("家庭主要成员三称呼:", 50, $y-=20, 'UTF-8')
				->drawText($contact->getRelation4(), 200, $y, 'UTF-8')
				->drawText("家庭主要成员三姓名:", 350, $y, 'UTF-8')
				->drawText($contact->getName4(), 500, $y, 'UTF-8')
				
				->drawText("家庭主要成员三工作单位:", 50, $y-=20, 'UTF-8')
				->drawText($contact->getCompany4(), 200, $y, 'UTF-8')
				->drawText("家庭主要成员三居住地: ", 50, $y-=20, 'UTF-8')
				->drawText($contact->getAddress4(),200, $y, 'UTF-8')
				
				->drawText("家庭主要成员三联系电话:", 350, $y, 'UTF-8')
				->drawText($contact->getPhone4(), 500, $y, 'UTF-8')
				->drawText("备注:", 50, $y-=20, 'UTF-8')
				->drawText($contact->getRemark(), 100, $y, 'UTF-8');
				$time = Date("Y-m-d,H:i");
				$users = new System_Models_UserMapper();
				$contactId = $users->getContactId($this->getUserId());
				$contacts = new Employee_Models_ContactMapper();
				$contactName = $contacts->findContactName($contactId);
				$page->setFont($font,11)
						->drawText("公司员工信息", 250, 790, 'UTF-8')
						->drawText("导出人:".$contactName, 50, 100, 'UTF-8')
						->drawText("导出日期:".$time, 250, 100, 'UTF-8')
						->drawText("页数:".$currentpage."(".$pageNumber.")", 500, 100, 'UTF-8');
				$pdf->pages[] = $page;
				$name_string = "公司员工信息".time().".pdf";
				$name_stringEn = urlencode("公司员工信息".time()).".pdf";
				$url = 'tmp/'.$name_string;
				$urlEn='tmp/'.$name_stringEn;
				$pdf->save($url);
		return $urlEn;

	}
	
	protected function pageProjectIndex($pdf,$page,$font)
	{
		$page = $pdf->newPage(Zend_Pdf_Page::SIZE_A4_LANDSCAPE);
		//put the personal information to the pdf
		$projects = new Project_Models_ProjectMapper();
		$arrayProjects = $projects->fetchAllJoin();
		$count = 1;//every page show approximately 20 pieces;
		//$arrayCount = count($arrayContacts);
		$totalItems = $arrayProjects->getTotalItemCount();
		$arrayProjects->setItemCountPerPage($totalItems);
		$pageNumber = ceil($totalItems / 15);
		$x = 0; $y = 535;
		$currentpage = 1;
		foreach($arrayProjects as $project)
		{
			if($count == 1)
			{
				$page->setLineWidth(0.5);
				$page->drawLine(50, 550, 780, 550);
				$page->drawLine(50, 75, 780, 75);
				$page->setFont($font,13)
						->drawText("工程编号", 50, $y, 'UTF-8')
						->drawText("工程名称", 110, $y, 'UTF-8')
						->drawText("工程状态", 400, $y, 'UTF-8')
						->drawText("结构类型", 470, $y, 'UTF-8')
						->drawText("开工时间", 540, $y, 'UTF-8')
						->drawText("项目经理", 610, $y, 'UTF-8')
						->drawText("施工许可证号", 680, $y, 'UTF-8');
				$time = Date("Y-m-d,H:i");
				$users = new System_Models_UserMapper();
				$contactId = $users->getContactId($this->getUserId());
				$contacts = new Employee_Models_ContactMapper();
				$contactName = $contacts->findContactName($contactId);
				$page->setFont($font,11)
						->drawText("工程管理总览", 390, 560, 'UTF-8')
						->drawText("导出人:".$contactName, 50, 60, 'UTF-8')
						->drawText("导出日期:".$time, 350, 60, 'UTF-8')
						->drawText("页数:".$currentpage."(".$pageNumber.")", 690, 60, 'UTF-8');
				}
				$y -= 25;$count++;
				$page->setFont($font, 11)
						->drawText($project->projectId, $x+=50, $y, 'UTF-8')
						->drawText($project->name, $x+=60, $y, 'UTF-8')
						->drawText($project->status, $x+=290, $y, 'UTF-8')
						->drawText($project->structype, $x+=70, $y, 'UTF-8')
						->drawText($project->startDate, $x+=70, $y, 'UTF-8')
						->drawText($project->contactName, $x+=70, $y, 'UTF-8')
						->drawText($project->license, $x+=70, $y, 'UTF-8');
			if($count >= 15)
			{
				$pdf->pages[] = $page;
				$page = $pdf->newPage(Zend_Pdf_Page::SIZE_A4_LANDSCAPE);
				$count = 1;
				$y = 750;
				$currentpage++;
				}
			$x = 0;
			}
		$pdf->pages[] = $page;
		$name_string = "工程管理总览".time().".pdf";
		$name_stringEn = urlencode("工程管理总览".time()).".pdf";
		$url = 'tmp/'.$name_string;
		$urlEn='tmp/'.$name_stringEn;
		$pdf->save($url);
		return $urlEn;
	}
	
	protected function pageEmployeeAjaxDisplay($pdf,$page,$font)
	{
		//put the personal information to the pdf
		$contacts = new Employee_Models_ContactMapper();
		$contactId = $this->_getParam('id',0);
		$contact = new Employee_Models_Contact();
		$contacts->findComplete($contactId,$contact);
		$x = 50; $y = 750;
		$currentpage = 1;
		$pageNumber = 1;
		$page->setLineWidth(0.5);
		$page->drawLine(50, 770, 560, 770);
		$page->drawLine(50, 125, 560, 125);
		$page->setFont($font,13)
				->drawText("姓名:", $x, $y-=20, 'UTF-8')
				->drawText($contact->getName(), $x+50, $y, 'UTF-8')

				->drawText("性别:", $x, $y-=20, 'UTF-8')
				->drawText($contact->getGender(), $x+50, $y, 'UTF-8')

				->drawText("生日:", $x, $y-=20, 'UTF-8')
				->drawText($contact->getBirth(), $x+50, $y, 'UTF-8')

				->drawText("部门:", $x, $y-=20, 'UTF-8')
				->drawText($contact->getDeptName(), $x+50, $y, 'UTF-8')

				->drawText("职务:", $x, $y-=20, 'UTF-8')
				->drawText($contact->getDutyName(), $x+50, $y, 'UTF-8')

				->drawText("入职时间:", $x, $y-=20, 'UTF-8')
				->drawText($contact->getEnroll(), $x+100, $y, 'UTF-8')

				->drawText("手机号码:", $x, $y-=20, 'UTF-8')
				->drawText($contact->getPhoneMob(), $x+100, $y, 'UTF-8');
		$time = Date("Y-m-d,H:i");
		$users = new System_Models_UserMapper();
		$contactId = $users->getContactId($this->getUserId());
		$contacts = new Employee_Models_ContactMapper();
		$contactName = $contacts->findContactName($contactId);
		$page->setFont($font,11)
				->drawText("员工信息总览", 250, 790, 'UTF-8')
				->drawText("导出人:".$contactName, 50, 100, 'UTF-8')
				->drawText("导出日期:".$time, 250, 100, 'UTF-8')
				->drawText("页数:".$currentpage."(".$pageNumber.")", 500, 100, 'UTF-8');
		$pdf->pages[] = $page;
		$name_string = "员工信息总览".time().".pdf";
		$name_stringEn = urlencode("员工信息总览".time()).".pdf";
		$url = 'tmp/'.$name_string;
		$urlEn='tmp/'.$name_stringEn;
		$pdf->save($url);
		return $urlEn;
	}
	
/*update 2011-08-23 version 0.2 auther lxj*/	
	protected function pageProjectAjaxDisplay($pdf,$page,$font)
	{
		//put the personal information to the pdf
		$projects = new Project_Models_ProjectMapper();
		$projectId = $this->_getParam('id',0);
		$project = new Project_Models_Project();
		$projects->find($projectId,$project);
		$x = 50; $y = 750;
		$currentpage = 1;
		$pageNumber = 1;
		$page->setLineWidth(0.5);
		$page->drawLine(50, 770, 560, 770);
		$page->drawLine(50, 125, 560, 125);
		$page->setFont($font,13)
				->drawText("工程名称:", $x, $y-=20, 'UTF-8')
				->drawText($project->getName(), $x+150, $y, 'UTF-8')

				->drawText("地址:", $x, $y-=20, 'UTF-8')
				->drawText($project->getAddress(), $x+150, $y, 'UTF-8')

				->drawText("工程状态:", $x, $y-=20, 'UTF-8')
				->drawText($project->getStatus(), $x+150, $y, 'UTF-8')

				->drawText("结构类型:", $x, $y-=20, 'UTF-8')
				->drawText($project->getStructype(), $x+150, $y, 'UTF-8')

				->drawText("层数:", $x, $y-=20, 'UTF-8')
				->drawText($project->getLevel(), $x+150, $y, 'UTF-8')

				->drawText("合同工期(天):", $x, $y-=20, 'UTF-8')
				->drawText($project->getPeriod(), $x+150, $y, 'UTF-8')

				->drawText("开工日期:", $x, $y-=20, 'UTF-8')
				->drawText($project->getStartDate(), $x+150, $y, 'UTF-8')
				
				->drawText("项目经理:", $x, $y-=20, 'UTF-8')
				->drawText($project->getContactName(), $x+150, $y, 'UTF-8')

				->drawText("建设单位:", $x, $y-=20, 'UTF-8')
				->drawText($project->getConstructor(), $x+150, $y, 'UTF-8')

				->drawText("工程承包单位:", $x, $y-=20, 'UTF-8')
				->drawText($project->getContractor(), $x+150, $y, 'UTF-8')

				->drawText("监理单位:", $x, $y-=20, 'UTF-8')
				->drawText($project->getSupervisor(), $x+150, $y, 'UTF-8')

				->drawText("设计单位:", $x, $y-=20, 'UTF-8')
				->drawText($project->getDesigner(), $x+150, $y, 'UTF-8')

				->drawText("施工许可证编号:", $x, $y-=20, 'UTF-8')
				->drawText($project->getLicense(), $x+150, $y, 'UTF-8')
				
				->drawText("合同金额(元人民币):", $x, $y-=20, 'UTF-8')
				->drawText($project->getAmount(), $x+150, $y, 'UTF-8')

				->drawText("建筑面积(平方米):", $x, $y-=20, 'UTF-8')
				->drawText($project->getConstrArea(), $x+150, $y, 'UTF-8');
				
		$time = Date("Y-m-d,H:i");
		$users = new System_Models_UserMapper();
		$contactId = $users->getContactId($this->getUserId());
		$contacts = new Employee_Models_ContactMapper();
		$contactName = $contacts->findContactName($contactId);
		$page->setFont($font,11)
				->drawText("工程详情总览", 250, 790, 'UTF-8')
				->drawText("导出人:".$contactName, 50, 100, 'UTF-8')
				->drawText("导出日期:".$time, 250, 100, 'UTF-8')
				->drawText("页数:".$currentpage."(".$pageNumber.")", 500, 100, 'UTF-8');
		$pdf->pages[] = $page;
		$name_string = "工程详情总览".time().".pdf";
		$name_stringEn = urlencode("工程详情总览".time()).".pdf";
		$url = 'tmp/'.$name_string;
		$urlEn='tmp/'.$name_stringEn;
		$pdf->save($url);
		return $urlEn;
	}
	
	protected function pagePmentCpp($pdf,$page,$font)
	{
		$condition[0] = $this->_getParam('projectId',0);
		$condition[1] = null;
		//put the personal information to the pdf
		$cpps = new Pment_Models_CppMapper();
		$arrayCpps = $cpps->fetchAllJoin(null,$condition);
		$count = 1;//every page show approximately 20 pieces;
		//$arrayCount = count($arrayContacts);
		$totalItems = $arrayCpps->getTotalItemCount();
		$arrayCpps->setItemCountPerPage($totalItems);
		$pageNumber = ceil($totalItems / 25);
		$x = 0; $y = 750;
		$currentpage = 1;
		foreach($arrayCpps as $cpp)
		{
			if($count == 1)
			{
				$page->setLineWidth(0.5);
				$page->drawLine(50, 770, 560, 770);
				$page->drawLine(50, 125, 560, 125);
				$page->setFont($font,13)
						->drawText("编号", 50, $y, 'UTF-8')
						->drawText("姓名", 100, $y, 'UTF-8')
						->drawText("岗位名称", 200, $y, 'UTF-8')
						->drawText("职业资格", 300, $y, 'UTF-8')
						->drawText("证书编号", 400, $y, 'UTF-8')
						->drawText("开始承担责任时间", 470, $y, 'UTF-8');
				$time = Date("Y-m-d,H:i");
				$users = new System_Models_UserMapper();
				$contactId = $users->getContactId($this->getUserId());
				$contacts = new Employee_Models_ContactMapper();
				$contactName = $contacts->findContactName($contactId);
				$page->setFont($font,11)
						->drawText("工程岗位信息总览", 250, 790, 'UTF-8')
						->drawText("导出人:".$contactName, 50, 100, 'UTF-8')
						->drawText("导出日期:".$time, 250, 100, 'UTF-8')
						->drawText("页数:".$currentpage."(".$pageNumber.")", 500, 100, 'UTF-8');
				}
				$y -= 25;$count++;
				$page->setFont($font, 11)
						->drawText($cpp->cppId, $x+=50, $y, 'UTF-8')
						->drawText($cpp->contactName, $x+=50, $y, 'UTF-8')
						->drawText($cpp->postName, $x+=100, $y, 'UTF-8')
						->drawText($cpp->qualif, $x+=100, $y, 'UTF-8')
						->drawText($cpp->certId, $x+=100, $y, 'UTF-8')
						->drawText($cpp->startDate, $x+=70, $y, 'UTF-8');
			if($count >= 25)
			{
				$pdf->pages[] = $page;
				$page = $pdf->newPage(Zend_Pdf_Page::SIZE_A4);
				$count = 1;
				$y = 750;
				$currentpage++;
				}
			$x = 0;
			}
		$pdf->pages[] = $page;
		$name_string = "工程岗位信息总览".time().".pdf";
		$name_stringEn = urlencode("工程岗位信息总览".time()).".pdf";
		$url = 'tmp/'.$name_string;
		$urlEn='tmp/'.$name_stringEn;
		$pdf->save($url);
		return $urlEn;
	}
	
	protected function pagePmentCppAjaxDisplay($pdf,$page,$font)
	{
		//put the personal information to the pdf
		$cpps = new Pment_Models_CppMapper();
		$cppId = $this->_getParam('id',0);
		$cpp = new Pment_Models_Cpp();
		$cpps->find($cppId,$cpp);
		$x = 50; $y = 750;
		$currentpage = 1;
		$pageNumber = 1;
		$page->setLineWidth(0.5);
		$page->drawLine(50, 770, 560, 770);
		$page->drawLine(50, 125, 560, 125);
		$page->setFont($font,13)
				->drawText("员工姓名:", $x, $y-=20, 'UTF-8')
				->drawText($cpp->getContactName(), $x+150, $y, 'UTF-8')

				->drawText("岗位名称:", $x, $y-=20, 'UTF-8')
				->drawText($cpp->getPostName(), $x+150, $y, 'UTF-8')

				->drawText("职业资格:", $x, $y-=20, 'UTF-8')
				->drawText($cpp->getQualif(), $x+150, $y, 'UTF-8')

				->drawText("证书编号:", $x, $y-=20, 'UTF-8')
				->drawText($cpp->getCertId(), $x+150, $y, 'UTF-8')

				->drawText("开始承担责任时间:", $x, $y-=20, 'UTF-8')
				->drawText($cpp->getStartDate(), $x+150, $y, 'UTF-8')

				->drawText("岗位职责:", $x, $y-=20, 'UTF-8')
				->drawText($cpp->getPostDetail(), $x+150, $y, 'UTF-8')

				->drawText("具体职责:", $x, $y-=20, 'UTF-8')
				->drawText($cpp->getResponsi(), $x+150, $y, 'UTF-8')
				
				->drawText("备注:", $x, $y-=20, 'UTF-8')
				->drawText($cpp->getRemark(), $x+150, $y, 'UTF-8')

				->drawText("上次修改时间:", $x, $y-=20, 'UTF-8')
				->drawText($cpp->getCTime(), $x+150, $y, 'UTF-8');
		$time = Date("Y-m-d,H:i");
		$users = new System_Models_UserMapper();
		$contactId = $users->getContactId($this->getUserId());
		$contacts = new Employee_Models_ContactMapper();
		$contactName = $contacts->findContactName($contactId);
		$page->setFont($font,11)
				->drawText("工程岗位信息总览", 250, 790, 'UTF-8')
				->drawText("导出人:".$contactName, 50, 100, 'UTF-8')
				->drawText("导出日期:".$time, 250, 100, 'UTF-8')
				->drawText("页数:".$currentpage."(".$pageNumber.")", 500, 100, 'UTF-8');
		$pdf->pages[] = $page;
		$name_string = "工程岗位信息总览".time().".pdf";
		$name_stringEn = urlencode("工程岗位信息总览".time()).".pdf";
		$url = 'tmp/'.$name_string;
		$urlEn='tmp/'.$name_stringEn;
		$pdf->save($url);
		return $urlEn;
	}
	
	protected function pagePmentMsprg($pdf,$page,$font)
	{
		$condition[0] = $this->_getParam('projectId',0);
		$condition[1] = null;
		//put the personal information to the pdf
		$mstprgs = new Pment_Models_MstprgMapper();
		$arrayMstprgs = $mstprgs->fetchAllJoin(null, $condition);
		$count = 1;//every page show approximately 20 pieces;
		//$arrayCount = count($arrayContacts);
		$totalItems = $arrayMstprgs->getTotalItemCount();
		$arrayMstprgs->setItemCountPerPage($totalItems);
		$pageNumber = ceil($totalItems / 25);
		$x = 0; $y = 750;
		$currentpage = 1;
		foreach($arrayMstprgs as $mstprg)
		{
			if($count == 1)
			{
				$page->setLineWidth(0.5);
				$page->drawLine(50, 770, 560, 770);
				$page->drawLine(50, 125, 560, 125);
				$page->setFont($font,13)
						->drawText("阶段号", 50, $y, 'UTF-8')
						->drawText("总进度任务名称", 100, $y, 'UTF-8')
						->drawText("开始日期", 220, $y, 'UTF-8')
						->drawText("结束日期", 320, $y, 'UTF-8')
						->drawText("工期(天)", 390, $y, 'UTF-8')
						->drawText("编制人", 470, $y, 'UTF-8');
				$time = Date("Y-m-d,H:i");
				$users = new System_Models_UserMapper();
				$contactId = $users->getContactId($this->getUserId());
				$contacts = new Employee_Models_ContactMapper();
				$contactName = $contacts->findContactName($contactId);
				$page->setFont($font,11)
						->drawText("工程岗位信息总览", 250, 790, 'UTF-8')
						->drawText("导出人:".$contactName, 50, 100, 'UTF-8')
						->drawText("导出日期:".$time, 250, 100, 'UTF-8')
						->drawText("页数:".$currentpage."(".$pageNumber.")", 500, 100, 'UTF-8');
				}
				$y -= 25;$count++;
				$page->setFont($font, 11)
						->drawText($mstprg->mstprgId, $x+=50, $y, 'UTF-8')
						->drawText($mstprg->task, $x+=100, $y, 'UTF-8')
						->drawText($mstprg->startDate, $x+=70, $y, 'UTF-8')
						->drawText($mstprg->endDate, $x+=100, $y, 'UTF-8')
						->drawText($mstprg->period, $x+=80, $y, 'UTF-8')
						->drawText($mstprg->contactName, $x+=70, $y, 'UTF-8');
			if($count >= 25)
			{
				$pdf->pages[] = $page;
				$page = $pdf->newPage(Zend_Pdf_Page::SIZE_A4);
				$count = 1;
				$y = 750;
				$currentpage++;
				}
			$x = 0;
			}
		$pdf->pages[] = $page;
		$name_string = "工程岗位信息总览".time().".pdf";
		$name_stringEn = urlencode("工程岗位信息总览".time()).".pdf";
		$url = 'tmp/'.$name_string;
		$urlEn='tmp/'.$name_stringEn;
		$pdf->save($url);
		return $urlEn;
	}
	
	protected function pagePmentMsprgDisplay($pdf,$page,$font)
	{
		//put the personal information to the pdf
		$mstprgs = new Pment_Models_MstprgMapper();
		$mstprgId = $this->_getParam('id',0);
		$mstprg = new Pment_Models_Mstprg();
		$mstprgs->find($mstprgId,$mstprg);
		$x = 50; $y = 750;
		$currentpage = 1;
		$pageNumber = 1;
		$page->setLineWidth(0.5);
		$page->drawLine(50, 770, 560, 770);
		$page->drawLine(50, 125, 560, 125);
		$page->setFont($font,13)
				->drawText("阶段号:", $x, $y-=20, 'UTF-8')
				->drawText($mstprg->getMstprgId(), $x+100, $y, 'UTF-8')

				->drawText("总进度任务名称:", $x, $y-=20, 'UTF-8')
				->drawText($mstprg->getTask(), $x+100, $y, 'UTF-8')

				->drawText("开始日期:", $x, $y-=20, 'UTF-8')
				->drawText($mstprg->getStartDate(), $x+100, $y, 'UTF-8')

				->drawText("结束日期:", $x, $y-=20, 'UTF-8')
				->drawText($mstprg->getEndDate(), $x+100, $y, 'UTF-8')

				->drawText("工期(天):", $x, $y-=20, 'UTF-8')
				->drawText($mstprg->getPeriod(), $x+100, $y, 'UTF-8')

				->drawText("编制人:", $x, $y-=20, 'UTF-8')
				->drawText($mstprg->getContactName(), $x+100, $y, 'UTF-8')

				->drawText("备注:", $x, $y-=20, 'UTF-8')
				->drawText($mstprg->getRemark(), $x+100, $y, 'UTF-8')

				->drawText("上次修改时间:", $x, $y-=20, 'UTF-8')
				->drawText($mstprg->getCTime(), $x+100, $y, 'UTF-8');
		$time = Date("Y-m-d,H:i");
		$users = new System_Models_UserMapper();
		$contactId = $users->getContactId($this->getUserId());
		$contacts = new Employee_Models_ContactMapper();
		$contactName = $contacts->findContactName($contactId);
		$page->setFont($font,11)
				->drawText("总计划进度详情", 250, 790, 'UTF-8')
				->drawText("导出人:".$contactName, 50, 100, 'UTF-8')
				->drawText("导出日期:".$time, 250, 100, 'UTF-8')
				->drawText("页数:".$currentpage."(".$pageNumber.")", 500, 100, 'UTF-8');
		$pdf->pages[] = $page;
		$name_string = "总计划进度详情".time().".pdf";
		$name_stringEn = urlencode("总计划进度详情".time()).".pdf";
		$url = 'tmp/'.$name_string;
		$urlEn='tmp/'.$name_stringEn;
		$pdf->save($url);
		return $urlEn;
	}
	
	protected function pagePmentPlogDisplay($pdf,$page,$font)
	{
		//put the personal information to the pdf
		$plogs = new Pment_Models_PlogMapper();
		$plogId = $this->_getParam('id',0);
		$plog = new Pment_Models_Plog();
		$plogs->find($plogId,$plog);
		$x = 50; $y = 750;
		$currentpage = 1;
		$pageNumber = 1;
		$page->setLineWidth(0.5);
		$page->drawLine(50, 770, 560, 770);
		$page->drawLine(50, 125, 560, 125);
		$page->setFont($font,13)
				->drawText("日期:", $x, $y-=20, 'UTF-8')
				->drawText($plog->getLogDate(), $x+150, $y, 'UTF-8')

				->drawText("天气(上午):", $x, $y-=20, 'UTF-8')
				->drawText($plog->getWeatherAm(), $x+150, $y, 'UTF-8')

				->drawText("天气(下午):", $x, $y-=20, 'UTF-8')
				->drawText($plog->getWeatherPm(), $x+150, $y, 'UTF-8')

				->drawText("最高温度(摄氏度):", $x, $y-=20, 'UTF-8')
				->drawText($plog->getTempHi(), $x+150, $y, 'UTF-8')

				->drawText("最低温度(摄氏度):", $x, $y-=20, 'UTF-8')
				->drawText($plog->getTempLo(), $x+150, $y, 'UTF-8')

				->drawText("施工部位:", $x, $y-=20, 'UTF-8')
				->drawText($plog->getPart(), $x+150, $y, 'UTF-8')

				->drawText("施工人数:", $x, $y-=20, 'UTF-8')
				->drawText($plog->getNumber(), $x+150, $y, 'UTF-8')

				->drawText("负责操作人:", $x, $y-=20, 'UTF-8')
				->drawText($plog->getOperator(), $x+150, $y, 'UTF-8')
				
				->drawText("责任工长:", $x, $y-=20, 'UTF-8')
				->drawText($plog->getForeman(), $x+150, $y, 'UTF-8')

				->drawText("安全情况:", $x, $y-=20, 'UTF-8')
				->drawText($plog->getSafety(), $x+150, $y, 'UTF-8')

				->drawText("存在问题:", $x, $y-=20, 'UTF-8')
				->drawText($plog->getProblem(), $x+150, $y, 'UTF-8')

				->drawText("解决问题:", $x, $y-=20, 'UTF-8')
				->drawText($plog->getResolve(), $x+150, $y, 'UTF-8')

				->drawText("往来文件:", $x, $y-=20, 'UTF-8')
				->drawText($plog->getRelatedFile(), $x+150, $y, 'UTF-8')

				->drawText("变更签证:", $x, $y-=20, 'UTF-8')
				->drawText($plog->getPart(), $x+150, $y, 'UTF-8')

				->drawText("材料设备情况:", $x, $y-=20, 'UTF-8')
				->drawText($plog->getMaterial(), $x+150, $y, 'UTF-8')

				->drawText("填报人:", $x, $y-=20, 'UTF-8')
				->drawText($plog->getContactName(), $x+150, $y, 'UTF-8')
				
				->drawText("备注:", $x, $y-=20, 'UTF-8')
				->drawText($plog->getRemark(), $x+150, $y, 'UTF-8')

				->drawText("创建时间:", $x, $y-=20, 'UTF-8')
				->drawText($plog->getCTime(), $x+150, $y, 'UTF-8');
		$time = Date("Y-m-d,H:i");
		$users = new System_Models_UserMapper();
		$contactId = $users->getContactId($this->getUserId());
		$contacts = new Employee_Models_ContactMapper();
		$contactName = $contacts->findContactName($contactId);
		$page->setFont($font,11)
				->drawText("日志详情", 250, 790, 'UTF-8')
				->drawText("导出人:".$contactName, 50, 100, 'UTF-8')
				->drawText("导出日期:".$time, 250, 100, 'UTF-8')
				->drawText("页数:".$currentpage."(".$pageNumber.")", 500, 100, 'UTF-8');
		$pdf->pages[] = $page;
		$name_string = "日志详情".time().".pdf";
		$name_stringEn = urlencode("日志详情".time()).".pdf";
		$url = 'tmp/'.$name_string;
		$urlEn='tmp/'.$name_stringEn;
		$pdf->save($url);
		return $urlEn;
	}
	
	protected function getUserId()
	{
		$userNamespace = new Zend_Session_Namespace('userNamespace');
		return $userNamespace->userId;
		}
}
?>