<?php

require_once(__DIR__ . '/Funcs.php');

/**
 * Parser and generator todo tag
 */
class Todo_Util_TodoParser {
    
    /**
     * @var Date|null
     */
    protected $start = null;
    
    /**
     * @var Date|null
     */
    protected $due = null;
    
    /**
     * @var Date|null
     */
    protected $completedDate = null;
    
    /**
     * @var string[]|null
     */
    protected $todoUsers = null;
    
    /**
     * @var string|null
     */
    protected $todoUser = null;
    
    /**
     * @var boolean
     */
    protected $checked = false;
    
    /**
     * @var string|null
     */
    protected $completedUser = null;
    
    /**
     * @var string|null
     */
    protected $userName = null;
    
    /**
     * @var boolean|null
     */
    protected $showDate = null;
    
    public function __construct() {
        
    }
    
    public function parse($str) {
        
    }
    
    public function parseTodoArgs($str) {
        $this->resetValues();
        $options = explode(' ', $str);
        foreach($options as $option) {
            $option = trim($option);
            if ($option[0] === '@') {
                $this->todoUsers = [];
                $this->todoUsers[] = substr($option, 1); //fill todousers array
                if($this->todoUser === null) $this->todoUser = substr($option, 1); //set the first/main todouser
            } else if ($option[0] === '#') {
                $this->checked = true;
                @list($completeduser, $completeddate) = explode(':', $option, 2);
                $this->completedUser = substr($completeduser, 1);
                $completeddate = Todo_Util_Funcs::parseDate($completeddate);
                if ($completeddate !== null) {
                    $this->completedDate = $completeddate;
                }
            } else {
                @list($key, $value) = explode(':', $option, 2);
                switch ($key) {
                    case 'username':
                        if(in_array($value, array('user', 'real', 'none'))) {
                            $this->userName = $value;
                        }
                        break;
                    case 'start':
                        $value = Todo_Util_Funcs::parseDate($value);
                        if($value !== null) {
                            $this->start = $value;
                        }
                        break;
                    case 'due':
                        $value = Todo_Util_Funcs::parseDate($value);
                        if ($value !== null) {
                            $this->due = $value;
                        }
                        break;
                    case 'showdate':
                        $value = Todo_Util_Funcs::parseBool($value);
                        if($value !== null) {
                            $this->showDate = $value;
                        }
                        break;
                    default:
                        # code...
                        break;
                }
            }
        }
    }
    
    public function generateSourceTag() {
        return '';
    }
    
    public function generateViewTag() {
        return '';
    }
    
    protected function resetValues() {
        $this->start = null;
        $this->due = null;
        $this->completedDate = null;
        $this->todoUsers = null;
        $this->todoUser = null;
        $this->checked = false;
        $this->completedUser = null;
        $this->showDate = null;
    }
    
}