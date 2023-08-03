<?php
class utility {
    var $skey = "50213CSIRIMMTBBS"; // change this 

    public  function safe_b64encode($string) {
        $data = base64_encode($string);
        $data = str_replace(array('+','/','='),array('-','_',''),$data);
        return $data;
    }

    public function safe_b64decode($string) {
        $data = str_replace(array('-','_'),array('+','/'),$string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }

    public  function encode($value){ 
	/*
        if(!$value){return false;}
        $text = $value;
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->skey, $text, MCRYPT_MODE_ECB, $iv);
        return trim($this->safe_b64encode($crypttext)); 
		*/

		$simple_string = $value; 
		$ciphering = "AES-128-CTR"; 
		$iv_length = openssl_cipher_iv_length($ciphering); 
		$options = 0; 
		$encryption_iv = '1234567891011121'; 
		$encryption_key = "BikramWrox"; 
		$encryption = openssl_encrypt($simple_string, $ciphering, $encryption_key, $options, $encryption_iv); 
		return trim($encryption);
    }

    public function decode($value){
		/*
        if(!$value){return false;}
        $crypttext = $this->safe_b64decode($value); 
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->skey, $crypttext, MCRYPT_MODE_ECB, $iv);
        return trim($decrypttext);
		*/
		$simple_string = $value; 
		$ciphering = "AES-128-CTR"; 
		$options = 0; 
		$decryption_iv = '1234567891011121'; 
		$decryption_key = "BikramWrox"; 
		$decryption=openssl_decrypt($simple_string, $ciphering, $decryption_key, $options, $decryption_iv);
		return trim($decryption);
    }
	
	public function GET_CUR_DT_INT()
	{
		date_default_timezone_set('Asia/Kolkata');
		return trim(date("YmdHis"));
	}
	
}


?>