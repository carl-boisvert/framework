<?php


class Log{

  /**
   * @var string
   * Represent the directory you want to use to keep you log file in
   */
  public $path = 'log\\';
  /**
   * @var bool
   * If erase is set to true, the log file will simply be overwritten.
   */
  public $erase = false;
  /**
   * @var string
   * By default, the name of the log file will be based on a numeric index.
   * The method can also be based on a date index.
   *
   */
  public $method = "number";

  private $logType = array(
    "LOG",
    "WARNING",
    "ERROR"
  );


  public function write($message,$type="LOG"){
    if(in_array($type,$this->logType)){
      $file = fopen(APP.$this->path.$this->getFileName(),"w");
      fwrite($file,$this->getMessage($message,$type));
      fclose($file);
    }
    else{
      throw new Exception("The log type you specified doesn't exist. The value accepted are: ".implode(",",$this->logType));
    }

  }

  private function getFileName(){
    if(!$this->erase){
      if($this->method == "number")
        return $this->getCountFile().'.txt';
      else if($this->method == "date")
        return (new DateTime())->format("d-m-y").'.txt';
      else
        throw new Exception("The log file name method you choose do not exist.");
    }
  }

  private function getCountFile(){
    return count(glob(APP.'log/*.txt'))+1;
  }

  private function getMessage($message,$type){
    return $type.": ".(new DateTime())->format("d-m-y H:i:s").': '.$message;
  }
}