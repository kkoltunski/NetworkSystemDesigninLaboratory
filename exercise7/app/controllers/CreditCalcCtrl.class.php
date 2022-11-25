<?php

namespace app\controllers;
use app\forms\CreditCalcForm;

class CreditCalcCtrl 
{
	private $form;
	private $result;

	public function __construct(){
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

        if ($this->form->amount == "") getMessages()->addError('Amount field is empty.');
        if ($this->form->years == "") getMessages()->addError('Years count is empty.');
        if ($this->form->interestRate == "") getMessages()->addError('Interest rate field is empty.');
		
		if (! getMessages()->isError()) 
        {
            if (!is_numeric($this->form->amount) || ($this->form->amount<=0)) 
            {
                getMessages()->addError('Amount is not a proper value.');
            }
            if (!is_numeric($this->form->years) || ($this->form->years<=0)) 
            {
                getMessages()->addError('Year count is not a proper value.');
            }	
            if (!is_numeric($this->form->interestRate) || ($this->form->interestRate<0)) 
            {
                getMessages()->addError('Interest rate is not a proper value.');
            }
		}
		
		return !getMessages()->isError();
	}
	
	public function action_calcCompute(){
		$this->getparams();
		
		if ($this->validate()) 
        {	
            if(inRole('admin'))
            {
                $this->form->amount = floatval($this->form->amount);
                $this->form->years = intval($this->form->years);
                $this->form->interestRate = floatval($this->form->interestRate);
                
                $this->result = ($this->form->amount * $this->form->interestRate) / $this->form->years;
                
                getMessages()->addInfo('Result computed.');
            }
            else
            {
                getMessages()->addError('Only admin can calculate.');
            }
		}

		$this->insertToDB();
		$this->generateView();
	}
	
	public function action_calcShow(){
		$this->generateView();
	}

	public function generateView(){
		getSmarty()->assign('page_title','Credit calculator');
        getSmarty()->assign('page_description','Application to credit calculation');
		getSmarty()->assign('form',$this->form);
		getSmarty()->assign('result',$this->result);

		getSmarty()->display('creditCalcView.tpl');
	}

    public function insertToDB()
    {
        getDB()->insert("result", [
            "value" => $this->result,
        ]);
	}
}
