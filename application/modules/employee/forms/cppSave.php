<?php
/*created: 2011.3.27
  author: mingtingling
  version: v0.1
*/
class Employee_Forms_PostSave extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');
		$this->addElement(
			/*岗位编号项*/
			 'text','postid',array(
		        'label'=>'岗位编号:',
			    'disabled'=>'disabled',
			    'required'=>false,
			    'filters'=>array('StringTrim'),
			    'class'=>'tbLarge tbText'
		      )
		);
		$this->addElement(
			/*岗位名称*/
	         'select','postname',array(
			    'label'=>'岗位名称:',
			    'required'=>true,
			    'class'=>'tbLarge tbText'
		      )
		);
		$this->addElement(
			/*姓名*/
		     'text','contactname',array(
			    'label'=>'姓名:',
			    'required'=>true,
			    'class'=>'tbLarge tbText'
		      )
		);
		$this->addElement(
			/*所属工程*/
		     'select','projectname',array(
			    'label'=>'所属工程:',
			    'required'=>true,
			    'class'=>'tbLarge tbText'
		      )
		);
	    $this->addElement(
			/*岗位证类别*/
		     'text','posttype',array(
			    'label'=>'岗位证类别:',
			    'required'=>false,
			    'class'=>'tbLarge tbText'
		      )
		);
		$this->addElement(
			/*岗位证编号*/
		     'text','postcardid',array(
			    'label'=>'岗位证编号:',
			    'required'=>false,
			    'class'=>'tbLarge tbText'
		      )
		);
		$this->addElement(
			/*安全能力考核证编号*/
		      'text','certid',array(
			    'label'=>'安全能力考核证编号:',
			    'required'=>false,
			    'class'=>'tbLarge tbText'
		      )
		);
       $this->addElement(
			/*联系电话*/
		      'text','contactno',array(
			    'label'=>'联系电话:',
			    'required'=>false,
			    'class'=>'tbLarge tbText'
		      )
		);
       $this->addElement(
			/*其他联系方式*/
		      'text','othercontact',array(
			    'label'=>'其他联系方式:',
			    'required'=>false,
			    'class'=>'tbLarge tbText'
		      )
		);
       $this->addElement(
			/*备注*/
		      'textarea','remark',array(
			    'label'=>'备注:',
			    'required'=>false,
			    'class'=>'tbLarge tbText'
		      )
		);

	   $this->addElement(
		      'submit','submit',array(
		         'ignore'=>true,
		         'class'=>'btConfirm radius',
		         'name'=>'submit'
	          )
	   );
	  $this->addElement(
		      'submit','submit2',array(
		          'ignore'=>true,
		          'class'=>'btConfirm radius',
		          'name'=>'submit'
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