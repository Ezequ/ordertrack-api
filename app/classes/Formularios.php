<?php

class Formularios
{
	public $form;

	public $errors = null;

	public $_rules = null;

	public function __construct() {
			$this->form 			= '';
		}

	public function setErrors($errors)
	{
		$this->errors = $errors;
	}
		
	public function cabecera($titulo,$msg)
	{
		$this->form .= '

		<div class="row">
          <div class="col-lg-12">
            <h1>'.$titulo.'</h1>
            <div class="alert alert-info alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              '.$msg.'
            </div>
          </div>
        </div><!-- /.row -->         
        ';
	}

	public function inicioForm($metodo,$action)
	{
		$this->form .= '
		    <form role="form" method="'.$metodo.'" action="'.$action.'">
		';
	}
	
	public function inicioFormFile($metodo,$action)
	{
		$this->form .= '
			<form role="form" method="'.$metodo.'" action="'.$action.'" enctype="multipart/form-data">
		';
	}

	public function finForm()
	{
		$this->form .= '
			</form>
		';
	}

	public function generarForm()
	{			   
	    echo $this->form;
	}

	public function addSubmit($label,$name,$value)
	{
		$this->form .=  '
			<button type="submit" class="btn btn-default" name="'.$name.'" value="'.$value.'">'.$label.'</button>
        ';
	}
	
	public function addLinkButton($label,$link)
	{
		$this->form .=  '
		<div class="form-group $this->getErrorClass($name)" style="display:-webkit-inline-box;">
			<div class="botones_columna"><a class="btn btn-default"  href="'.$link.'">'.$label.'</a></div>
		</div>
        ';
	}

	public function addText($text)
	{
		$this->form .=  '
			<span>' . $text . '</span>
        ';
	}

	public function addClean($label)
	{
		$this->form .=  '
			<button type="reset" class="btn btn-default">'.$label.'</button>
        ';
	}

	public function addTextArea($label,$name,$value)
	{
		$this->form .=  '
			<div class="form-group ' . $this->getErrorClass($name) . '">
              <label>'.$label. $this->getRequired($name) .'</label>
              <textarea class="form-control" rows="5" name="'.$name.'">'.$value.'</textarea>
            </div>
        ';
	}

	public function addInput($label,$name,$value,$type, $placeholder = "Ingrese dato")
	{
		$this->form .=  '
			<div class="form-group' . $this->getErrorClass($name) . '">
                <label>'.$label. $this->getRequired($name) .'</label>
                <input type="'.$type.'" class="form-control" placeholder="'.$placeholder.'" name="'.$name.'" value="'.$value.'">
              </div>
        ';
	}

	public function addInputSimple($label,$name,$value,$type, $placeholder = "Ingrese dato")
	{
		$this->form .=  '
            <input type="'.$type.'" class="form-control" placeholder="'.$placeholder.'" name="'.$name.'" value="'.$value.'">
        ';
	}

	public function addInputFecha($label,$name,$value)
	{
		$this->form .=  '
			<div class="form-group $this->getErrorClass($name)">
                <label>'.$label. $this->getRequired($name) .'</label>
                <input type="date" class="form-control" placeholder="Ingrese fecha dd/mm/aa" name="'.$name.'" value="'.$value.'">
              </div>
        ';
	}

	public function addCheckBox($label,$name,$value,$checked)
	{
		$this->form .=  '
			<div class="form-group $this->getErrorClass($name)">
              <div class="checkbox3 checkbox-success checkbox-inline checkbox-check  checkbox-circle">
				  <input type="checkbox" id="'.$name.'" value="'.$value.'" name="'.$name.'" ';
                  if($checked){$this->form .= 'checked';}
        			
        			$this->form .=  '>
				  <label for="'.$name.'">
				    '.$label. $this->getRequired($name) .'
				  </label>
				</div>
			</div>
        ';
	}

	public function addBack($url ="#", $label = "Volver", $moreUrl = "")
	{
		$this->form .=  '
			<a class="btn btn-danger" href="'.$url.'">'.$label.'</a>
        ';
	}

	public function addHiddenInput($name,$value)
	{
		$this->form .= '
			<input type="hidden" name="'.$name.'" value="'.$value.'"/>
        ';
	}
	
	public function addComboBox($label,$name,$arr,$seleccionada,$script)//$arr["value"=>"valor_a_mostrar"]
	{
		$selected = "";
		//ej script: onchange="javascript:id_superior_onChange(this.value);"
		$this->form .=  '
			<div class="form-group' . $this->getErrorClass($name) . '">
                  <label>'.$label. $this->getRequired($name) .'</label>
	              <select class="form-control" name="'.$name.'" onchange="javascript:'.$script.'">
	              	<option value="0"></option>
				  	';
				  	foreach($arr as $key=>$value)
				  	{
				  		if($seleccionada == $key){$selected = "selected";};										
						$this->form .= '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
						$selected = "";
					}			  	
				  	$this->form .='
				  </select>
			</div>
        ';
	}

	public function addListOfInputs($title, $extra, $inputs) {
		
		$this->form .= '<div class="sub-title">' . $title . '</div>';

		$columns = $extra['columns'];
		$column_i = 0;

		$this->form .=  '
		<div class=" col-md-12 no-padding no-margin">
			<div class=" col-md-' . $extra['column_width'] . ' no-margin no-padding">
	            <table class="table table-bordered table-responsive">
        ';


        $this->form .=  '
	        		<thead>
	            		<tr>
        ';

        foreach ($extra['headers'] as $key => $value) {
        	$this->form .=  '<th>' . $value . '</th>';
		}

		$this->form .=  '
	            		</tr>
	            	</thead>
	            	<tbody>
        ';

        foreach ($inputs as $key => $input) 
        {
        	if($column_i == 0) {
        		$this->form .=  '<tr>';
        	}

        	$this->form .=  '<td class="text-center" style="vertical-align: middle;">';

        	if($input['type'] == 'text') {
        	
        		$this->addText($input['text']);
        	
        	} else {

	        	for ($i=1; $i < 6; $i++) {
	            	if(!isset($input['data'.$i])) $input['data'.$i] = ""; 
	        	}
	        	$this->addGenericInput($input['type'], $input['data1'],  $input['data2'],  $input['data3'],  $input['data4'],  $input['data5']);
        	}
        	
        	$this->form .=  '</td>';

        	$column_i++;

        	if($column_i == $columns) {
        		$this->form .=  '</tr>';
        		$column_i = 0;
        	}
        }

        $this->form .=  '
	        		</tbody>
	            </table>
	        </div>
        </div>
        ';
	}

	public function addGenericInput($input, $data1="", $data2="", $data3="", $data4="", $data5="")
	{
		switch ($input) {
			case 'common':
				$data3 = Input::old($data2) !== null ? Input::old($data2) : $data3;
				return $this->addInput($data1,$data2,$data3,$data4,$data5);	//($label,$name,$value,$type, $placeholder = "Ingrese dato")
				break;
			case 'common_simple':
				$data3 = Input::old($data2) !== null ? Input::old($data2) : $data3;
				return $this->addInputSimple($data1,$data2,$data3,$data4,$data5);	//($label,$name,$value,$type, $placeholder = "Ingrese dato")
				break;
			case 'text':
				$data3 = Input::old($data2) !== null ? Input::old($data2) : $data3;
				return $this->addTextArea($data1,$data2,$data3); // ($label,$name,$value)
				break;
			case "checkbox":
				return $this->addCheckBox($data1,$data2,$data3, $data4); //($label,$name,$value,$checked)
				break;
			case 'hidden':
				return $this->addHiddenInput($data1,$data2); // ($name,$value)
				break;
			case 'select':
				$data4 = Input::old($data2) !== null ? Input::old($data2) : $data4;
				return $this->addComboBox($data1, $data2,$data3, $data4,$data5);//($label,$name,$arr,$seleccionada,$script);
				break;
			default:
				break;
		}
	}

	public function getErrorClass($name)
	{
		if ($this->errors && $this->errors->has($name))
			return " has-error";
	}

	public function setRules($rules)
	{
		$this->_rules = $rules;
	}

	public function getRequired($name)
	{
		if (isset($this->_rules[$name]) && strpos($this->_rules[$name],"required") !== false){
			return '<font style="color:red"> *</font>';
		} else {
			return "";
		}
	}
}