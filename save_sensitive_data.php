<?php

require_once('./include/php/basic_defines.inc');
require_once('./include/php/db_connect.inc');


// Test code

    $objEncManager = new DataEncryptor();

    $sensitiveData = "7890";
    echo "Raw Data: _" . $sensitiveData . "_<br><br>";

    $encryptedData = $objEncManager->mcryptEncryptString( $sensitiveData );
    echo "Enc Data: _" . $encryptedData . "_<br><br>";
    echo "Enc Data length: " . strlen( $encryptedData) . "<br><br>";

    $decryptedData = $objEncManager->mcryptDecryptString( $encryptedData, $objEncManager->lastIv );
    echo "D-enc Data: _" . $decryptedData . "_<br><br>";

    echo "IV: _" . $objEncManager->lastIv . "_<br><br>";


/*
 * Note: These functions do not accurately handle cases where the data 
 * being encrypted have trailing whitespace so the data
 *       encrypted by them must not have any. Leading whitespace is okay.
 *  
 * Note: If your data needs to be passed through a non-binary safe medium you should
 * base64_encode it but this makes the data about 33% larger.
 * 
 * Note: The decryption IV must be the same as the encryption IV so the encryption
 * IV must be stored or transmitted with the encrypted data.
 * From (http://php.net/manual/en/function.mcrypt-create-iv.php)... 
 * "The IV is only meant to give an alternative seed to the encryption routines. 
 * This IV does not need to be secret at all, though it can be desirable. 
 * You even can send it along with your ciphertext without losing security."
 * 
 * Note: These methods don't do any error checking on the success of the various mcrypt functions
 */
class DataEncryptor
{
    const MY_MCRYPT_CIPHER        = MCRYPT_RIJNDAEL_256;
    const MY_MCRYPT_MODE          = MCRYPT_MODE_CBC;
    const MY_MCRYPT_KEY_STRING    = "1234567890-abcDEFGHUzyxwvutsrqpo"; // This should be a random string, recommended 32 bytes

    public  $lastIv               = '';


    public function __construct()
    {
        // do nothing
    }


    /**
     * Accepts a plaintext string and returns the encrypted version
     */
    public function mcryptEncryptString( $stringToEncrypt, $base64encoded = true )
    {
        // Set the initialization vector
            $iv_size      = mcrypt_get_iv_size( self::MY_MCRYPT_CIPHER, self::MY_MCRYPT_MODE );
            $iv           = mcrypt_create_iv( $iv_size, MCRYPT_RAND );
            $this->lastIv = $iv;

        // Encrypt the data
            $encryptedData = mcrypt_encrypt( self::MY_MCRYPT_CIPHER, self::MY_MCRYPT_KEY_STRING, $stringToEncrypt , self::MY_MCRYPT_MODE , $iv );

        // Data may need to be passed through a non-binary safe medium so base64_encode it if necessary. (makes data about 33% larger)
            if ( $base64encoded ) {
                $encryptedData = base64_encode( $encryptedData );
                $this->lastIv  = base64_encode( $iv );
            } else {
                $this->lastIv = $iv;
            }

        // Return the encrypted data
            return $encryptedData;
    }


    /**
     * Accepts a plaintext string and returns the encrypted version
     */
    public function mcryptDecryptString( $stringToDecrypt, $iv, $base64encoded = true )
    {
        // Note: the decryption IV must be the same as the encryption IV so the encryption IV must be stored during encryption

        // The data may have been base64_encoded so decode it if necessary (must come before the decrypt)
            if ( $base64encoded ) {
                $stringToDecrypt = base64_decode( $stringToDecrypt );
                $iv              = base64_decode( $iv );
            }

        // Decrypt the data
            $decryptedData = mcrypt_decrypt( self::MY_MCRYPT_CIPHER, self::MY_MCRYPT_KEY_STRING, $stringToDecrypt, self::MY_MCRYPT_MODE, $iv );

        // Return the decrypted data
            return rtrim( $decryptedData ); // the rtrim is needed to remove padding added during encryption
    }


}


?>