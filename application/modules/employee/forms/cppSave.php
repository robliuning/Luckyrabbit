<?php
/*created: 2011.3.27
  author: mingtingling
  review:mingtingling rob
  review time:2011.4.3
*/
class Employee_Forms_CppSave extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');

		$this->addElement(
			/*员工姓名*/
		     'text','name',array(
			    'label'=>'员工姓名:',
			    'required'=>true,
			    'class'=>'tbLarge tbText ac_contactName'
		      )
		);
		$this->addElement(
			/*岗位名称*/
	         'select','postId',array(
			    'label'=>'岗位名称:',
			    'required'=>true,
			    'class'=>'tbLarge tbText'
		      )
		);
		$this->addElement(
			/*所属工程*/
		     'select','projectId',array(
			    'label'=>'所属工程:',
			    'required'=>true,
			    'class'=>'tbLarge tbText'
		      )
		);
	    $this->addElement(
			/*岗位证类别*/
		     'text','postType',array(
			    'label'=>'岗位证类别:',
			    'required'=>false,
			    'class'=>'tbLarge tbText'
		      )
		);
		$this->addElement(
			/*岗位证编号*/
		     'text','postCardId',array(
			    'label'=>'岗位证编号:',
			    'required'=>false,
			    'class'=>'tbLarge tbText'
		      )
		);
		$this->addElement(
			/*安全能力考核证编号*/
		      'text','certId',array(
			    'label'=>'安全能力考核证编号:',
			    'required'=>false,
			    'class'=>'tbLarge tbText'
		      )
		);

	   $this->addElement(
		   /*按钮一*/
		      'submit','submit',array(
		         'ignore'=>true,
		         'class'=>'btConfirm radius',
		         'name'=>'submit'
	          )
	   );
	  $this->addElement(
		  /*按钮二*/
		      'submit','submit2',array(
		          'ignore'=>true,
		          'class'=>'btConfirm radius',
		          'name'=>'submit'
	          )
	  );
	  		$this->addElement(
		     /*员工姓名对应的Id,隐藏域*/
		      'text','contactId',array(
			    'required'=>false,
			    'class'=>'hide ac_contactId'
			  )
		);
				
      $this->setElementDecorators(array(
              'ViewHelper','Errors',
                  array(array('data'=>'HtmlTag'),
                  array('tag'=>'td','class'=>'element')),
                  array('Label',array('tag'=>'td')),
                  array(array('row'=>'HtmlTag'),array('tag'=>'tr'))
   	    	 )
	);

		$this->setDecorators(array(
            'FormElements',
            array('HtmlTag',array('tag'=>'table')),
            'Form'
            )
	);

	}
}
?>