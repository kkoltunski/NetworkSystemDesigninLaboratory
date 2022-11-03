<?php

require_once $conf->root_path.'/lib/smarty/Smarty.class.php';
require_once $conf->root_path.'/lib/Messages.class.php';
require_once $conf->root_path.'/app/CreditCalcForm.class.php';

class CreditCalcCtrl 
{
	private $msgs;
	private $form;
	private $result;

	public function __construct(){
		$this->msgs = new Messages();
		$this->form = new CreditCalcForm();
        $this->result = null;
	}
	
    private function getParams()
    {
        $this->form->amount = isset($_REQUEST['x']) ? $_REQUEST['x'] : null;
        $this->form->years = isset($_REQUEST['y']) ? $_REQUEST['y'] : null;
        $this->form->interestRate = isset($_REQUEST['z']) ? $_REQUEST['z'] : null;	
    }

	private function validate() {
		if (! (isset($this->form->amount) && isset($this->form->years) && isset($this->form->interestRate))) {
			return false;
		}
		
        if ($this->form->amount == "") $this->msgs->addError('Amount field is empty.');
        if ($this->form->years == "") $this->msgs->addError('Years count is empty.');
        if ($this->form->interestRate == "") $this->msgs->addError('Interest rate field is empty.');
		
		if (! $this->msgs->isError()) 
        {
            if (!is_numeric($this->form->amount) || ($this->form->amount<=0)) 
            {
                $this->msgs->addError('Amount is not a proper value.');
            }
            if (!is_numeric($this->form->years) || ($this->form->years<=0)) 
            {
                $this->msgs->addError('Year count is not a proper value.');
            }	
            if (!is_numeric($this->form->interestRate) || ($this->form->interestRate<0)) 
            {
                $this->msgs->addError('Interest rate is not a proper value.');
            }
		}
		
		return ! $this->msgs->isError();
	}
	
	public function process(){
		$this->getparams();
		
		if ($this->validate()) 
        {		
            $this->form->amount = floatval($this->form->amount);
            $this->form->years = intval($this->form->years);
            $this->form->interestRate = floatval($this->form->interestRate);
            
            $this->result = ($this->form->amount * $this->form->interestRate) / $this->form->years;
			
			$this->msgs->addInfo('Result computed.');
		}
		
		$this->generateView();
	}
	
	private function generateView(){
		global $conf;
		
		$smarty = new Smarty();
		$smarty->assign('conf',$conf);
		
        $smarty->assign('page_title','Credit calculator');
        $smarty->assign('page_description','Application to credit calculation');
		
		$smarty->assign('msgs',$this->msgs);
		$smarty->assign('form',$this->form);
		$smarty->assign('result',$this->result);
		
		$smarty->display($conf->root_path.'\app\creditCalc.html');
	}
}
